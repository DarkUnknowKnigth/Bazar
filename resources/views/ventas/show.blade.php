@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Compras
                    </div>
                    <div class="card body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vendedor</th>
                                    <th>Comprador</th>
                                    <th>Fecha</th>
                                    <th>producto</th>
                                    <th>monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $v)
                                    <tr>
                                        <td>
                                           {{$v->vendedor->fullname()}}
                                        </td>
                                        <td>
                                           {{$v->comprador->fullname()}}
                                        </td>
                                        <td>
                                           {{$v->fecha}}
                                        </td>
                                        <td>
                                           {{$v->producto->nombre}}
                                        </td>
                                        <td>
                                           {{$v->precioVenta}}
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

@endsection
