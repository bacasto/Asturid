@extends('layouts.app')
{{--is-valid / is-invalid--}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center">
                <h1>Login</h1>
            </div>
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-6" style="margin: auto">
                <form method="post" action="{{route('login')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Contraseña</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                           name="remember">
                                    <span class="ml-2 text-sm text-gray-600">Recordar contraseña</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                   href="{{ route('register') }}">
                                    ¿Aún no tienes cuenta?
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" style="float: right"
                                   href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3 mt-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection


