@extends('admin.layouts.index')

@section('title', 'Chi tiết khách hàng')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Thông tin chi tiết</a>
                        </li>
                        @if ($customerInfo)
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Thông tin xác minh cấp 2</a>
                        </li>
                        @endif
                      </ul>
                    </div>
                    <form action="{{ Route('post.edit-customer-info', ['id' => $customer->id]) }}" method="POST">
                    @csrf
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Tên</label>
                                                    <input type="text" class="form-control " name="name" placeholder="Enter ..." value="{{ $customer->name }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">SĐT</label>
                                                    <input type="text" class="form-control " name="phone" placeholder="Enter ..." value="{{ $customer->phone }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">CCCD</label>
                                            <input type="text" class="form-control " name="idCard" placeholder="Enter ..." value="{{ $customer->idCard }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Nhóm khách hàng</label>
                                            <select class="form-control" name="salaryType" required>
                                                @php
                                                    $salaryList = [
                                                        "Cán bộ công chức viên chức Nhà nước",
                                                        "Nhân viên văn phòng (nhận lương chuyển khoản)",
                                                        "Công nhân (nhận lương chuyển khoản)",
                                                        "Sở hữu Hợp đồng Bảo hiểm Nhân thọ hoặc Đăng ký Xe máy",
                                                        "Khác (lương tiền mặt, kinh doanh tự do,…)",
                                                    ]
                                                @endphp
                                                @foreach ($salaryList as $item)
                                                    <option value="{{ $item }}" {{ $customer->salaryType == $item ? "selected" : "" }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Thời gian gọi</label>
                                            <select name="timeCall"  class="form-control" required>
                                                @php
                                                    $optionList = [
                                                        "Liên hệ ngay trong vòng 1 giờ",
                                                        "Thứ 2-Thứ 6:8:00-10:00",
                                                        "Thứ 2-Thứ 6:10:00-12:00",
                                                        "Thứ 2-Thứ 6:12:00-14:00",
                                                        "Thứ 2-Thứ 6:14:00-16:00",
                                                        "Thứ 2-Thứ 6:16:00-18:00",
                                                        "Thứ 2-Thứ 6:17:30-19:00",
                                                        "Thứ 2-Thứ 6:Sau 18h",
                                                        "Thứ 7:8:00-10:00",
                                                        "Thứ 7:10:00-12:00",
                                                        "Thứ 7:12:00-14:00",
                                                        "Thứ 7:14:00-16:00",
                                                        "Thứ 7:16:00-17:30"
                                                    ]
                                                @endphp
                                                @foreach ($optionList as $item)
                                                    <option value="{{ $item }}" {{ $customer->timeCall == $item ? "selected" : "" }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Status </label>
                                            <select class="form-control" name="status">
                                                <option value="PENDING" {{ $customer->status == "PENDING" ? "selected" : ""}}>Đang xử lý</option>
                                                <option value="SALE" {{ $customer->status == "SALE" ? "selected" : ""}}>Đang gọi</option>
                                                <option value="FILL" {{ $customer->status == "FILL" ? "selected" : ""}}>Đang điền tt</option>
                                                <option value="CENSOR" {{ $customer->status == "CENSOR" ? "selected" : ""}}>Đang duyệt</option>
                                                <option value="DONE" {{ $customer->status == "DONE" ? "selected" : ""}}>Done</option>
                                                <option value="DISABLE" {{ $customer->status == "DISABLE" ? "selected" : ""}}>Disable</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Sale nhận xử lý</label>
                                            <input type="text" class="form-control " placeholder="Enter ..." value="{{  $customer->sale ? $customer->Sale->name : '-' }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Thẩm định viên nhận xử lý</label>
                                            <input type="text" class="form-control " placeholder="Enter ..." value="{{  $customer->censor ? $customer->Censor->name : '-' }}" disabled>
                                        </div>

                                        <div class="form-group">
                                           <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>

                                @if ($customerInfo)
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="" style="display: block">Mặt trước cccd</label>
                                            <img src="{{ $customerInfo->frontCCCD }}" width="640"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="display: block">Mặt sau cccd</label>
                                            <img src="{{ $customerInfo->backCCCD }}" width="640" />
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="display: block">Khuôn mặt</label>
                                            <img src="{{ $customerInfo->faceData }}" width="640" />
                                        </div>
                                        <div class="form-group">
                                            <label for="" >Bảng lương: </label>
                                            <a href="{{ $customerInfo->salary_slip }}"  target="_blank">Xem bảng lương</a>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="confirm" name="confirm" value="confirm" checked disabled>
                                                <label for="confirm" class="custom-control-label">Xác nhận hợp đồng điện tử</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="accept" name="accept" value="accept" checked disabled>
                                                <label for="accept" class="custom-control-label">Tôi đồng ý với Điều khoản xử lý dữ liệu cá nhân và Điều khoản giao dịch</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/. container-fluid -->


@endsection
