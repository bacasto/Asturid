@extends('layouts.app')

@section('content')
    <style>
        .list-group-input{
            list-style: none;
        }
    </style>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 mb-4" style="text-align: center">
                <h3>{{$producto->name}}</h3>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{$producto->image}}" style="width: 100%">
            </div>
            <div class="col-12 col-md-6 mb-4">
                <p>{{$producto->description}}</p>
                <p>Unidades disponibles: <strong>{{$producto->stock}}</strong></p>
                <p>Precio: <strong>{{$producto->price}}€</strong></p>
                <p>Extras:</p>
                <ul class="list-group list-goup-light">
                    <li class="list-group-input">
                        <input class="form-check-input" type="checkbox" value="">
                        Extra1
                    </li>
                    <li class="list-group-input">
                        <input class="form-check-input" type="checkbox" value="">
                        Extra1
                    </li>
                    <li class="list-group-input">
                        <input class="form-check-input" type="checkbox" value="">
                        Extra1
                    </li>
                </ul>
                <button type="button" class="btn btn-primary mt-4">Añadir al carrito</button>
            </div>

        </div>
    </div>
@endsection
