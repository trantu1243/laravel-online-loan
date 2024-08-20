@extends('admin.layouts.index')

@section('title', 'Quy trình đăng kí vay')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Quy trình đăng kí vay</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Title</th>

                          <th style="width: 60%">Nội dung</th>
                          <th>Ảnh</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($process as $item)
                              <tr>
                                    <td class="break-word">{{ $item->title }}</td>
                                    <td style="width: 60%" class="break-word">{{ $item->content }}</td>
                                    <td><img src="{{ $item->image }}" alt="" style="width: 60px" /></td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-warning btn-sm" href="{{ Route('edit-process', ['id' => $item->id ]) }}">
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
