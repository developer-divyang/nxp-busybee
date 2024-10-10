<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userlogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logo',
    ];

    // Relationship with Product
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

