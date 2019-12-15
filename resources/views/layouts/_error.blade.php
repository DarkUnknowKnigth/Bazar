@if(count($errors->all())>0)
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{$e}}</li>
                        @endforeach
                    </ul>
                </strong>
                </div>
                <script type="application/javascript">
                $(".alert").alert();
                </script>
            </div>
        </div>
    </div>
@endif
