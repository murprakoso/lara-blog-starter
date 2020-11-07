<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['tags'] = Tag::all();

        return view('admin.tags.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['tag'] = null;
        return view('admin.tags.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try {
            //
            $params = $request->except('_token');
            $params['slug'] = Str::slug($params['name']);

            if (Tag::create($params)) {
                toastr()->info('Tag has been saved.');
            }

            return redirect('admin/tags');
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
        $tag = Tag::findOrFail($id);

        $this->data['tag'] = $tag;
        return view('admin.tags.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        try {
            //
            $params = $request->except('_token');
            $params['slug'] = Str::slug($params['name']);

            $tag = Tag::findOrFail($id);

            if ($tag->update($params)) {
                toastr()->info('Tag has been updated.');
            }

            return redirect('admin/tags');
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
            $tag = Tag::findOrFail($id);

            if ($tag->delete()) {
                toastr()->info('Tag has been deleted.');
            }
            return redirect('admin/tags');
        } catch (\Throwable $th) {
            dd($th);
            die;
        }
    }
}
