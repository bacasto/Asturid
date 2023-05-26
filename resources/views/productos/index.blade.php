@extends('layouts.app')

@section('content')

    <style>
        li{
            margin: 15px; 
            list-style:none; 
            padding:5px";
            background-color: bisque;
            border-radius: 5px;
        }
        li:hover{
            background-color: orange;
        }
        .items
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 mb-4" style="text-align: center">
                <h1>Productos</h1>
            </div>
    <div class="col-12">
        <li>
            <a href="route('show')"></a>
        </li>
        @foreach($categorias as $categoria);

        <li>
            <a href="#" style="color:black; border-radius:5px text-decoration-line: none">{{$categoria -> name}}</a>
        </li>
    </div>
            @foreach($productos as $producto)

                <div class="col-6 col-md-4 mt-4 mb-4">

                    <div class="card">
                        <div class="card-head" style="text-align: center">
                            <h3>{{$producto->name}}</h3>
                            <small>{{$producto->category->name}}</small>
                        </div>
                        <div class="card-body" style="padding-top:0px">
                            <img style="width: 100%;height: 250px;object-fit: contain" src="{{$producto->image}}">
                            <span>{{$producto->description}}</span>
                            <span style="text-align: center;display: inherit;font-size: 22px;font-weight: bold"><i class="fa-solid fa-tag">{{$producto->price}}€</i></span>
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
    </div>
@endsection