<?php

namespace App\Http\Controllers\Admin\Censor;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function show(Request $request){
        $id = Auth::id();
        $day = 5;
        if ($request->has('day')) $day = $request->input('day');
        $customers = CustomerInfo::with(['loan'])
            ->where('censor', $id)
            ->where('status', 'DONE')
            ->where('debt', '>', 0)
            ->where(function($query) use ($day) {
                $query->where('day', now()->day);
                for($i = 1; $i < $day; $i++)
                    $query->orWhere('day', now()->addDay($i)->day);
            })
            ->paginate(15);
        $overdueCustomers = CustomerInfo::with(['loan'])
            ->where('censor', $id)
            ->where('month_debt', '>', 0)
            ->paginate(15);

        return view('admin.pages.censor.reminder', [
            'customers' => $customers,
            'overdueCustomers' => $overdueCustomers,
            'day'=> $day
        ]);
    }

    public function remind($id){
        $userId = Auth::id();
        $customer = CustomerInfo::where('id', $id)->where('status', 'DONE')->where('CENSOR', $userId)->first();
        $customer->num_reminder += 1;
        $customer->save();
        toastr()->success(": Đã nhắc nhở khách hàng {$customer->name}");
        return back();
    }

    public function transfer($id, Request $request){
        $userId = Auth::id();
        $customer = CustomerInfo::where('id', $id)->where('status', 'DONE')->where('CENSOR', $userId)->first();

        $request->validate([
            'money' => 'required|string'
        ]);
        $customer->debt -= $request->input('money');
        $customer->sum += $request->input('money');
        if ($customer->debt <= 0){
            $customer->paid = true;
        }
        $customer->save();
        toastr()->success(": Đã xác nhận khách hàng {$customer->name} trả {$request->input('money')} vnđ");
        return back();
    }

    public function transfer2($id, Request $request){
        $userId = Auth::id();
        $customer = CustomerInfo::with(['loan'])->where('id', $id)->where('status', 'DONE')->where('CENSOR', $userId)->first();

        $request->validate([
            'money' => 'required|string'
        ]);
        $rate = $customer->loan->rate / 1200;
        $pv = $customer->loan->amount * 1000000;
        $nper = $customer->loan->duration;

        $m = $pv / $nper;

        $pvif = pow(1 + $rate, $nper);
        $m = ($rate * $pv * ($pvif)) / ($pvif - 1);
        $m = round($m, -3);

        $money = $customer->debt - $m;

        $customer->debt -= $request->input('money');
        $customer->sum += $request->input('money');
        if ($money <= $request->input('money')){
            $customer->month_debt = 0;
        }
        $customer->save();
        toastr()->success(": Đã xác nhận khách hàng {$customer->name} trả {$request->input('money')} vnđ");
        return back();
    }
}
