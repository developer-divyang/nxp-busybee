@if(!empty($prods))
@foreach($prods as $product)
<div class="prodBox">

    @if(Auth::check())
    @if($product->wishlist->count() > 0)
    <a class="wishlist-remove" href="javascript:;" data-href="{{ route('user-wishlist-remove',$product->id) }}">
        <img class="wishlistImg remove" src="{{ asset('assets/front/images/heart-red.png') }}" alt="wishlist Image">
    </a>
    @else
    <a class="new" href="javascript:;" data-href="{{ route('user-wishlist-add',$product->id) }}">
        <img class="wishlistImg new" src="{{ asset('assets/front/images/wishlist.png') }}" alt="wishlist Image">
    </a>
    @endif
    @else
    <a href="{{ route('user.login') }}"><img class="wishlistImg" src="{{ asset('assets/front/images/wishlist.png') }}" alt="wishlist Image"></a>
    @endif
    <div class="prod-image">
        <div class="swiper prodImageSlider">
            @if($product->getColorImages)


            @php
            $productColorImages = $product->getColorImages->first()->image_path;
            $images = json_decode($productColorImages);
            @endphp

            <div class="swiper-wrapper img_slide_{{ $product->id }}">
                @foreach($images as $productColorImage)
                <div class="swiper-slide"><img src="{{ Storage::url($productColorImage) }}" alt="Product Image"></div>
                @endforeach

            </div>

            @endif
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <div class="prod-content">
        <a href="{{ route('front.product', $product->slug) }}">
            <p>{{ $product->showName() }}</p>
            <div class="price">
                <h5 id="offerPrice">{{ $product->setCurrency($product->min_price) }} -</h5>
                <h5 id="oldPrice">{{ $product->setCurrency($product->max_price) }}</h5>
            </div>
        </a>
        @if($product->getColorImages)

        <div class="color-choice">
            @foreach($product->getColorImages as $pcolor)
            @php
            $color = App\Models\Color::find($pcolor->color_id);
            @endphp
            <div data-id="{{ $color->id }}" data-product="{{ $product->id }}" class="color select_color">
                <img src="{{ Storage::url($color->color_image) }}" class="img-fluid image-circle" alt="">
            </div>
            @endforeach
        </div>
        @endif

    </div>


</div>
@endforeach
@else
<div class="no-products">No products found</div>
@endif