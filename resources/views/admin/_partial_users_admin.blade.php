
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Rol</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Dirección</th>
            <th scope="col">Codigo postal</th>
            <th scope="col">Email</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->rol->name}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->zip}}</td>
                <td>{{$user->email}}</td>

                <td>
                    <button class="btn btn-success btn_edit_user" data-bs-toggle="modal"
                            data-bs-target="#modalupdateuser"
                            data-user_id="{{$user->id}}"
                            data-name_user="{{$user->name}}"
                            data-rol_user="{{$user->rol_id}}"
                            data-phone_user="{{$user->phone}}"
                            data-address_user="{{$user->address}}"
                            data-email_user="{{$user->email}}"
                            data-zip_user="{{$user->zip}}"
                    >Editar
                    </button>
                    <button id="btn_remove_{{$user->id}}" data-user_id="{{$user->id}}"
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
        if (confirm("¿Estas seguro que deseas borrar este usuario?")) {
            let userId = e.currentTarget.dataset.user_id;
            let url = '{{ route("destroy.user", ":id") }}';
            url = url.replace(':id', userId);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#content_users').html(response.view)
                },
                error: function (error) {
                    if (error.status == 422) {
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        }

    })

    $('.btn_edit_user').click((e) => {
        let category_id = e.currentTarget.dataset.cat_id_product;;
        $('input[name="product_id"]').val(e.currentTarget.dataset.product_id)
        $('input[name="name_edit"]').val(e.currentTarget.dataset.name_product)
        $('textarea[name="description_edit"]').val(e.currentTarget.dataset.desc_product)
        $('input[name="stock_edit"]').val(e.currentTarget.dataset.stock_product)
        $('select[name="category_edit"]').val(category_id);
        $('input[name="price_edit"]').val(e.currentTarget.dataset.price_product)
        if (e.currentTarget.dataset.show_product == 1) {
            $('input[name="show_edit"]').prop('checked', true)
        } else {
            $('input[name="show_edit"]').prop('checked', false)
        }

    })
</script>