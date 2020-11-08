<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'title', 'slug', 'image', 'content', 'published'
    ];

    public const UPLOAD_DIR = 'uploads';


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_posts');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'post_tags');
    }

    public static function active()
    {
        $users = DB::table('posts')
            ->where('published', '=', 1)
            ->get();
        return $users;
    }
}
