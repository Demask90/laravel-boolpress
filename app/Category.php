<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'content', 'slug' ];
    // definisco la relazione (1 a N) tra il model Category e il model Post
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
