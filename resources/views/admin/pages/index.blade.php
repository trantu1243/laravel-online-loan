@extends('admin.layouts.index')

@section('title', 'Dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách khách hàng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('dashboard') }}" method="GET">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="idCard">CCCD</label>
                                        <input name="idCard" type="text" class="form-control" id="idCard" value="{{$idCard}}" placeholder="Enter CCCD" autocomplete="none">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input name="phone" type="text" class="form-control" id="phone" value="{{$phone}}" placeholder="Enter SĐT" autocomplete="none">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">-- Lựa chọn trạng thái --</option>
                                            <option value="PENDING" {{ $status == "PENDING" ? "selected" : ""}}>Đang xử lý</option>
                                            <option value="SALE" {{ $status == "SALE" ? "selected" : ""}}>Đang gọi</option>
                                            <option value="FILL" {{ $status == "FILL" ? "selected" : ""}}>Đang điền tt</option>
                                            <option value="CENSOR" {{ $status == "CENSOR" ? "selected" : ""}}>Đang duyệt</option>
                                            <option value="TRANSFER" {{ $status == "TRANSFER" ? "selected" : ""}}>Đang chuyển tiền</option>
                                            <option value="DONE" {{ $status == "DONE" ? "selected" : ""}}>Done</option>
                                            <option value="DISABLE" {{ $status == "DISABLE" ? "selected" : ""}}>Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="status">Sale</label>
                                        <select class="form-control" name="sale">
                                            <option value="">-- Lựa chọn --</option>
                                            @foreach ($sales as $item)
                                                <option value="{{ $item->id }}" {{ $sale == $item->id ? "selected" : ""}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="status">Thẩm định viên</label>
                                        <select class="form-control" name="censor">
                                            <option value="">-- Lựa chọn --</option>
                                            @foreach ($censors as $item)
                                                <option value="{{ $item->id }}" {{ $censor == $item->id ? "selected" : ""}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">

                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Filter</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Danh sách khách hàng</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>CCCD</th>
                          <th>Tên</th>
                          <th>SĐT</th>
                          <th style="width: 200px">Nhóm</th>
                          <th>Thời gian gọi</th>
                          <th>Status</th>
                          <th>Sale</th>
                          <th>Censor</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($customers as $item)
                              <tr>
                                    @php
                                        $idCard = $item->idCard;
                                        $maskedIdCard = Str::substr($idCard, 0, 1) . str_repeat('*', 5) . Str::substr($idCard, -1);
                                    @endphp
                                    <td>{{ $maskedIdCard }}</td>
                                    @php
                                        $name = $item->name;
                                        $maskedName = Str::substr($name, 0, 1) . str_repeat('*', 5) . Str::substr($name, -1);
                                    @endphp
                                    <td>{{ $maskedName }}</td>
                                    @php
                                        $phone = $item->phone;
                                        $masked = Str::substr($phone, 0, 1) . str_repeat('*', 5) . Str::substr($phone, -1);
                                    @endphp
                                    <td>{{ $masked }}</td>
                                    <td style="width: 250px" class="break-word">{{ $item->salaryType }}</td>
                                    <td style="width: 250px" class="break-word">{{ $item->timeCall }}</td>
                                    @php
                                        $status = $item->status;
                                        $btn = 'primary';
                                        if ($item->status === 'SALE') {
                                            $status = 'Đang gọi';
                                            $btn = 'info';
                                        }
                                        elseif ($item->status === 'PENDING') {
                                            $status = 'Đang xử lý';
                                            $btn = 'primary';
                                        }
                                        elseif ($item->status === 'CENSOR') {
                                            $status = 'Đang duyệt';
                                            $btn = 'warning';
                                        }
                                        elseif ($item->status === 'FILL') {
                                            $status = 'Đang điền tt';
                                            $btn = 'info';
                                        }
                                        elseif ($item->status === 'TRANSFER') {
                                            $status = 'Đang chuyển tiền';
                                            $btn = 'warning';
                                        }
                                        elseif ($item->status === 'DONE') {
                                            $status = 'Done';
                                            $btn = 'success';
                                        }
                                        elseif ($item->status === 'DISABLE') {
                                            $status = 'Disable';
                                            $btn = 'danger';
                                        }
                                    @endphp
                                    <td><span class="badge bg-{{ $btn }}">{{ $status }}</span></td>
                                    <td>{{ $item->sale ? $item->Sale->name : '-' }}</td>
                                    <td>{{ $item->censor ? $item->Censor->name : '-' }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-warning btn-sm" href="{{ Route('edit-customer-info', ['id' => $item->id]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm delete-button" data-id="{{ $item->id }}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </td>
                              </tr>
                          @endforeach


                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      {{ $customers->links('pagination::bootstrap-4') }}
                  </div>


                  <div class="card-footer">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div>
                                <label for="">Tổng khách hàng đã vay: </label>
                                <p style="display: inline">{{ $count }}</p>
                            </div>
                            <div>
                                <label for="" >Tổng tiền đã giải ngân: </label>
                                <p style="display: inline">{{ number_format($total*1000000, 0, ',') }} vnd</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ Route('export-customer') }}" target="_blank">
                                    <i class="fa fa-download"></i>
                                    Export
                                </a>
                            </li>
                          </ol>
                        </div>
                      </div>

                </div>
                </div>
                <!-- /.card -->
            </div>

          </div>
    </div>
</section>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="content-popup">
                Bạn có chắc chắn muốn xóa không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" id="deleteButton" href="">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div data-base-url="{{ route('delete-customer-info', ['id' => 'PLACEHOLDER']) }}" id="urlBasePlaceholder"></div>
<script>
    document.querySelectorAll('.delete-button').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();

            var id = this.getAttribute('data-id');

            var baseUrl = document.getElementById('urlBasePlaceholder').getAttribute('data-base-url');
            var actionUrl = baseUrl.replace('PLACEHOLDER', id);

            document.getElementById('deleteForm').setAttribute('action', actionUrl);
            document.querySelector('#content-popup').textContent = `Bạn có chắc chắn muốn xóa không?`;

            var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {});
            confirmDeleteModal.show();
        });
    });
</script>

@endsection
