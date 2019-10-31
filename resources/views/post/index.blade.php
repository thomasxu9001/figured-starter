@extends('layouts.app')

@section("content")
    <div class="col-sm-8 blog-main">
        @if (Auth::check())
            <div class="float-right">
                <a href="/posts/create">New Post</a>
            </div>
        @endif
        <div>
            <blog-post-list-component></blog-post-list-component>
        </div>
    </div>
@endsection
