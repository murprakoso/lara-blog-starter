@extends('themes.bootstrap4.layout')


@section('content')
<!-- Portfolio Section -->
<div class="container">
    <h2 class="mt-3">Blog</h2>

    <div class="row">

        @forelse ($blogs as $blog)
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <a href="{{ url('blog/'.$blog->slug) }}"><img class="card-img-top" src="{{ asset('storage/'.$blog->image) }}" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ url('blog/'.$blog->slug) }}">{{ $blog->title }}</a>
                        </h4>
                        <p class="card-text">{!! Str::limit($blog->content, 470, '...') !!}</p>
                        {{-- <p class="card-text">{!! Str::of($blog->content)->words(40,'...') !!}</p> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-12 portfolio-item">
                <div class="alert alert-warning text-center">No Post</div>
            </div>
        @endforelse



    </div>

    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>
<!-- /.row -->
@endsection
