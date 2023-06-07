<div class="row">
    @foreach($productos as $producto)
        <div class="col-6 col-md-4 mt-4 mb-4">
            <div class="card">
                <div class="card-head" style="text-align: center">
                    <h3>{{$producto->name}}</h3>
                    <small>{{$producto->category->name}}</small>
                </div>
                <div class="card-body" style="padding-top:0px">
                    <img style="width: 100%;height: 250px;object-fit: contain" src="{{asset('storage/productos/'.$producto->image)}}">
                    <span>{{$producto->description}}</span>
                    <span style="text-align: center;display: inherit;font-size: 22px;font-weight: bold"><i
                            class="fa-solid fa-tag">{{$producto->price}}€</i></span>
                </div>
                <div class="card-footer" style="text-align: center">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Añadir
                        al carrito
                    </button>
                    <a href="{{route('show.product',$producto->id)}}" class="btn btn-success">Ver más</a>
                </div>
            </div>
        </div>
    @endforeach
</div>