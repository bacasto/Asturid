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
                <h1>Menus ({{count($menus)}})</h1>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-md-6" style="margin: auto">
                        <form style="text-align: center;" id="form_search">
                            @csrf
                            <input type="search" minlength="3" maxlength="250" class="form-control" name="text_search" placeholder="Buscar por nombre">
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
                @include('menus._partial_menus')
            </div>



        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const MIN_LENGHT_FILTER = 2;
        $('#btn_send_filter').click(()=>{
            if($('input[name="text_search"]').val().length<MIN_LENGHT_FILTER){
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

            $.ajax({
                type:"post",
                url: "{{route('search.menus')}}",
                contentType: false,
                processData: false,
                dataType:'json',
                data: form_data,
                success: function (response){
                    $('#content_products').html(response.html)
                },
                error: function(error){

                }
            })
        })
    </script>
@endsection
