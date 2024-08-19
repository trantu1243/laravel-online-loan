<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'amount',
        'duration',
        'status',
        'rate',
        'minIncome'
    ];

    public function customer()
    {
        return $this->hasMany(CustomerInfo::class);
    }
}
