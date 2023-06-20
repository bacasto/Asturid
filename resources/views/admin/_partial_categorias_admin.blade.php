<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->name}}</td>

                <td>
                    <button class="btn btn-success btn_edit_cat" data-bs-toggle="modal"
                            data-bs-target="#modalupdatecat"
                            data-categoria_id="{{$categoria->id}}"
                            data-categoria_name="{{$categoria->name}}"
                    >Editar
                    </button>
                    <button id="btn_remove_{{$categoria->id}}" data-categoria_id="{{$categoria->id}}"
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
        if (confirm("¿Estas seguro que deseas borrar esta categoría?")) {
            let catId = e.currentTarget.dataset.categoria_id;
            let url = '{{ route("destroy.cat", ":id") }}';
            url = url.replace(':id', catId);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#content_categories').html(response.view)
                },
                error: function (error) {
                    if (error.status == 422) {
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        }

    })

    $('.btn_edit_cat').click((e) => {
        $('input[name="categoria_id"]').val(e.currentTarget.dataset.categoria_id)
        $('input[name="name_edit"]').val(e.currentTarget.dataset.categoria_name)
    })
</script>
