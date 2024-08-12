@extends('admin.layouts.index')

@section('title', 'Các gói vay')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Đánh giá từ khách hàng</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Tên</th>
                          <th>Nghề nhiệp</th>
                          <th style="width: 250px">Nội dung</th>
                          <th>Ảnh</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($customers as $item)
                              <tr>
                                    <td class="break-word">{{ $item->name }}</td>
                                    <td>{{ $item->career }}</td>
                                    <td style="width: 250px" class="break-word">{{ $item->content }}</td>
                                    <td><img src="{{ $item->image }}" alt="" style="width: 80px" /></td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-warning btn-sm" href="{{ Route('edit-customer', ['id' => $item->id ]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sửa
                                        </a>

                                    </td>
                              </tr>
                          @endforeach


                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

        </div>
    </div><!--/. container-fluid -->


@endsection
