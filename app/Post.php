<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // MASS ASSIGNEMENT

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
    ];


    // Relation with 'Categories'

    // Posts -> Categories
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
