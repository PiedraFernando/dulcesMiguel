<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Mostrar una lista de los registros
    public function index()
    {
        $users = User::all();
        return view( 'usuarios.index', ['users' => $users]);

    }

    //Mostrar el formulario para crear un nuevo registro
    public function create()
    {
            return view('usuarios.create');
    }

    //Almacenar los registros recien creados de create en la base de datos.
    public function store(Request $request)
    {
        $usuario = new User();

        $usuario->name = request ( 'name');
        $usuario->email = request ( 'email');
        $usuario->password = request ( 'password');

        $usuario->save();

        return redirect('/usuarios');
    }

    //Mostrar un registro en especifico
    public function show($id)
    {
        //
    }

    //Muestra los datos a editar de un registro especifico
    public function edit($id)
    {
        return view ('usuarios.edit',['user'=>User::findOrFail($id)]);
    }

    //Actualizar un registro en la base de datos.
    public function update(Request $request, $id)
    {
        $usuario =  User::findOrFail($id);

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');

        $usuario->update();

        return redirect('/usuarios');
    }

    //Eliminar un registro especifico de la base de datos.
    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->delete();

        return redirect ('/usuarios');
    }
}
