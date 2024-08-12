@extends('admin.layouts.index')

@section('title', 'Đổi mật khẩu')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Đổi mật khẩu</h3>
                    </div>
                    <form action="{{ Route('post.change-password', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail1">Email</label>
                                <input name="username" value="{{ $user->email }}" type="text" class="form-control" id="inputEmail1" placeholder="Enter email" autocomplete="none" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Tên</label>
                                <input name="name" value="{{ $user->name }}" type="text" class="form-control" id="inputName" placeholder="Enter name" autocomplete="none" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1">Mật khẩu mới</label>
                                <input name="password" type="password" class="form-control" id="inputPassword1" placeholder="Password">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="inputPassword1">Xác nhận mật khẩu</label>
                                <input name="password_confirmation" type="password" class="form-control" id="inputPassword1" placeholder="Password">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!--/. container-fluid -->
@endsection
