@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/wishlist.css') }}">
@endsection
@section('content')

<div class="mainPage wishlist-page">
   <h2 style="text-align:center">My <span>Wishlist</span></h2>
   <div class="wishlistContainer">
      @if(count($wishlists) > 0)
      @foreach($wishlists as $wishlist)
      @php
      $productColorImages = $wishlist->getColorImages->first()->image_path;
      $images = json_decode($productColorImages);
      @endphp
      <div class="box p_{{ $wishlist->id }}">
         <div class="image-box">

            <img src="{{ Storage::url($images[0]) }}" alt="">
         </div>
         <div class="product-info">
            <h4 class="product-name">
               <a href="{{ route('front.product', $wishlist->slug) }}">{{ mb_strlen($wishlist->name,'UTF-8') > 35 ? mb_substr($wishlist->name,0,35,'UTF-8').'...' : $wishlist->name }}</a>
            </h4>
            <div class="price">
               <h5 id="offerPrice">{{ $wishlist->setCurrency($wishlist->min_price) }} -</h5>
               <h5 id="oldPrice">{{ $wishlist->setCurrency($wishlist->max_price) }}</h5>
            </div>

            <a style="text-align: center;text-decoration:none;color:#fff" class="remove wishlist-remove" href="javascript:;" data-id="{{ $wishlist->id }}" data-href="{{ route('user-wishlist-remove',$wishlist->id) }}">Remove Item</a>
         </div>
      </div>
      @endforeach
      @else

      <h4 style="text-align: center;width: 100%;">No Wishlist Found</h4>
      @endif

   </div>

</div>




@endsection