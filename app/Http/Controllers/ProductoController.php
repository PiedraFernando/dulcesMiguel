<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Http\Requests\ProductoForReques;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $query = trim($request->get('search'));
            $productos = Producto::where('nombre','LIKE','%'.$query.'%')
                ->orWhere('clave','LIKE','%'.$query.'%')
                ->orWhere('codigo_de_barras','LIKE','%'.$query.'%')
                ->orderby('nombre','asc')->get();
            return view('productos.index',['productos' => $productos,'search'=>$query]);
        }
    }
    public function faltantes()
    {
        $productos = Producto::where('cantidad','<','5')
                ->orderby('nombre','asc')->get();
        return view('productos.index',['productos' => $productos,'faltantes'=> "f"]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoForReques $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->clave = $request->get('clave');
        $producto->codigo_de_barras = $request->get('codigo');
        $producto->precio_compra = $request->get('compra');
        $producto->precio_venta = $request->get('venta');
        $producto->cantidad = $request->get('cantidad');
        $producto->save();
        return redirect('/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('productos.edit', ['producto'=>Producto::findorFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoForReques $request, $id)
    {
        $producto = Producto::findorFail($id);
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->clave = $request->get('clave');
        $producto->codigo_de_barras = $request->get('codigo');
        $producto->precio_compra = $request->get('compra');
        $producto->precio_venta = $request->get('venta');
        $producto->cantidad = $request->get('cantidad');
        $producto->update();
        return redirect('/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findorFail($id);
        $producto->delete();
        return redirect('/producto');
    }
}
