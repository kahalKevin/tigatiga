@extends('layouts.app')

@section('content')

    <!-- Slider Area Start -->
    <div class="slider-area" id="slide-homepage">
      <!-- Slider Area Start Here -->
      <div class="slider-activation owl-carousel">
        <!-- Start Single Slide -->
        @foreach($home_banners as $banner)
          <a href="{{ $banner->_href_url }}">
            <div class="slide align-center-left fullscreen animation-style-01">
              <img src="{{ $cmsUrl . $banner->_image_url }}" alt="">
            </div>
          </a>
        @endforeach
      </div>
      <!-- Slider Area End Here -->
    </div>
    <!-- Slider Area End -->
    <!-- Service Area Start Here -->
    <div class="service-area ptb-80" id="get-the-latest">
      <div class="container">
        <!-- Section Title Start Here -->
        <div class="section-title">
          <h1> Get The Latest </h1>
          <p>Discover the latest of our must-have items.</p>
        </div>
        <!-- Section Title End Here -->
        <br>
        <div class="row justify-content-center">  
        @foreach($latest_products as $pr)
          <div class="col-lg-3 mb-all-40">
            <div class="single-elomous-product">
              <!-- Product Image Start -->
              <div class="pro-img">
                <a href="{{ url('/') }}/shop/detail/{{ $pr->_slug }}">
                  <img class="primary-img" src="{{$cmsUrl . $pr->_image_url }}" alt="single-product">
                </a>
              </div>
              <!-- Product Image End -->
              <!-- Product Content Start -->
              <div class="pro-content">
                <div class="pro-info">
                  <h4><a href="{{ url('/') }}/shop/detail/{{ $pr->_slug }}">{{ $pr->_name }}</a></h4>
                  <p><span class="special-price">Rp. {{ number_format($pr->_price,0, '.', '.') }}</span></p>
                </div>
              </div>
              <!-- Product Content End -->
            </div>
          </div>
        @endforeach
        </div>
        <!-- Big drone Image Area Start -->
        @if(!empty($inventory_ads->_href_url))
        <div class="dron-img opacity-img mt-80">
          <a href="{{ $inventory_ads->_href_url }}">
            <img class="mx-auto d-block img" src="{{ $cmsUrl . $inventory_ads->_image_url }}" alt="ads-example" width="728">
          </a>
        </div>
        @endif
        <!-- Big drone Image Area End -->
      </div>
    </div>
    <!-- Service Area End  Here -->
    <!-- BEST PRODUCT Start Here -->
    <div class="service-area" id="best-product">
      <div class="container">
        <!-- Section Title Start Here -->
        <div class="section-title">
          <h1> Best Product </h1>
          <p>Discover the best in best you must have.</p>
        </div>
        <!-- Section Title End Here -->
        <br>
        <div class="row justify-content-center">
        @foreach($best_products as $pr)
          <!-- Single Service Area Start Here -->
          <div class="col-lg-3  mb-all-40">
            <div class="single-elomous-product">
              <!-- Product Image Start -->
              <div class="pro-img">
                <a href="{{ url('/') }}/shop/detail/{{ $pr->_slug }}">
                  <img class="primary-img" src="{{$cmsUrl . $pr->_image_url }}" alt="single-product">
                </a>
              </div>
              <!-- Product Image End -->
              <!-- Product Content Start -->
              <div class="pro-content">
                <div class="pro-info">
                  <h4><a href="{{ url('/') }}/shop/detail/{{ $pr->_slug }}">{{ $pr->_name }}</a></h4>
                  <p><span class="special-price">Rp. {{ number_format($pr->_price, 0, '.', '.') }}</span></p>
                  <!-- <del class="old-price">$80.50</del> -->
                </div>
              </div>
              <!-- Product Content End -->
              <!-- <span class="sticker-sale">-5%</span> -->
            </div>
          </div>
          <!-- Single Service Area End Here -->
        @endforeach
          <!-- Single Service Area End Here -->
        </div>
        <br>
        <div class="newsletter-area ptb-80">
          <div class="container">
            <!-- Section Title Start Here -->
            <!-- Section Title End Here -->
            <div class="newsletter-box text-center">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-3 col-xs-12 d-none d-sm-block">
                  <!-- <img class="email-submit-image" src="./icon/email-submit.svg" alt="email-submit"> -->
                  <span class="email-submit-caption-left">NEWS<br>LETTER</span>
                  <!-- <span class="email-submit-caption-left-background"></span> -->
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                  <div class="email-submit-caption">
                    Get early access to the latest news,<br>
                    Products and offers.
                </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-5">
                  <form action="{{ url('subscribe') }}" method="POST">
                    @csrf
                    <input class="subscribe" placeholder="Email" name="email" id="subscribe" type="text">
                    <button type="submit" class="submit">SUBMIT</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Section Title Start Here -->
        <div class="section-title">
          <h1> Brand </h1>
          <p>Choose your brand.</p>
        </div>
        <!-- Section Title End Here -->
        <div class="partner-icons">
          <img src="{{ url('/') }}/icon/adidas-logo.png" width="200">
          <img src="{{ url('/') }}/icon/lotto-logo.png" width="200">
          <img src="{{ url('/') }}/icon/mizuno-logo.png" width="200">
          <img src="{{ url('/') }}/icon/nike-logo.png" width="200">
          <img src="{{ url('/') }}/icon/piero-logo.png" width="200">
          <img src="{{ url('/') }}/icon/puma-logo.png" width="200">
          <img src="{{ url('/') }}/icon/specs-logo.png" width="200">
          <img src="{{ url('/') }}/icon/umbro-logo.png" width="200">
        </div>
      </div>
    </div>

@endsection
