@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Permissions</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('permissions.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($permissions->isEmpty())
            <div class="well text-center">No Permissions found.</div>
        @else
            @include('permissions.table')
        @endif

        @include('core-templates::common.paginate', ['records' => $permissions])

    </div>
@endsection