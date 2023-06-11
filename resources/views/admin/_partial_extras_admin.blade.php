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
        @foreach($extras as $extra)
            <tr>
                <td>{{$extra->id}}</td>
                <td>{{$extra->name}}</td>
                <td>
                    <button class="btn btn-success btn_edit_extra" data-bs-toggle="modal"
                            data-bs-target="#modalupdateextra"
                            data-extra_id="{{$extra->id}}"
                            data-extra_name="{{$extra->name}}"
                            data-extra_category="{{$extra->category_id}}"
                    >Editar
                    </button>
                    <button id="btn_remove_{{$extra->id}}" data-extra_id="{{$extra->id}}"
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
            let extraId = e.currentTarget.dataset.extra_id;
            let url = '{{ route("destroy.extra", ":id") }}';
            url = url.replace(':id', extraId);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#content_extras').html(response.view)
                },
                error: function (error) {
                    if (error.status == 422) {
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        }

    })

    $('.btn_edit_menu').click((e) => {
        $('input[name="extra_id"]').val(e.currentTarget.dataset.extra_id)
        $('input[name="name_edit"]').val(e.currentTarget.dataset.name_extra)
        $('input[name="category_edit"]').val(e.currentTarget.dataset.extra_category)
    })
</script>
