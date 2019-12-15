<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>
                Busca tu producto
            </h4>
        </div>
        <div class="card-body">
            <form action="{{route('buscar')}}" method="get">
                <div class="row">
                    <div class="col-md-11 col-sm-12">
                        <input class="form-control" type="text" name="nombre" id="nombre">
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
