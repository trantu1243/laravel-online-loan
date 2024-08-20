@extends('admin.layouts.index')

@section('title', 'Footer')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Footer</h3>
                    </div>
                    <form action="{{ Route('save-footer-setting') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="phone">Đăng ký khoản vay</label>
                                <input name="phone" type="text" value="{{ $footer->phone }}" class="form-control" id="phone" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="hotline">Chăm sóc khách hàng</label>
                                <input name="hotline" type="text" value="{{ $footer->hotline }}" class="form-control" id="hotline" placeholder="Enter ..." autocomplete="none" required>
                            </div>


                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input name="address" type="text" value="{{ $footer->address }}" class="form-control" id="address" placeholder="Enter ..." autocomplete="none" required>
                            </div>


                            <div class="form-group">
                                <label for="website">Website</label>
                                <input name="website" type="text" value="{{ $footer->website }}" class="form-control" id="website" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <input name="note" type="text" value="{{ $footer->note }}" class="form-control" id="note" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content" rows="5" placeholder="Enter content" autocomplete="none" required>{{ $footer->content }}</textarea>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!--/. container-fluid -->


@endsection
