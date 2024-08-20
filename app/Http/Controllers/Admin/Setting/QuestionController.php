<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(){
        $questions = Question::all();
        return view('admin.pages.settings.question',[
            'questions' => $questions
        ]);
    }

    public function showEdit($id){
        $question = Question::find($id);
        return view('admin.pages.settings.edit-question',[
            'question' => $question
        ]);
    }

    public function edit($id, Request $request){
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $question = Question::find($id);
        $question->question = $request->input('question');
        $question->answer = $request->input('answer');
        $question->save();

        toastr()->success(" Sửa thành công");
        return back();
    }
}
