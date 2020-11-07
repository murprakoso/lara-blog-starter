<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['posts'] = Post::get();
        return view('admin.posts.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['categoryIDs'] = [];
        $this->data['tags'] = Tag::pluck('name', 'id');
        $this->data['post'] = null;

        return view('admin.posts.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            //code...
            $params = $request->except('_token');
            $params['slug'] = Str::slug($request['title']);
            $params['author_id'] = Auth::user()->id;
            $params['published'] = $request['status'];

            $image = $request->image;
            $imageName = $params['slug'] . '_' . time() . '_';
            $newImage = $imageName . $image->getClientOriginalName();

            $params['image'] = $newImage;

            $post = Post::create($params);
            // dd($newImage);
            if ($post) {
                $post->categories()->attach($request->category_id);
                toastr()->info('Post has been saved.');
            }
            return redirect('admin/posts');


            //
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();

        $this->data['post'] = $post;
        $this->data['tags'] = Tag::pluck('name', 'id');
        $this->data['categories'] = $categories->toArray();
        $this->data['categoryIDs'] = $post->categories->pluck('id')->toArray();

        return view('admin.posts.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
