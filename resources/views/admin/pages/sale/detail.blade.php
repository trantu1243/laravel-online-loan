@extends('admin.layouts.index')

@section('title', 'Sale')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Chi tiết khách hàng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sale</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Infomation</a>
                        </li>

                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Tên</label>
                                            <input type="text" class="form-control " placeholder="Enter ..." value="{{ $customer->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">SĐT</label>
                                            <input type="text" class="form-control " placeholder="Enter ..." value="{{ $customer->phone }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">CCCD</label>
                                    <input type="text" class="form-control " placeholder="Enter ..." value="{{ $customer->idCard }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Nhóm khách hàng</label>
                                    <input type="text" class="form-control " placeholder="Enter ..." value="{{ $customer->salaryType }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Thời gian gọi</label>
                                    <input type="text" class="form-control " placeholder="Enter ..." value="{{ $customer->timeCall }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Sale nhận xử lý</label>
                                    <input type="text" class="form-control " placeholder="Enter ..." value="{{  $customer->sale ? $customer->Sale->name : '-' }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Thẩm định viên nhận xử lý</label>
                                    <input type="text" class="form-control " placeholder="Enter ..." value="{{  $customer->censor ? $customer->Censor->name : '-' }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Status: </label>
                                        @php
                                        $status = $customer->status;
                                        $btn = 'primary';
                                        if ($customer->status === 'SALE') {
                                            $status = 'Đang gọi';
                                            $btn = 'info';
                                        }
                                        elseif ($customer->status === 'PENDING') {
                                            $status = 'Đang xử lý';
                                            $btn = 'primary';
                                        }
                                        elseif ($customer->status === 'CENSOR') {
                                            $status = 'Đang duyệt';
                                            $btn = 'warning';
                                        }
                                        elseif ($customer->status === 'FILL') {
                                            $status = 'Đang điền tt';
                                            $btn = 'info';
                                        }
                                        elseif ($customer->status === 'DONE') {
                                            $status = 'Done';
                                            $btn = 'success';
                                        }
                                        elseif ($customer->status === 'DISABLE') {
                                            $status = 'Disable';
                                            $btn = 'danger';
                                        }
                                    @endphp
                                    <div class="btn btn-{{ $btn }} btn-sm">{{ $status }}</div>
                                </div>
                                <div class="form-group">
                                    @if ($customer->status === 'SALE')
                                        <label style="display: block">Xác nhận khách hàng đồng ý(hoặc hủy khi khách hàng ko đồng ý) và tạo tạo link lấy thông tin cấp 2:</label>
                                        <form action="{{ Route('cancel-customer', ['id' => $customer->id]) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-default" id="">Hủy bỏ</button>
                                        </form>
                                        <form id="confirmationForm" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" id="confirmButton">Xác nhận và tạo link</button>
                                        </form>
                                    @elseif ($customer->status === 'FILL' || $customer->status === 'CENSOR')
                                        <form id="confirmationForm" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" id="confirmButton">Tạo lại link</button>
                                        </form>
                                    @endif

                                </div>
                                <div class="form-group hidden" id="formLink">
                                    <label for="">Link update thông tin xác minh cấp 2</label>
                                    <input type="text" class="form-control " id="resultLink" placeholder="Enter ..." value="" disabled>
                                    <div style="margin-top: 10px">
                                        <button class="btn btn-outline-secondary" type="button" id="copyButton"><i class="fa fa-clone"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('confirmationForm').onsubmit = async function(e) {
        e.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/admin/gen-link', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                id: "{{ $customer->id }}"
            })
        });

        if (response.ok) {
            const data = await response.json();
            console.log(data);
            const resultLinkInput = document.getElementById('resultLink');
            resultLinkInput.value = data.link;

            const formLink = document.getElementById('formLink');
            formLink.classList.remove('hidden');
        } else {
            console.error('Error:', response.statusText);
        }
    }
</script>
<script>
    document.getElementById('copyButton').addEventListener('click', () => {
        const resultLink = document.getElementById('resultLink');
        resultLink.disabled = false;
        resultLink.select();
        document.execCommand('copy');
        resultLink.disabled = true;
        resultLink.blur();
        alert('Đã sao chép link');
    });
</script>

@endsection
