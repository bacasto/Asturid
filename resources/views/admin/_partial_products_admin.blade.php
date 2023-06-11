<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Description</th>
            <th scope="col">Categoría</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Imagen</th>
            <th scope="col">Mostrar</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{$producto->id}}</td>
                <td>{{$producto->name}}</td>
                <td>{{$producto->description}}</td>
                <td>{{$producto->category->name}}</td>
                <td>{{$producto->price}}€</td>
                <td>{{$producto->stock}}</td>
                <td><img style="width: 80px" src="{{asset('storage/productos/'.$producto->image)}}"></td>
                <td>{{$producto->showProduct==1 ? 'Si' : 'No' }}</td>
                <td>
                    <button class="btn btn-success btn_edit_product" data-bs-toggle="modal"
                            data-bs-target="#modalupdateproduct"
                            data-product_id="{{$producto->id}}"
                            data-name_product="{{$producto->name}}"
                            data-desc_product="{{$producto->description}}"
                            data-cat_id_product="{{$producto->category_id}}"
                            data-cat_name_product="{{$producto->category->name}}"
                            data-stock_product="{{$producto->stock}}"
                            data-show_product="{{$producto->showProduct}}"
                            data-price_product="{{$producto->price}}"
                    >Editar
                    </button>
                    <button id="btn_remove_{{$producto->id}}" data-product_id="{{$producto->id}}"
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
        if (confirm("¿Estas seguro que deseas borrar este producto?")) {
            let productId = e.currentTarget.dataset.product_id;
            let url = '{{ route("destroy.producto", ":id") }}';
            url = url.replace(':id', productId);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#content_products').html(response.view)
                },
                error: function (error) {
                    if (error.status == 422) {
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })
        }

    })

    $('.btn_edit_product').click((e) => {
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
