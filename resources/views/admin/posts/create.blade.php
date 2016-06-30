@extends('layouts.admin')
@section('content')
    <h1>Crear Post</h1>
    <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'Título:') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Categoría:') !!}
                {!! Form::select('category_id', array(1 => 'PHP', 2 => 'JavaScript'), ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Foto:') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Cuerpo:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Crear Post', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@stop
@section('footer')

@stop