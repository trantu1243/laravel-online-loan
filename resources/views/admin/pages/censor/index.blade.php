@extends('admin.layouts.index')

@section('title', 'Censor')

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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách đã duyệt</h3>
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
                                    <th>Thời gian chuyển tiền</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($censorCustomers as $item)
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
                                        <td>{{ $item->transfer_time ? $item->transfer_time : '-' }}</td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-warning btn-sm" href="{{ Route('detail-censor', ['id' => $item->id]) }}">
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
                        {{ $censorCustomers->links('pagination::bootstrap-4') }}
                    </div>

                    <div class="card-footer">
                        <div>
                            <label for="">Tổng khách hàng đã vay: </label>
                            <p style="display: inline">{{ $count }}</p>
                        </div>
                        <div>
                            <label for="" >Tổng tiền đã giải ngân: </label>
                            <p style="display: inline">{{ number_format($total*1000000, 0, ',') }} vnd</p>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Danh sách chờ duyệt</h3>

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
                          <th>Time</th>
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
                                    <td>{{ $item->fill_time ? \Carbon\Carbon::parse($item->fill_time)->diffForHumans() : '-' }}</td>
                                    <td class="project-actions text-right">
                                        @if ($item->status == 'CENSOR')
                                        <form action="{{ Route('browse-censor', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">
                                                Duyệt
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
