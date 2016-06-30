@extends('layouts.admin')
@section('content')

    @if(Session::has('deleted_user'))

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p class="bg-danger">{{ session('deleted_user') }}</p>
        </div>
    @endif
    <h1>Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Fecha modificación</th>
            </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/50x50'}}" alt="" height="50px" class="img-rounded"></td>
                <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ? $user->role->name : '-' }}</td>
                <td>{{ $user->is_active == 1 ? 'Activado' : 'No activado' }}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop
@section('footer')

@stop