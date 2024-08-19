<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show(){
        $subjects = Subject::all();
        return view('admin.pages.settings.form', ['subjects' => $subjects]);
    }

    public function add(Request $request){
        $request->validate([
            'subject' => 'required|string'
        ]);

        Subject::create([
            'subject' => $request->input('subject')
        ]);

        toastr()->success('Thêm thành công');
        return back();
    }

    public function destroy($id){
        $subject = Subject::findOrFail($id);
        $subject->delete();
        toastr()->success('Xóa thành công');
        return back();
    }
}
