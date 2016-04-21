@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Posts</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('posts.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($posts->isEmpty())
            <div class="well text-center">No Posts found.</div>
        @else
            @include('posts.table')
        @endif
        
    </div>
@endsection