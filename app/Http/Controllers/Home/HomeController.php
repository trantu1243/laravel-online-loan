<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Advantage;
use App\Models\Code;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\FooterInfo;
use App\Models\Process;
use App\Models\Question;
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
        $questions = Question::all();
        $estimate = Estimate::find(1);
        $subjects = Subject::all();
        $process = Process::all();
        $advantages = Advantage::all();
        $footer = FooterInfo::find(1);
        return view('index', [
            'setting' => $setting,
            'loans' => $loans,
            'customers' => $customers,
            'code' => $code,
            'subjects' => $subjects,
            'questions' => $questions,
            'estimate' => $estimate,
            'process' => $process,
            'advantages' => $advantages,
            'footer' => $footer
        ]);
    }
}
