@extends('admin.layouts.index')

@section('title', 'Censor')

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
            <li class="breadcrumb-item active">Censor</li>
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
                                    <label for="" style="display: block">Mặt trước cccd</label>
                                    <img src="{{ $customerInfo->frontCCCD }}" width="640"/>
                                </div>
                                <div class="form-group">
                                    <label for="" style="display: block">Mặt sau cccd</label>
                                    <img src="{{ $customerInfo->backCCCD }}" width="640" />
                                </div>
                                <div class="form-group">
                                    <label for="" style="display: block">Khuôn mặt</label>
                                    <img src="{{ $customerInfo->faceData }}" width="640" />
                                </div>
                                <div class="form-group">
                                    <label for="" >Bảng lương: </label>
                                    <a href="{{ $customerInfo->salary_slip }}"  target="_blank">Xem bảng lương</a>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="confirm" name="confirm" value="confirm" checked disabled>
                                        <label for="confirm" class="custom-control-label">Xác nhận hợp đồng điện tử</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="accept" name="accept" value="accept" checked disabled>
                                        <label for="accept" class="custom-control-label">Tôi đồng ý với Điều khoản xử lý dữ liệu cá nhân và Điều khoản giao dịch</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if ($customer->status == "CENSOR")
                                        <label style="display: block">Kiểm duyệt thông tin khách hàng:</label>
                                        <form action="{{ Route('censor-cancel', ['id' => $customer->id]) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-default" id="">Hủy bỏ</button>
                                        </form>
                                        <form action="{{ Route('browse', ['id' => $customer->id]) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" id="confirmButton">Xác nhận duyệt và chuyển tiền</button>
                                        </form>
                                    @endif

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
@endsection
