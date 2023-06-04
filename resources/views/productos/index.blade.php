@extends('layouts.app')

@section('content')
    <style>
        .items_categories li{
            margin:15px;
            list-style: none;
            padding: 5px;
            background-color: bisque;
            border-radius: 5px;
        }
        .items_categories li:hover{
            background-color: #f6a03e;
        }
        .items_categories li a{
            text-decoration-line: none;
            color:black;
        }

    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 mb-4" style="text-align: center">
                <h1>Productos ({{count($productos)}})</h1>

                <span>{{ isset($category_name) ? $category_name : '' }}</span>
            </div>

            <div class="col-12">
                <ul class="items_categories" style="display: flex">
                    <li> <a href="{{route('show.product.category',0)}}">Todos</a> </li>
                @foreach($categorias as $categoria)
                        <li>
                            <a href="{{route('show.product.category',$categoria->id)}}">{{$categoria->name}}</a>
                        </li>
                @endforeach
                </ul>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-md-6" style="margin: auto">
                        <form style="text-align: center;" id="form_search">
                            @csrf
                            <input type="search" minlength="3" maxlength="250" class="form-control" name="text_search" placeholder="Buscar por nombre o descripcion">
                            <div id="error_text">

                            </div>
                            <label>
                                Precio mínimo
                                <input type="number" min="0" step="0.01" class="form-control" name="min_price">
                            </label>
                            <label>
                                Precio máximo
                                <input type="number" max="999" step="0.01" class="form-control" name="max_price">
                            </label>
                            <button type="button" id="btn_send_filter" style="padding: 5px" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="content_products">
                @include('productos._partial_productos')
            </div>



        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const MIN_LENGHT_FILTER = 2;
        @if(isset($category_id))
            let category_id = '{{$category_id}}'
        @else
            let category_id = 0
        @endif
        $('#btn_send_filter').click(()=>{
            if($('input[name="text_search"]').val().length<MIN_LENGHT_FILTER){
                console.log('Debes escribir mas')
                $('#error_text').html(`<p style="color: red;font-weight: bold">Debes introducir al menos ${MIN_LENGHT_FILTER} carácteres</p>`)
                return;
            }else{
                $('#error_text').html('')
            }
            let form_data = new FormData();

            form_data.append('_token','{{csrf_token()}}')
            form_data.append('text',$('input[name="text_search"]').val())
            form_data.append('p_min',$('input[name="min_price"]').val())
            form_data.append('p_max',$('input[name="max_price"]').val())
            form_data.append('category_id',category_id)

            $.ajax({
                type:"post",
                url: "{{route('search.products')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    document.getElementById('content_products').innerHTML = response.html
                },
                error: function(error){
                    console.log("Error: "+error)
                }
            })


        })
    </script>
@endsection
