@extends('layouts.app')

@section('htmlheader_title')
    403
@endsection

@section('contentheader_title')
    No Authorized
@endsection

@section('$contentheader_description')
@endsection

@section('content')

<div class="error-page">
    <h2 class="headline text-yellow">No Authorized</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! No Authorized.</h3>
        <p>
            {{ trans('adminlte_lang::message.notfindpage') }}
            {{ trans('adminlte_lang::message.mainwhile') }} <a href='{{ url('/home') }}'>No Authorized</a> {{ trans('adminlte_lang::message.usingsearch') }}
        </p>
        <form class='search-form'>
            <div class='input-group'>
                <input type="text" name="search" class='form-control' placeholder="{{ trans('adminlte_lang::message.search') }}"/>
                <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </div><!-- /.input-group -->
        </form>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection