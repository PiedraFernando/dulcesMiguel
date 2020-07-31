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
		return view('ventas.index');
	}
	public function create()
	{

	}
	public function store(Request $request)
	{
		$venta = new Ventas();
		$venta->fecha =  date("d/m/Y");
		$venta->total = $request->get('total');
		$ids = $request->get('id');
		$cantidades = $request->get('cantidad');
		foreach($ids as $i => $id){
			$producto = Producto::where('id', $request->get("id"))->firstOrFail(); 
			$cantidadcarro = $producto->cantidad_carro - $cantidades[$i];
			if($cantidadcarro<0){
				$cantidadcarro = 0;
			}
            Producto::where('id', $id)->update(['cantidad_carro' => $cantidadcarro]);
		}
		$venta->save();
		return redirect('/ventas');
	}


	public function show($id)
	{
		
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
	public function search(Request $request)
	{
		$producto = Producto::where('id','=',$request->id)->first()->toJson();
		return $producto;
	}
	public function totalVentas()
	{
		return view("ventas.totalventas",["ventas"=>Ventas::groupBy('fecha')
		->selectRaw('sum(total) as total, fecha')->get()]);
	}
}
