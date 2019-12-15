@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            @if(auth()->user()->rol->nombre=="Cliente")
                            <div class="card">
                                <div class="card-header">
                                    Registrar un producto
                                </div>
                                <div class="card-body">
                                    <form action="{{route('productos.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-text" for="nombre">Nombre del producto</label>
                                            <input class="form-control" type="text" name="nombre" id="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-text" for="descripcion">Descripcion del producto</label>
                                            <input class="form-control" type="text" name="descripcion" id="descripcion" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-text" for="caracteristicas">Caracteristicas del producto</label>
                                            <input class="form-control" type="text" name="caracteristicas" id="caracteristicas" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-text" for="disponibles">Disponibles</label>
                                            <input class="form-control" type="number" name="disponibles" id="disponibles" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-text" for="precioPropuesto">Precio del producto (sugerido)</label>
                                            <input class="form-control" type="number" name="precioPropuesto" step="0.01" id="precioPropuesto" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Fotos</label>
                                            <input type="file" class="form-control-file" id="foto" name="foto">
                                        </div>
                                        <div class="from-group">
                                            <label for="area_id" class="form-text">Asigne un area</label>
                                            <select name="area_id" id="area_id" class="form-control" required>
                                                <option value="" disabled>Seleccione un area</option>
                                                @forelse (\App\Area::all() as $a)
                                                    <option value="{{$a->id}}">{{$a->nombre}}</option>
                                                @empty
                                                    <option value="" disabled>No hay Areas</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <button class="btn btn-success" type="submit">Registrar nuevo producto</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="@if(auth()->user()->rol->nombre=="Cliente") col-md-8 @else col-md-12 @endif">
                <div class="card">
                    <div class="card-header">
                        Listado de Productos
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($productos as $p)
                            <div class="@if(auth()->user()->rol->nombre=="Cliente") col-lg-4 col-md-6 mb-4 @else col-lg-4 col-md-6 mb-4 @endif">
                                <div class="card">
                                    <div id="carouselProduct{{$p->id}}" class="carousel slide my-4" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($p->fotos as $f)
                                                <li data-target="#carouselProduct{{$p->id}}" data-slide-to="{{$loop->iteration}}" class="@if($loop->iteration==1) active @endif"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($p->fotos as $f)
                                                <div class="carousel-item @if($loop->iteration==1) active @endif">
                                                    <img class="d-block img-fluid" width="100%" src="{{env('APP_URL').$f->path}}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselProduct{{$p->id}}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselProduct{{$p->id}}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    @if(auth()->user()->rol->nombre=="Encargado" || $p->consignado)
                                        <div class="card-body">
                                            <h4 class="card-title">
                                            <a href="{{route('productos.show',$p)}}">{{$p->nombre}}</a>
                                            </h4>
                                            <h5>Precio: {{$p->precioPropuesto}}</h5>
                                            <p class="card-text">Descripcion: {{$p->descripcion}}</p>
                                            <p>
                                                Disponibles: {{$p->disponibles}}
                                            </p>
                                        </div>
                                    @endif
                                    @if(auth()->user()->id ==$p->user->id && !$p->consignado)
                                        <div class="card-body">
                                            <form action="{{route('productos.update',$p)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label class="form-text" for="nombre">Nombre</label>
                                                    <input class="form-control" type="text" name="nombre" id="nombre" value="{{$p->nombre}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-text" for="descripcion">Descripcion del producto</label>
                                                    <input class="form-control" type="text" name="descripcion" id="descripcion" value="{{$p->descripcion}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-text" for="caracteristicas">Caracteristicas del producto</label>
                                                    <input class="form-control" type="text" name="caracteristicas" id="caracteristicas" value="{{$p->caracteristicas}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-text" for="disponibles">Disponibles</label>
                                                    <input class="form-control" type="number" name="disponibles" id="disponibles" value="{{$p->disponibles}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-text" for="precioPropuesto">Precio del producto (sugerido)</label>
                                                    <input class="form-control" type="number" name="precioPropuesto" step="0.01" id="precioPropuesto" value="{{$p->precioPropuesto}}">
                                                </div>
                                                <div class="from-group">
                                                    <label for="area_id" class="form-text">Asigne un area</label>
                                                    <select name="area_id" id="area_id" class="form-control">
                                                        <option value="" disabled>Seleccione un area</option>
                                                        @forelse (\App\Area::all() as $a)
                                                            <option value="{{$a->id}}" @if($a->id == $p->area->id) selected @endif>{{$a->nombre}}</option>
                                                        @empty
                                                            <option value="" disabled>No hay Areas</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-warning" type="submit" style="width:100%">Actualizar</button>
                                                </div>
                                            </form>
                                            <form action="{{route('productos.destroy',$p)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="form-group">
                                                    <button class="btn btn-danger" type="submit" style="width:100%">Eliminar</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="card-footer">
                                        <div class="container">
                                            @if(auth()->user()->id == $p->user->id)
                                                <h2>Fotos</h2>
                                                <form action="{{route('productos.imagen',$p)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="foto">Fotos
                                                            <button class="btn btn-success" type="submit">+</button>
                                                        </label>
                                                        <input type="file" class="form-control-file" id="foto" name="foto">
                                                    </div>
                                                </form>
                                                <ul>
                                                    @foreach ($p->fotos as $f)
                                                        <li>
                                                            <form action="{{route('fotos.destroy',$f)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <label>{{$f->path}}</label>
                                                                <button class="btn btn-danger" type="submit">X</button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if(auth()->user()->rol->nombre=="Encargado")
                                                @if(!$p->consignado)
                                                    <form action="{{route('productos.update',$p)}}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <select class="form-control" name="consignado" id="consignado" required>
                                                            <option value="1" @if($p->consignado == 1) selected @endif>Si</option>
                                                            <option value="0" @if($p->consignado == 0) selected @endif>No</option>
                                                        </select>
                                                        <button class="btn btn-warning" type="submit">Actualizar</button>
                                                    </form>
                                                @else
                                                    <p>Consignado</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card">
                                <div class="card-header">Vayaaaaa</div>
                                <div class="card-body">
                                    <p>Vaya parece que los vendedores se tomaron el dia...</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
