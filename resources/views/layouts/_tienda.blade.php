<div class="container-fluid p-5">
    <div class="row">
        <div class="col-lg-3 col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="my-4">Areas</h1>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse (\App\Area::all() as $area)
                            @if($area->activa)
                                <a href="{{route('areas.show',$area)}}" class="list-group-item">{{$area->nombre}}</a>
                            @endif
                        @empty
                            <p>No hay areas</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    <!-- /.col-lg-3 -->
        <div class="col-lg-9 col-xl-9 col-md-9">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active fit-width">
                                <img class="d-block img-fluid" width="100%" src="https://images-na.ssl-images-amazon.com/images/G/33/img19/Holiday_Deals/Hero_Gateway_Desktop_1500x600._CB445922893_.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item fit-width">
                                <img class="d-block img-fluid" width="100%" src="https://images-na.ssl-images-amazon.com/images/G/33/img19/Toys/Toylist/htl_gw_hero_hotwheels_panda_toys_2x_es_v1._CB447692496_.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item fit-width">
                                <img class="d-block img-fluid" width="100%" src="https://images-na.ssl-images-amazon.com/images/G/33/img19/Hollydays/Navidadweek/MarthaDebayle_HFT/H_Martha_1500x600._CB444794396_.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <script type="application/javascript">
                        $('.carousel').carousel()
                    </script>
                </div>
            </div>
            <br>
            <div class="row">
                @forelse($productos as $p)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
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
                        <div class="card-footer">
                            Vendido por: {{$p->user->fullname()}}
                            @guest
                                <a href="{{route('login')}}">inicia session para comprar</a>
                            @else
                                @if(Auth::user()->id != $p->user->id)
                                    <form action="{{route('ventas.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="number" class="form-control" onchange="document.getElementById('monto-{{$p->id}}').value=(this.value*parseFloat('{{$p->precioPropuesto}}')).toFixed(2)" name="cantidad" placeholder="cantidad" min="1" max="{{$p->disponibles}}">
                                            <input type="number" step="0.01" class="form-control" name="precioVenta" placeholder="monto" id="monto-{{$p->id}}">
                                            <button class="btn btn-success" type="submit">Ofertar</button>
                                        </div>
                                        <input type="number" name="producto_id" value="{{$p->id}}" hidden>
                                        <input type="number" name="vendedor_id" value="{{$p->user->id}}" hidden>
                                        <input type="number" name="comprador_id" value="{{auth()->user()->id}}" hidden>

                                    </form>
                                @endif
                            @endguest
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
            <!-- /.row -->
        </div>
    <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
</div>
