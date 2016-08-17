@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Users</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('users.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($users->isEmpty())
            <div class="well text-center">No Users found.</div>
        @else
            @include('users.table')
        @endif

        @include('core-templates::common.paginate', ['records' => $users])

    </div>
@endsection