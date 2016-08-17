@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Role</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

            @include('roles.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection