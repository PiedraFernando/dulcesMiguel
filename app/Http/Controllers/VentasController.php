<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\User;
use App\Ventas;
use Yajra\DataTables\DataTables;
class VentasController extends Controller
{
    public function index()
    {
return view ('ventas.index');
            }
    public function create()
            {
                        }
    public function store(Request $request)
     {
 
             }
                    
                    
    public function show($id)
            {
                            //
          }
                    
                    
    public function edit($id)
        {

         }
                    
                    
 public function update(Request $request, $id)
           {
 
          }
                    
                    
public function destroy($id)
    {

     }
}

