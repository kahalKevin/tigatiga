<header class="absolute-header header-area padding-area header-sticky nav-box">
   <div class="container">
      <div class="row align-items-center" style="height: 66px;">
         <!-- Logo Start -->
         <div class="col-xl-2 col-lg-2 col-6">
            <div class="logo">
               <a href="{{ url('/') }}">
               <img src="{{ asset('/icon/logo-supershop.png') }}" alt="logo-image" height="45">
               </a>
            </div>
         </div>
         <!-- Logo End -->
         <!-- Menu Area Start Here -->
         <div class="col-xl-8 col-lg-8 d-none d-lg-block">
            <nav class="navbar navbar-expand-lg">
                {!! json_decode(cache('navigation'), true)['navigation_desktop'] !!}
            </nav>
         </div>
         <!-- Menu Area End Here -->
         <!-- Cart Box Start Here -->
         <div class="col-xl-2 col-lg-2 col-6">
            <div class="cart-box">
               <ul>
                @if (Auth::check()) 
                  <span class="register username d-none d-sm-block">
                    <a class="btn btn-info btn-lg" href="{{ url('/') }}/profile">Hi, {{ Auth::user()->_first_name }}</a>
                  </span>   
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
                        <form id="form-header-search" action="/shop/index-search" method="get">
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
                                    <input id="search-item" type="text" name="searchItem" placeholder="I want to shop">
                                    <input id="track-order" type="text" disabled="true" name="searchOrder" placeholder="Track My order">
                                    <button type="submit" >
                                    <span class="icon icon-Search"></span>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </li>
                  <!-- Categorie Search Box End Here -->
                  <li class="">
                     <a href="{{ url('/shop/cart') }}"><span class="icon icon-FullShoppingCart"></span>
                     <span class="total-pro">
                        @if(Session::has('user_cart_list-'. Session::get('user_cart')))
                          {{ Session::get('user_cart_list-'. Session::get('user_cart'))[0]->count() }}
                        @else
                          0
                        @endif
                     </span>
                     </a>
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
               @if(Auth::check())
                  <li>
                     <a href="{{ url('/') }}/profile">Hi, {{ Auth::user()->_first_name }}</a>
                  </li>
               @else
                  <li>
                     <a data-toggle="modal" data-target="#modal-login">Login</a>
                  </li>
                  <li>
                     <a data-toggle="modal" data-target="#modal-register">Register</a>
                  </li>
               @endif
               {!! json_decode(cache('navigation'), true)['navigation_mobile'] !!}
            </ul>
         </nav>
      </div>
      <!-- Mobile Menu End Here -->
   </div>
   <!-- Container End -->
</header>