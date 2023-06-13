@extends('layouts.app')

@section('content')
    <style>
        .content_title_product{
            text-align: start;
        }
        .content_add_product{
            text-align: end;
        }
        @media(max-width: 790px){
            .content_add_product{
                text-align: center;
            }
            .content_title_product{
                text-align: center;
            }
        }
        #content_products, #content_users{
            height: 60vh;
            overflow: auto;
        }
    </style>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6 content_title_product">
                <h1>Mis pedidos</h1>
            </div>

            <div class="col-12" id="content_products">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ID Transacción</th>
                            <th scope="col">Precio total</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de pedido</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->transaction}}</td>
                                <td>{{$order->total}}€</td>
                                <td>{{$order->state->state}}</td>
                                <td>{{\Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s')}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection



