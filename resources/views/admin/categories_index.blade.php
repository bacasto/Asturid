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
                <h1>Extras</h1>
            </div>
            <div class="col-12 col-md-6 content_add_user">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modaladdcat"  class="btn btn-primary">Añadir categoría</button>
            </div>
            <div class="col-12" id="content_categories">
                @include('admin._partial_categorias_admin',$categorias)
            </div>

        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="modaladdcat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir categoría</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="addCatForm">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name" required>
                            <div id="errorName"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnAddCat" data-bs-dismiss="modal">Añadir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalupdatecat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar categoría</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updateCatForm">
                        <input class="form-control" type="hidden" name="categoria_id" required>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" max="250" name="name_edit" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateCat" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btnAddCat').click(()=>{
            let form_data = new FormData();
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('name',$('input[name="name"]').val())
            $.ajax({
                type:"post",
                url: "{{route('add.cat')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('addCatForm').reset();
                    $('#content_categories').html(response.view)
                },
                error: function(error){
                    if(error.status==422){
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        })

        $('#btnUpdateCat').click(()=>{
            let form_data = new FormData();
            form_data.append('_token','{{csrf_token()}}')
            form_data.append('categoria_id',$('input[name="categoria_id"]').val())
            form_data.append('name',$('input[name="name_edit"]').val())
            $.ajax({
                type:"post",
                url: "{{route('update.cat')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('updateCatForm').reset();
                    $('#content_categories').html(response.view)
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
