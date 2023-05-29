@extends('layouts.app')
{{--is-valid / is-invalid--}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12" style="text-align: center">
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
                </div>
            @endif
        </div>
        <div class="col-md-6" style="margin: auto">
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationServer013">Nombre y apellidos</label>
                        <input type="text" name="name" class="form-control" id="validationServer013"
                               placeholder="Nombre y apellidos"
                               value="" required>

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationServer023">Email</label>
                        <input type="email" name="email" class="form-control " id="validationServer023"
                               placeholder="example@example.es"
                               value="" required>

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationServerUsername33">Teléfono</label>
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   placeholder="Telefono"
                                   aria-describedby="inputGroupPrepend33" name="phone" required>

                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationServer033">Dirección</label>
                        <input type="text" name="address" class="form-control"
                               placeholder="Direccion"
                               required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Código postal</label>
                        <input type="text" name="zip" class="form-control" placeholder="Código postal"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="terms" class="custom-control-input" id="invalidCheck33">
                        <label class="custom-control-label" for="invalidCheck33">Acepto los términos y condiciones</label>
                    </div>

                </div>
                <div class="form-group">
                    <a class="" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <button class="btn btn-primary" type="submit">Registro</button>
            </form>
        </div>
    </div>

</div>
@endsection
