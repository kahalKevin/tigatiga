@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="thanks-order">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box">
                <div class="box-title">
                    <p class="to-title">Thanks Your Order</p>
                </div>
                <p class="to-caption">ORDER ID : 2342343422</p>
                <p class="to-caption2">We Always try to  get your order to arrive as soon as possible</p>
                <a class="btn btn-info btn-lg" href="#">Check your order</a>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick View Content Start -->
<div class="main-product-thumbnail quick-thumb-content">
    <div class="container">
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                          <div class="row">
                            <!-- Main Thumbnail Image Start -->
                            <div class="col-md-6 mb-all-40">
                                <!-- Thumbnail Large Image start -->
                                <div class="tab-content">
                                    <div id="thumb-menu-1" class="tab-pane fade show active">
                                        <a data-fancybox="images" href="img/products/p2.jpg"><img src="/template/img/products/p2.jpg" alt="product-view"></a>
                                    </div>
                                    <div id="thumb-menu-2" class="tab-pane fade">
                                        <a data-fancybox="images" href="img/products/p5.jpg"><img src="/template/img/products/p5.jpg" alt="product-view"></a>
                                    </div>
                                    <div id="thumb-menu-3" class="tab-pane fade">
                                        <a data-fancybox="images" href="img/products/p6.jpg"><img src="/template/img/products/p6.jpg" alt="product-view"></a>
                                    </div>
                                    <div id="thumb-menu-4" class="tab-pane fade">
                                        <a data-fancybox="images" href="img/products/p7.jpg"><img src="/template/img/products/p7.jpg" alt="product-view"></a>
                                    </div>
                                    <div id="thumb-menu-5" class="tab-pane fade">
                                        <a data-fancybox="images" href="img/products/p8.jpg"><img src="/template/img/products/p8.jpg" alt="product-view"></a>
                                    </div>
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image Start -->
                                <div class="product-thumbnail">
                                    <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                        <a class="active" data-toggle="tab" href="#thumb-menu-1"><img src="/template/img/thumbnail/th1.png" alt="product-thumbnail"></a>
                                        <a data-toggle="tab" href="#thumb-menu-2"><img src="/template/img/thumbnail/th2.png" alt="product-thumbnail"></a>
                                        <a data-toggle="tab" href="#thumb-menu-3"><img src="/template/img/thumbnail/th3.png" alt="product-thumbnail"></a>
                                        <a data-toggle="tab" href="#thumb-menu-4"><img src="/template/img/thumbnail/th4.png" alt="product-thumbnail"></a>
                                        <a data-toggle="tab" href="#thumb-menu-5"><img src="/template/img/thumbnail/th5.png" alt="product-thumbnail"></a>
                                    </div>
                                </div>
                                <!-- Thumbnail image end -->
                            </div>
                            <!-- Main Thumbnail Image End -->
                            <!-- Thumbnail Description Start -->
                            <div class="col-md-6">
                                <div class="thubnail-desc ">
                                    <h3 class="product-header">Aspire Dron Model</h3>
                                    <ul class="rating-summary">
                                        <li class="rating-pro">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </li>
                                        <li class="read-review"><a href="#">read reviews (1)</a></li>
                                        <li class="write-review"><a href="#">write review</a></li>
                                    </ul>
                                    <div class="pro-thumb-price mt-20">
                                        <p><span class="special-price">$84.17</span><del class="old-price">$80.50</del></p>
                                    </div>
                                    <ul class="pro-list-features">
                                        <li>Ex Tax: <span class="ex-text">$68.71</span></li>
                                        <li>Brands <a href="#">Maron</a></li>
                                        <li>Product Code: <span>Drone</span></li>
                                        <li>Reward Points: <span>200</span></li>
                                        <li>Availability: <span>In Stock</span></li>
                                    </ul>
                                    <div class="product-size mtb-30 clearfix">
                                        <label>Size</label>
                                        <select class="">
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                        </select>
                                    </div>
                                    <div class="quatity-stock">
                                        <label>Quantity</label>
                                        <ul class="d-flex flex-wrap">
                                            <li class="box-quantity">
                                                <form action="#">
                                                    <input class="quantity" type="number" min="1" value="1">
                                                </form>
                                            </li>
                                            <li>
                                                <button class="pro-cart">add to cart</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Thumbnail Description End -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Content End -->

@endsection