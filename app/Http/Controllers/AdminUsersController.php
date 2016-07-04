<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cargamos todos lo usuarios.
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recogemos todos los roles
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // Recogemos todos los datos de la $request.
//        User::create($request->all());
//        return redirect('/admin/users');

        // Si la contraseña está vacía no se pasa cini parámetro.
        if(trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            // Encripto contraseña.
            $input['password'] = bcrypt($request->password);
        }
        
        if($file = $request->file('photo_id')) {
            // le cambio el nombre a la imagen, con la fecha delante y concatenando el nombre original de la foto.
            $name = time() . $file->getClientOriginalName();
            // Muevo la imagen al directorio images, con el nombre que he asignado anteriormente.
            $file->move('images', $name);
            //Persisto la foto en la tabla Photos.
            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        }

        // Persistimos el usuario.
        $user = User::create($input);
//        return $request->all();
        // Feedback de la acción.
        Session::flash('created_user', 'El usuario: ' . $user->name . ' ha sido creado.');
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        // Buscamos el usuario con el $id proporcionado.
        $user = User::findOrFail($id);

        if(trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            // Recojo toda la petición y la almaceno en un array $input.
            $input = $request->all();
            // Encripto contraseña.
            $input['password'] = bcrypt($request->password);
        }
        
        // Miramos si se ha introducido una imagen.
        // En dicho caso, la movemos al directorio indicado.
        // Almacenamos en el array input el photo_id recibido de la petición
        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        // Actualizamos los datos de en la tabla Users con el input que hemos rellenado anteriormente.
        $user->update($input);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Busco el usuario de la BBDD.
        $user = User::findOrFail($id);
        // Borramos la imagen del path.
        // No hace falta incluir el path de la carpeta /images/ porque ya está declarada en el accesor.
//        unlink(public_path() . '/images/' . $user->photo->file);
        // Quedaría de la siguiente forma.
        // Si no hay foto no la borro. Es un fix de verificación. Evita un pete inesperado al borrar user.
        if($user->photo_id != 0) {
            unlink(public_path() . $user->photo->file);
        }
        // Borro el usuario.
        $user->delete();

        // Feedback de la acción.
        Session::flash('deleted_user', 'El usuario: ' . $user->name . ' ha sido eliminado.');
        
        return redirect('/admin/users');
    }
}
