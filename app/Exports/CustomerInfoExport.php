<?php

namespace App\Exports;

use App\Models\CustomerInfo;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerInfoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerInfo::all();
    }
}
