@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center">
                <h1>Mi perfil</h1>
            </div>

            <div class="col-md-6" style="margin: auto">
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationServer013">Nombre y apellidos</label>
                            <input type="text" name="name" class="form-control" id="validationServer013"
                                   placeholder="Nombre y apellidos"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->name}}" required>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationServer023">Email</label>
                            <input type="email" name="email" class="form-control " id="validationServer023"
                                   placeholder="example@example.es"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}" required>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationServerUsername33">Teléfono</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       placeholder="Telefono" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}"
                                       aria-describedby="inputGroupPrepend33" name="phone" required>

                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationServer033">Dirección</label>
                            <input type="text" name="address" class="form-control"
                                   placeholder="Direccion" value="{{\Illuminate\Support\Facades\Auth::user()->address}}"
                                   required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Código postal</label>
                            <input type="text" name="zip" class="form-control" placeholder="Código postal"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->zip}}"
                                   required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Contraseña</label><br>
                            <span>Dejar en blanco para mantener la misma</span>
                            <input type="password" autocomplete="new-password"  name="password" class="form-control"
                                   required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   required>
                        </div>

                        <div id="errors">

                        </div>
                    </div>

                    <button class="btn btn-primary" id="btnUpdateProfile" type="button">Actualizar</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        $('#btnUpdateProfile').click(()=>{
            let name = $('input[name="name"]').val();
            let email = $('input[name="email"]').val();
            let phone = $('input[name="phone"]').val();
            let address = $('input[name="address"]').val();
            let zip = $('input[name="zip"]').val();
            let password = $('input[name="password"]').val()
            let password_confirmation = $('input[name="password_confirmation"]').val()
            $('#errors').innerHTML = '';
            if(name.length==0 || name == " "){
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo nombre inválido</p>'
                return;
            }
            if(email.length==0 || email == " "){
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo email inválido</p>'
                return;
            }
            if(phone.length==0 || phone == " "){
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo telefono inválido</p>'
                return;
            }
            if(address.length==0 || address == " "){
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo dirección inválido</p>'
                return;
            }
            if(zip.length==0 || zip == " "){
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo Codigo postal inválido</p>'
                return;
            }
            console.log(password)
            if(password!="" && password.length<6){
                console.log('valida 1')
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo contraseña debe tener mas de 6 caracteres.</p>'
                return;
            }

            if(password!=password_confirmation){
                console.log('valida 2')
                $('#errors').innerHTML = '<p style="color:red; font-weight: bold">Campo contraseña y confirmacion deben coincidir.</p>'
                return;
            }
            $('#errors').innerHTML = '';
            let form_data = new FormData();
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('name',name)
            form_data.append('email',email)
            form_data.append('phone',phone)
            form_data.append('address',address)
            form_data.append('zip',zip)
            form_data.append('password',password)
            form_data.append('password_confirmation',$('input[name="password_confirmation"]').val())

            $.ajax({
                type:"post",
                url: "{{route('update.profile')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                   toastr.success("Datos modificados correctamente.")
                },
                error: function(error){
                    console.log("Error: "+error)
                }
            })
        })
    </script>
@endsection
