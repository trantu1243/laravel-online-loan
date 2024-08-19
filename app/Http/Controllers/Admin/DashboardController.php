<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function show(Request $request){
        $query = CustomerInfo::query();

        $idCard = "";
        $phone = "";
        $status = "";
        $sale = "";
        $censor = "";

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

        if ($request->input('sale')) {
            $sale = $request->input('sale');
            $query->where('sale', $request->input('sale'));
        }

        if ($request->input('censor')) {
            $censor = $request->input('censor');
            $query->where('censor', $request->input('censor'));
        }

        $customers = $query->paginate(20);
        $sales = User::where('role', 'SALE')->orWhere('role', 'ADMIN')->get();
        $censors = User::where('role', 'CENSOR')->orWhere('role', 'ADMIN')->get();

        $count = $query->count();

        $total = $query
            ->join('sales', 'customer_infos.loan_id', '=', 'sales.id')
            ->sum('sales.amount');

        return view('admin.pages.index', [
            'customers' => $customers,
            'sales' => $sales,
            'censors' => $censors,
            'idCard' => $idCard,
            'phone' => $phone,
            'status' => $status,
            'sale' => $sale,
            'censor' =>$censor,
            'count' => $count,
            'total' => $total
        ]);
    }

    public function destroy($id){
        $customer = CustomerInfo::findOrFail($id);
        $customer->delete();

        toastr()->success(" Xóa thành công");
        return back();
    }
}
