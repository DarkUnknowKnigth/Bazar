<?php

namespace App\Http\Controllers;

use App\Area;
use App\Producto;
use Illuminate\Http\Request;

class AreaController extends Controller
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
        return view('areas.index')->with([
            'areas'=>Area::paginate()
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
            'nombre'=>'required|string',
            'descripcion'=>'required|string',
        ]);
        $request['activa']=true;
        Area::create($request->all());
        return redirect()->route('areas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return view('welcome')->with([
            'productos'=>Producto::where('area_id','=',$area->id)->paginate()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nombre'=>'string|required',
            'descripcion'=>'string|required'
        ]);
        if($area->activa){

            if(count($area->productos)>0){

                $area->update($request->except(['nombre']));
            }else{
                $area->update($request->all());
            }
            return redirect()->route('areas.index');
        }
        else{
            return redirect()->route('areas.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function activar(Area $area)
    {
        $area->update(['activa'=>!$area->activa]);
        return redirect()->route('areas.index');
    }
}
