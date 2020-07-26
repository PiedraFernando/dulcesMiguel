<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () { /* manda al login */
//    return view('login');
//});

Route::post('/producto/add', 'ProductoController@add');
Route::post('/producto/addCar', 'ProductoController@addCar');
Route::get('/producto/faltantes', 'ProductoController@faltantes');
Route::resource('producto', 'ProductoController');
Auth::routes();



Route::get('/', 'HomeController@index')->name('home');
Route::resource('usuarios', 'UserController');

Route::resource('categorias', 'CategoriaController');

//ventas rutas
Route::resource('ventas','VentasController');