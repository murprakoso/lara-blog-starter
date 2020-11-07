@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>

        <a href="{{ url('admin/categories/create') }}" class="btn btn-primary btn-sm btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create New</span>
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Category</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <div class="table-responsive">
                        <table class="table select" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                                    <td>
                                        <a href="{{ url('admin/categories/'. $category->id .'/edit') }}"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- delete --}}
                                        {!! Form::open(['url' => 'admin/categories/'. $category->id, 'class' =>
                                        'delete',
                                        'style' => 'display:inline-block']) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<i class="fas fa-trash"></i>', ['type'=>'submit','class' =>
                                        'btn btn-secondary
                                        btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
