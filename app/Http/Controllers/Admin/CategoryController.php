<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = null;

        return view('admin.categories.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            //
            $params = $request->except('_token');
            $params['slug'] = Str::slug($params['name']);
            $params['parent_id'] = (int)$params['parent_id'];

            if (Category::create($params)) {
                // Session::flash('success', 'category has been saved');
                toastr()->info('Category has been saved.');
            }
            return redirect('admin/categories');

            //
        } catch (\Throwable $th) {
            echo $th;
            die;
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
        $categories = Category::orderBy('id', 'asc')->get();
        $category = Category::findOrFail($id);

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = $category;

        return view('admin.categories.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            //
            $params = $request->except('_token');
            $params['slug'] = Str::slug($params['name']);
            $params['parent_id'] = (int)$params['parent_id'];

            $category = Category::findOrFail($id);

            if ($category->update($params)) {
                toastr()->info('Category has been updated.');
            }
            return redirect('admin/categories');
            //
        } catch (\Throwable $th) {
            echo $th;
            die;
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
            $category = Category::findOrFail($id);

            if ($category->delete()) {
                toastr()->info('Category has been deleted.');
            }
            return redirect('admin/categories');
        } catch (\Throwable $th) {
            dd($th);
            die;
        }
    }
}
