<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//esto imprime por ajax los datos a la tabla del modal de ventas
Route::get('ventas', function (){
return datatables()
->eloquent(App\Producto::query())
->addColumn('btn', 'ventas.actions')
->rawColumns(['btn'])
->toJson();
});

/*Route::get('productos', function (){
    return datatables()
    ->eloquent(App\Producto::query())
    ->addColumn('input', 'ventas.miput')
    ->rawColumns(['input'])
    ->toJson();
    });
    */


