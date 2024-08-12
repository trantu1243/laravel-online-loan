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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($censorCustomers as $item)
                                <tr>
                                    <td>{{ $item->idCard }}</td>
                                    <td style="width: 250px" class="break-word">{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
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
                                        elseif ($item->status === 'DONE') {
                                            $status = 'Done';
                                            $btn = 'success';
                                        }
                                        elseif ($item->status === 'DISABLE') {
                                            $status = 'Disable';
                                            $btn = 'danger';
                                        }
                                    @endphp
                                    <td><div class="btn-block btn-{{ $btn }} btn-sm">{{ $status }}</div></td>
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
                      {{ $customers->links('pagination::bootstrap-4') }}
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
                          <th>Censor</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($customers as $item)
                              <tr>
                                  <td>{{ $item->idCard }}</td>
                                  <td style="width: 250px" class="break-word">{{ $item->name }}</td>
                                  <td>{{ $item->phone }}</td>
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
                                    elseif ($item->status === 'DONE') {
                                      $status = 'Done';
                                      $btn = 'success';
                                    }
                                    elseif ($item->status === 'DISABLE') {
                                      $status = 'Disable';
                                      $btn = 'danger';
                                    }
                                  @endphp
                                  <td><div class="btn btn-block btn-{{ $btn }} btn-sm">{{ $status }}</div></td>
                                  <td>{{ $item->sale ? $item->Sale->name : '-' }}</td>
                                  <td>{{ $item->censor ? $item->Censor->name : '-' }}</td>
                                  <td class="project-actions text-right">
                                      @if ($item->status == 'CENSOR')
                                          <a type="submit" class="btn btn-info btn-sm" href="{{ Route('detail-censor', ['id' => $item->id]) }}">

                                              Duyệt
                                          </a>
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
