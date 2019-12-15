<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Producto;
use App\Area;
use App\Rol;
use Illuminate\Support\Facades\Hash;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'id'=>1,
            'nombre'=>'Encargado',
            'numero'=>1
        ]);
        Rol::create([
            'id'=>2,
            'nombre'=>'Cliente',
            'numero'=>2
        ]);
        Rol::create([
            'id'=>3,
            'nombre'=>'Pagador',
            'numero'=>3
        ]);
        User::create([
            'nombre'=>'Monica',
            'apellidoPaterno'=>'Martinez',
            'apellidoMaterno'=>'Nose',
            'email'=>'moni@gmail.com',
            'password'=>Hash::make('moni1234'),
            'sexo'=>1,
            'rol_id'=>1
        ]);
        User::create([
            'nombre'=>'Miguel',
            'apellidoPaterno'=>'Cruz',
            'apellidoMaterno'=>'Hernandez',
            'email'=>'migue@gmail.com',
            'password'=>Hash::make('migue1234'),
            'sexo'=>1,
            'rol_id'=>2
        ]);
        User::create([
            'nombre'=>'Kristel',
            'apellidoPaterno'=>'Cruz',
            'apellidoMaterno'=>'Hernandez',
            'email'=>'kris@gmail.com',
            'password'=>Hash::make('kris1234'),
            'sexo'=>0,
            'rol_id'=>3
        ]);
        Area::create([
            'nombre'=>'Electronicos',
            'descripcion'=>'Area especializada en electronicos',
            'activa'=>1
        ]);
    }
}
