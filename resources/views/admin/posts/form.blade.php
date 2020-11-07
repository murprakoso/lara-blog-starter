@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($post) ? 'Update' : 'New'
@endphp

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Posts</h1>
    </div>

    <!-- Content Row -->
    @if (!empty($post))
    {!! Form::model($post, ['url' => ['admin/posts', $post->id], 'method' => 'PUT','enctype' =>
    'multipart/form-data'])
    !!}
    {!! Form::hidden('id') !!}
    @else
    {!! Form::open(['url' => 'admin/posts','enctype' =>
    'multipart/form-data']) !!}
    @endif
    {{-- @csrf --}}
    {!! Form::token(); !!}

    <div class="row">


        <div class="col-lg-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $formTitle }} Post</h6>
                </div>
                <div class="card-body">

                    @include('admin.partials.flash',['$errors' => $errors])

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'post title'])
                        !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'Content') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control summernote', 'placeholder' => 'content'])
                        !!}
                    </div>


                </div>
            </div>
        </div>
        {{-- /.col --}}

        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <div class="form-group">
                        {!! Form::label('image', 'Post Image') !!}
                        {!! Form::file('image', ['class' => 'form-control-file', 'placeholder' => 'post image']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category', 'Category') !!}
                        {!! General::selectMultiLevel('category_id', $categories, ['class' => 'form-control category',
                        'selected'
                        => !empty(old('category_id')) ? old('category_id') : $categoryIDs ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('tag', 'Tag') !!}
                        {!! Form::select('tag_id[]', $tags, null, ['class'=>'form-control select2','multiple' => true]);!!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['placeholder' => 'Status...','class'=>'form-control']);!!}
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('admin/posts') }}" class="btn btn-secondary">Back</a>

                </div>
            </div>
        </div>



    </div>
    {!! Form::close() !!}
</div>
@endsection
