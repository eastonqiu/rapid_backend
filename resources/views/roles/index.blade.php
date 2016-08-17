@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Roles</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('roles.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($roles->isEmpty())
            <div class="well text-center">No Roles found.</div>
        @else
            @include('roles.table')
        @endif

        @include('core-templates::common.paginate', ['records' => $roles])

    </div>
@endsection