<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use App\Models\ContractTemplate;
use App\Models\DieuKhoan;
use Illuminate\Http\Request;

class ContractTemplateController extends Controller
{
    public function show(){
        $contractTemplate = ContractTemplate::find(1);
        $dieukhoan = DieuKhoan::find(1);
        return view('admin.pages.contract.index', [
            'contractTemplate' => $contractTemplate,
            'dieukhoan' => $dieukhoan
        ]);
    }

    public function save(Request $request){
        $request->validate([
            'template' => 'required|string'
        ]);

        $contractTemplate = ContractTemplate::find(1);
        $contractTemplate->template = $request->input('template');
        $contractTemplate->save();

        toastr()->success('Lưu thành công');
        return back();
    }

    public function dieukhoan(Request $request){
        $request->validate([
            'dk_xu_ly_du_lieu_ca_nhan' => 'required|string',
            'dk_giao_dich' => 'required|string'
        ]);

        $dieukhoan = DieuKhoan::find(1);
        $dieukhoan->dk_xu_ly_du_lieu_ca_nhan = $request->input('dk_xu_ly_du_lieu_ca_nhan');
        $dieukhoan->dk_giao_dich = $request->input('dk_giao_dich');
        $dieukhoan->save();

        toastr()->success('Lưu thành công');
        return back();
    }
}
