@extends('layouts.admin')
@section('content')
    <h1>Media</h1>
    @if($photos)
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
        @foreach($photos as $photo)
            <tr>
                <td>{{ $photo->id }}</td>
                <td><img src="{{ $photo->file }}" alt="" height="50px"></td>
                <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : '-' }}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}

                    <div class="form-group">
                        {!! Form::submit('Borrar', ['class'=>'btn btn-danger']) !!}
                    </div>
                {!! Form::close() !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@stop
@section('footer')

@stop