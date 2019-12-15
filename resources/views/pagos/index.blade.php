@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Realizar un pago
                    </div>
                    <div class="card-body">
                        <form action="{{route('pagos.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="form-text" for="">Informacion del pago</label>
                                <input class="form-control" type="number" step="0.01" placeholder="monto" name="monto" required>
                                <select name="venta_id" class="form-control" required>
                                    <option value="">Selecciona tu compra</option>
                                    @foreach (\App\Venta::all() as $v)
                                        <option value="{{$v->id}}">Compra:{{$v->comprador->fullname()}} - Vende:{{$v->vendedor->fullname()}} - Producto:{{$v->producto->nombre}}- valor:{{$v->precioVenta}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Pagar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Mis Pagos
                            </div>
                            <div class="card body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Entregado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos as $p)
                                            <tr>
                                                <td>
                                                {{$p->fecha}}
                                                </td>
                                                <td>
                                                {{$p->monto}}
                                                </td>
                                                <td>
                                                    @if(!$p->entregado)
                                                        <form action="{{route('pagos.update',$p->pago_id)}}" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="numeric" value="1" name="entregado" hidden>
                                                            <button class="btn btn-success" type="submit">Entregar</button>
                                                        </form>
                                                    @else
                                                        Entregado
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Adeudos
                            </div>
                            <div class="card body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Saldo</th>
                                            <th>Total de pagos</th>
                                            <th>Precio de compra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deudas as $d)
                                            <tr>
                                                <td>
                                                    {{\App\Producto::find($d->producto_id)->nombre}}
                                                </td>
                                                <td>
                                                    {{$d->saldo}}
                                                </td>
                                                <td>
                                                    {{$d->pagos}}
                                                </td>
                                                <td>
                                                    {{$d->precioVenta}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
