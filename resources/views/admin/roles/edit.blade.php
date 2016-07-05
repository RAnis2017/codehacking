@extends('layouts.admin')
@section('content')
    <h1>Editar Role</h1>
    <div class="col-sm-6">
        {!! Form::model($role,['method'=>'PATCH', 'action'=>['AdminRolesController@update', $role->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nombre Rol:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Modificar Rol', ['class'=>'btn btn-primary col-sm-6']) !!}
        </div>
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminRolesController@destroy', $role->id]]) !!}

        <div class="form-group">
            {!! Form::submit('Eliminar Rol', ['class'=>'btn btn-danger col-sm-6']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <div class="col-sm-6">

    </div>
@stop
@section('footer')

@stop