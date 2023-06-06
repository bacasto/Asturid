
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Description</th>
            <th scope="col">Categoría</th>
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
                <td>{{$producto->stock}}</td>
                <td><img style="width: 80px" src="{{asset('storage/productos/'.$producto->image)}}"></td>
                <td>{{$producto->showProduct==1 ? 'Si' : 'No' }}</td>
                <td>
                    <button class="btn btn-success">Editar</button>
                    <button id="btn_remove_{{$producto->id}}" data-product_id="{{$producto->id}}" class="btn btn-danger btn_remove">Eliminar</button>
                </td>
            </tr>
        <script>
            console.log("Producto {{$producto->id}}")
        </script>
        @endforeach
        </tbody>
    </table>
</div>
<script>
     console.log('hola')
        $('.btn_remove').click((e)=>{
            if(confirm("¿Estas seguro que deseas borrar este producto?")){
                let productId = e.currentTarget.dataset.product_id;
                let url = '{{ route("destroy.producto", ":id") }}';
                url = url.replace(':id',productId);
                $.ajax({
                    type:"get",
                    url: url,
                    contentType: false,
                    processData: false,
                    dataType:'json',
                    success: function (response){
                        toastr.success(response.message)
                        $('#content_products').html(response.view)
                    },
                    error: function(error){
                        if(error.status==422){
                            toastr.warning('Los datos introducidos no son válidos')
                        }
                    }
                })
            }

        })
</script>
