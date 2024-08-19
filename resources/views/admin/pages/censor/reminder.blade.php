@extends('admin.layouts.index')

@section('title', 'Censor')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bộ nhắc nhở</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Censor</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('show-reminder') }}" method="GET">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="day">Số ngày còn lại để nộp</label>
                                        <input name="day" type="number" class="form-control" id="day" value="{{$day}}" placeholder="Enter " autocomplete="none">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary float-left">Filter</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Danh sách nhắc nhở</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>CCCD</th>
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Status</th>
                                <th>Ngày nộp tiền</th>
                                <th>Tiền cần nộp</th>
                                <th>Số tháng còn lại</th>
                                <th>Gói vay</th>
                                <th>Lần nhắc nhở</th>
                                <th>Tiền đã thu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $item)
                                <tr>

                                    <td>{{ $item->idCard }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if ($item->paid || !$item->month_num)
                                            <span class="badge bg-success">Đã nộp</span>
                                        @else
                                            <span class="badge bg-warning">Chưa nộp</span>
                                        @endif
                                    </td>
                                    <td>{{$item->day}} ( {{$item->transfer_time}} )</td>
                                    <td>{{$item->debt ? number_format($item->debt, 0, ',') .'vnd' : '-'}}</td>
                                    <td>{{$item->month_num}}</td>
                                    <td>{{  $item->loan ? $item->loan->id . ' | ' . $item->loan->amount . ' triệu | ' . $item->loan->duration . ' tháng | ' . $item->loan->rate . '%/năm' : '-' }}</td>
                                    <td>{{ $item->num_reminder ? $item->num_reminder : 0 }}</td>
                                    <td>{{ number_format($item->sum, 0, ',') }}vnd</td>
                                    <td class="project-actions text-right">

                                        <form action="{{ Route('post-reminder', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" style="margin-bottom: 5px; width: 75px">
                                                Nhắc nhở
                                            </button>
                                        </form>
                                        <a class="btn btn-success btn-sm transfer-button" data-id="{{ $item->id }}" data-name="{{ $item->name }}" style="width: 75px">
                                            Nộp tiền
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      {{ $customers->links('pagination::bootstrap-4') }}
                  </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Danh sách quá hạn</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>CCCD</th>
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Ngày nộp tiền</th>
                                <th>Số tiền nợ tháng trước</th>
                                <th>Số tháng nợ</th>
                                <th>Gói vay</th>
                                <th>Lần nhắc nhở</th>
                                <th>Tiền đã thu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($overdueCustomers as $item)
                                <tr>
                                    <td>{{ $item->idCard }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->day }} ( {{$item->transfer_time}} )</td>
                                    @php
                                        $rate = $item->loan->rate / 1200;
                                        $pv = $item->loan->amount * 1000000;
                                        $nper = $item->loan->duration;

                                        $m = $pv / $nper;

                                        $pvif = pow(1 + $rate, $nper);
                                        $m = ($rate * $pv * ($pvif)) / ($pvif - 1);
                                        $m = round($m, -3);

                                        $money = $item->debt - $m;
                                    @endphp
                                    <td>{{ number_format($money, 0, ',') }}vnd</td>
                                    <td>{{ $item->month_debt }}</td>
                                    <td>{{ $item->loan ? $item->loan->id . ' | ' . $item->loan->amount . ' triệu | ' . $item->loan->duration . ' tháng | ' . $item->loan->rate . '%/năm' : '-' }}</td>
                                    <td>{{ $item->num_reminder ? $item->num_reminder : 0 }}</td>
                                    <td>{{ number_format($item->sum, 0, ',') }}vnd</td>
                                    <td class="project-actions text-right">
                                        <form action="{{ Route('post-reminder', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" style="margin-bottom: 5px; width: 75px">
                                                Nhắc nhở
                                            </button>
                                        </form>
                                        <a class="btn btn-success btn-sm transfer2-button" data-id="{{ $item->id }}" data-name="{{ $item->name }}" style="width: 75px">
                                            Nộp tiền
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      {{ $overdueCustomers->links('pagination::bootstrap-4') }}
                  </div>
                </div>
                <!-- /.card -->
            </div>

          </div>
    </div>
</section>

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
                Xác nhận khác hàng đã chuyển tiền
            </div>
            <div class="modal-footer" style="display: block">
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    <div class="form-group">
                        <label for="money">Nhập số tiền khách hàng đã chuyển</label>

                        <input type="number" class="form-control" placeholder="Enter ..." name="money" id="money" required/>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-danger" id="deleteButton" href="">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div data-base-url="{{ route('transfer-reminder', ['id' => 'PLACEHOLDER']) }}" id="urlBasePlaceholder"></div>
<div data-base-url="{{ route('transfer2-reminder', ['id' => 'PLACEHOLDER']) }}" id="urlBasePlaceholder2"></div>

<script>
    document.querySelectorAll('.transfer-button').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();

            var id = this.getAttribute('data-id');
            var name = this.getAttribute('data-name');

            var baseUrl = document.getElementById('urlBasePlaceholder').getAttribute('data-base-url');
            var actionUrl = baseUrl.replace('PLACEHOLDER', id);

            document.getElementById('deleteForm').setAttribute('action', actionUrl);
            document.querySelector('#content-popup').textContent = `Xác nhận khác hàng ${name} đã chuyển tiền`;

            var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {});
            confirmDeleteModal.show();
        });
    });
</script>

<script>
    document.querySelectorAll('.transfer2-button').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();

            var id = this.getAttribute('data-id');
            var name = this.getAttribute('data-name');

            var baseUrl = document.getElementById('urlBasePlaceholder2').getAttribute('data-base-url');
            var actionUrl = baseUrl.replace('PLACEHOLDER', id);

            document.getElementById('deleteForm').setAttribute('action', actionUrl);
            document.querySelector('#content-popup').textContent = `Xác nhận khác hàng ${name} đã chuyển tiền`;

            var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {});
            confirmDeleteModal.show();
        });
    });
</script>
@endsection
