@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit User</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

            @include('users.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection