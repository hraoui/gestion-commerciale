<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'description', 'category_id', 'price', 'stock', 'photo', 'barcode',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    public function solds()
    {
        return $this->hasMany(SoldProduct::class);
    }
}
