<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use Illuminate\Http\Request;

class FooterInfoController extends Controller
{
    public function show(){
        $footer = FooterInfo::find(1);
        return view('admin.pages.settings.footer', ['footer' => $footer]);
    }

    public function save(Request $request){
        $request->validate([
            'phone' => 'required|string',
            'hotline' => 'required|string',
            'address' => 'required|string',
            'website' => 'required|string',
            'note' => 'required|string',
            'content' => 'required|string'
        ]);

        $footer = FooterInfo::find(1);
        $footer->phone = $request->input('phone');
        $footer->hotline = $request->input('hotline');
        $footer->address = $request->input('address');
        $footer->website = $request->input('website');
        $footer->note = $request->input('note');
        $footer->content = $request->input('content');
        $footer->save();

        toastr()->success(" Sửa thành công");
        return back();
    }
}
