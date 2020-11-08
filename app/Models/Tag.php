<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_tags');
    }


    /**
     *
     * @param  int  $id  post_id
     * @method getSelected Tag in edit post
     */
    public static function getTagIdSelected($id)
    {
        return DB::table('post_tags')
            ->where('post_id', $id)
            ->pluck('tag_id');
    }
}
