<img class="small" src="{{ asset('assets/front/images/Logo.png') }}" alt="">
<div class="center-nav">
   <ul>
      <a href="{{ route('front.index') }}">
         <li class="" data-page="home">Home</li>
      </a>
      <a href="{{ route('front.category') }}">
         <li class="" data-page="product">Product</li>
      </a>
      
      <a href="">
         <li class="" data-page="about">About us</li>
      </a>
   </ul>
   <img src="{{ asset('assets/front/images/Logo.png') }}" alt="">
   <ul>
      <a href="">
         <li class="" data-page="reviews">Reviews</li>
      </a>
      
      <a href="">
         <li class="" data-page="faqs">FAQ's</li>
      </a>
      <a href="">
         <li class="" data-page="contact">Contact Us</li>
      </a>
   </ul>
</div>
<div
   id="toggle"
   style="display: flex; justify-content: space-between; gap: 40px">
   <div class="nav-end">
      @if(Auth::check())
      <a href="{{ route('user-wishlists') }}" style="position: relative;">
         <span style="position:absolute; display:flex; align-items:center; justify-content:center; color:white; font-size:12px; height:18px;width:18px; border-radius: 50%; background-color:red;top:-10px;right:-10px;z-index:99" id="wishlist-count">{{ Auth::user()->wishlistCount() }}</span>
         <img src="{{ asset('assets/front/images/heart.png') }}" alt="" /></a>
      <a href="{{ route('user-dashboard') }}"><img src="{{ asset('assets/front/images/user.png') }}" alt="" /></a>
      @else
      <a href="{{ route('user.login') }}"><img src="{{ asset('assets/front/images/user.png') }}" alt="" /></a>
      @endif
      <a href="{{ route('front.cartview') }}" style="position: relative;">
         <span style="position:absolute; display:flex; align-items:center; justify-content:center; color:white; font-size:12px; height:18px;width:18px; border-radius: 50%; background-color:red;top:-10px;right:-10px;z-index:99" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
         <img src="{{ asset('assets/front/images/shopping-cart.png') }}" alt="" /></a>
   </div>
   <img src="{{ asset('assets/front/images/ham.png') }}" alt="" class="ham">
</div>


<!--<div id="toggle" style="display: flex; justify-content: space-between; gap: 40px;">-->
<!--   <div class="nav-end">-->
<!--      <img src="{{ asset('assets/front/images/heart.png') }}" alt="">-->
<!--      <img src="{{ asset('assets/front/images/user.png') }}" alt="">-->
<!--      <img src="{{ asset('assets/front/images/shopping-cart.png') }}" alt="">-->
<!--   </div>-->
<!--   <img src="{{ asset('assets/front/images/ham.png') }}" alt="" class="ham">-->
<!--</div>-->


<!-- <div class="top-header font-400 d-none d-lg-block py-1 text-general">
    <div class="container">
       <div class="row align-items-center">
          <div class="col-lg-4 sm-mx-none">
             <div class="d-flex align-items-center text-general">
                <i class="flaticon-phone-call flat-mini me-2 text-general"></i>
                <span class="text-dark"> {{ $ps->phone }}</span>
             </div>
          </div>
          <div class="col-lg-8 ">
             <ul class="top-links text-general ms-auto  d-flex justify-content-end">
                <li class="my-account-dropdown">
                   <div class="language-selector nice-select">
                      <i class="fas fa-globe-americas text-dark"></i>
                      <select name="language" class="language selectors nice">
                      @foreach(DB::table('languages')->get() as $language)
                      <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >
                      {{$language->language}}
                      </option>
                      @endforeach
                      </select>
                   </div>
                </li>
                <li class="my-account-dropdown">
                   <div class="currency-selector nice-select">
                      <span class="text-dark">{{ Session::has('currency') ? DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
                      <select name="currency" class="currency selectors nice">
                      @foreach(DB::table('currencies')->get() as $currency)
                      <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                      {{$currency->name}}
                      </option>
                      @endforeach
                      </select>
                   </div>
                </li>
                @if($gs->reg_vendor == 1)
                <div class=" align-items-center text-general sell">
                   @if(Auth::check())
                   @if(Auth::guard('web')->user()->is_vendor == 2)
                   <a href="{{ route('vendor.dashboard') }}" class="sell-btn "> {{ __('Sell') }}</a>
                   @else
                   <a href="{{ route('user-package') }}" class="sell-btn "> {{ __('Sell') }}</a>
                   @endif
                </div>
                @else
                <div class=" align-items-center text-general">
                   <a href="{{ route('vendor.login') }}" class="sell-btn "> {{ __('Sell') }}</a>
                </div>
                @endif
                @endif
             </ul>
          </div>
       </div>
    </div>
 </div> -->