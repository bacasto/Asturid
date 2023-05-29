@extends('layouts.app')

@section('content')
    <style>
        .items_categories li{
            margin:15px;
            list-style: none;
            padding: 5px;
            background-color: bisque;
            border-radius: 5px;
        }
        .items_categories li:hover{
            background-color: #f6a03e;
        }
        .items_categories li a{
            text-decoration-line: none;
            color:black;
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 mb-4" style="text-align: center">
                <h1>Productos ({{count($productos)}})</h1>

                <span>{{ isset($category_name) ? $category_name : '' }}</span>
            </div>

            <div class="col-12">
                <ul class="items_categories" style="display: flex">
                    <li> <a href="{{route('show.product.category',0)}}">Todos</a> </li>
                @foreach($categorias as $categoria)
                        <li>
                            <a href="{{route('show.product.category',$categoria->id)}}">{{$categoria->name}}</a>
                        </li>
                @endforeach
                </ul>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-md-6" style="margin: auto">
                        <form action="" method="get" style="text-align: center;">
                            <input type="search" class="form-control" name="search" placeholder="Buscar por nombre o descripcion">
                            <label>
                                Precio minimo
                                <input type="number" min="0" class="form-control" name="min_price">
                            </label>
                            <label>
                                Precio maximo
                                <input type="number" min="0" class="form-control" name="max_price">
                            </label>
                        </form>
                    </div>
                </div>
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
