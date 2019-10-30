@extends('layouts.app')

@section("content")
    <div class="col-sm-8 blog-main">
        <post-detail-component id="{{ $id }}" has-permission={{ Auth::check()}}></post-detail-component>
    </div><!-- /.blog-main -->
@endsection
