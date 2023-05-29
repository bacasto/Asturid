@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Productos</h1>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Mostrar</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{$producto->id}}</td>
                                <td>{{$producto->name}}</td>
                                <td>{{$producto->description}}</td>
                                <td>{{$producto->category->name}}</td>
                                <td>{{$producto->stock}}</td>
                                <td><img style="width: 80px" src="{{$producto->image}}"></td>
                                <td>{{$producto->showProduct==1 ? 'Si' : 'No' }}</td>
                                <td>
                                    <button class="btn btn-success">Editar</button>
                                    <button class="btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection