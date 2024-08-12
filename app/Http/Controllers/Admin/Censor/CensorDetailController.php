<?php

namespace App\Http\Controllers\Admin\Censor;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\CustomerInfoV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CensorDetailController extends Controller
{
    public function show($id){
        $customer = CustomerInfo::with(['Sale', 'Censor'])->where('id', $id)->first();
        $customerInfo = CustomerInfoV2::where('customer_info_id', $customer->id)->first();
        return view('admin.pages.censor.detail', ['customer' => $customer, 'customerInfo' => $customerInfo]);
    }

    public function browse($id){
        $userId = Auth::id();

        $customer = CustomerInfo::where('id', $id)->where('status', 'CENSOR')->first();
        $customer->status = 'DONE';
        $customer->censor = $userId;
        $customer->save();

        toastr()->success(' Đã duyệt thành công');
        return redirect(route('show-censor'));
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
