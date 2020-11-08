@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Post</h1>

        <a href="{{ url('admin/posts/create') }}" class="btn btn-primary btn-sm btn-icon-split">
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
                    <h6 class="m-0 font-weight-bold text-primary">List Post</h6>
                </div>
                <div class="card-body">

                    @include('admin.partials.flash')
                    <div class="table-responsive">
                        <table class="table select" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th style="min-width: 100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox-light">
                                    </td>
                                    <td>
                                        <strong> {{ $post->title }}</strong>
                                    </td>
                                    <td>
                                        @foreach ($post->categories as $category) {{ $category->name }} @endforeach
                                    </td>
                                    <td>
                                        @foreach ($post->tags as $tag)
                                        <span class="badge badge-primary">{{ '#'.$tag->name }}</span> @endforeach
                                    </td>
                                    <td>
                                        @if ($post->published == '1')
                                            <span class="badge badge-success">{{ __('Published') }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="d-inline-block">
                                        <a href="{{ url('blog/'. $post->slug) }}" target="_blank"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ url('admin/posts/'. $post->id .'/edit') }}"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- delete --}}
                                        {!! Form::open(['url' => 'admin/posts/'. $post->id, 'class' =>
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
