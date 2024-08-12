<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\CustomerInfoV2;
use Illuminate\Http\Request;

class EditCustomerInfoController extends Controller
{
    public function show($id){
        $customer = CustomerInfo::findOrFail($id);
        $customerInfo = CustomerInfoV2::where('customer_info_id', $customer->id)->first();
        return view('admin.pages.edit', ['customer' => $customer, 'customerInfo' => $customerInfo]);
    }

    public function edit($id, Request $request){
        $request->validate([
            "name" => "required|string",
            "phone" => "required|string",
            "idCard" => "required|string",
            "salaryType" => "required|string",
            "timeCall" => "required|string",
            "status" => "required|string"
        ]);
        $customer = CustomerInfo::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->idCard = $request->input('idCard');
        $customer->salaryType = $request->input('salaryType');
        $customer->timeCall = $request->input('timeCall');
        $customer->status = $request->input('status');
        $customer->save();

        toastr()->success(" Lưu thành công");
        return back();
    }

}
