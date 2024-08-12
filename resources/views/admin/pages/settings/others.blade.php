<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Khác</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="/plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="/plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="/plugins/simplemde/simplemde.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.navbar')
  <!-- /.navbar -->

  @include('admin.layouts.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Khác</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ Route('save-others') }}" method="POST">
        @csrf
            <!-- ./row -->
            <div class="row">
                <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h3 class="card-title">
                        Các ưu điểm vượt trội
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <textarea id="advantage" class="p-3" name="advantage">{{ $code->advantage }}</textarea>
                    </div>

                </div>
                </div>
                <!-- /.col-->
            </div>

            <div class="row">
                <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h3 class="card-title">
                        Quy trình đăng ký vay
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <textarea id="procedure" class="p-3" name="procedure">{{ $code->procedure }}</textarea>
                    </div>

                </div>
                </div>
                <!-- /.col-->
            </div>

            <div class="row">
                <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h3 class="card-title">
                    Câu hỏi thường gặp
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <textarea id="question" class="p-3" name="question">{{ $code->question }}</textarea>
                    </div>

                </div>
                </div>
                <!-- /.col-->
            </div>


            <div class="row">
                <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h3 class="card-title">
                    About Footer
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <textarea id="about_footer" class="p-3" name="about_code">{{ $code->about_footer }}</textarea>
                    </div>

                </div>
                </div>
                <!-- /.col-->
            </div>

            <div class="row">
                <div class="col-md-12">
                <div class="card-body">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </div>
                <!-- /.col-->
            </div>
        </form>

      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="/plugins/codemirror/codemirror.js"></script>
<script src="/plugins/codemirror/mode/css/css.js"></script>
<script src="/plugins/codemirror/mode/xml/xml.js"></script>
<script src="/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("advantage"), {
      mode: "htmlmixed",
      theme: "monokai"
    });

    CodeMirror.fromTextArea(document.getElementById("procedure"), {
      mode: "htmlmixed",
      theme: "monokai"
    });

    CodeMirror.fromTextArea(document.getElementById("question"), {
      mode: "htmlmixed",
      theme: "monokai"
    });

    CodeMirror.fromTextArea(document.getElementById("about_footer"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>
