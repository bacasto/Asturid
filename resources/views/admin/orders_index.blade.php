@extends('layouts.app')

@section('content')
    <style>
        .content_title_product{
            text-align: start;
        }
        .content_add_product{
            text-align: end;
        }
        @media(max-width: 790px){
            .content_add_product{
                text-align: center;
            }
            .content_title_product{
                text-align: center;
            }
        }
        #content_products, #content_users{
            height: 60vh;
            overflow: auto;
        }
    </style>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6 content_title_product">
                <h1>Pedidos</h1>
            </div>
            <div class="col-12" id="content_orders">
                @include('admin._partial_orders_admin',$orders)
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalupdateorder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updateOrdersForm">
                        <input class="form-control" type="hidden" name="order_id" required>
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" name="state_edit" required>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->state}}</option>
                                @endforeach
                            </select>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateOrder" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        $('#btnUpdateOrder').click(()=>{
            let form_data = new FormData();

            form_data.append('_token','{{csrf_token()}}')
            form_data.append('order_id',$('input[name="order_id"]').val())
            form_data.append('state_id',$('select[name="state_edit"]').val())

            $.ajax({
                type:"post",
                url: "{{route('update.order')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    toastr.success(response.message)
                    document.getElementById('updateOrdersForm').reset();
                    $('#content_orders').html(response.view)
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



