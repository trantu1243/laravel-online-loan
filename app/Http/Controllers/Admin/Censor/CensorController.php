<?php

namespace App\Http\Controllers\Admin\Censor;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CensorController extends Controller
{
    public function show(){
        $customers = CustomerInfo::with(['Sale', 'Censor'])->where('status', 'CENSOR')->where('censor', null)->orderBy('created_at', 'desc')->paginate(15);

        $id = Auth::id();
        $censorCustomers = CustomerInfo::where('censor', $id)->orderBy('updated_at', 'desc')->paginate(10);

        $count = CustomerInfo::where('censor', $id)
            ->whereMonth('transfer_time', now()->month)
            ->count();

        $total = CustomerInfo::join('sales', 'customer_infos.loan_id', '=', 'sales.id')
            ->where('censor', $id)
            ->whereMonth('transfer_time', now()->month)
            ->sum('sales.amount');
        return view('admin.pages.censor.index', [
            'customers' => $customers,
            'censorCustomers' => $censorCustomers,
            'count' => $count,
            'total' => $total
        ]);
    }

    public function browse($id){
        $customer = CustomerInfo::findOrFail($id);
        $id = Auth::id();
        $customer->censor = $id;
        $customer->save();

        return redirect(route('detail-censor', ['id' => $customer->id]));
    }
}
