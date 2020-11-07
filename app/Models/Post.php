<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'title', 'slug', 'image', 'content', 'published'
    ];


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_posts');
    }
}
