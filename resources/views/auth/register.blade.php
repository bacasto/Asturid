@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="col-12" style="text-align: center;">
                <h1>Registro</h1>
            </div>
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div> @endif
            </div>
        <div class="col-md-6" style="margin: auto;">
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationServer013">Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationServerUsername33">email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend33">Email</span>
                            </div>
                            <input type="text" class="form-control" name="email" placeholder="email" aria-describedby="inputGroupPrepend33" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="validationServer013">Telefono</label>
                            <input type="text" class="form-control" placeholder="telefono" name="phone"
                                required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                    <label for="validationServer023">direccion</label>
                    <input type="text" class="form-control" placeholder="direccion" name="address"
                        required>
                    </div>

                </div>
                    <div class="col-md-12 mb-3">
                    <label for="validationServer053">Codigo Postal</label>
                    <input type="text" class="form-control" id="validationServer053" placeholder="Codigo Postal" name="zip"
                        required>
                    </div>

                    <div class="col-md-12 mb-3">
                    <label for="validationServer053">contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder=""
                        required>
                    </div>

                    <div class="col-md-12 mb-3">
                    <label for="validationServer053">confirmarcontraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder=""
                        required>
                    </div>
                


                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="invalidCheck33" name="terms">
                    <label class="custom-control-label" for="invalidCheck33">Acepto los terminos y condiciones</label>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Registro</button>
            </form>
        </div>
    </div>
</div>
@endsection