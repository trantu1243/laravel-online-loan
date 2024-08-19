<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Subject;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show(){
        $setting = Setting::find(1);
        $loans = Sale::where('status', true)->get();
        $customers = Customer::all();
        $code = Code::find(1);
        $subjects = Subject::all();
        return view('index', [
            'setting' => $setting,
            'loans' => $loans,
            'customers' => $customers,
            'code' => $code,
            'subjects' => $subjects
        ]);
    }
}
