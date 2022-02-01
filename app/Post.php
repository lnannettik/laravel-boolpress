<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // MASS ASSIGNEMENT

    protected $fillable = [
        'title',
        'content',
        'slug'
    ];
}
