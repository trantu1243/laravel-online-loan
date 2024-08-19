<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\DieuKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function dk_giao_dich(){
        $dieukhoan = DieuKhoan::find(1);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($dieukhoan->dk_giao_dich);
        return $pdf->stream();
    }

    public function dk_xu_ly_du_lieu_ca_nhan(){
        $dieukhoan = DieuKhoan::find(1);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($dieukhoan->dk_xu_ly_du_lieu_ca_nhan);
        return $pdf->stream();
    }
}
