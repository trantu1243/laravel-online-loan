<?php

namespace App\Http\Controllers\Admin\Censor;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CensorController extends Controller
{
    public function show(){
        $customers = CustomerInfo::with(['Sale', 'Censor'])->where('status', 'CENSOR')->orderBy('created_at', 'desc')->paginate(15);

        $id = Auth::id();
        $censorCustomers = CustomerInfo::where('censor', $id)->where('status', 'DONE')->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.pages.censor.index', ['customers' => $customers, 'censorCustomers' => $censorCustomers]);
    }

    public function browse($id){
        $customer = CustomerInfo::findOrFail($id);
        $id = Auth::id();
        $customer->sale = $id;
        $customer->status = 'DONE';
        $customer->save();

        return redirect(route('detail-censor', ['id' => $customer->id]));
    }
}
