@extends('layouts.app')

@section('title', "- " . $category->_meta_title)
@section('description', $category->_meta_desc)
@section('content')
<div class="service-area ptb-80" id="shop">
            <div class="container">
                <div class="box" action="index.html" method="post">
                    @if(isset($category_parent))
                        <p class="sp-title">{{ $category_parent->_name }}</p>
                        <p class="sp-caption">{{ $category->_name }}</p>
                        @else
                        <p class="sp-title">{{ $category->_name }}</p>
                        @endif
                    <div class="row">
                        <!-- Sidebar Shopping Option Start -->
                        <div class="col-lg-3 order-2 order-lg-1 mt-all-30">
                            <!-- Product Size Start -->
                            <div class="size mb-30" id="size">
                                <h3 class="sidebar-title">SIZE</h3>
                                <ul class="size-list sidbar-style">
                                    <form action="/shop/index/{{ $category->_slug }}" method="get">
                                    @php 
                                        $input = Input::get();
                                    @endphp
                                    
                                    @if($input != null)
                                        @foreach($input as $key => $val)
                                            @if($key != 'sizeIndex')                                        
                                                @if($key == 'priceFrom' || $key == 'priceTo' || $key == 'page')
                                                    <input type="hidden" name="{{ $key }}" value="{{ $val }}" /> 
                                                @else
                                                    @foreach($val as $value)
                                                    <input type="hidden" name="{{ $key }}[]" value="{{ $value }}" />
                                                    @endforeach
                                                @endif                                        
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach ($sizes as $size)
                                        <li class="form-check">
                                            <div class="row">
                                                <input class="form-check-input" value="{{ $size->id }}" id="small{{ $i }}" type="checkbox" name="sizeIndex[]" onchange="this.form.submit();" 
                                                @if(isset($sizes_selected))
                                                @foreach($sizes_selected as $ss)
                                                    @if($ss == $size->id)
                                                    checked="true"
                                                    @endif
                                                @endforeach
                                                @endif
                                                >
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-6">
                                                    <label class="form-check-label" for="small{{ $i }}">{{ $size->_name }}</label>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    </form>
                                </ul>
                            </div>
                            <div class="size mb-30" id="price">
                                <h3 class="sidebar-title">PRICE</h3>
                                <ul class="size-list sidbar-style">
                                    <li class="form-check">
                                        <div class="row">
                                            <form class="price" action="/shop/index/{{ $category->_slug }}" method="get">
                                                @php 
                                                    $input = Input::get();
                                                @endphp
                                                
                                                @if($input != null)
                                                    @foreach($input as $key => $val)
                                                            @if($key != 'priceFrom' && $key != 'priceTo' && $key != 'page')
                                                                @foreach($val as $value)
                                                                <input type="hidden" name="{{ $key }}[]" value="{{ $value }}" />
                                                                @endforeach
                                                            @else
                                                                <input type="hidden" name="{{ $key }}[]" value="{{ $val }}" />
                                                            @endif                                        
                                                    @endforeach
                                                @endif
                                                <div class="form-group row">
                                                    <!-- <div class="col-lg-3"> -->
                                                        <label for="from" class="col-lg-3 col-md-3 col-sm-3 col-form-label">From</label>
                                                    <!-- </div> -->
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <input class="form-control" type="number" name="priceFrom" value="{{ isset($priceFrom) ? $priceFrom : '' }}">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <!-- <div class="col-lg-3"> -->
                                                        <label for="to" class="col-lg-3 col-md-3 col-sm-3 col-form-label">To</label>
                                                    <!-- </div> -->
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <input class="form-control" type="number" name="priceTo" value="{{ isset($priceTo) ? $priceTo : '' }}">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 form-btn">
                                                            <input class="btn btn-info btn-lg" type="submit" value="Apply">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="size mb-30">
                                <h3 class="sidebar-title">GENDER</h3>
                                <form action="/shop/index/{{ $category->_slug }}" method="get">
                                <ul class="size-list sidbar-style">
                                    @php 
                                        $input = Input::get();
                                    @endphp
                                    
                                    @if($input != null)
                                        @foreach($input as $key => $val)
                                            @if($key != 'genderIndex')                                        
                                                @if($key == 'priceFrom' || $key == 'priceTo' || $key == 'page')
                                                    <input type="hidden" name="{{ $key }}" value="{{ $val }}" /> 
                                                @else
                                                    @foreach($val as $value)
                                                    <input type="hidden" name="{{ $key }}[]" value="{{ $value }}" />
                                                    @endforeach
                                                @endif                                        
                                            @endif
                                        @endforeach
                                    @endif

                                    @php
                                        $i = 0
                                    @endphp                                
                                    @foreach($genders as $gender)
                                    <li class="form-check">
                                        <div class="row">
                                            <input class="form-check-input" value="{{ $gender->id }}" id="genderIndex{{ $i }}" type="checkbox" name="genderIndex[]" onchange="this.form.submit();"
                                            @if(isset($genders_selected))
                                            @foreach($genders_selected as $gs)
                                                @if($gs == $gender->id)
                                                checked="true"
                                                @endif
                                            @endforeach
                                            @endif
                                            >
                                            <div class="col-lg-12">
                                                <label class="form-check-label" for="genderIndex{{ $i }}">{{ $gender->_name }}</label>
                                            </div>
                                        </div>
                                    </li>
                                    @php
                                        $i++;
                                    @endphp                                    
                                    @endforeach
                                </ul>
                                </form>
                            </div>
                            <div class="size mb-30" id="tag">
                                <h3 class="sidebar-title">TAG</h3>
                                <!-- <ul class="instagram-img"> -->
                                    @foreach($tags as $tag)
                                        <a href="/shop/indexByTag/{{ $tag->id }}+{{ $tag->name }}">#{{ $tag->name }}</a> &nbsp&nbsp
                                    @endforeach
<!--                                 </ul> -->
                            </div>
                            <!-- Product Size End -->
                        </div>
                        <div class="col-lg-9 order-2 order-lg-1 mt-all-30" id="sort">
                            <div class="grid-list-top universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                                <div class="grid-list-view d-flex align-items-center  mb-sm-15">
                            
                                    <div class="toolbar-sorter d-md-flex align-items-center">
                                        <div class="d-block d-sm-none" style="color: white; margin-bottom: 10px;">Sort By:</div>
                                        <label class="d-none d-sm-block">Sort By:</label>
                                        <div class="nice-select sorter wide" tabindex="0">
                                            <span class="current">Position</span>
                                            <ul class="list">
                                                <li data-value="Position" class="option">Position</li>
                                                <li data-value="Product Name" class="option">Neme, A to Z</li>
                                                <li data-value="Product Name" class="option">Neme, Z to A</li>
                                                <li data-value="Price" class="option">Price low to heigh</li>
                                                <li data-value="Price" class="option">Price heigh to low</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Single Service Area Start Here -->
                                @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 mb-all-40">
                                        <div class="single-elomous-product">
                                            <div class="pro-img">
                                                <a href="{{ url('/') }}/shop/detail/{{$product->_slug}}">
                                                    <img class="primary-img" src="{{ $cmsUrl . $product->_image_url }}" alt="single-product">
                                                </a>
                                            </div>
                                            <div class="pro-content">
                                                <div class="pro-info">
                                                    <h4><a href="{{ url('/') }}/shop/detail/{{$product->_slug}}">{{ $product->_name }}</a></h4>
                                                    <p><span class="special-price">Rp. {{ number_format($product->_price, 0, '.', '.') }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if (count($products) == 0)
                                    <div>
                                        <h1 class="text-white text-capitalize">Oops, Result is empty...</h1>
                                    </div>
                                @endif
                            </div>
                            @include('layouts.pagination.default', ['paginator' => $products->appends(Input::except('page'))])
                        </div>
                        <!--END COLUMN -->
                    </div>
                </div>
            </div>
        </div>

@endsection