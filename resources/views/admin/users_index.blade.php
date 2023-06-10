@extends('layouts.app')

@section('content')
    <style>

        .content_title_user{
            text-align: start;
        }
        .content_add_user{
            text-align: end;
        }
        @media(max-width: 790px){
            .content_add_user{
                text-align: center;
            }
            .content_title_user{
                text-align: center;
            }
        }
        #content_users{
            height: 60vh;
            overflow: auto;
        }
    </style>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6 content_title_user">
                <h1>Usuarios</h1>
            </div>
            <div class="col-12 col-md-6 content_add_user">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modaladduser"  class="btn btn-primary">Añadir usuario</button>
            </div>
            <div class="col-12" id="content_users">
                @include('admin._partial_users_admin',$users)
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modaladduser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="addUsersForm">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name" required>
                            <div id="errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>Rol</label>
                            <select name="rol" class="form-control">
                                @foreach(\App\Models\Rol::all() as $rol)
                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text"  name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input  class="form-control" type="password" min="6" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input class="form-control" type="text"  name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input  class="form-control" type="text" name="address" required>
                        </div>
                        <div class="form-group">
                            <label>Código postal</label>
                            <input class="form-control" type="text"  name="zip" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnAddUser" data-bs-dismiss="modal">Añadir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalupdateuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updateUsersForm">
                        <input class="form-control" type="hidden" name="user_id" required>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name_edit" required>
                            <div id="errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>Rol</label>
                            <select name="rol_edit" class="form-control">
                                @foreach(\App\Models\Rol::all() as $rol)
                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input class="form-control" type="text"  name="phone_edit" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text"  name="email_edit" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña (Dejar en blanco para mentener)</label>
                            <input  class="form-control" type="password" min="6" name="password_edit" required>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input  class="form-control" type="text" name="address_edit" required>
                        </div>
                        <div class="form-group">
                            <label>Código postal</label>
                            <input class="form-control" type="text"  name="zip_edit" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateUser" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btnAddUser').click(()=>{
            let form_data = new FormData();
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('name',$('input[name="name"]').val())
            form_data.append('rol',$('select[name="rol"]').val())
            form_data.append('email',$('input[name="email"]').val())
            form_data.append('password',$('input[name="password"]').val())
            form_data.append('phone',$('input[name="phone"]').val())
            form_data.append('address',$('input[name="address"]').val())
            form_data.append('zip',$('input[name="zip"]').val())


            $.ajax({
                type:"post",
                url: "{{route('add.user')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('addUsersForm').reset();
                    $('#content_users').html(response.view)
                },
                error: function(error){
                    if(error.status==422){
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        })

        $('#btnUpdateUser').click(()=>{
            //TODO=>Terminar validaciones
            let form_data = new FormData();

            form_data.append('_token','{{csrf_token()}}')
            form_data.append('user_id',$('input[name="user_id"]').val())
            form_data.append('name',$('input[name="name_edit"]').val())
            form_data.append('rol',$('select[name="rol_edit"]').val())
            form_data.append('email',$('input[name="email_edit"]').val())
            form_data.append('password',$('input[name="password_edit"]').val())
            form_data.append('phone',$('input[name="phone_edit"]').val())
            form_data.append('address',$('input[name="address_edit"]').val())
            form_data.append('zip',$('input[name="zip_edit"]').val())

            $.ajax({
                type:"post",
                url: "{{route('update.user')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('updateUsersForm').reset();
                    $('#content_users').html(response.view)
                },
                error: function(error){
                    if(error.status==422){
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        })
    </script>
@endsection