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
                <h3>{{$menu->name}}</h3>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{asset('storage/menus/'.$menu->image)}}" style="width: 100%">
            </div>
            <div class="col-12 col-md-6 mb-4">
                <p>El menu {{$menu->name}} se compone de los siguientes platos:</p>
                <p>Entrante: {{$menu->entrante->name}}</p>
                <p>Primer plato: {{$menu->primerplato->name}}</p>
                <p>Segundo plato: {{$menu->segundoplato->name}}</p>
                <p>Bebida: {{$menu->bebida->name}}</p>
                <p>Postre: {{$menu->postre->name}}</p>

                <p style="font-weight: bold;font-size: 18px">Precio: <strong>{{$menu->price}}€</strong></p>
                <button type="button" class="btn btn-primary mt-4">Añadir al carrito</button>
            </div>

        </div>
    </div>
@endsection
