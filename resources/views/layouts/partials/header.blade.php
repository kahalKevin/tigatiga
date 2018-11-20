<header class="absolute-header header-area padding-area header-sticky nav-box">
   <div class="container">
      <div class="row align-items-center" style="height: 66px;">
         <!-- Logo Start -->
         <div class="col-xl-2 col-lg-2 col-6">
            <div class="logo">
               <a href="{{ url('/') }}">
               <img src="{{ asset('/icon/logo.svg') }}" alt="logo-image">
               </a>
            </div>
         </div>
         <!-- Logo End -->
         <!-- Menu Area Start Here -->
         <div class="col-xl-8 col-lg-8 d-none d-lg-block">
            <nav class="navbar navbar-expand-lg">
                {!! cache('navigation') !!}
            </nav>
         </div>
         <!-- Menu Area End Here -->
         <!-- Cart Box Start Here -->
         <div class="col-xl-2 col-lg-2 col-6">
            <div class="cart-box">
               <ul>
                @if (Auth::check()) 
                  <span class="register d-none d-sm-block">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-edit-profile">Hi, {{ Auth::user()->_first_name }}</button>
                  </span>
                  <span class="register d-none d-sm-block"> / </span>
                  <form action="{{ url('logout') }}" method="get">
                  @csrf
                  <span class="register d-none d-sm-block">                
                        <button type="submit" class="btn btn-info btn-lg">Logout</button>                
                  </span>      
                  </form>     
                @else 
                  <span class="register d-none d-sm-block">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-login">Login</button>
                  </span>
                  <span class="register d-none d-sm-block"> / </span>
                  <span class="register d-none d-sm-block">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-register">Register</button>
                  </span>            
                @endif
                  <!-- Search Box Start Here -->
                  <li class="drodown-show">
                     <a href="#"><span class="icon icon-Search"></span></a>
                     <div class="dropdown categorie-search-box">
                        <form action="#">
                           <div class="container">
                              <div class=row>
                                 <div class="col-md-2">
                                    <div id="search-item-title" class="title-search title-active">
                                       Search
                                    </div>
                                    <div id="track-order-title" class="title-search">
                                       Track My Order
                                    </div>
                                 </div>
                                 <div class="col-md-10">
                                    <input id="search-item" type="text" name="search" placeholder="I want to shop">
                                    <input id="track-order" type="text" name="search" placeholder="Track My order">
                                    <button>
                                    <span class="icon icon-Search"></span>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </li>
                  <!-- Categorie Search Box End Here -->
                  <li class="drodown-show">
                     <a href="#"><span class="icon icon-FullShoppingCart"></span>
                     <span class="total-pro">
                        @if(Session::has('user_cart_list-'. Session::get('user_cart')))
                          {{ Session::get('user_cart_list-'. Session::get('user_cart'))[0]->count() }}
                        @else
                          0
                        @endif
                     </span>
                     </a>
                     <ul class="dropdown cart-box-width">
                        <li>
                          @if(Session::has('user_cart_list-'. Session::get('user_cart')))
                            @php
                              $total_price_all_item = 0
                            @endphp

                            @foreach(Session::get('user_cart_list-'. Session::get('user_cart'))[0] as $cart_item)
                              @php
                                $total_price_per_item = $cart_item->_qty * $cart_item->products()->get()[0]->_price
                              @endphp

                              <div class="single-cart-box">
                                <div class="cart-img">
                                   <a href="#">
                                   <img src="{{ env('IMG_URL_PREFIX') . $cart_item->products()->get()[0]->_image_url }}" alt="cart-image">
                                   </a>
                                   <span class="pro-quantity">{{ $cart_item->_qty }}X</span>
                                </div>
                                <div class="cart-content">
                                   <h6>
                                      <a href="product-details.html">{{ $cart_item->products()->get()[0]->_name }} </a>
                                   </h6>
                                   <span class="cart-price">Rp. {{ number_format($total_price_per_item, 2) }}</span>
                                   <span>Size: {{ $cart_item->productStocks()->get()[0]->size()->get()[0]->_name }}</span>
                                </div>
                                <a class="del-icone" href="#">
                                <i class="ion-close"></i>
                                </a>
                             </div>
                              @php
                                $total_price_all_item = $total_price_all_item + $total_price_per_item
                              @endphp
                            @endforeach
                             <!-- Cart Footer Inner Start -->
                             <div class="cart-footer">
                                <ul class="price-content">
                                   <li>Subtotal
                                      <span>{{ $total_price_all_item }}</span>
                                   </li>
                                   <li>Shipping
                                      <span>Rp. {{ number_format(0, 2) }}</span>
                                   </li>
                                   <li>Taxes
                                      <span>Rp. {{ number_format(0, 2) }}</span>
                                   </li>
                                   <li>Total
                                      <span>Rp. {{ number_format($total_price_all_item, 2) }}</span>
                                   </li>
                                </ul>
                                <div class="cart-actions text-center">
                                  <a href="{{ url('/shop/checkout') }}"><span class="icon icon-FullShoppingCart"></span><span class="total-pro">2</span></a>
                                </div>
                             </div>
                          @else
                            <!-- Cart Box Start -->
                           <div class="single-cart-box">
                              <div class="cart-img">
                                 <a href="#">
                                 <img src="img/products/p1.jpg" alt="cart-image">
                                 </a>
                                 <span class="pro-quantity">1X</span>
                              </div>
                              <div class="cart-content">
                                 <h6>
                                    <a href="product-details.html">Printed Summer Red </a>
                                 </h6>
                                 <span class="cart-price">27.45</span>
                                 <span>Size: S</span>
                                 <span>Color: Yellow</span>
                              </div>
                              <a class="del-icone" href="#">
                              <i class="ion-close"></i>
                              </a>
                           </div>
                           <!-- Cart Box End -->
                           <!-- Cart Box Start -->
                           <div class="single-cart-box">
                              <div class="cart-img">
                                 <a href="#">
                                 <img src="img/products/p2.jpg" alt="cart-image">
                                 </a>
                                 <span class="pro-quantity">1X</span>
                              </div>
                              <div class="cart-content">
                                 <h6>
                                    <a href="product-details.html">Printed Round Neck</a>
                                 </h6>
                                 <span class="cart-price">45.00</span>
                                 <span>Size: XL</span>
                                 <span>Color: Green</span>
                              </div>
                              <a class="del-icone" href="#">
                              <i class="ion-close"></i>
                              </a>
                           </div>
                           <!-- Cart Box End -->
                           <!-- Cart Footer Inner Start -->
                           <div class="cart-footer">
                              <ul class="price-content">
                                 <li>Subtotal
                                    <span>$57.95</span>
                                 </li>
                                 <li>Shipping
                                    <span>$7.00</span>
                                 </li>
                                 <li>Taxes
                                    <span>$0.00</span>
                                 </li>
                                 <li>Total
                                    <span>$64.95</span>
                                 </li>
                              </ul>
                              <div class="cart-actions text-center">
                                 <a class="cart-checkout" href="checkout.html">Checkout</a>
                              </div>
                           </div>
                          @endif                           
                           <!-- Cart Footer Inner End -->
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
         <!-- Cart Box End Here -->
      </div>
      <!-- Row End -->
      <!-- Mobile Menu Start Here -->
      <div class="mobile-menu d-block d-lg-none">
         <nav>
            <ul>
               <li>
                  <a data-toggle="modal" data-target="#modal-login">Login</a>
               </li>
               <li>
                  <a data-toggle="modal" data-target="#modal-register">Register</a>
               </li>
               <li>
                   <a href="#">Brand</a>
                   <ul>
                       <li><a href="#">Nike</a></li>
                       <li><a href="#">Adidas</a></li>
                       <li><a href="#">Specs</a></li>
                       <li><a href="#">Mitre</a></li>
                       <li><a href="#">Umbro</a></li>
                   </ul>
               </li>
               <li>
                   <a href="#">Categories</a>
                   <ul>
                       <li><a href="#">Apparel</a></li>
                       <li><a href="#">Footwear</a></li>
                       <li><a href="#">Categories</a></li>
                   </ul>
               </li>
               <li>
                   <a href="#">Liga Indonesia</a>
                   <ul>
                       <li><a href="#">Persija</a></li>
                       <li><a href="#">Persib</a></li>
                       <li><a href="#">Persipura</a></li>
                       <li><a href="#">PSM</a></li>
                   </ul>
               </li>
               <li>
                   <a href="#">Liga Internasional</a>
                   <ul>
                       <li>
                            <a href="#">English Premier League</a>
                            <ul>
                               <li><a href="#">Liverpool</a></li>
                               <li><a href="#">MU</a></li>
                            </ul>
                       </li>
                       <li>
                            <a href="#">Serie A</a>
                            <ul>
                               <li><a href="#">Liverpool</a></li>
                               <li><a href="#">MU</a></li>
                            </ul>
                       </li>
                       <li>
                            <a href="#">La Liga Spanyol</a>
                            <ul>
                               <li><a href="#">Real Madrid</a></li>
                            </ul>
                       </li>
                   </ul>
               </li>
               <li>
                   <a href="#">Tim Nasional</a>
                   <ul>
                       <li><a href="#">England</a></li>
                       <li><a href="#">Germany</a></li>
                       <li><a href="#">Indonesia</a></li>
                       <li><a href="#">Spanyol</a></li>
                   </ul>
               </li>
            </ul>
         </nav>
      </div>
      <!-- Mobile Menu End Here -->
   </div>
   <!-- Container End -->
</header>