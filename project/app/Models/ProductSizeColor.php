<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'stock'
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with Size
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    // Relationship with ProductColor
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    
}

