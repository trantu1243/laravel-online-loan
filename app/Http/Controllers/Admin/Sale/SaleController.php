<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function show(){
        $customers = CustomerInfo::with(['Sale', 'Censor'])->where('status', 'PENDING')->orderBy('created_at', 'desc')->paginate(15);

        $id = Auth::id();
        $saleCustomers = CustomerInfo::where('sale', $id)->where('status', '!=', 'DONE')->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.pages.sale.index', ['customers' => $customers, 'saleCustomers' => $saleCustomers]);
    }

    public function call($id){
        $customer = CustomerInfo::findOrFail($id);
        $id = Auth::id();
        $customer->sale = $id;
        $customer->status = 'SALE';
        $customer->save();

        toastr()->success("Đã nhận gọi khách hàng");

        return redirect(route('detail-sale', ['id' => $customer->id]));
    }
}
