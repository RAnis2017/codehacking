<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// Grupo de ruteo, para mayor seguridad.
//// Este grupo hace que los usuarios que no sean administradores no puedan entrar al panel de control.
Route::group(['middleware' => 'Admin'], function() {
    // Inicio del panel de administración. Una simple vista.
    Route::get('/admin', function() {
        return view('admin.index');
    });
    // distintas páginas del panel de administración. Van pasando por los diferrentes controladores.
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    
});
