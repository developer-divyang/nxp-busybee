<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_name',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with ProductSizeColor
    public function sizeColors()
    {
        return $this->hasMany(ProductSizeColor::class, 'size_id');
    }
}

