<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'comment',
        'file_path',
    ];

    // Relationship with Product
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with ProductColor
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

