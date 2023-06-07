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
                    <form action="" method="post" enctype="multipart/form-data" id="addProductsForm">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name" required>
                            <div id="errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-control" name="description" required></textarea>
                            <div id="errorDesc"></div>
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input  class="form-control" type="number" min="0" name="stock" value="0" required>
                            <div id="errorStock"></div>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input  class="form-control" type="number" step="0.01" name="price" min="0" value="0" required>
                            <div id="errorStock"></div>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" type="file" accept="image/*" name="image" required>
                            <div id="errorImage"></div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="checkShow" checked name="show" required>
                            <label for="checkShow" >Mostrar en la pagina</label>
                            <div id="errorShow"></div>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updateProductsForm">
                        <input class="form-control" type="hidden" name="product_id" required>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name_edit" required>
                            <div id="errorNameEdit"></div>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-control" name="description_edit" required></textarea>
                            <div id="errorDescEdit"></div>
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input  class="form-control" type="number" min="0" name="stock_edit" value="0" required>

                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input  class="form-control" type="number" step="0.01" name="price_edit" min="0" value="0" required>
                            <div id="errorPrecioEdit"></div>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" type="file" accept="image/*" name="image_edit" required>
                            <div id="errorImageEdit"></div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="checkShowEdit" checked name="show_edit" required>
                            <label for="checkShowEdit" >Mostrar en la pagina</label>
                            <div id="errorShowEdit"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateProduct" data-bs-dismiss="modal">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btnAddUser').click(()=>{
            //TODO=>Terminar validaciones

            let form_data = new FormData();
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('name',$('input[name="name"]').val())
            form_data.append('description',$('textarea[name="description"]').val())
            form_data.append('stock',$('input[name="stock"]').val())
            form_data.append('category',$('select[name="category"]').val())
            form_data.append('price',$('input[name="price"]').val())
            form_data.append('image',image)
            form_data.append('show',$('input[name="show"]').prop('checked'))

            $.ajax({
                type:"post",
                url: "{{route('add.user')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('addProductsForm').reset();
                    $('#content_users').html(response.view)
                },
                error: function(error){
                    if(error.status==422){
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        })

        $('#btnUpdateProduct').click(()=>{
            //TODO=>Terminar validaciones

            let image = $('input[name="image_edit"]').prop('files')[0];

            let form_data = new FormData();
            if(image == undefined){
                form_data.append('image',null)
            }else{
                form_data.append('image',image)
            }

            form_data.append('_token','{{csrf_token()}}')
            form_data.append('product_id',$('input[name="product_id"]').val())
            form_data.append('name',$('input[name="name_edit"]').val())
            form_data.append('description',$('textarea[name="description_edit"]').val())
            form_data.append('stock',$('input[name="stock_edit"]').val())
            form_data.append('category',$('select[name="category_edit"]').val())
            form_data.append('price',$('input[name="price_edit"]').val())

            form_data.append('show',$('input[name="show_edit"]').prop('checked'))

            $.ajax({
                type:"post",
                url: "{{route('update.user')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('updateProductsForm').reset();
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