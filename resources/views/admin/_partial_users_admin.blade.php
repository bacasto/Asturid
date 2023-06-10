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
       console.log('editt')
        $('input[name="user_id"]').val(e.currentTarget.dataset.user_id)
        $('input[name="name_edit"]').val(e.currentTarget.dataset.name_user)
        $('select[name="rol"]').val(e.currentTarget.dataset.rol_user)
        $('input[name="email_edit"]').val(e.currentTarget.dataset.email_user)
        $('input[name="phone_edit"]').val(e.currentTarget.dataset.phone_user);
        $('input[name="address_edit"]').val(e.currentTarget.dataset.address_user)
        $('input[name="zip_edit"]').val(e.currentTarget.dataset.zip_user)

    })
</script>