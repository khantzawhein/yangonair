<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FbPostTemplate extends Model
{
    //
    protected $fillable = [
        'name',
        'template_en',
        'template_my_MM',
        'category'
    ];
}
