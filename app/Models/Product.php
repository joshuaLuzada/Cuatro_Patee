<?php
// filepath: c:\xampp\htdocs\Cuatro_Patee\app\Models\Product.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 
    'image',
    'name',
    'price',
    'stock',
    'description'
    ];
}