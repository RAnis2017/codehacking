@extends('layouts.admin')
@section('content')
    <h1>Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Foto</th>
                <th>Creador</th>
                <th>Categoría</th>
                <th>Título</th>
                <th>Cuerpo</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Modificación</th>
            </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning" role="button">Editar</a></td>
                <td>{{ $post->id }}</td>
                <td><img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" alt="" height="50"></td>
                <td><a href="{{ route('admin.users.edit', $post->user_id) }}">{{ $post->user->name }}</a></td>
                <td>{{ $post->category ? $post->category->name : '-' }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body}}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop
@section('footer')

@stop