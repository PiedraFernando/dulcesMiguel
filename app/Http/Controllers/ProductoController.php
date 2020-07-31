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
        if ($request) {
            $query = trim($request->get('search'));
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('abreviacion', 'LIKE', '%' . $query . '%')
                ->orderby('nombre', 'asc')->get();
            return view('productos.index', ['productos' => $productos, 'search' => $query]);
        }
    }
    public function add(Request $request)
    {
        $cantidad = $request->get("cantidad");
        $producto = Producto::where('id', $request->get("id"))->firstOrFail();
        $cantidad += $producto->cantidad_almacen;
        Producto::where('id', $request->get("id"))
            ->update(['cantidad_almacen' => $cantidad]);
        return redirect('/producto');
    }
    public function addCar(Request $request)
    {
        $cantidad = $request->get("cantidad");
        $producto = Producto::where('id', $request->get("id"))->firstOrFail();
        $cantidadcarro = $cantidad + $producto->cantidad_carro;
        $cantidadalmacen = $producto->cantidad_almacen - $cantidad;
        if ($cantidadalmacen < 0) {
            return redirect('/producto');
        } else {
            Producto::where('id', $request->get("id"))
                ->update(['cantidad_almacen' => $cantidadalmacen]);
            Producto::where('id', $request->get("id"))
                ->update(['cantidad_carro' => $cantidadcarro]);
            return redirect('/producto');
        }
    }
    public function faltantes()
    {
        $productos = Producto::where('cantidad_almacen', '<', '5')
            ->orderby('nombre', 'asc')->get();
        return view('productos.index', ['productos' => $productos, 'faltantes' => "f"]);
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

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/imagenes/', $name);
        }
        $producto = new Producto();
        $producto->nombre = $request->get('nombre');
        $producto->abreviacion = $request->get('abreviacion');
        $producto->precio_compra = $request->get('compra');
        $producto->precio_venta = $request->get('venta');
        $producto->cantidad_almacen = $request->get('cantidad_almacen');
        $producto->cantidad_carro = $request->get('cantidad_carro');
        if ($request->hasFile('imagen')) {
            $producto->imagen = $name;
        }
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
        return view('productos.edit', ['producto' => Producto::findorFail($id)]);
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
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/imagenes/', $name);
        }
        $producto = Producto::findorFail($id);
        $producto->nombre = $request->get('nombre');
        $producto->abreviacion = $request->get('abreviacion');
        $producto->precio_compra = $request->get('compra');
        $producto->precio_venta = $request->get('venta');
        $producto->cantidad_almacen = $request->get('cantidad_almacen');
        $producto->cantidad_carro = $request->get('cantidad_carro');
        if ($request->hasFile('imagen')) {
            $producto->imagen = $name;
        }
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
