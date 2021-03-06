<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name',
        'code',
        'body',
        'length',
        'header',
        'keywords',
        'description'
    ];
}
