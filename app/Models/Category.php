<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function products(){
        // Define the relationship with products
        return $this->hasMany(Product::class);
    }

}
