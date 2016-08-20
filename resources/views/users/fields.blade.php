{!! Form::hidden('id', null) !!}

@if(app('request')->input('pwd'))
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
@else
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

@permission('role-all')
<!-- Roles Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('roles', 'Roles:') !!}
    @foreach($allRoles as $role)
        <div>
            {!! Form::checkbox('roles[]', $role['id'], in_array($role['id'], empty($roles)? [] : $roles)) !!}
            {!! Form::label('display_name', $role['display_name']) !!}
        </div>
    @endforeach
</div>
@endpermission

@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
