<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col">ID Transacción</th>
            <th scope="col">Precio total</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha de pedido</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->transaction}}</td>
                <td>{{$order->total}}€</td>
                <td>{{$order->state->state}}</td>
                <td>{{\Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s')}}</td>

                <td>
                    <button class="btn btn-success btn_edit_order" data-bs-toggle="modal"
                            data-bs-target="#modalupdateorder"
                            data-order_id="{{$order->id}}"
                            data-order_status_id="{{$order->state_id}}"
                    >Editar
                    </button>
                    <button id="btn_remove_{{$order->id}}" data-order_id="{{$order->id}}"
                            class="btn btn-danger btn_remove">Eliminar
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
<script>
    $('.btn_remove').click((e) => {
        if (confirm("¿Estas seguro que deseas borrar este pedido?")) {
            let orderId = e.currentTarget.dataset.order_id;
            let url = '{{ route("destroy.order", ":id") }}';
            url = url.replace(':id', orderId);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#content_orders').html(response.view)
                },
                error: function (error) {
                    if (error.status == 422) {
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        }

    })

    $('.btn_edit_order').click((e) => {
        $('input[name="order_id"]').val(e.currentTarget.dataset.order_id)
        $('input[select="state_edit"]').val(e.currentTarget.dataset.order_status_id)
    })
</script>
