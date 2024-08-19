<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerInfoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new CustomerInfoExport, 'data.xlsx');
    }
}
