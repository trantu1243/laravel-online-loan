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
                      <h3 class="card-title">Sửa</h3>
                    </div>
                    <form action="{{ Route('post.edit-process', ['id' => $process->id ]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{ $process->title }}" placeholder="Enter title" autocomplete="none" required>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <input name="content" type="text" class="form-control" id="content" value="{{ $process->content }}" placeholder="Enter content" autocomplete="none" required>
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
                                    @foreach ($processImage as $item)
                                        <option value="{{ $item->file }}" {{ $process->image == $item->file ? 'selected' : '' }}>{{ $item->filename }}</option>
                                    @endforeach
                                </select>
                                <img id="sltImage" src="{{$process->image}}" height="80px" style = "margin-top: 10px">
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
