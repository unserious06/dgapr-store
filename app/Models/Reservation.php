<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name', 'email', 'phone', 'quantity', 'message', 'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

