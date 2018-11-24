@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="checkout">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="ch-title">Checkout</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-md-9 mb-all-40">
                <p class="title-shipping">Buyer Details</p>
                    <div class="box-shipping-courier">
                        <div class="mb-20">
                            <button class="tab" data-toggle="modal" data-target="#modal-login">Login</button>
                            <button class="tab border-bottom border-red">Buy without register</button>
                        </div>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="text" class="form-control" placeholder="Type Your Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Email</label>
                                    <input type="email" class="form-control" placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Phone</label>
                                    <input type="email" class="form-control" placeholder="+6281908xxxx">
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-sm-end">
                                    <button type="button" class="enter-shipping-address" data-toggle="modal" data-target="#modal-add-new-address">ENTER SHIPPING ADDRESS</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="title-shipping mt-30">Shipping Courier</p>
                    <div class="box-shipping-courier">
                        <div class="row mb-20">
                            <div class="col-sm-12 col-md-4 d-inline-block">
                                <img class="product-image" src="/img/product/adidas-gazelle2.png" width="61" height="63"/>
                                <div class="comment-desc">
                                    <p>Adidas Gazelle II Orange</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 d-inline-block">
                                <div class="input-group justify-content-sm-center mb-3" style="margin-top:10px;">
                                    <label for="quantity" class="mr-20 align-self-center">Quantity :</label>
                                    <span class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="minus-btn">
                                            <img src="/icon/ico-min.svg" class="ico_minus">
                                        </button>
                                    </span>
                                    <input type="text" id="qty_input" name="quantity" value="1" min="1">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-dark btn-sm" id="plus-btn">
                                            <img src="/icon/ico-plus.svg" class="ico_plus">
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
                        <div class="row">
                            <div class="col-md-3">
                                <label class="align-content-center">Shipping Courier</label>
                            </div>
                            <div class="col-md-9">
                            <div class="nice-select sorter wide" tabindex="0">
                                <span class="current">JNE Regular ( 2 Day )</span>
                                <ul class="list">
                                    <li data-value="Position" class="option">JNE Regular ( 2 Day )</li>
                                    <li data-value="Product Name" class="option">TIKI</li>
                                    <li data-value="Product Name" class="option">POS Indonesia</li>
                                </ul>
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
                                <label for="total-shipping">Total Shipping</label>
                                <input class="form-control" type="text" name="total-shipping" value="Rp. 9.000"
                                    disabled>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="grand-price">Grand Price</label>
                                <input id="grand-price" class="form-control" type="text" name="grand-price" value="Rp. 1.009.000"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 form-btn">
                                        <input id="pay" class="btn btn-info btn-lg" type="submit" name="apply" value="Pay">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Product Size End -->
                <!--END COLUMN -->
                <div class="modal fade" id="modal-change-address" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">CHANGE ADDRESS</h4>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="box">
                                    <div class="round">
                                    <input type="radio" name="address" value="test"/>
                                    </div>
                                    <div class="cust-name">
                                    Dwi Putra
                                    </div>
                                    <div class="cust-addr-phone">
                                    Kantor Codigo. Graha Mitra Lantai 7 Jl. Jend. Gatot Subroto Kav.21
                                    </div>
                                    <div class="cust-addr-phone">
                                    08382381908
                                    </div>
                                    <a href="#">Delete</a>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="box">
                                    <div class="round">
                                    <input type="radio" name="address" value="test"/>
                                    </div>
                                    <div class="cust-name">
                                    Dwi Putra
                                    </div>
                                    <div class="cust-addr-phone">
                                    Jl. Sultan Agung Tirtayasa Gg. Pulomas III Rt. 02 Rw. 02 Ds. Kedawung
                                    </div>
                                    <div class="cust-addr-phone">
                                    08382381908
                                    </div>
                                    <a href="#">Delete</a>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="box">
                                    <div class="round">
                                    <input type="radio" name="address" value="test"/>
                                    </div>
                                    <div class="cust-name">
                                    Dwi Putra
                                    </div>
                                    <div class="cust-addr-phone">
                                    Perumahan Bulak Kapal Permai Kel. Margahayu Kec. Bekasi Timur
                                    </div>
                                    <div class="cust-addr-phone">
                                    08382381908
                                    </div>
                                    <a href="#">Delete</a>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a id="add-new-address" href="#" class="btn btn-info">ADD NEW ADDRESS</a>
                                    <a id="choose-address" href="#" class="btn btn-info">CHOOSE THIS ADDRESS</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-add-new-address" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <p class="modal-title">Add New Address</p>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group">
                                    <label class="label-form" for="receiver-name">Receiver Name</label>
                                    <input class="form-control auth" type="text" name="receiver-name" value="" placeholder="Type your name">
                                </div>
                                <div class="form-group">
                                    <label class="label-form" for="phone">Phone</label>
                                    <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
                                </div>
                                <div class="form-group">
                                    <label class="label-form" for="city-distinct">City or Distinct</label>
                                    <input class="form-control auth" type="text" name="city-distinct" value="" placeholder="Search City or District">
                                </div>
                                <div class="form-group">
                                    <label class="label-form" for="postal-code">Postal Code</label>
                                    <input class="form-control auth" type="text" name="postal-code" value="" placeholder="Type your postal Code">
                                </div>
                                <div class="form-group">
                                    <label class="label-form" for="address">Address</label>
                                    <textarea class="form-control auth" name="address" rows="8" cols="80"></textarea>
                                </div>
                                <input class="btn btn-info btn-lg" type="submit" name="submit" value="SAVE">
                            </form>
                        </div>
                    </div>
                </div>
    </div>
            </div>
        </div>
    </div>
</div>

@endsection
