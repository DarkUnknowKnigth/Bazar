<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Producto;
Route::get('/', function () {
    return view('welcome')->with([
        'productos'=>Producto::paginate()
    ]);
})->name('/');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/buscar', function(){
    return view('welcome')->with([
        'productos'=>Producto::where('nombre','like','%'.request()->nombre.'%')->paginate()
    ]);
})->name('buscar');
Route::get('/tienda', 'HomeController@tienda')->name('tienda');
Route::put('areas/activar/{area}','AreaController@activar')->name('areas.activar');
Route::resource('areas', 'AreaController')->except(['edit','create','destroy']);
Route::resource('productos', 'ProductoController');
Route::resource('fotos', 'FotoController');
Route::post('productos/imagen/{producto}', 'ProductoController@imagen')->name('productos.imagen');
Route::get('users/vendedores', 'UserController@sellers')->name('users.seller');
Route::resource('users', 'UserController');
Route::get('ventas/todas','VentaController@todas')->name('ventas.todas');
Route::get('ventas/mias','VentaController@mias')->name('ventas.mias');
Route::resource('ventas','VentaController');
Route::resource('pagos','PagoController');
