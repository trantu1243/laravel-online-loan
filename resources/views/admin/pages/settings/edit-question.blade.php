@extends('admin.layouts.index')

@section('title', 'Câu hỏi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Câu hỏi</h3>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="question">Câu hỏi</label>
                                <textarea name="question" type="text" class="form-control" id="question" placeholder="Enter question" autocomplete="none" required>{{ $question->question }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="answer">Câu trả lời</label>
                                <textarea name="answer" type="text" class="form-control" id="answer" placeholder="Enter answer" autocomplete="none" required>{{ $question->answer }}</textarea>
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
