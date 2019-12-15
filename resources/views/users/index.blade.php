@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               Registrar usuario
                            </div>
                            <div class="card-body">
                                <form action="{{route('users.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-text" for="nombre">Nombre</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-text" for="apellidoPaterno">Apellido Paterno</label>
                                        <input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-text" for="apellidoMaterno">Apellido Materno</label>
                                        <input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-text" for="emal">Correo</label>
                                        <input class="form-control" type="email" name="email" id="emal" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-text" for="password">Contraseña</label>
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sexo" class="form-text">Sexo</label>
                                        <select id="sexo" type="text" class="form-control" name="sexo" required>
                                            <option value="">Seleccione un sexo</option>
                                            <option value="1">Hombre</option>
                                            <option value="0">Muejer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="rol_id" class="form-text">Rol</label>
                                        <select id="rol_id" type="text" class="form-control" name="rol_id" required>
                                            <option value="" disabled>Seleccione un rol</option>
                                            @forelse (\App\Rol::all() as $r)
                                                <option value="{{$r->id}}">{{$r->nombre}}</option>
                                            @empty
                                                <option value="" disabled>No hay opciones</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <button class="btn btn-success" type="submit">Dar de alta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="oveflow:y">
                            <div class="card-header">
                                Compras de usuarios
                            </div>
                            <div class="card-body">
                                <ul>
                                    @forelse (\App\Venta::orderBy('updated_at','desc')->get() as $v)
                                        <li>{{$v->comprador->fullname()}} compró x {{$v->cantidad}}  {{$v->producto->nombre}} a {{$v->vendedor->fullname()}} por <b>valor:{{$v->precioVenta}}</b></li>
                                    @empty
                                        <li>No hay ventas</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Listado de Usuarios
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($users as $u)
                            <div class="card-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{$u->fullname()}}
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('users.update',$u)}}" id="edit-{{$u->id}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label class="form-text" for="nombre">Nombre</label>
                                                <input class="form-control" type="text" name="nombre" id="nombre" value="{{$u->nombre}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-text" for="apellidoPaterno">Apellido Paterno</label>
                                                <input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{$u->apellidoPaterno}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-text" for="apellidoMaterno">Apellido Materno</label>
                                                <input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{$u->apellidoMaterno}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-text" for="emal">Correo</label>
                                                <input class="form-control" type="email" name="email" id="email" value="{{$u->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="sexo" class="form-text">Sexo</label>
                                                <select id="sexo" type="text" class="form-control" name="sexo">
                                                    <option value="">Seleccione un sexo</option>
                                                    <option value="1" @if($u->sexo=='1') selected @endif>Hombre</option>
                                                    <option value="0" @if($u->sexo=='0') selected @endif>Muejer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Rol</label>
                                                <input type="text" class="form-control" value="{{$u->rol->nombre}}" disabled>
                                            </div>
                                        </form>
                                        <div class="bg-danger col-auto py-3 px-2 rounded">
                                            <p>¡Cambio de contraseña!</p>
                                            <form action="{{route('users.update',$u)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <input class="form-control" type="password" name="password" placeholder="nueva contraseña">
                                                    <button class="btn btn-primary" type="submit" style="width:100%">cambiar contraseña</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-group">
                                            <button class="btn btn-warning" type="submit" onclick="event.preventDefault();document.getElementById('edit-{{$u->id}}').submit()">Guardar</button>
                                            <form action="{{route('users.destroy',$u)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card">
                                <div class="card-header">
                                    Vayaa....
                                </div>
                                <div class="card-body">
                                    Parece que tendremos buscar mas gente
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
