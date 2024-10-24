<div class="selected-wrapper wishlist-page">
    <h2 style="text-align:center">Selected <span>Items</span></h2>
    <div style="min-height:200px; width:100%; border-bottom:2px solid rgba(0,0,0,0.3);margin-bottom:15px; margin-top: 20px; display: flex;gap: 10px; padding: 0px 10px 20px 10px;align-items: center; flex-wrap: wrap;justify-content: center; ">
        @if(!empty($productt))

        <!---------------- before line selected product --------------->
        @if($productt->getColorImages)
        @foreach($productt->getColorImages as $pcolor)
        @if (isset($colorIds) && in_array($pcolor->color_id, $colorIds))






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

            <div class="accorBoxRight color_{{ $pcolor->color_id }}">
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
                            $quantity = 1;

                            if(isset($products[$productt->id . $size_n->size_name . $color->color_name])){
                            $quantity = $products[$productt->id. $size_n->size_name. $color->color_name]['qty'];
                            }
                            @endphp

                            <input type="number" min="1" max="100" maxlength="3" data-id="{{ $color->id }}" data-color-id="{{ $color->color_name }}" data-size-id="{{ $size_n->size_name }}" class="quantity-input color-quantity" name="quantity[{{$pcolor->color_id}}][{{$size_n->id}}][]" value="{{ $quantity }}" style="pointer-events: auto;">
                            <button type="button" class="counter-btn plus-btn">+</button>
                        </div>
                    </div>

                    @endforeach


                </div>
            </div>
        </div>
        @endif


        @endforeach
        @endif



    </div>
</div>
<!---------- after line non selected product------------->











@if($productt->getColorImages)

<div class="unselected-wrapper wishlist-page">
    <h2 style="text-align:center">All <span>Items</span></h2>
    <div style="min-height:5px; padding:5px; display:flex; justify-content:center; width:100%;margin-bottom:30px;">
        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-input">
            <button class="search-btn">
                <img src="{{ asset('assets/front/images/searchBtn.png') }}" alt="Search" class="search-icon">
            </button>
        </div>
    </div>
    <div style="min-height:5px; padding:5px; display:flex; justify-content:center; width:100%;margin-bottom:30px;">
        @foreach($productt->getColorImages as $pcolor)
        @if(isset($colorIds) && !in_array($pcolor->color_id, $colorIds))




        <div class="accorBox" style="margin: 5px;">


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
                            @endphp

                            <input type="number" min="1" max="100" maxlength="3" data-id="{{ $color->id }}" data-color-id="{{ $color->color_name }}" data-size-id="{{ $size_n->size_name }}" class="quantity-input color-quantity" name="quantity[{{$pcolor->color_id}}][{{$size_n->id}}][]" value="{{ $quantity }}" style="pointer-events: auto;">
                            <button type="button" class="counter-btn plus-btn">+</button>
                        </div>
                    </div>

                    @endforeach


                </div>
            </div>
        </div>
        @endif

        @endforeach
    </div>
        @endif
        @else
        <div class="no-products">No products found</div>
        @endif
    </div>
</div>