<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_group',
        'color_name',
        'color_image',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with ProductColorImage
    public function images()
    {
        return $this->hasMany(ProductColorImage::class, 'color_id');
    }

    //get all ProductColorImage belongs to this product_id and color_id
    public function productColorImages()
    {
        return $this->hasMany(ProductColorImage::class, 'color_id')->where('product_id', $this->product_id);
    }
    

    // Relationship with ProductSizeColor
    public function sizeColors()
    {
        return $this->hasMany(ProductSizeColor::class, 'color_id');
    }
}

