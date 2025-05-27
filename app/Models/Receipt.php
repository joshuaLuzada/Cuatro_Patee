<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'number',
        'total',
        // add other fields here
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price');
    }
}
