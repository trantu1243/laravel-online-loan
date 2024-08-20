@extends('admin.layouts.index')

@section('title', 'Ước tính khoản vay')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Ước tính khoản vay</h3>
                    </div>
                    <form action="{{ Route('save-estimate-setting') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="min_loan">Số tiền vay tối thiểu (triệu đồng)</label>
                                <input name="min_loan" type="number" value="{{ $estimate->min_loan }}" class="form-control" id="min_loan" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="max_loan">Số tiền vay tối đa (triệu đồng)</label>
                                <input name="max_loan" type="number" value="{{ $estimate->max_loan }}" class="form-control" id="max_loan" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="min_month">Số tháng tối thiểu (triệu đồng)</label>
                                <input name="min_month" type="number" value="{{ $estimate->min_month }}" class="form-control" id="min_month" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="max_month">Số tháng tối đa (triệu đồng)</label>
                                <input name="max_month" type="number" value="{{ $estimate->max_month }}" class="form-control" id="max_month" placeholder="Enter ..." autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="rate">Lãi hiển thị (%/năm)</label>
                                <input name="rate" type="number" value="{{ $estimate->rate }}" class="form-control" id="rate" placeholder="Enter rate" autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content" rows="20" placeholder="Enter content" autocomplete="none" required>{{ $estimate->content }}</textarea>
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
