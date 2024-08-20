@extends('admin.layouts.index')

@section('title', 'Chung')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upload ảnh</h3>
                    </div>
                    <form action="{{ Route('upload-image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="image">
                                    <label class="custom-file-label" for="customFile">Choose image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="logo">logo (95∶32)</option>
                                    <option value="background">background (96∶35)</option>
                                    <option value="mb_background">moblie background</option>
                                    <option value="pc_banner">pc banner (4:1)</option>
                                    <option value="mobile_banner">mobile banner (3∶4)</option>
                                    <option value="about">about</option>
                                    <option value="mb_about_image">mobile about</option>
                                    <option value="logo_footer">logo footer</option>
                                    <option value="mb_logo_footer">mobile logo footer</option>
                                    <option value="footer_bg">footer background</option>
                                    <option value="mb_footer_bg">mobile footer background</option>
                                    <option value="popup">popup (1:1)</option>
                                    <option value="popup_button">popup button</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Chung</h3>
                    </div>
                    <form action="{{ Route('save-setting') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input name="title" type="text" value="{{ $setting->title }}" class="form-control" id="title" placeholder="Enter title" autocomplete="none">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="hotline">Hotline</label>
                                        <input name="hotline" type="text" value="{{ $setting->hotline }}" class="form-control" id="hotline" placeholder="Enter hotline" autocomplete="none">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="link_mes">Link messenger</label>
                                        <input name="link_mes" type="text" value="{{ $setting->link_mes }}" class="form-control" id="link_mes" placeholder="Enter title" autocomplete="none">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input name="color" type="text" value="{{ $setting->color }}" class="form-control" id="color" placeholder="Enter color" autocomplete="none">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="line_color">Line color</label>
                                        <input name="line_color" type="text" value="{{ $setting->line_color }}" class="form-control" id="line_color" placeholder="Enter hotline" autocomplete="none">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="bg_color">Background color</label>
                                        <input name="bg_color" type="text" value="{{ $setting->bg_color }}" class="form-control" id="bg_color" placeholder="Enter title" autocomplete="none">
                                    </div>
                                </div>
                            </div>





                            <div class="form-group">
                                <label for="logo">Logo (95∶32)</label>
                                <select name="logo" id="logo" class="form-control" onchange="updateImage(this, 'logoImage')">
                                    @foreach ($logo as $item)
                                        <option value="{{$item->file}}" {{ $item->file === $setting->logo ? "selected":"" }}>{{$item->filename}}</option>
                                    @endforeach
                                </select>
                                <img id="logoImage" src="{{$setting->logo}}" height="60px" style = "margin-top: 10px">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="background">Background (96∶35)</label>
                                        <select name="background" id="background" class="form-control" onchange="updateImage(this, 'backgroundImage')">
                                            @foreach ($background as $item)
                                                <option value="{{$item->file}}"  {{ $item->file === $setting->background ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="backgroundImage" src="{{$setting->background}}" height="80px" style = "margin-top: 10px">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mb_background">Mobile background (3∶4)</label>
                                        <select name="mb_background" id="mb_background" class="form-control" onchange="updateImage(this, 'mb_backgroundImage')">
                                            @foreach ($mb_background as $item)
                                                <option value="{{$item->file}}"  {{ $item->file === $setting->mb_background ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="mb_backgroundImage" src="{{$setting->mb_background}}" height="80px" style = "margin-top: 10px">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="pc_banner">PC banner (4:1)</label>
                                        <select name="pc_banner" id="pc_banner" class="form-control" onchange="updateImage(this, 'pc_bannerImage')">
                                            @foreach ($pc_banner as $item)
                                                <option value="{{$item->file}}"  {{ $item->file === $setting->pc_banner ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="pc_bannerImage" src="{{$setting->pc_banner}}" height="80px" style = "margin-top: 10px">
                                    </div>

                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="mobile_banner">Mobile banner(3:4)</label>
                                        <select name="mobile_banner" id="mobile_banner" class="form-control" onchange="updateImage(this, 'mobile_bannerImage')">
                                            @foreach ($mobile_banner as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->mobile_banner ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="mobile_bannerImage" src="{{$setting->mobile_banner}}" height="80px" style = "margin-top: 10px">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dieu_khoan_xu_ly_du_lieu_ca_nhan">Điều khoản xử lý dữ liệu cá nhân</label>
                                        <input name="dieu_khoan_xu_ly_du_lieu_ca_nhan" type="text" value="{{ $setting->dieu_khoan_xu_ly_du_lieu_ca_nhan }}" class="form-control" id="dieu_khoan_xu_ly_du_lieu_ca_nhan" placeholder="Enter ..." autocomplete="none">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dieu_khoan_giao_dich">Điều khoản giao dịch</label>
                                        <input name="dieu_khoan_giao_dich" type="text" value="{{ $setting->dieu_khoan_giao_dich }}" class="form-control" id="dieu_khoan_giao_dich" placeholder="Enter ..." autocomplete="none">
                                    </div>
                                </div>

                            </div>






                            <div class="form-group">
                                <label for="rate">Lãi hiển thị (%/năm)</label>
                                <input name="rate" type="number" value="{{ $setting->rate }}" class="form-control" id="rate" placeholder="Enter rate" autocomplete="none">
                            </div>



                            <div class="form-group">
                                <label for="about1">About</label>
                                <textarea name="about1" class="form-control" id="about1" placeholder="Enter about">{{ $setting->about1 }}</textarea>
                                <textarea name="about2" class="form-control" id="about2" placeholder="Enter about" style="margin-top:10px">{{ $setting->about2 }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="about_image">About image</label>
                                        <select name="about_image" id="about_image" class="form-control" onchange="updateImage(this, 'about_imageImage')">
                                            @foreach ($about as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->about_image ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="about_imageImage" src="{{$setting->about_image}}" height="80px" style = "margin-top: 10px">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mb_about_image">Mobile bout image</label>
                                        <select name="mb_about_image" id="mb_about_image" class="form-control" onchange="updateImage(this, 'mb_about_imageImage')">
                                            @foreach ($mb_about_image as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->mb_about_image ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="mb_about_imageImage" src="{{$setting->mb_about_image}}" height="80px" style = "margin-top: 10px">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="logo_footer">Logo footer</label>
                                        <select name="logo_footer" id="logo_footer" class="form-control" onchange="updateImage(this, 'logo_footerImage')">
                                            @foreach ($logo_footer as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->logo_footer ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="logo_footerImage" src="{{$setting->logo_footer}}" height="60px" style = "margin-top: 10px">
                                    </div>

                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="mb_logo_footer">Mobile Logo footer</label>
                                        <select name="mb_logo_footer" id="mb_logo_footer" class="form-control" onchange="updateImage(this, 'mb_logo_footerImage')">
                                            @foreach ($mb_logo_footer as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->mb_logo_footer ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="mb_logo_footerImage" src="{{$setting->mb_logo_footer}}" height="60px" style = "margin-top: 10px">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="footer_bg">Logo background</label>
                                        <select name="footer_bg" id="footer_bg" class="form-control" onchange="updateImage(this, 'footer_bgImage')">
                                            @foreach ($footer_bg as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->footer_bg ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="footer_bgImage" src="{{$setting->footer_bg}}" height="60px" style = "margin-top: 10px">
                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="mb_footer_bg">Mobile Logo background</label>
                                        <select name="mb_footer_bg" id="mb_footer_bg" class="form-control" onchange="updateImage(this, 'mb_footer_bgImage')">
                                            @foreach ($mb_footer_bg as $item)
                                                <option value="{{$item->file}}" {{ $item->file === $setting->mb_footer_bg ? "selected":"" }}>{{$item->filename}}</option>
                                            @endforeach
                                        </select>
                                        <img id="mb_footer_bgImage" src="{{$setting->mb_footer_bg}}" height="60px" style = "margin-top: 10px">
                                    </div>
                                </div>

                            </div>


                            <label for="">Popup</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="popup" {{$setting->popup ? "checked":''}}>
                                <label class="form-check-label" for="exampleCheck1">Hiển thị Popup</label>
                            </div>

                            <div id="elementsToShow" class="{{$setting->popup ? '':'hidden'}}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="popup_image">Popup image (1:1)</label>
                                            <select name="popup_image" id="popup_image" class="form-control" onchange="updateImage(this, 'popup_imageImage')">
                                                @foreach ($popup as $item)
                                                    <option value="{{$item->file}}"  {{ $item->file === $setting->popup_image ? "selected":"" }}>{{$item->filename}}</option>
                                                @endforeach
                                            </select>
                                            <img id="popup_imageImage" src="{{$setting->popup_image}}" height="80px" style = "margin-top: 10px">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="popup_button">Popup Button</label>
                                            <select name="popup_button" id="popup_button" class="form-control" onchange="updateImage(this, 'popup_buttonImage')">
                                                @foreach ($popup_button as $item)
                                                    <option value="{{$item->file}}"  {{ $item->file === $setting->popup_button ? "selected":"" }}>{{$item->filename}}</option>
                                                @endforeach
                                            </select>
                                            <img id="popup_buttonImage" src="{{$setting->popup_button}}" height="80px" style = "margin-top: 10px">
                                        </div>
                                    </div>

                                </div>




                                <div class="form-group">
                                    <label for="detail_link">Link chi tiết</label>
                                    <input name="detail_link" type="text" class="form-control" id="detail_link" value="{{ $setting->detail_link }}" placeholder="Enter link" autocomplete="none">
                                </div>
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

    <script>
        document.getElementById('exampleCheck1').addEventListener('change', function() {
            var elements = document.getElementById('elementsToShow');
            if (this.checked) {
                elements.classList.remove('hidden');
            } else {
                elements.classList.add('hidden');
            }
        });
    </script>
    <script>
        function updateImage(selectElement, imgId) {
            var img = document.getElementById(imgId);
            img.src = selectElement.value;
        }
    </script>

@endsection
