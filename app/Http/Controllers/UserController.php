<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with([
            'users'=>User::paginate()
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
            'nombre'=>'string|required',
            'apellidoPaterno'=>'string|required',
            'apellidoMaterno'=>'string|required',
            'sexo'=>'boolean|required',
            'email'=>'string|email|required',
            'password'=>'string|required',
            'rol_id'=>'required|numeric'
        ]);
        $request['password']=Hash::make($request->password);
        User::create($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with([
            'u'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        if(auth()->user()->id == $user->id || auth()->user()->rol->nombre=="Encargado"){
            $request->validate([
                'nombre'=>'string',
                'apellidoPaterno'=>'string',
                'apellidoMaterno'=>'string',
                'sexo'=>'boolean',
                'email'=>'string|email',
                'password'=>'string',
            ]);
            if($request->password){
                $user->update(['password'=>Hash::make($request->password)]);
                if(auth()->user()->id == $user->id){
                    auth()->logout();
                    return redirect()->route('login');
                }
            }else{
                $user->update($request->all());
            }
        }
        if(auth()->user()->rol->nombre=="Encargado"){
            return redirect()->route('users.index');
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->rol->nombre=="Encargado"){
            $user->delete();
        }
        return redirect()->route('users.index');
    }
}
