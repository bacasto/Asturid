<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Imagen</th>
            <th scope="col">Entrante</th>
            <th scope="col">Primer plato</th>
            <th scope="col">Segundo plato</th>
            <th scope="col">Postre</th>
            <th scope="col">Bebida</th>
            <th scope="col">Precio</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td><img style="width: 80px" src="{{asset('storage/menus/'.$menu->image)}}"></td>
                <td>{{$menu->entrante->name}}<br><small>({{$menu->entrante->price}}€)</small></td>
                <td>{{$menu->primerplato->name}}<br><small>({{$menu->primerplato->price}}€)</small></td>
                <td>{{$menu->segundoplato->name}}<br><small>({{$menu->segundoplato->price}}€)</small></td>
                <td>{{$menu->bebida->name}}<br><small>({{$menu->bebida->price}}€)</small></td>
                <td>{{$menu->postre->name}}<br><small>({{$menu->postre->price}}€)</small></td>
                <td>{{$menu->price}}€</td>

                <td>
                    <button class="btn btn-success btn_edit_menu" data-bs-toggle="modal"
                            data-bs-target="#modalupdatemenu"
                            data-menu_id="{{$menu->id}}"
                            data-menu_price="{{$menu->price}}"
                            data-menu_name="{{$menu->name}}"
                            data-entrante="{{$menu->entrante_id}}"
                            data-primerplato="{{$menu->primerplato_id}}"
                            data-segundoplato="{{$menu->segundoplato_id}}"
                            data-bebida="{{$menu->bebida_id}}"
                            data-postre="{{$menu->postre_id}}"
                    >Editar
                    </button>
                    <button id="btn_remove_{{$menu->id}}" data-menu_id="{{$menu->id}}"
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
            let menuId = e.currentTarget.dataset.menu_id;
            let url = '{{ route("destroy.menu", ":id") }}';
            url = url.replace(':id', menuId);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#content_menus').html(response.view)
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

        $('input[name="menu_id"]').val(e.currentTarget.dataset.menu_id)
        $('input[name="name_edit"]').val(e.currentTarget.dataset.menu_name)
        $('select[name="entrante_edit"]').val(e.currentTarget.dataset.entrante)
        $('input[name="primerplato_edit"]').val(e.currentTarget.dataset.primerplato)
        $('input[name="segundoplato_edit"]').val(e.currentTarget.dataset.segundoplato);
        $('input[name="postre_edit"]').val(e.currentTarget.dataset.bebida)
        $('input[name="bebida_edit"]').val(e.currentTarget.dataset.postre)

    })
</script>
