<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use App\Models\ContractTemplate;
use Illuminate\Http\Request;

class ContractTemplateController extends Controller
{
    public function show(){
        $contractTemplate = ContractTemplate::find(1);
        return view('admin.pages.contract.index', ['contractTemplate' => $contractTemplate]);
    }

    public function save(Request $request){
        $request->validate([
            'template'
        ]);

        $contractTemplate = ContractTemplate::find(1);
        $contractTemplate->template = $request->input('template');
        $contractTemplate->save();

        toastr()->success('Lưu thành công');
        return back();
    }
}
