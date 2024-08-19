<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DieuKhoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dk_xu_ly_du_lieu_ca_nhan',
        'dk_giao_dich'
    ];

    protected $table = 'dieu_khoan';
}
