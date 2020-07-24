<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view( 'usuarios.index', ['users' => $users]);
  
    }

    public function create()
    {
        return view('usuarios.create');
    }

   
    public function store(Request $request)
    {
        $usuario = new User();
        
        $usuario->name = request ( 'name');
        $usuario->email = request ( 'email');
        $usuario->password = request ( 'password');

        $usuario->save();

        return redirect('/usuarios');
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view ('usuarios.edit',['user'=>User::findOrFail($id)]);
    }

   
    public function update(Request $request, $id)
    {
        $usuario =  User::findOrFail($id);
        
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');

        $usuario->update();

        return redirect('/usuarios');
    }

    
    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->delete();
        
        return redirect ('/usuarios');
    }
}
