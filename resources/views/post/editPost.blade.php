@extends('layouts.app')

@section("content")
    <div class="col-sm-8 blog-main">
        <create-edit-post-component token="{{Auth::user()->api_token}}" id="{{$id}}"></create-edit-post-component>
    </div><!-- /.blog-main -->
@endsection
