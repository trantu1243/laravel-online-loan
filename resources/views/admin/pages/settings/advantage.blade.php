@extends('admin.layouts.index')

@section('title', 'Ưu điểm vượt trội')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Ưu điểm vượt trội</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th style="width: 80%">Nội dung</th>
                          <th>Ảnh</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($advantage as $item)
                              <tr>
                                    <td style="width: 60%" class="break-word">{{ $item->content }}</td>
                                    <td><img src="{{ $item->image }}" alt="" style="width: 60px" /></td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-warning btn-sm" href="{{ Route('edit-advantage', ['id' => $item->id ]) }}">
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
