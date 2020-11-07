@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($tag) ? 'Update' : 'New'
@endphp

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tags</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-6 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $formTitle }} Tag</h6>
                </div>
                <div class="card-body">

                    @include('admin.partials.flash',['$errors' => $errors])

                    @if (!empty($tag))
                    {!! Form::model($tag, ['url' => ['admin/tags', $tag->id], 'method' => 'PUT'])
                    !!}
                    {!! Form::hidden('id') !!}
                    @else
                    {!! Form::open(['url' => 'admin/tags']) !!}
                    @endif

                    {{-- @csrf --}}
                    {!! Form::token(); !!}

                    <div class="form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'tag name'])
                        !!}
                    </div>


                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('admin/tags') }}" class="btn btn-secondary">Back</a>
                    {!! Form::close() !!}

                </div>
            </div>

        </div>


    </div>
</div>
@endsection
