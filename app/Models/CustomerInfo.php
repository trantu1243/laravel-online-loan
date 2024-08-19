<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCard',
        'name',
        'phone',
        'salaryType',
        'timeCall',
        'status',
        'sale',
        'censor',
        'linkfb',
        'desiredAmount',
        'desiredDuration',
        'income',
        'loan_id',
        'call_time',
        'transfer_time',
        'contract_id',
        'fill_time',
        'debt',
        'paid',
        'num_reminder',
        'month_num',
        'day',
        'month_debt',
        'sum'
    ];

    public function Sale()
    {
        return $this->belongsTo(User::class, 'sale');
    }

    public function Censor()
    {
        return $this->belongsTo(User::class, 'censor');
    }

    public function loan()
    {
        return $this->belongsTo(Sale::class, 'loan_id');
    }

    protected $table = 'customer_infos';

}
