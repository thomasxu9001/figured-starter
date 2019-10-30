@extends('layouts.app')

@section("content")
    <div class="col-sm-8 blog-main">
        @if (Auth::check())
            <div>
                <a href="/posts/create">New Post</a>
            </div>
        @endif
        <div>
            <blog-post-card-component></blog-post-card-component>
        </div>
    </div>
@endsection
