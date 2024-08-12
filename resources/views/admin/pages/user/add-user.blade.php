@extends('admin.layouts.index')

@section('title', 'Thêm user')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Thêm</h3>
                    </div>
                    <form action="{{ Route('post.add-user') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputUsername">Tên</label>
                                <input name="name" type="text" class="form-control" id="inputUsername" placeholder="Enter name" autocomplete="none">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="inputEmail1">Email</label>
                                <input name="email" type="email" class="form-control" id="inputUsername" placeholder="Enter email" autocomplete="none">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="inputPassword1">Mật khẩu</label>
                                <input name="password" type="password" class="form-control" id="inputPassword1" placeholder="Password">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="inputPassword1">Xác nhận mật khẩu</label>
                                <input name="password_confirmation" type="password" class="form-control" id="inputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="role">Vai trò</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="SALE">SALE</option>
                                    <option value="CENSOR">CENSOR</option>
                                </select>
                            </div>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!--/. container-fluid -->
@endsection
