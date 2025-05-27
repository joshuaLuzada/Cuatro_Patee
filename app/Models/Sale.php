<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Add 'product_id' to fillable fields
    protected $fillable = ['product_id', 'product_name', 'quantity', 'price'];

    // Relationship: Sale belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}