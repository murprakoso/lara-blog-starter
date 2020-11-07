<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'parent_id'];


    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }


    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'category_posts');
    }
}
