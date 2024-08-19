@extends('admin.layouts.index')

@section('title', 'Form')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Thêm đối tượng vay</h3>
                    </div>
                    <form action="{{ Route('add-form') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="subject">Đối tượng</label>
                                <input name="subject" type="text" class="form-control" id="subject" placeholder="Enter" autocomplete="none">
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>

            <div class="col-12">
                <div class="card">

                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>

                          <th>Đối tượng vay</th>

                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($subjects as $item)
                              <tr>

                                    <td>{{ $item->subject }}</td>

                                    <td class="project-actions text-right">
                                        <form action="{{ Route('delete-form', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-button">
                                                <i class="fas fa-trash">
                                                </i>
                                                Xóa
                                            </button>
                                        </form>
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
