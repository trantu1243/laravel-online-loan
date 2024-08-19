<?php

namespace App\Http\Controllers\Admin\Censor;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\CustomerInfo;
use App\Models\CustomerInfoV2;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CensorDetailController extends Controller
{
    public function show($id){
        $customer = CustomerInfo::with(['Sale', 'Censor', 'loan'])->where('id', $id)->first();
        $customerInfo = CustomerInfoV2::where('customer_info_id', $customer->id)->first();
        return view('admin.pages.censor.detail', ['customer' => $customer, 'customerInfo' => $customerInfo]);
    }

    public function browse($id){
        $userId = Auth::id();

        $customer = CustomerInfo::where('id', $id)->where('status', 'CENSOR')->first();
        $customer->status = 'TRANSFER';
        $customer->censor = $userId;
        $customer->save();

        toastr()->success(' Đã duyệt thành công');
        return back();
    }

    public function confirm($id){
        $userId = Auth::id();

        $customer = CustomerInfo::where('id', $id)->where('censor', $userId)->first();

        $loan = Sale::find($customer->loan_id);
        $customer->status = 'DONE';

        $customer->transfer_time = now();
        $customer->month_num = $loan->duration;
        $customer->day = now()->addDay()->day;
        $customer->month_debt = 0;
        $customer->sum = 0;
        $customer->debt = 0;
        $customer->save();

        toastr()->success(' Đã xác nhận chuyển tiền');
        return back();
    }

    public function cancel($id){
        $userId = Auth::id();

        $customer = CustomerInfo::find($id);
        $customer->status = 'DISABLE';
        $customer->censor = $userId;
        $customer->save();

        toastr()->success(' Đã hủy thành công');
        return redirect(route('show-censor'));
    }
}
