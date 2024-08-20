<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_loan',
        'max_loan',
        'min_month',
        'max_month',
        'rate',
        'content'
    ];

}
