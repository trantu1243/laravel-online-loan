@extends('admin.layouts.index')

@section('title', 'Câu hỏi')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Câu hỏi thường gặp</h3>

                    </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>

                            <th>Câu hỏi</th>
                            <th>Câu trả lời</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($questions as $item)
                              <tr>

                                    <td class="break-word" style="width: 30%">{{ $item->question }}</td>
                                    <td class="break-word" style="width: 70%">{{ $item->answer }}</td>
                                    <td class="project-actions text-right">

                                        <a href="{{ Route('edit-question-setting', ['id' => $item->id ])}}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt">
                                            </i>
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
