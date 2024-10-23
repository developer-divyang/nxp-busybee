<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function countConversation()
    {
        return ChatMessage::where('user_id', '!=', Auth::guard('admin')->user()->id)->where('is_seen', 0)->latest('id')->get()->count();
    }
}

