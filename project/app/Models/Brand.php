<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['is_default','brand'];
    protected $table    = 'brands';

    public $timestamps  = false;
}
