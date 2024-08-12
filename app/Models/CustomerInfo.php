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
        'censor'
    ];

    public function Sale()
    {
        return $this->belongsTo(User::class, 'sale');
    }

    public function Censor()
    {
        return $this->belongsTo(User::class, 'censor');
    }
}
