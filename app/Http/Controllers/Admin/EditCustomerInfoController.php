<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\CustomerInfoV2;
use App\Models\Sale;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class EditCustomerInfoController extends Controller
{
    public function show($id){
        $customer = CustomerInfo::findOrFail($id);
        $customerInfo = CustomerInfoV2::where('customer_info_id', $customer->id)->first();
        $subjects = Subject::all();
        $sales = User::where('role', 'SALE')->orWhere('role', 'ADMIN')->get();
        $censors = User::where('role', 'CENSOR')->orWhere('role', 'ADMIN')->get();
        $loans = Sale::all();
        return view('admin.pages.edit', [
            'customer' => $customer,
            'customerInfo' => $customerInfo,
            'subjects' => $subjects,
            'sales' => $sales,
            'censors' => $censors,
            'loans' => $loans
        ]);
    }

    public function edit($id, Request $request){
        $request->validate([
            "name" => "required|string",
            "phone" => "required|string",
            "idCard" => "required|string",
            "salaryType" => "required|string",
            "timeCall" => "required|string",
            "status" => "required|string",
            "linkfb" => "required|string",
            "desiredAmount" => "required|string",
            "desiredDuration" => "required|string",
            "income" => "required|string",

        ]);
        $customer = CustomerInfo::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->idCard = $request->input('idCard');
        $customer->salaryType = $request->input('salaryType');
        $customer->timeCall = $request->input('timeCall');
        $customer->status = $request->input('status');

        if ($request->has('sale')) $customer->sale = $request->input('sale');
        if ($request->has('censor')) $customer->censor = $request->input('censor');
        if ($request->has('loan_id')) $customer->loan_id = $request->input('loan_id');
        if ($request->has('transfer_time')) $customer->transfer_time = $request->input('transfer_time');

        $customer->save();

        toastr()->success(" Lưu thành công");
        return back();
    }

}
