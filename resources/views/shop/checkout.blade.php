@extends('layouts.app')

@section('content')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="service-area ptb-80" id="checkout">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="ch-title">Checkout</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-md-9 mb-all-40">
                    <p class="title-shipping">Shipping Courier</p>
                    <div class="box-shipping-courier">


                        @foreach($orderItems as $item)
                        <div class="row mb-20">
                            <div class="col-sm-12 col-md-4 d-inline-block">
                                <img class="product-image" src="{{ env('IMG_URL_PREFIX') . $item->products->_image_url }}" width="61" height="63"/>
                                <div class="comment-desc">
                                    <p>{{ $item->products->_name }}</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 d-inline-block">
                                <div class="input-group justify-content-center mb-3">
                                    <label for="quantity" class="mr-20 align-self-center">Quantity :</label>
                                    <span class="input-group-prepend">
                                    </span>
                                    <input type="text" id="qty_input" name="quantity" value="{{ $item->_qty }}" min="1">
                                    <span class="input-group-prepend">
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 d-inline-block">
                                <div class="price" name="price">
                                    <p>Total Price</p>
                                    <p><b>Rp. {{ number_format($item->_qty * $item->product_price, 2) }}</b></p>
                                </div>
                            </div>
                        </div>                        
                        @endforeach
                        <div class="row">
                            <div class="col-md-3">
                                <label class="align-content-center">Shipping Courier</label>
                            </div>
                            <div class="col-md-9">
                            <div class="nice-select sorter wide" tabindex="0">
                                @if(isset($defaultAddress))
                                    <span class="current">Select Shipping Courier</span>
                                    <ul class="list list-shipping-courier-checkout">
                                    @foreach($shippingDetail["rajaongkir"]["results"][0]["costs"] as $service)
                                    <li data-value="{{ $service["cost"][0]["value"] }}" class="option">{{ $service["service"] . "(". $service["cost"][0]["etd"] ." Day) IDR ".number_format($service["cost"][0]["value"]).".00" }}</li>
                                    @endforeach                                    
                                    </ul>
                                @else
                                    <span class="current">Please Add new address first</span>
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                    <p class="title-shipping mt-30">Shipping Address</p>
                    <div class="box-shipping-courier mt-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shipping-courier-item">
                                    <div class="row">
                                        @if(isset($defaultAddress))
                                        <div class="col-md-12">
                                            <p class="cust-name">{{ $defaultAddress->_receiver_name }}</p>
                                            <p class="cust-address">{{ $defaultAddress->_address }}<br>, {{ $defaultAddress->_kode_pos }}</p>
                                            <p class="cust-phone">{{ $defaultAddress->_receiver_phone }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-change-address">
                                @if(isset($defaultAddress))
                                    CHANGE ADDRESS
                                @else
                                    ADD NEW ADDRESS
                                @endif
                                </button>
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
                                <input class="form-control" type="text" name="total-price" value="Rp. {{ number_format($totalOrder['price'], 2) }}"
                                    disabled>
                                <input type="hidden" name="total-price-checkout-usage" value="{{ $totalOrder['price'] }}"
                                    disabled id="total-price-checkout-usage">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="total-shipping">Total Shipping</label>
                                <input class="form-control" type="text" name="total-shipping" value=""
                                    disabled id="total-shipping-cost-checkout">
                                <input type="hidden" name="total-shipping-cost-usage" value=""
                                    disabled id="total-shipping-cost-usage">    
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="grand-price">Grand Price</label>
                                <input id="grand-price-checkout" class="form-control" type="text" name="grand-price-checkout" value="Rp. {{ number_format($totalOrder['price'], 2) }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 form-btn">
                                        @if(isset($defaultAddress))
                                            <button class="btn btn-info btn-lg" name="apply" id="pay" type="button">Pay</button>
                                        @else
                                            <button class="btn btn-info btn-lg" name="apply" id="pay" type="submit" disabled>Pay</button>
                                        @endif
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
                            <form class="form-horizontal" action="{{ url('/') }}/shop/set-default-address" method="post">
                            @csrf
                            <input class="form-control auth" type="hidden" name="order_id" id="order-id" value="{{ $order->id }}">
                            <div class="row">
                                @foreach($list_user_address as $lua)
                                    <div class="col-md-4 col-xs-12">
                                        <div class="box">
                                            <div class="round">
                                            <input type="radio" name="address" value="{{ $lua->id }}" {{ $lua->_default == '1' ? "checked" : "" }}/>
                                            </div>
                                            <div class="cust-name">
                                                {{ $lua->_receiver_name }}
                                            </div>
                                            <div class="cust-addr-phone">
                                                {{ $lua->_address }}
                                            </div>
                                            <div class="cust-addr-phone">
                                                {{ $lua->_receiver_phone }}
                                            </div>
                                            <a href="/profile/delete-address/{{ $lua->id }}" onclick="return confirm('Are you sure?')">Delete</a>
                                        </div>
                                    </div>
                                @endforeach                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a id="add-new-address" data-dismiss="modal" data-toggle="modal" data-target="#modal-add-new-address" class="btn btn-info">ADD NEW ADDRESS</a>
                                    <button class="btn btn-info" name="apply" id="choose-address" type="submit">CHOOSE THIS ADDRESS</button>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
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
                <form class="form-horizontal" action="{{ url('/') }}/shop/add-new-address" method="post">
                    @csrf
                    <input class="form-control auth" type="hidden" name="order_id" value="{{ $order->id }}">
                    <div class="form-group">
                        <label class="label-form" for="receiver-name">Receiver Name</label>
                        <input class="form-control auth" type="text" name="receiver_name" value="" placeholder="Type your name">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="phone">Phone</label>
                        <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="provinsi">Province</label>
                        <select name="provinsi" id="provinsi" class="form-control auth provinsi">
                            <option value="">Select Province</option>
                            @foreach($province->rajaongkir->results as $prov)
                                <option value='{{ $prov->province_id }}'>{{ $prov->province }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label class="label-form" for="city">City or Distinct</label>
                        <div>
                            <select name="city" class="form-control auth city">
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="postal-code">Postal Code</label>
                        <input class="form-control auth" type="text" name="postal_code" value="" placeholder="Type your postal Code">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="address">Address</label>
                        <textarea class="form-control auth" name="address" rows="8" cols="80"></textarea>
                    </div>
                    <button class="btn btn-info btn-lg" type="submit" name="submit">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{env('MIDTRANS_SNAP_JS_URL')}}" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
  document.getElementById('pay').onclick = function(){
    paymentLoggedIn();
  };
</script>
@endsection
