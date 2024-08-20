<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    public function show(){
        $estimate = Estimate::find(1);
        return view('admin.pages.settings.estimate', ['estimate' => $estimate]);
    }

    public function save(Request $request){
        $request->validate([
            'min_loan' => 'required|string',
            'max_loan' => 'required|string',
            'min_month' => 'required|string',
            'max_month' => 'required|string',
            'rate' => 'required|string',
            'content' => 'required|string'
        ]);

        $estimate = Estimate::find(1);
        $estimate->min_loan = $request->input('min_loan');
        $estimate->max_loan = $request->input('max_loan');
        $estimate->min_month = $request->input('min_month');
        $estimate->max_month = $request->input('max_month');
        $estimate->rate = $request->input('rate');
        $estimate->content = $request->input('content');
        $estimate->save();

        toastr()->success(" Sửa thành công");
        return back();
    }
}
