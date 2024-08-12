<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update thông tin xác minh cấp 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Update thông tin</h3>
                          </div>
                        <form action="{{ Route('update-info', ['token' => $token]) }} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Ảnh chụp mặt trước CCCD</label>

                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*" id="frontCCCD" name="frontCCCD" required>
                                    <label class="custom-file-label" for="frontCCCD">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Ảnh chụp mặt sau CCCD</label>

                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*" id="backCCCD" name="backCCCD" required>
                                    <label class="custom-file-label" for="backCCCD">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Bảng lương</label>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="salary_slip" id="salary_slip" required>
                                        <label class="custom-file-label" for="salary_slip">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Khuôn mặt</label>
                                    <button type="button" class="btn btn-secondary" id="startCapture"><i class="fa fa-camera"></i></button>

                                    <div id="cameraContainer" style="display: none; text-align: center; margin-top: 10px;">
                                        <video id="video" width="640" height="480" autoplay></video>
                                        <div><button type="button" class="btn btn-secondary" id="capture">Chụp</button></div>

                                    </div>

                                    <canvas id="canvas" width="640" height="480" style="display: none; margin-top: 10px;"></canvas>

                                    <input type="hidden" id="faceData" name="faceData" required>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="confirm" name="confirm" value="confirm" required>
                                        <label for="confirm" class="custom-control-label">Xác nhận hợp đồng điện tử</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="accept" name="accept" value="accept" required>
                                        <label for="accept" class="custom-control-label">Tôi đồng ý với
                                            <span>
                                                <a href="https://www.lottefinance.vn/web/service/customer/termAndCond/loanTnC?csrt=11640075599545901093">Điều khoản xử lý dữ liệu cá nhân</a>
                                            </span> và
                                            <span><a href="https://www.lottefinance.vn/web/service/customer/termAndCond/userDataPolicies?csrt=11640075599545901093">Điều khoản giao dịch</a></span></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </section>
    </div>
    <script>
        const startCaptureButton = document.getElementById('startCapture');
        const cameraContainer = document.getElementById('cameraContainer');
        const video = document.getElementById('video');
        const captureButton = document.getElementById('capture');
        const canvas = document.getElementById('canvas');
        const confirmButton = document.getElementById('confirm');
        const faceDataInput = document.getElementById('faceData');
        const context = canvas.getContext('2d');

        startCaptureButton.addEventListener('click', () => {
            cameraContainer.style.display = 'block';
            canvas.style.display = 'none';
            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                    window.currentStream = stream;
                });
        });

        captureButton.addEventListener('click', () => {
            canvas.style.display = 'block';
            cameraContainer.style.display = 'none';
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            faceDataInput.value = canvas.toDataURL('image/png');
            let tracks = window.currentStream.getTracks();
            tracks.forEach(track => track.stop());
        });

    </script>

    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function () {
        bsCustomFileInput.init();
    });
    </script>
</body>
</html>
