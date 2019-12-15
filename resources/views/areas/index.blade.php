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
                                    Crear Area
                                </div>
                                <div class="card-body">
                                    <form action="{{route('areas.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-text" for="nombre">Nombre del area</label>
                                            <input class="form-control" type="text" name="nombre" id="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-text" for="descripcion">Descripcion del area</label>
                                            <input class="form-control" type="text" name="descripcion" id="descripcion" required>
                                        </div>
                                        <button class="btn btn-success" type="submit">Crear</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Listado de Areas
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($areas as $a)
                                <div class="card-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            Area: {{$a->nombre}}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('areas.update',$a)}}" id="edit-{{$a->id}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nombre">Nombre del area</label>
                                                    <input class="form-control" type="text" value="{{$a->nombre}}" name="nombre" id="nombre">
                                                </div>
                                                <div class="form-group">
                                                    <label for="discripcion">Descripcion del area</label>
                                                    <input class="form-control" type="text" value="{{$a->descripcion}}" name="descripcion" id="descripcion">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group">
                                                @if(count($a->productos)<=0)
                                                    <form action="{{route('areas.activar',$a)}}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn @if($a->activa) btn-danger @else btn-success @endif" type="submit">{{$a->activa?'Deshabilitar':'Habilitar'}}</button>
                                                    </form>
                                                    @endif
                                                    @if($a->activa)
                                                        <button class="btn btn-warning" type="submit" onclick="event.preventDefault();document.getElementById('edit-{{$a->id}}').submit()">Guardar</button>
                                                    @endif
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
                                        Parece que tendremos que despedir algien
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    {{$areas->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
