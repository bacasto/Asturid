@extends('layouts.app')

@section('content')
    <style>
        #content_users{
            height: 60vh;
            overflow: auto;
        }
    </style>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Usuarios</h1>
            </div>
            <div class="col-12"  id="content_users">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">CP</th>
                            <th scope="col">Email</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->rol->name}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->zip}}</td>
                                <td>{{$user->email}}</td>
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
