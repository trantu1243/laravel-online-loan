@extends('admin.layouts.index')

@section('title', 'Các gói vay')

@section('content')
    <div class="container-fluid">
        <script>
            function toggleCheckboxes(checkbox) {
                var checkbox1 = document.getElementById("checkbox1");
                var checkbox2 = document.getElementById("checkbox2");

                var element1 = document.getElementById('selectImage');
                var element2 = document.getElementById('uploadImage');

                if (checkbox.id === "checkbox1" && checkbox.checked) {
                    checkbox2.checked = false;
                    element1.classList.remove('hidden');
                    element2.classList.add('hidden');
                } else if (checkbox.id === "checkbox2" && checkbox.checked) {
                    checkbox1.checked = false;
                    element1.classList.add('hidden');
                    element2.classList.remove('hidden');
                }
            }
        </script>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Thêm gói vay</h3>
                    </div>
                    <form action="{{ Route('post.edit-customer', ['id' => $customer->id ]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ $customer->name }}" placeholder="Enter name" autocomplete="none">
                            </div>

                            <div class="form-group">
                                <label for="career">Nghề nghiệp</label>
                                <input name="career" type="text" class="form-control" id="career" value="{{ $customer->career }}" placeholder="Enter career" autocomplete="none">
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <input name="content" type="text" class="form-control" id="content" value="{{ $customer->content }}" placeholder="Enter content" autocomplete="none">
                            </div>

                            <div class="form-group">
                                <div class="form-check" style="display: inline-block">
                                    <input class="form-check-input" type="radio" name="checkbox1" id="checkbox1" onclick="toggleCheckboxes(this)" checked>
                                    <label class="form-check-label">Chọn ảnh có sẵn</label>
                                </div>
                                <div class="form-check" style="display: inline-block">
                                    <input class="form-check-input" type="radio" name="checkbox2" id="checkbox2" onclick="toggleCheckboxes(this)">
                                    <label class="form-check-label">Upload ảnh</label>
                                </div>
                            </div>

                            <div class="form-group" id="selectImage">
                                <label for="image">Chọn ảnh</label>
                                <select name="selectImage" id="image" class="form-control" onchange="updateImage(this, 'sltImage')">
                                    @foreach ($customerImage as $item)
                                        <option value="{{ $item->file }}" {{ $customer->image == $item->file ? 'selected' : '' }}>{{ $item->filename }}</option>
                                    @endforeach
                                </select>
                                <img id="sltImage" src="{{$customer->image}}" height="80px" style = "margin-top: 10px">
                            </div>

                            <div class="form-group hidden" id="uploadImage">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="image">
                                    <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>



        </div>
    </div><!--/. container-fluid -->
    <script>
        function updateImage(selectElement, imgId) {
            var img = document.getElementById(imgId);
            img.src = selectElement.value;
        }
    </script>

@endsection
