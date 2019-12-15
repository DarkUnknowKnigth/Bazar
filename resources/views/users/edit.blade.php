@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{$u->fullname()}}
        </div>
        <div class="card-body">
            <form action="{{route('users.update',$u)}}" method="POST">
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
                    <button class="btn btn-warning" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <form action="{{route('users.update',$u)}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="nueva contraseña">
                    <button class="btn btn-danger" type="submit" style="width:100%">cambiar contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
