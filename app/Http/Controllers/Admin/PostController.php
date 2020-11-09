<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $this->data['tagIDs'] = null;
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
            //
            $params = $request->except('_token');
            // $params['slug'] = Str::slug($request['title']);
            $params['slug'] = Str::slug($request['slug']);
            $params['author_id'] = Auth::user()->id;
            $params['published'] = $request['status'];
            // Image
            $image = $request->image;
            $imageName = $params['slug'] . '_' . time() . '_';
            $newImage = $imageName . $image->getClientOriginalName();

            $folder = Post::UPLOAD_DIR . '/images';
            $params['image']  = $image->storeAs($folder . '/original', $newImage, 'public');
            //
            $post = Post::create($params);
            if ($post) {
                $post->categories()->attach($request->category_id);
                $post->tags()->attach($request->tag_id);

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
     * @param   array   tagIDs -> tagID Selected
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        // $tag = DB::table('post_tags')->where('post_id', $id)->pluck('tag_id');

        $this->data['post'] = $post;

        $this->data['tags'] = Tag::pluck('name', 'id');
        $this->data['tagIDs'] = Tag::getTagIdSelected($id);

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
    public function update(PostRequest $request, $id)
    {
        try {
            //
            $params = $request->except('_token');

            $params['slug'] = Str::slug($request['slug']);
            $params['author_id'] = Auth::user()->id;
            $params['published'] = $request['status'];

            $post = Post::findOrFail($id);
            // Image if has file
            if ($request->hasFile('image')) {
                $image = $request->image;
                $imageName = $params['slug'] . '_' . time() . '_';
                $newImage = $imageName . $image->getClientOriginalName();

                $folder = Post::UPLOAD_DIR . '/images';
                $params['image']  = $image->storeAs($folder . '/original', $newImage, 'public');
                Storage::disk('public')->delete($post->image); // unlink img
            }
            //

            if ($post->update($params)) {
                // sync on pivot table
                Post::find($id)->categories()->sync($request->category_id);
                Post::find($id)->tags()->sync($request->tag_id);

                toastr()->info('Post has been updated.');
            }
            return redirect('admin/posts');


            //
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($post->delete()) {
                Storage::disk('public')->delete($post->image);
                toastr()->info('Post has been deleted.');
            }
            return redirect('admin/posts');

            //
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
