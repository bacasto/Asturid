@extends('layouts.app')
@section('content')
    <h1>Plantilla</h1>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-4" style="text-align: center;">
                <h2>Productos</h2>
            </div>
            @foreach($productos as $producto)
            <div class="col-6 col-md-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-head mb-4" style="text-align: center;">
                        <h3>{{$producto->name}}</h3>
                        <small>{{$producto->category->name}}</small>
                    </div>
                    <div class="card-body" style="padding-top: 0px;">
                        <img style="width:100%; height:250px; object-fit:contain" src="{{$producto->image}}" alt="">
                        <span>{{$producto->description}}</span>
                        <span style="text-align: center; margin:auto; width:100%; display:inherit; font-size: 22px"><i class="fa-solid fa-tag">{{$producto->price}}€</i></span>
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary"><i class="fa fa-cart-shopping">Añadir al carro</i></button>
                        <a href="" class="btn btn-success">Ver mas...</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection