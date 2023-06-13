@extends('layouts.app')

@section('content')
    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        .bg-grey {
            background-color: #eae8e8;
        }

        @media (min-width: 992px) {
            .card-registration-2 .bg-grey {
                border-top-right-radius: 16px;
                border-bottom-right-radius: 16px;
            }
        }

        @media (max-width: 991px) {
            .card-registration-2 .bg-grey {
                border-bottom-left-radius: 16px;
                border-bottom-right-radius: 16px;
            }
        }
    </style>
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Carrito</h1>
                                            <h6 class="mb-0 text-muted"><span id="cartElements">{{count($cartElements)}}</span> elementos</h6>
                                        </div>

                                        @foreach($cartElements as $element)
                                        <hr class="my-4" id="line_element_{{$element->id}}">
                                        <div class="row mb-4 d-flex justify-content-between align-items-center" id="cont_element_{{$element->id}}">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img
                                                    src="{{asset('storage/productos/'.$element->product->image)}}"
                                                    class="img-fluid rounded-3" alt="img-product">
                                            </div>
                                            <div class="col-md-5 col-lg-5 col-xl-5">
                                                <h6 class="text-muted">{{$element->product->name}}</h6>
                                                <h6 class="text-black mb-0">{{ \Illuminate\Support\Str::limit($element->product->description,40)}}</h6>
                                            </div>

                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0">{{$element->product->price}}€</h6>
                                            </div>
                                            <div class="col-md-2 col-lg-2 col-xl-2 text-end">
                                                <button type="button" data-cart_id="{{$element->id}}" class="text-muted btnDeleteCartElement"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="{{route('dashboard')}}" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Volver a productos</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Resumen</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">Subtotal</h5>
                                            <h5 id="subTotalPrice">{{ number_format(\App\CartHelper::getTotalAmount(),2)}}€</h5>
                                        </div>

                                        <h5 class="text-uppercase mb-3">Envío</h5>

                                        <div class="mb-4 pb-2">
                                            <select class="select">
                                                <option value="1">Estandar</option>
                                            </select>
                                        </div>

                                        <h5 class="text-uppercase mb-3">Direccion envio</h5>

                                        <div class="mb-4 pb-2">
                                            <select class="select">
                                                <option value="1">{{\Illuminate\Support\Facades\Auth::user()->address}}</option>
                                            </select>
                                        </div>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Precio total</h5>
                                            <h5 id="totalPrice">{{ number_format(\App\CartHelper::getTotalAmount(),2) }}€</h5>
                                        </div>

                                        <button type="button" class="btn btn-dark btn-block btn-lg"
                                                data-mdb-ripple-color="dark">Pagar</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('.btnDeleteCartElement').click((e)=>{
            let id_cart = e.currentTarget.dataset.cart_id
            let url = '{{ route("destroy.cart", ":id") }}';
            url = url.replace(':id', id_cart);
            $.ajax({
                type: "get",
                url: url,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    toastr.success(response.message)
                    $('#cont_element_'+id_cart).remove();
                    $('#line_element_'+id_cart).remove();
                    $('#totalPrice').text(response.totalAmount+'€')
                    $('#subTotalPrice').text(response.totalAmount+'€')
                    $('#cartElements').text(response.cartCount)
                },
                error: function (error) {
                    if (error.status == 422) {
                        toastr.warning('Los datos introducidos no son válidos')
                    }
                }
            })

        })

    </script>
@endsection
