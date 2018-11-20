@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="checkout">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="ch-title">Add To Cart</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-md-9 mb-all-40">
                    <p class="title-shipping">Products In Cart</p>
                    <div class="box-shipping-courier">
                        <div class="row mb-20">
                            <div class="col-sm-12 col-md-4 d-inline-block">
                                <img class="product-image" src="/img/product/adidas-gazelle2.png" width="61" height="63"/>
                                <div class="comment-desc">
                                    <p>Adidas Gazelle II Orange</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 d-inline-block">
                                <div class="input-group justify-content-center mb-3">
                                    <label for="quantity" class="mr-20 align-self-center">Quantity :</label>
                                    <span class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="minus-btn">
                                            <img src="{{ asset('/icon/ico-min.svg') }}" class="ico_minus">
                                        </button>
                                    </span>
                                    <input type="text" id="qty_input" name="quantity" value="1" min="1">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="plus-btn">
                                            <img src="{{ asset('/icon/ico-plus.svg') }}" class="ico_plus">
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 d-inline-block">
                                <div class="price" name="price">
                                    <p>Total Price</p>
                                    <p><b>Rp. 500.0000</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <p class="title-shipping">Shopping Summary</p>
                    <div class="shopping-summary">
                        <form class="price" action="index.html" method="post">
                            <div class="form-group">
                                <label for="total-price">Total Price</label>
                                <input class="form-control" type="text" name="total-price" value="Rp. 1.000.000"
                                    disabled>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 form-btn">
                                        <input id="pay" class="btn btn-info btn-lg" type="button" name="apply" value="CHECKOUT">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
