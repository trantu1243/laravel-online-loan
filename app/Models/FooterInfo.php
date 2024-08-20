<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'hotline',
        'address',
        'website',
        'note',
        'content'
    ];

    protected $table = 'footer_info';
}
