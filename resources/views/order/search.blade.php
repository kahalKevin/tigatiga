@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="search-order">
            <div class="container">
                <div class="box" action="index.html" method="post">
                    <p class="sp-title">KITS</p>
                    <p class="sp-caption">CLOTHINGS</p>
                    <div class="row">
                        <!-- Sidebar Shopping Option Start -->
                        <div class="col-lg-3 order-2 order-lg-1 mt-all-30">
                            <!-- Product Size Start -->
                            <div class="size mb-30" id="size">
                                <h3 class="sidebar-title">SIZE</h3>
                                <ul class="size-list sidbar-style">
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="" id="small" type="checkbox">
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <label class="form-check-label" for="small">S</label>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 value-size">
                                                <label class="form-check-label" for="small">(20)</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="" id="medium" type="checkbox">
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <label class="form-check-label" for="medium">M</label>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 value-size">
                                                <label class="form-check-label" for="medium">(23)</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="" id="large" type="checkbox">
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <label class="form-check-label" for="large">L</label>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 value-size">
                                                <label class="form-check-label" for="large">(8)</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="" id="xtra-large" type="checkbox">
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <label class="form-check-label" for="xtra-large">XL</label>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 value-size">
                                                <label class="form-check-label" for="xtra-large">(10)</label>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- <li class="form-check"> -->
                                        <a href="#" >Show More</a>
                                    <!-- </li> -->
                                </ul>
                            </div>
                            <div class="size mb-30" id="price">
                                <h3 class="sidebar-title">PRICE</h3>
                                <ul class="size-list sidbar-style">
                                    <li class="form-check">
                                        <div class="row">
                                            <form class="price" action="index.html" method="post">
                                                <div class="form-group row">
                                                    <!-- <div class="col-lg-3"> -->
                                                        <label for="from" class="col-lg-3 col-md-3 col-sm-3 col-form-label">From</label>
                                                    <!-- </div> -->
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <input class="form-control" type="number" name="from">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <!-- <div class="col-lg-3"> -->
                                                        <label for="to" class="col-lg-3 col-md-3 col-sm-3 col-form-label">To</label>
                                                    <!-- </div> -->
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <input class="form-control" type="number" name="to">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 form-btn">
                                                            <input class="btn btn-info btn-lg" type="submit" name="apply" value="Apply">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="size mb-30">
                                <h3 class="sidebar-title">GENDRE</h3>
                                <ul class="size-list sidbar-style">
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="" id="pria" type="checkbox">
                                            <div class="col-lg-12">
                                                <label class="form-check-label" for="pria">Pria</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="" id="wanita" type="checkbox">
                                            <div class="col-lg-12">
                                                <label class="form-check-label" for="wanita">Wanita</label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="size mb-30" id="tag">
                                <h3 class="sidebar-title">TAG</h3>
                                <ul class="instagram-img">
                                    <li>
                                        <a href="#">#Sepatu</a>
                                    </li>
                                    <li>
                                        <a href="#">#Pria</a>
                                    </li>
                                    <li>
                                        <a href="#">#Adidas</a>
                                    </li>
                                    <li>
                                        <a href="#">#Nike</a>
                                    </li>
                                    <li>
                                        <a href="#">#Wanita</a>
                                    </li>
                                    <li>
                                        <a href="#">#Jersey</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Product Size End -->
                        </div>
                        <div class="col-lg-9 order-2 order-lg-1 mt-all-30" id="sort">
                            <p class="hasil-pencarian">Hasil Pencarian dari "Sepatu"</p>
                            <p class="produk-keterangan">4 Produk ditemukan</p>
                            <div class="row">
                                <!-- Single Service Area Start Here -->
                                <div class="col-lg-4 col-md-6 mb-all-40">
                                    <div class="single-elomous-product">
                                        <div class="pro-img">
                                            <a href="shop-detail.html">
                                                <img class="primary-img" src="/img/product/nike-mercurial.png" alt="single-product">
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="shop-detail.html">Sepatu Futsal Nike Mercurial</a></h4>
                                                <p><span class="special-price">Rp. 35.000</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Service Area Start Here -->
                                <div class="col-lg-4 col-md-6 mb-all-40">
                                    <div class="single-elomous-product">
                                        <div class="pro-img">
                                            <a href="shop-detail.html">
                                                <img class="primary-img" src="/img/product/vans.png" alt="single-product">
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="shop-detail.html">Vans Old Skool Black</a></h4>
                                                <p><span class="special-price">Rp. 500.000</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Service Area Start Here -->
                                <div class="col-lg-4 col-md-6 mb-all-40">
                                    <div class="single-elomous-product">
                                        <div class="pro-img">
                                            <a href="shop-detail.html">
                                                <img class="primary-img" src="/img/product/adidas-gazelle2.png" alt="single-product">
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="shop-detail.html">Adidas Gazelle II Orange</a></h4>
                                                <span class="discount">
                                                    <p>Rp. 100.000</p>
                                                </span>
                                                <p><span class="special-price">Rp. 500.000</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Service Area Start Here -->
                                <div class="col-lg-4 col-md-6 mb-all-40">
                                    <div class="single-elomous-product">
                                        <div class="pro-img">
                                            <a href="shop-detail.html">
                                                <img class="primary-img" src="/img/product/nb.png" alt="single-product">
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="shop-detail.html">New Balance Running</a></h4>
                                                <p><span class="special-price">Rp. 350.000</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END COLUMN -->
                    </div>
                </div>
            </div>
        </div>

@endsection