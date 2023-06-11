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
                <h1>Menús</h1>
            </div>
            <div class="col-12 col-md-6 content_add_user">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modaladdmenu"  class="btn btn-primary">Añadir menu</button>
            </div>
            <div class="col-12" id="content_menus">
                @include('admin._partial_menus_admin',$menus)
            </div>

        </div>
    </div>
    <!-- Modal -->
    @php

        $cat_bebidas = \App\Models\Category::where('name','Bebidas')->first();
        $cat_postres = \App\Models\Category::where('name','Postres')->first();
        $productos = \App\Models\Product::whereNotIn('category_id',[$cat_bebidas->id,$cat_postres->id])->get();
        $bebidas = \App\Models\Product::where('category_id',$cat_bebidas->id)->get();
        $postres = \App\Models\Product::where('category_id',$cat_postres->id)->get();
    @endphp
    <div class="modal fade" id="modaladdmenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="addMenusForm">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name" required>
                            <div id="errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" type="file" accept="image/*" name="image" required>

                        </div>
                        <div class="form-group">
                            <label>Entrante</label>
                            <select name="entrante" class="form-control">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Primer plato</label>
                            <select name="primerplato" class="form-control">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Segundo plato</label>
                            <select name="segundoplato" class="form-control">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bebida</label>
                            <select name="bebida" class="form-control">
                                @foreach($bebidas as $bebida)
                                    <option value="{{$bebida->id}}">{{$bebida->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Postre</label>
                            <select name="postre" class="form-control">
                                @foreach($postres as $postre)
                                    <option value="{{$postre->id}}">{{$postre->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnAddMenu" data-bs-dismiss="modal">Añadir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalupdatemenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updateMenusForm">
                        <input class="form-control" type="hidden" name="menu_id" required>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name_edit" required>
                            <div id="errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" type="file" accept="image/*" name="image_edit" required>

                        </div>
                        <div class="form-group">
                            <label>Entrante</label>
                            <select name="entrante_edit" class="form-control">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Primer plato</label>
                            <select name="primerplato_edit" class="form-control">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Segundo plato</label>
                            <select name="segundoplato_edit" class="form-control">
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bebida</label>
                            <select name="bebida_edit" class="form-control">
                                @foreach($bebidas as $bebida)
                                    <option value="{{$bebida->id}}">{{$bebida->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Postre</label>
                            <select name="postre_edit" class="form-control">
                                @foreach($postres as $postre)
                                    <option value="{{$postre->id}}">{{$postre->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateMenu" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btnAddMenu').click(()=>{
            let image = $('input[name="image"]').prop('files')[0];
            let form_data = new FormData();
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('name',$('input[name="name"]').val())
            form_data.append('image',image)
            form_data.append('entrante',$('select[name="entrante"]').val())
            form_data.append('primerplato',$('select[name="primerplato"]').val())
            form_data.append('segundoplato',$('select[name="segundoplato"]').val())
            form_data.append('postre',$('select[name="bebida"]').val())
            form_data.append('bebida',$('select[name="postre"]').val())

            $.ajax({
                type:"post",
                url: "{{route('add.menu')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('addMenusForm').reset();
                    $('#content_menus').html(response.view)
                },
                error: function(error){
                    if(error.status==422){
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        })

        $('#btnUpdateMenu').click(()=>{
            //TODO=>Terminar validaciones
            let form_data = new FormData();
            let image = $('input[name="image_edit"]').prop('files')[0];
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('menu_id',$('input[name="menu_id"]').val())
            form_data.append('image',image)
            form_data.append('name', $('input[name="name_edit"]').val())
            form_data.append('entrante',$('select[name="entrante_edit"]').val())
            form_data.append('primerplato',$('select[name="primerplato_edit"]').val())
            form_data.append('segundoplato',$('select[name="segundoplato_edit"]').val());
            form_data.append('postre',$('select[name="postre_edit"]').val())
            form_data.append('bebida',$('select[name="bebida_edit"]').val())
                console.log($('select[name="postre_edit"]').val())
            $.ajax({
                type:"post",
                url: "{{route('update.menu')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('updateMenusForm').reset();
                    $('#content_menus').html(response.view)
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
