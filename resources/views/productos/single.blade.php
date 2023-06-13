@extends('layouts.app')

@section('content')
    <style>
        .list-group-input{
            list-style: none;
        }
    </style>
    @php
        $extras = \App\Models\Extra::where('category_id',$producto->category_id)->get();
    @endphp
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 mb-4" style="text-align: center">
                <h3>{{$producto->name}}</h3>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{asset('storage/productos/'.$producto->image)}}" style="width: 100%">
            </div>
            <div class="col-12 col-md-6 mb-4">
                <p>{{$producto->description}}</p>
                <p>Unidades disponibles: <strong>{{$producto->stock}}</strong></p>
                <p>Precio: <strong>{{$producto->price}}€</strong></p>
                <p>Categoria: <strong>{{$producto->category->name}}</strong></p>
                <p>Extras:</p>
                <ul class="list-group list-goup-light">
                    @foreach($extras as $extra)
                    <li class="list-group-input">
                        <input class="form-check-input" type="checkbox" name="extras" value="{{$extra->id}}">
                        {{$extra->name}}
                    </li>
                    @endforeach
                </ul>
                <button type="button" class="btn btn-primary mt-4" data-product_id="{{$producto->id}}" id="btnAddCart">Añadir al carrito</button>
            </div>

        </div>
    </div>
    <script>
        $('#btnAddCart').click((e)=>{
            let extrasChecked = $('input[name="extras"]:checked');
            let extras="";
            extrasChecked.each(function () {
                console.log($(this).val());
                extras+=$(this).val()+",";
            })
            let formData = new FormData();
            formData.append('_token','{{csrf_token()}}')
            if(extras!=undefined && extras.length>0 && extras!=null){
                formData.append('extras',extras);
            }
            formData.append('product_id',e.currentTarget.dataset.product_id);
            console.log(extras)
            $.ajax({
                type:"post",
                url: "{{route('add.cart')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: formData,
                success: function (response){
                    toastr.success(response.message)
                    console.log(response)
                    $('#countCartElements').text(response.cartCount);
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
