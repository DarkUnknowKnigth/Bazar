<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ventas.show')->with([
            'ventas'=>Venta::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'precioVenta'=>'numeric|required',
            'cantidad'=>'numeric|required',
            'producto_id'=>'required',
            'vendedor_id'=>'required',
            'comprador_id'=>'required'
        ]);
        $p=Producto::find($request->producto_id);
        $p->update(['disponibles'=>($p->disponibles-$request->cantidad)]);
        $request['fecha']=Carbon::now()->toDateString();
        $venta=Venta::create($request->all());
        return redirect()->route('ventas.todas',$venta);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {

    }
    public function todas(){
        return view('ventas.show')->with([
            'ventas'=>Venta::where('comprador_id','=',auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
