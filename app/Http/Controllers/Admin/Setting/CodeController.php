<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function show(){
        $code = Code::find(1);
        return view('admin.pages.settings.code', ['code' => $code ]);
    }

    public function showOthers(){
        $code = Code::find(1);
        return view('admin.pages.settings.others', ['code' => $code ]);
    }

    public function change(Request $request){
        $request->validate([
            'header' => 'required|string',
            'footer' => 'required|string',
        ]);
        $code = Code::find(1);
        $code->header = $request->input('header');
        $code->footer = $request->input('footer');
        $code->save();

        toastr()->success(' Lưu thành công');
        return back();
    }

    public function changeOthers(Request $request){
        $request->validate([
            'advantage' => 'required|string',
            'procedure' => 'required|string',
            'question' => 'required|string',
            'about_footer' => 'required|string',
        ]);
        $code = Code::find(1);
        $code->advantage = $request->input('advantage');
        $code->procedure = $request->input('procedure');
        $code->question = $request->input('question');
        $code->about_footer = $request->input('about_footer');
        $code->save();

        toastr()->success(' Lưu thành công');
        return back();
    }
}
