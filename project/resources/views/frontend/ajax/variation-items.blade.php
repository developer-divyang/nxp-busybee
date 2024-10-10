@if(!empty($productt))
<!---------------- before line selected product --------------->
@if($productt->getColorImages)
@foreach($productt->getColorImages as $pcolor)






<div class="accorBox">

    <div class="accorBoxLeft">
        <div class="swiper hatQuantitySlider">
            <div class="swiper-wrapper">

                @php
                $colorImages = json_decode($pcolor->image_path);
                @endphp
                @foreach($colorImages as $colorImage)
                <div class="swiper-slide"><img src="{{ Storage::url($colorImage) }}" alt=""></div>
                @endforeach

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="accorBoxRight ">
        @php
        $color = App\Models\Color::find($pcolor->color_id);
        @endphp
        <input type="hidden" name="color_id[]" value="{{ $color->id }}">
        <h4 style="font-size:22px; font-weight:400!important;">{{ $color->color_name }}</h4>
        <div class="sizeBox">

            @php
            $size = App\Models\ProductSizeColor::where('product_id', $productt->id)->where('color_id', $pcolor->color_id)->get();
            @endphp

            @foreach($size as $size)
            @php
            $size_n = App\Models\Size::find($size->size_id);
            @endphp
            <div style="margin-top:10px; display:flex; flex-direction:column; flex:1; width:50%;min-width:45px">

                <input type="hidden" name="size_id[{{$pcolor->color_id}}][]" value="{{ $size_n->id }}">
                <p style="padding:8px; border:1.5px solid rgba(0,0,0,0.3); border-radius:10px; text-align:center;height:44px;font-size:14px;"> {{ $size_n->size_name }}</p>
                <div class="counter">
                    <button type="button" class="counter-btn minus-btn">−</button>

                    @php
                    $quantity = 0;

                    if(isset($products[$productt->id . $size_n->size_name . $color->color_name])){
                    $quantity = $products[$productt->id. $size_n->size_name. $color->color_name]['qty'];
                    }
                    @endphp

                    <input type="text" data-color-id="{{ $color->color_name }}" data-size-id="{{ $size_n->size_name }}" class="quantity-input color-quantity" name="quantity[{{$pcolor->color_id}}][{{$size_n->id}}][]" value="{{ $quantity }}" readonly>
                    <button type="button" class="counter-btn plus-btn">+</button>
                </div>
            </div>

            @endforeach


        </div>
    </div>
</div>

@endforeach
@endif


<!---------- after line non selected product------------->

<div style="min-height:5px; padding:5px; display:flex; justify-content:center; width:100%;margin-bottom:30px;">
    <div class="search-container">
        <input type="text" placeholder="Search..." class="search-input">
        <button class="search-btn">
            <img src="{{ asset('assets/front/images/searchBtn.png') }}" alt="Search" class="search-icon">
        </button>
    </div>
</div>










@if($productt->getColorImages)
@foreach($productt->getColorImages as $pcolor)






<div class="accorBox">

    <div class="accorBoxLeft">
        <div class="swiper hatQuantitySlider">
            <div class="swiper-wrapper">

                @php
                $colorImages = json_decode($pcolor->image_path);
                @endphp
                @foreach($colorImages as $colorImage)
                <div class="swiper-slide"><img src="{{ Storage::url($colorImage) }}" alt=""></div>
                @endforeach

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="accorBoxRight ">
        @php
        $color = App\Models\Color::find($pcolor->color_id);
        @endphp
        <input type="hidden" name="color_id[]" value="{{ $color->id }}">
        <h4 style="font-size:22px; font-weight:400!important;">{{ $color->color_name }}</h4>
        <div class="sizeBox">

            @php
            $size = App\Models\ProductSizeColor::where('product_id', $productt->id)->where('color_id', $pcolor->color_id)->get();
            @endphp

            @foreach($size as $size)
            @php
            $size_n = App\Models\Size::find($size->size_id);
            @endphp
            <div style="margin-top:10px; display:flex; flex-direction:column; flex:1; width:50%;min-width:45px">

                <input type="hidden" name="size_id[{{$pcolor->color_id}}][]" value="{{ $size_n->id }}">
                <p style="padding:8px; border:1.5px solid rgba(0,0,0,0.3); border-radius:10px; text-align:center;height:44px;font-size:14px;"> {{ $size_n->size_name }}</p>
                <div class="counter">
                    <button type="button" class="counter-btn minus-btn">−</button>

                    @php
                    $quantity = 0;

                    if(isset($products[$productt->id . $size_n->size_name . $color->color_name])){
                    $quantity = $products[$productt->id. $size_n->size_name. $color->color_name]['qty'];
                    }
                    @endphp

                    <input type="text" data-color-id="{{ $color->color_name }}" data-size-id="{{ $size_n->size_name }}" class="quantity-input color-quantity" name="quantity[{{$pcolor->color_id}}][{{$size_n->id}}][]" value="{{ $quantity }}" readonly>
                    <button type="button" class="counter-btn plus-btn">+</button>
                </div>
            </div>

            @endforeach


        </div>
    </div>
</div>

@endforeach
@endif
@else
<div class="no-products">No products found</div>
@endif