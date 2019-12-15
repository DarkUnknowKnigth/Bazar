<?php

namespace App\Http\Controllers;

use App\Mail\CompraProducto;
use App\Pago;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagos.index')->with([
            'pagos'=>Pago::join('pago_venta','pagos.id','pago_venta.pago_id')->join('ventas','pago_venta.venta_id','ventas.id')->where('user_id','=',auth()->user()->id)->orderBy('entregado')->get(),
            'deudas'=>DB::select(DB::raw('SELECT *,(precioVenta-pagos) as saldo FROM ventas INNER JOIN (SELECT venta_id,SUM(monto) as pagos FROM pagos INNER JOIN pago_venta ON pagos.id = pago_venta.pago_id GROUP BY pago_venta.venta_id) x on ventas.id=venta_id'))
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
            'monto'=>'numeric|required',
            'venta_id'=>'numeric|required',
        ]);
        $pago=Pago::create([
            'monto'=>$request->monto,
            'fecha'=>Carbon::now()->toDateString(),
            'entregado'=>0,
            'user_id'=>auth()->user()->id
        ]);
        $pago->ventas()->attach($request->venta_id);
        $venta=Venta::find($request->venta_id);
        // Mail::to($venta->vendendor->user->email)->send(new CompraProducto($venta->vendedor,$venta->comprador,$venta->producto));
        return redirect()->route('pagos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        if(!$pago->entregado){
            $pago->update(['entregado'=>1]);
        }
        return redirect()->route('pagos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
