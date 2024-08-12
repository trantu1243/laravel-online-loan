<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function show(Request $request){
        $query = CustomerInfo::query();

        $idCard = "";
        $phone = "";
        $status = "";
        if ($request->input('idCard')) {
            $idCard = $request->input('idCard');
            $query->where('idCard', $request->input('idCard'));
        }

        if ($request->input('phone')) {
            $phone = $request->input('phone');
            $query->where('phone', $request->input('phone'));
        }

        if ($request->input('status')) {
            $status = $request->input('status');
            $query->where('status', $request->input('status'));
        }

        $customers = $query->paginate(20);
        return view('admin.pages.index', [
            'customers' => $customers,
            'idCard' => $idCard,
            'phone' => $phone,
            'status' => $status
        ]);
    }

    public function destroy($id){
        $customer = CustomerInfo::findOrFail($id);
        $customer->delete();

        toastr()->success(" Xóa thành công");
        return back();
    }
}
