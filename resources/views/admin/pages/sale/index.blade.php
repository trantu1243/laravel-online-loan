@extends('admin.layouts.index')

@section('title', 'Sale')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách khách hàng</h1>
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
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Danh sách khách hàng đã gọi</h3>

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
                            <th>Thời gian sale gọi</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($saleCustomers as $item)
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
                                    <td>{{ $item->call_time ? \Carbon\Carbon::parse($item->call_time)->diffForHumans() : '-'}}</td>
                                    <td class="project-actions text-right">

                                        <a class="btn btn-warning btn-sm" href="{{ Route('detail-sale', ['id' => $item->id ])}}">
                                            <i class="fa fa-user">
                                            </i>
                                            Chi tiết
                                        </a>

                                    </td>
                              </tr>
                          @endforeach


                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      {{ $saleCustomers->links('pagination::bootstrap-4') }}
                  </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách khách hàng đang chờ xử lý</h3>

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
                        <th>Thời gian đăng ký</th>
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
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                <td class="project-actions text-right">
                                    @if ($item->status == 'PENDING')
                                    <form action="{{ Route('call-sale', ['id' => $item->id ])}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-phone">
                                            </i>
                                            Call
                                        </button>
                                    </form>
                                    @endif
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
              </div>
              <!-- /.card -->
            </div>

          </div>
    </div>
</section>

@endsection
