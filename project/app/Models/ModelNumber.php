<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelNumber extends Model
{
    protected $fillable = ['is_default','model_number'];
    protected $table    = 'model_numbers';

    public $timestamps  = false;
}
