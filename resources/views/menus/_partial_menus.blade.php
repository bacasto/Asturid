<div class="row">
    @foreach($menus as $menu)
        <div class="col-6 col-md-4 mt-4 mb-4">
            <div class="card">
                <div class="card-head" style="text-align: center">
                    <h3>{{$menu->name}}</h3>

                </div>
                <div class="card-body" style="padding-top:0px">
                    <img style="width: 100%;height: 250px;object-fit: contain" src="{{asset('storage/menus/'.$menu->image)}}">
                    <span></span>
                    <span style="text-align: center;display: inherit;font-size: 22px;font-weight: bold"><i
                            class="fa-solid fa-tag">{{$menu->price}}€</i></span>
                </div>
                <div class="card-footer" style="text-align: center">
                    <a href="{{route('show.menu',$menu->id)}}" class="btn btn-success">Ver más</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
