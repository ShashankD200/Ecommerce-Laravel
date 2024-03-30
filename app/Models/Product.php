<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $table = 'products';
   protected $fillable = [
    'name', // Add the 'name' attribute to the $fillable array
    'description',
    'size',
    'category',
    'price',
    'offer_price',
    'in_stock',
    'discount',
    'gender',
];
   public static function getAllProducts(){
    return self::all();
   }
   public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
