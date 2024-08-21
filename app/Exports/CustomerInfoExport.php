<?php

namespace App\Exports;

use App\Models\CustomerInfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerInfoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerInfo::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'cccd',
            'name',
            'phone',
            'salaryType',
            'timeCall',
            'status',
            'sale id',
            'censor id',
            'created at',
            'updated at',
            'linkfb',
            'desiredAmount',
            'desiredDuration',
            'income',
            'call_time',
            'transfer_time',
            'contract_id',
            'loan_id',
            'fill_time',
            'debt',
            'paid',
            'num_reminder',
            'month_num',
            'day',
            'month_debt',
            'sum'
        ];
    }
}
