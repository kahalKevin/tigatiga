@extends('layouts.app')

@section('content')

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="service-area ptb-80" id="shop-detail">
    <div class="container">
        <div class="box" action="index.html" method="post">
            <p class="sp-title">Detail Item</p>
            <p class="sp-caption">{{ $category_parent->_name }} - {{ $category->_name }}</p>
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-6 col-md-6 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        @for($i = 0; $i < $products_galleries->count(); $i++)
                        <div id="thumb{{ $i }}" class="tab-pane fade {{ $i === 0 ? "show active" : "" }}">
                            <a data-fancybox="images" href="{{ $cmsUrl . $products_galleries[$i]->_url }}?wid=1400"><img src="{{ $cmsUrl . $products_galleries[$i]->_url }}?wid=1400"
                                    alt="product-view"></a>
                        </div>                        
                        @endfor
                    </div>

                    <div class="product-thumbnail">
                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                            @for($i = 0; $i < $products_galleries->count(); $i++)                                
                                <a {{ $i === 0 ? 'class="active"' : '' }} data-toggle="tab" href="#thumb{{$i}}"><img src="{{ $cmsUrl . $products_galleries[$i]->_url }}?wid=1400"
                                    alt="product-thumbnail">
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
                <!-- Product Size End -->
                <div class="col-lg-6 col-md-6">
                    <div class="thubnail-desc" id="thumbnail-desc">
                        <h3 class="product-header">{{ $product->_name }}</h3>
                        <div class="pro-thumb-price mt-20">
                            <p>
                                <span class="special-price">Rp. {{ number_format($product->_price, 2) }}</span>
                            </p>
                        </div>
                        @if($products_sizes->count() > 0)
                        <div class="pro-instock">
                            <p>In Stock</p>
                        </div>                        
                        @else
                        <div class="pro-instock">
                            <p>No Stock</p>
                        </div>                        
                        @endif
                        <div id="tag-detail">
                            @foreach($product_tags as $tag)
                                <a href="/shop/indexByTag/{{ $tag->id }}+{{ $tag->name }}">#{{ $tag->name }}</a> &nbsp&nbsp
                            @endforeach
                        </div>

                        <br>
                        <div class="toolbar-sorter d-md-flex align-items-center" id="size-choose">
                            <label>Size :</label>
                           <!--  <div class="nice-select sorter wide" tabindex="0"> -->
                                @if($products_sizes->count() > 0)
                                <!-- <span class="current">{{ $products_sizes[0]->size->_name }}</span> -->
                                <select class="list" id="size_input">
                                    @for($i = 0; $i < $products_sizes->count(); $i++)                                       
                                        <option value="{{ $products_sizes[$i]->size_id }}">{{ $products_sizes[$i]->size->_name }}
                                        </option>
                                    @endfor
                                </select>
                                @else
                                <select class="list" id="size_input">
                                        <option value="">No Size Available </option>
                                </select>
                                @endif
                            <!-- </div> -->
                        </div><br>
                        <div class="color d-md-flex clearfix" id="quantity">
                            <label for="quantity">Quantity :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark btn-sm" id="minus-btn">
                                        <img src="{{ asset('/icon/ico-min.svg') }}" class="ico_minus">
                                    </button>
                                </div>
                                <input type="text" id="qty_input" name="quantity" value="1" min="1">
                                <input type="hidden" id="price_per_item" name="price_per_item" value="{{ $product->_price }}" min="1">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark btn-sm" id="plus-btn">
                                        <img src="{{ asset('/icon/ico-plus.svg') }}" class="ico_plus">
                                    </button>
                                </div>
                            </div>
                            <label for="price">Total :</label>
                            <div class="price" name="price">
                                <div class="row">
                                    <div>
                                        Rp. 
                                    </div>
                                    <div>
                                        <span name="price_total" id="price_total">{{ number_format($product->_price, 2) }}</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($products_sizes->count() > 0)
                        <button class="pro-cart" onclick="addToCart({{ $product->id }})">add to cart</button>
                        @endif
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
                                                {!! $product->_desc_product !!}
                                            </div>
                                            <div id="delivery" class="tab-pane fade">
                                                {!! $product->_desc_delivery !!}
                                            </div>
                                            <div id="size" class="tab-pane fade">
                                                {!! $product->_desc_size !!}
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
                                            @foreach($related_products as $related_product)
                                            <div class="col-md-3">
                                                <div class="single-elomous-product">
                                                    <div class="pro-img">
                                                        <a href="/shop/detail/{{$related_product->_slug}}">
                                                            <img class="primary-img" src="{{ $cmsUrl . $related_product->_image_url }}"
                                                                alt="{{ $related_product->_slug }}">
                                                        </a>
                                                    </div>
                                                    <div class="pro-content">
                                                        <div class="pro-info">
                                                            <h4><a href="/shop/detail/{{$related_product->_slug}}">{{ $related_product->_name }}</a></h4>
                                                            <p><span class="price">Rp. {{ number_format($related_product->_price, 2) }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
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