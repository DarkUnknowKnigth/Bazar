<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Producto;
use Illuminate\Http\Request;
use File;

class ProductoController extends Controller
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
        if(auth()->user()->rol->nombre=='Encargado'){
            return view('productos.index')->with([
                'productos'=>Producto::paginate()
            ]);
        }elseif(auth()->user()->rol->nombre=='Cliente'){
            return view('productos.index')->with([
                'productos'=>auth()->user()->productos
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string',
            'descripcion'=>'required|string',
            'caracteristicas'=>'required|string',
            'disponibles'=>'numeric|required',
            'precioPropuesto'=>'required',
            'area_id'=>'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $producto=Producto::create([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'caracteristicas'=>$request->caracteristicas,
            'disponibles'=>$request->disponibles,
            'precioPropuesto'=>$request->precioPropuesto,
            'precioVendido'=>null,
            'consignado'=>0,
            'area_id'=>$request->area_id,
            'user_id'=>auth()->user()->id
        ]);
        if($request->file('foto')){
            $destinationPath = 'public/image/productos/'; // upload path
            $profileImage = date('YmdHis') . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move($destinationPath, $profileImage);
            Foto::create([
                'path'=>$destinationPath.$profileImage,
                'producto_id'=>$producto->id,
                'user_id'=>auth()->user()->id
            ]);
        }
        return redirect()->route('productos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'=>'string',
            'descripcion'=>'string',
            'caracteristicas'=>'string',
            'disponibles'=>'numeric',
            'precioPropuesto'=>'numeric',
            'area_id'=>'numeric',
            'consignado'=>'boolean'
        ]);
        if($request->consignado){
            $producto->update(['consignado'=>$request->consignado]);
        }else{
            $producto->update($request->except(['consignado']));
        }
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        if($producto->user->id == auth()->user()->id){
            if(count($producto->fotos)){
                foreach($producto->fotos as $f){
                    File::delete(public_path().$f->path);
                    $f->delete();
                }
            }
            $producto->delete();
        }
        return redirect()->route('productos.index');
    }
    public function imagen(Producto $producto,Request $request){
        if($request->file('foto')){
            $destinationPath = 'public/image/productos/'; // upload path
            $profileImage = date('YmdHis') . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move($destinationPath, $profileImage);
            Foto::create([
                'path'=>$destinationPath.$profileImage,
                'producto_id'=>$producto->id,
                'user_id'=>auth()->user()->id
            ]);
        }
        return redirect()->route('productos.index');

    }
}
