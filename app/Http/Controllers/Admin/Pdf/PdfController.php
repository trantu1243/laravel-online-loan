<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function generate($id){
        $contract = Contract::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($contract->content);
        return $pdf->stream();
    }
}
