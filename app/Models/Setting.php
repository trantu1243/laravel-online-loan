<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'logo',
        'background',
        'pc_banner',
        'mobile_banner',
        'popup',
        'popup_image',
        'detail_link',
        'about1',
        'about2',
        'about_image',
        'rate',
        'mb_logo_footer',
        'dieu_khoan_xu_ly_du_lieu_ca_nhan',
        'dieu_khoan_giao_dich',
        'mb_about_image'
    ];
}
