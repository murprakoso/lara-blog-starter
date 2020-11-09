<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function __construct()
    {
        //
        $this->blog = new Post();
    }

    public function index()
    {
        // $blog = new Post();
        $blog = Post::where('published', '=', 1)->paginate(6);
        $this->data['blogs'] = $blog;

        return $this->loadTheme('blogs.index', $this->data);
    }


    public function detail($slug)
    {
        $blog = Post::active()->where('slug', $slug)->first();
        $categories = Category::all();

        if (!$blog) {
            return redirect('blog');
        }
        $this->data['blog'] = $blog;
        $this->data['categories'] = $categories;

        // dd($blog);
        return $this->loadTheme('blogs.detail', $this->data);
    }
}
