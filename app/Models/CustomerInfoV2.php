<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfoV2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_info_id',
        'frontCCCD',
        'backCCCD',
        'salary_slip',
        'faceData',
        'confirm',
        'accept',
        'employment_contract'
    ];

    protected $table = 'customer_infor_v2s';
}
