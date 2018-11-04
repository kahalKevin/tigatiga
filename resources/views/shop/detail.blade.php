@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="shop-detail">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="sp-title">Detail Item</p>
            <p class="sp-caption">Kit - Shoes</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-6 col-md-6 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane fade show active">
                            <a data-fancybox="images" href="./img/product/tumblr/1.png"><img src="https://target.scene7.com/is/image/Target/GUEST_7b175d3e-cdfe-489b-8fb7-80d8d1d3a4c3?wid=1400"
                                    alt="product-view"></a>
                        </div>
                        <div id="thumb2" class="tab-pane fade">
                            <a data-fancybox="images" href="./template/img/products/p5.jpg"><img src="https://target.scene7.com/is/image/Target/GUEST_26c17b04-3294-428b-9546-a0fd56f53575?wid=1400"
                                    alt="product-view"></a>
                        </div>
                        <div id="thumb3" class="tab-pane fade">
                            <a data-fancybox="images" href="./template/img/products/p6.jpg"><img src="https://target.scene7.com/is/image/Target/GUEST_4a59581b-6a2f-42f9-8398-275729236f19?wid=1400"
                                    alt="product-view"></a>
                        </div>
                        <div id="thumb4" class="tab-pane fade">
                            <a data-fancybox="images" href="./template/img/products/p7.jpg"><img src="https://target.scene7.com/is/image/Target/GUEST_f14a6b20-7434-4dd7-805a-91c6f12d1f3e?wid=1400"
                                    alt="product-view"></a>
                        </div>
                        <div id="thumb5" class="tab-pane fade">
                            <a data-fancybox="images" href="./template/img/products/p8.jpg"><img src="https://target.scene7.com/is/image/Target/GUEST_334810ac-8dfd-4e58-91f3-00367b47d9c1?wid=1400"
                                    alt="product-view"></a>
                        </div>
                    </div>

                    <div class="product-thumbnail">
                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                            <a class="active" data-toggle="tab" href="#thumb1"><img src="https://target.scene7.com/is/image/Target/GUEST_b8591b8a-d716-401a-bb9c-81a8978bb3a6?wid=1400"
                                    alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb2"><img src="https://target.scene7.com/is/image/Target/GUEST_26c17b04-3294-428b-9546-a0fd56f53575?wid=1400"
                                    alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb3"><img src="https://target.scene7.com/is/image/Target/GUEST_4a59581b-6a2f-42f9-8398-275729236f19?wid=1400"
                                    alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb4"><img src="https://target.scene7.com/is/image/Target/GUEST_f14a6b20-7434-4dd7-805a-91c6f12d1f3e?wid=1400"
                                    alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb5"><img src="https://target.scene7.com/is/image/Target/GUEST_334810ac-8dfd-4e58-91f3-00367b47d9c1?wid=1400"
                                    alt="product-thumbnail"></a>
                        </div>
                    </div>
                </div>
                <!-- Product Size End -->
                <div class="col-lg-6 col-md-6">
                    <div class="thubnail-desc" id="thumbnail-desc">
                        <h3 class="product-header">Adidas Gazelle II Orange</h3>
                        <div class="pro-thumb-price mt-20">
                            <p>
                                <span class="special-price">Rp. 500.000</span>
                            </p>
                        </div>
                        <div class="pro-instock">
                            <p>In Stock</p>
                        </div>
                        <div id="tag-detail">
                            <ul class="instagram-img">
                                <li>
                                    <a href="#">#adidas</a>
                                </li>
                                <li>
                                    <a href="#">#orange</a>
                                </li>
                                <li>
                                    <a href="#">#gazelle</a>
                                </li>
                                <li>
                                    <a href="#">#sneaker</a>
                                </li>
                                <li>
                                    <a href="#">#shoes</a>
                                </li>
                            </ul>
                        </div>

                        <br>
                        <div class="toolbar-sorter d-md-flex align-items-center" id="size-choose">
                            <label>Size :</label>
                            <div class="nice-select sorter wide" tabindex="0">
                                <span class="current">41</span>
                                <ul class="list">
                                    <li data-value="Position" class="option">42</li>
                                    <li data-value="Product Name" class="option">43</li>
                                    <li data-value="Product Name" class="option">44</li>
                                    <li data-value="Price" class="option">45</li>
                                    <li data-value="Price" class="option">46</li>
                                </ul>
                            </div>
                        </div><br>
                        <div class="color d-md-flex clearfix" id="quantity">
                            <label for="quantity">Quantity :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark btn-sm" id="minus-btn">
                                        <img src="/icon/ico-min.svg" class="ico_minus">
                                    </button>
                                </div>
                                <input type="text" id="qty_input" name="quantity" value="1" min="1">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark btn-sm" id="plus-btn">
                                        <img src="/icon/ico-plus.svg" class="ico_plus">
                                    </button>
                                </div>
                            </div>
                            <label for="price">Total :</label>
                            <div class="price" name="price">
                                Rp. 1.000.0000
                            </div>
                        </div>
                        <button class="pro-cart">add to cart</button>
                    </div>
                </div>
            </div>
            <!--END COLUMN -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!-- Product Thumbnail Description Start -->
                    <br>
                    <div class="thumnail-desc dark-white-bg">
                        <div class="container">
                            <div class="thumb-desc-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="main-thumb-desc nav tabs-area" role="tablist">
                                            <li><a class="active" data-toggle="tab" href="#product-desc">Product</a></li>
                                            <li><a data-toggle="tab" href="#delivery">Delivery</a></li>
                                            <li><a data-toggle="tab" href="#size">Size</a></li>
                                        </ul>
                                        <!-- Product Thumbnail Tab Content Start -->
                                        <div class="tab-content thumb-content">
                                            <div id="product-desc" class="tab-pane fade show active">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3">
                                                        <ul>
                                                            <li>SKU (Simple)</li>
                                                            <li>Material luar</li>
                                                            <li>Material dalam</li>
                                                            <li>Sole Material</li>
                                                            <li>Warna</li>
                                                            <li>Petunjuk Perawatan</li>
                                                            <li>Production Country</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <ul>
                                                            <li>342DESHF3E57B8GS</li>
                                                            <li>Sude</li>
                                                            <li>Sintetis</li>
                                                            <li>Rubber</li>
                                                            <li>Orange</li>
                                                            <li>Simpan di dalam kotak dengan gel silika</li>
                                                            <li>Indonesia</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="delivery" class="tab-pane fade">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3">
                                                        <ul>
                                                            <li>SKU (Simple)</li>
                                                            <li>Material luar</li>
                                                            <li>Material dalam</li>
                                                            <li>Sole Material</li>
                                                            <li>Warna</li>
                                                            <li>Petunjuk Perawatan</li>
                                                            <li>Production Country</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <ul>
                                                            <li>342DESHF3E57B8GS</li>
                                                            <li>Sude</li>
                                                            <li>Sintetis</li>
                                                            <li>Rubber</li>
                                                            <li>Orange</li>
                                                            <li>Simpan di dalam kotak dengan gel silika</li>
                                                            <li>Indonesia</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="size" class="tab-pane fade">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3">
                                                        <ul>
                                                            <li>SKU (Simple)</li>
                                                            <li>Material luar</li>
                                                            <li>Material dalam</li>
                                                            <li>Sole Material</li>
                                                            <li>Warna</li>
                                                            <li>Petunjuk Perawatan</li>
                                                            <li>Production Country</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <ul>
                                                            <li>342DESHF3E57B8GS</li>
                                                            <li>Sude</li>
                                                            <li>Sintetis</li>
                                                            <li>Rubber</li>
                                                            <li>Orange</li>
                                                            <li>Simpan di dalam kotak dengan gel silika</li>
                                                            <li>Indonesia</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Thumbnail Tab Content End -->
                                    </div>
                                </div>
                                <div class="row" id="related-product">
                                    <div class="col-md-12">
                                        <!-- Related Product Start-->
                                        <div class="tab-content thumb-content">
                                            <div class="related-product-title">
                                                Premium Related Product
                                            </div><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="single-elomous-product">
                                                    <div class="pro-img">
                                                        <a href="shop/detail">
                                                            <img class="primary-img" src="/img/product/nike-mercurial.png"
                                                                alt="nike-mercurial">
                                                        </a>
                                                    </div>
                                                    <div class="pro-content">
                                                        <div class="pro-info">
                                                            <h4><a href="shop/detail">Sepatu Futsal Nike
                                                                    Mercurial</a></h4>
                                                            <p><span class="price">Rp. 350.000</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="single-elomous-product">
                                                    <div class="pro-img">
                                                        <a href="shop/detail">
                                                            <img class="primary-img" src="/img/product/nb.png"
                                                                alt="new-balance">
                                                        </a>
                                                    </div>
                                                    <div class="pro-content">
                                                        <div class="pro-info">
                                                            <h4><a href="shop/detail">New Balance Running</a></h4>
                                                            <p><span class="price">Rp. 350.000</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="single-elomous-product">
                                                    <div class="pro-img">
                                                        <a href="shop/detail">
                                                            <img class="primary-img" src="/img/product/vans.png"
                                                                alt="vans">
                                                        </a>
                                                    </div>
                                                    <div class="pro-content">
                                                        <div class="pro-info">
                                                            <h4><a href="shop/detail">Vans Old Skool Black</a></h4>
                                                            <p><span class="price">Rp. 500.000</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="single-elomous-product">
                                                    <div class="pro-img">
                                                        <a href="shop/detail">
                                                            <img class="primary-img" src="/img/product/adidas-gazelle2.png"
                                                                alt="adidas">
                                                        </a>
                                                    </div>
                                                    <div class="pro-content">
                                                        <div class="pro-info">
                                                            <h4><a href="shop/detail">Adidas Gazelle II
                                                                    Orange</a></h4>
                                                            <p><span class="price">Rp. 500.000</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Related Product End -->
                                    </div>
                                </div>
                                <!-- Row End -->
                            </div>
                        </div>
                        <!-- Container End -->
                    </div>
                    <!-- Product Thumbnail Description End -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection