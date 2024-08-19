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
                    <form action="{{ Route('add-loan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" autocomplete="none">
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <input name="content" type="text" class="form-control" id="content" placeholder="Enter content" autocomplete="none">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="amount">Gói vay (triệu)</label>
                                        <input name="amount" type="number" class="form-control" id="amount" placeholder="Enter amount" autocomplete="none">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="duration">Thời hạn (tháng)</label>
                                        <input name="duration" type="number" class="form-control" id="duration" placeholder="Enter duration" autocomplete="none">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rate">Lãi suất (%)</label>
                                        <input name="rate" type="number" class="form-control" id="rate" placeholder="Enter rate" autocomplete="none">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="minIncome">Mức thu nhập tối thiểu để vay (triệu)</label>
                                        <input name="minIncome" type="number" class="form-control" id="minIncome" placeholder="Enter min income" autocomplete="none">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-check" style="display: inline-block">
                                    <input class="form-check-input" type="radio" name="checkbox2" id="checkbox2" onclick="toggleCheckboxes(this)" checked>
                                    <label class="form-check-label">Upload ảnh</label>
                                </div>
                                <div class="form-check" style="display: inline-block">
                                    <input class="form-check-input" type="radio" name="checkbox1" id="checkbox1" onclick="toggleCheckboxes(this)">
                                    <label class="form-check-label">Chọn ảnh có sẵn </label>
                                </div>

                            </div>

                            <div class="form-group hidden" id="selectImage">
                                <label for="image">Chọn ảnh</label>
                                <select name="selectImage" id="image" class="form-control" onchange="updateImage(this, 'sltImage')">
                                    @foreach ($customerImage as $item)
                                        <option value="{{ $item->file }}">{{ $item->filename }}</option>
                                    @endforeach
                                </select>
                                <img id="sltImage" src="" height="80px" style = "margin-top: 10px">
                            </div>

                            <div class="form-group" id="uploadImage">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="image">
                                    <label class="custom-file-label" for="customFile">Chọn ảnh (Khuyến nghị ảnh 400px X 570-580px)</label>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Các gói vay</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th style="width: 100px">Tiêu đề</th>
                          <th style="width: 150px">Nội dung</th>
                          <th>Gói vay</th>
                          <th>Thời hạn</th>
                          <th>Lãi suất</th>
                          <th>Thu nhập tối thiểu</th>
                          <th>Ảnh</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($loans as $item)
                              <tr>
                                    <td>{{ $item->id }}</td>
                                    @php
                                        $title = $item->title;
                                        if (strlen(strip_tags($title)) > 10) {
                                            $title = substr(strip_tags($title), 0, 10) . '...';
                                        }
                                    @endphp
                                    <td>{{ $title }}</td>
                                    @php
                                        $content = $item->content;
                                        if (strlen(strip_tags($content)) > 15) {
                                            $content = substr(strip_tags($content), 0, 15) . '...';
                                        }
                                    @endphp
                                    <td>{{ $content }}</td>
                                    <td>{{ $item->amount }} triệu</td>
                                    <td>{{ $item->duration }} tháng</td>
                                    <td>{{ $item->rate }}%</td>
                                    <td>{{ $item->minIncome }} triệu</td>
                                    <td><img src="{{ $item->image }}" alt="" style="width: 60px" /></td>
                                    <td>
                                        <form>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="{{'customSwitch' . $item->id}}" {{ $item->status ? 'checked' : '' }} onclick="handleCheckboxChange({{ $item->id }}, this)">
                                                    <label class="custom-control-label" for="{{'customSwitch' . $item->id}}"></label>
                                                </div>
                                            </div>
                                        </form>
                                    </td>

                                  <td class="project-actions text-right">
                                      <a class="btn btn-warning btn-sm" href="{{ Route('edit-loan', ['id' => $item->id ])}}">
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          Sửa
                                      </a>

                                      <a class="btn btn-danger btn-sm delete-button" data-id="{{ $item->id }}">
                                          <i class="fas fa-trash">
                                          </i>
                                          Xóa
                                      </a>
                                  </td>
                              </tr>
                          @endforeach


                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    {{ $loans->links('pagination::bootstrap-4') }}
                </div>
                </div>
                <!-- /.card -->
              </div>

        </div>
    </div><!--/. container-fluid -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="content-popup">
                    Bạn có chắc chắn muốn xóa không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" id="deleteButton" href="">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div data-base-url="{{ route('delete-loan', ['id' => 'PLACEHOLDER']) }}" id="urlBasePlaceholder"></div>
    <script>
        document.querySelectorAll('.delete-button').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();

                var id = this.getAttribute('data-id');
                var baseUrl = document.getElementById('urlBasePlaceholder').getAttribute('data-base-url');
                var actionUrl = baseUrl.replace('PLACEHOLDER', id);

                document.getElementById('deleteForm').setAttribute('action', actionUrl);

                var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {});
                confirmDeleteModal.show();
            });
        });
    </script>
    <script>
        function handleCheckboxChange(itemId, checkbox) {
            const status = checkbox.checked ? true : false;

            fetch(`/api/loan/update-status/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {

            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
     <script>
        function updateImage(selectElement, imgId) {
            var img = document.getElementById(imgId);
            img.src = selectElement.value;
        }
    </script>
@endsection
