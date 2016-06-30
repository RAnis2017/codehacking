@extends('layouts.admin')
@section('content')
    <h1>Edición de usuarios</h1>

    <div class="row">
    
        <div class="col-sm-3">
            <img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">

            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Rol:') !!}
                {!! Form::select('role_id', ['' => 'Elige un Rol...'] + $roles, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Estado:') !!}
                {!! Form::select('is_active', array(1 => 'Activado', 0 => 'No activado'), null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Foto:') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Contraseña:') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Actualizar Usuario', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}


                <div class="form-group">
                    {!! Form::submit('Borrar Usuario', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>
            {!! Form::close() !!}

        </div>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>

@stop
@section('footer')

@stop