@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/prodDes.css') }}">
@endsection
@section('content')



<div class="des-container">
    <div class="product-des">
        <div class="left">
            @if($productt->getColorImages)

            @php
            $productColorImages = $productt->getColorImages->first()->image_path;
            $images = json_decode($productColorImages);
            @endphp
            <div class="swiper mySwiper">
                <div class="swiper-wrapper img_slide_{{ $productt->id }}">
                    @foreach($images as $productColorImage)
                    <div class="swiper-slide"><img src="{{ Storage::url($productColorImage) }}" alt=""></div>
                    @endforeach

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            @endif

        </div>
        <div class="right">
            <h2> {{ $productt->name }} <br>
                <!-- <span>contra-Stitch Trucker</span> -->
            </h2>
            <div class="des-rating">
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1">&#9733;</label>
                </div>

                <p>customer reviews</p>


            </div>
            @if($productt->getColorImages)


            <div class="color-choice">
                @foreach($productt->getColorImages as $c => $pcolor)
                @php
                $selected_color = ($c == '0')? 'prod_color_active' : '';
                $color = App\Models\Color::find($pcolor->color_id);
                @endphp

                <div data-id="{{ $color->id }}" data-product="{{ $productt->id }}" class="color select_color">
                    <img src="{{ Storage::url($color->color_image) }}" class="img-fluid image-circle {{ $selected_color }}" alt="">
                </div>
                @endforeach


            </div>
            @endif

            <div class="optFilter">

                <!--<div style="display: flex;flex-wrap: wrap; gap:8px;">-->
                    <div style="width: 100%;" >
                        <p style="font-size: 12px; margin-bottom: 4px;">Select Quantity</p>
                    <div class="quantity-container QuanCont">
                        <span class="quantity-label">Quantity</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn minus-btn">−</button>
                            <input type="text" class="quantity-input " name="f3" id="f3" value="1" readonly>
                            <button class="quantity-btn plus-btn">+</button>
                        </div>
                        <input type="hidden" id="d3" name="d3" class="d3" value="{{ ($productt->blank_price)? $productt->blank_price : 0 }}">
                        <input type="hidden" id="e3" name="e3" class="e3" value="{{ ($productt->weight)? $productt->weight : 0 }}">
                    </div>
                    <!-- ----------------------- -->
                    <p style="font-size: 12px; margin-bottom: 4px;">Select Embroidery Type</p>
                    <div class="custom-select">
                        <select id="g3" name="g3" class="g3" onchange="constantCalculation()">
                            <option value="">Select Embroidery Type</option>
                            <option selected value="regular">Regular</option>
                            <option value="3D">3D</option>

                        </select>
                    </div>
                    <p style="font-size: 12px; margin-bottom: 4px;">Select front Embroidery</p>
                    <div class="custom-select">

                        <select id="h3" name="h3" class="h3" onchange="constantCalculation()">
                            <option value="">Select Front Embroidery</option>
                            <option selected value="front-center">Front Center</option>
                            <option value="front-left">Front Left Panel</option>
                            <option value="front-right">Front Right Panel</option>

                        </select>
                    </div>
                </div>
                <!--<div style="display: flex;flex-wrap: wrap; gap:8px">-->
                    <div style="width: 100%;">
                        <p style="font-size: 12px; margin-bottom: 4px;">Select side Embroidery</p>
                    <div class="custom-select">
                        <select id="i3" name="i3" class="i3">
                            <option value="">Select Side Embroidery </option>
                            <option value="yes">Yes</option>
                            <option selected value="no">No</option>
                        </select>
                    </div>
                    <div class="side_location" id="side_location" style="display: none;">
                    <p style="font-size: 12px; margin-bottom: 4px;">Select side Embroidery Type</p>
                        <div class="custom-select ">
                        <select id="j3" name="j3" class="j3" onchange="constantCalculation()">
                            <option value="">Select Side Embroidery Locations </option>
                            <option value="right">Right</option>
                            <option value="left">Left</option>
                            <option value="both">Both</option>
                            <option value="na">NA (No side embroidery)</option>
                        </select>
                    </div>
                    </div>
                    
                    <!-- ----------------------- -->
                    <p style="font-size: 12px; margin-bottom: 4px;">Select back Embroidery</p>
                    <div class="custom-select">
                        <select id="k3" name="k3" class="k3">
                            <option value="">Select Back Embroidery </option>
                            <option value="yes">Yes</option>
                            <option selected value="no">No</option>
                        </select>
                    </div>
                    

                    <!-- ----------------------- -->
                    <div class="back_location" id="back_location" style="display: none;">
                        <p style="font-size: 12px; margin-bottom: 4px;">Select back Embroidery location</p>
                        <div class="custom-select">
                        <select id="l3" name="l3" class="l3" onchange="constantCalculation()">
                            <option class='options' value="">Select Back Embroidery Locations </option>
                            <option class='options' value="center">Center</option>
                            <option class='options' value="left">Left</option>
                            <option class='options' value="right">Right</option>
                            <option class='options' value="na">NA (No back embroidery)</option>
                        </select>
                    </div>
                    </div>
                    
                </div>
                <!--<div style="display: flex;flex-wrap: wrap; gap:8px">-->
                    
                <!--</div>-->
            </div>

            <div class="price" style="display: none;">
                <p>Estimated price<span> (Excluding Shipping) </span></p>
                <h3>$19/ <span>per cap</span></h3>
            </div>

            <div class="buttons">
                <!-- <a class="prodDesBtn" href=""><img src="images/shopping-cart2.png" alt="">ADD TO CART</a> -->
                <a class="prodDesBtn" href="{{ route('customization-step-1',$productt->slug) }}"><img src="{{ asset('assets/front/images/setting2.png') }}" alt="">CUSTOMIZATION</a>
            </div>
        </div>
    </div>
    <div class="tabsSection">
        <div class="tab-container">
            <ul class="tabs">
                <li class="tab active" data-target="description">Description</li>
                <!-- <li class="tab" data-target="specs">Specification</li> -->
                <!-- <li class="tab" data-target="review">Reviews</li> -->
            </ul>
            <div class="tab-content">
                <div id="description" class="content active">
                    <div class="description">

                        <p>{!! $productt->details !!}</p>


                    </div>


                </div>
                <div id="specs" class="content">
                </div>
                <div id="review" class="content">Reviews Section</div>
                <!-- <div id="checkout" class="content">Content for Checkout</div> -->
            </div>
        </div>
    </div>


    <div class="relatedProd">
        <h2>Related <span>Products</span></h2>
        <div class="prodSlider">
            <div class="swiper relatedSwiper">
                <div class="swiper-wrapper">
                    @foreach($related_products as $related_product)
                    <div class="swiper-slide">
                        <div class="prod-image">
                            <a href="#"><img src="{{ asset('assets/front/images/wishlist.png') }}" alt="" /></a>
                            @if($related_product->getColorImages)

                            <div class="prod-image-slider img_slide_{{ $related_product->id }}">
                                @php
                                $productColorImages = $related_product->getColorImages->first()->image_path;
                                $images = json_decode($productColorImages);
                                @endphp
                                @foreach($images as $productColorImage)
                                <div class="prod-image-slide ">
                                    <img src="{{ Storage::url($productColorImage) }}" alt="">
                                </div>
                                @endforeach

                            </div>
                            <div class="prod-image-nav">
                                <div class="prod-image-prev">◀</div>
                                <div class="prod-image-next">▶</div>
                            </div>
                            @endif
                        </div>
                        <div class="prod-content">
                            <a href="{{ route('front.product', $related_product->slug) }}">
                                <p>{{ $related_product->name }}</p>
                            </a>
                            <div class="price">
                                <h5 id="offerPrice">{{ $related_product->setCurrency($related_product->min_price) }} -</h5>
                                <h5 id="oldPrice">{{ $related_product->setCurrency($related_product->max_price) }}</h5>
                            </div>
                            @if($related_product->getColorImages)

                            <div class="color-choice">
                                @foreach($related_product->getColorImages as $p => $pcolor)
                                @php
                                $selected_color = ($p == '0')? 'prod_color_active' : '';

                                $color = App\Models\Color::find($pcolor->color_id);
                                @endphp
                                <div data-id="{{ $color->id }}" data-product="{{ $related_product->id }}" class="color related_select_color">
                                    <img src="{{ Storage::url($color->color_image) }}" class="img-fluid image-circle {{ $selected_color }}" alt="">
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('script')

@php
$const = $productt->constant;
@endphp
<script>
    var constant = @php echo $const;
    @endphp;
    $(document).ready(function() {
        constantCalculation();

    });

    //onload get selected color data-id and set it to local storage in array bcz there is multple product color 

    // var selectedColorArray = [];
    // setTimeout(() => {

    var selectedColor = $('.prod_color_active').parent().data('id');
    // alert(selectedColor);
    // selectedColorArray.push(selectedColor);

    localStorage.setItem('selected_color', selectedColor);
    // }, 5000);

    //create array and set in local storage


    //var selectedColor = $('.select_color.prod_color_active').data('id');



    $(document).on('click', '.select_color', function(e) {
        var selectedColorArray = [];
        var colorId = $(this).data('id');
        //set local storage color_id
        selectedColorArray.push(colorId);
        console.log(selectedColorArray);
        localStorage.setItem('selected_color', JSON.stringify(selectedColorArray));
        var productId = $(this).data('product');
        $.ajax({
            url: "{{ route('front.product.colorImages') }}",
            type: 'POST',
            data: {
                color_id: colorId,
                product_id: productId,
                _token: '{{ csrf_token() }}'

            },
            success: function(response) {
                // Assuming the response contains an array of image URLs
                if (response.success) {
                    var images = response.images;
                    var swiperWrapper = $('.img_slide_' + productId);
                    swiperWrapper.html(''); // Clear existing images

                    images.forEach(function(imageUrl) {
                        var imgElement = '<div class="swiper-slide"><img src="' + imageUrl + '" alt="Product Image"></div>';
                        swiperWrapper.append(imgElement);
                    });

                    $(this).addClass('selected').siblings().removeClass('selected');
                    //set local storage color_id
                    localStorage.setItem('selected_color', colorId);


                } else {
                    console.log('Error:', response);
                }


            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });


    $(document).on('click', '.related_select_color', function(e) {

        var colorId = $(this).data('id');
        var productId = $(this).data('product');
        $.ajax({
            url: "{{ route('front.product.colorImages') }}",
            type: 'POST',
            data: {
                color_id: colorId,
                product_id: productId,
                _token: '{{ csrf_token() }}'

            },
            success: function(response) {
                // Assuming the response contains an array of image URLs
                if (response.success) {
                    var images = response.images;
                    var swiperWrapper = $('.img_slide_' + productId);
                    swiperWrapper.html(''); // Clear existing images

                    images.forEach(function(imageUrl, index) {
                        var imgElement = '<div class="prod-image-slide' + (index === 0 ? ' active' : '') + '"><img src="' + imageUrl + '" alt="Product Image"></div>';
                        swiperWrapper.append(imgElement);
                    });

                    initializeSliders();


                } else {
                    console.log('Error:', response);
                }


            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });



    $('.plus-btn').click(function() {
        var quantityInput = $(this).siblings('.quantity-input');
        var currentValue = parseInt(quantityInput.val());
        if (!isNaN(currentValue)) {
            quantityInput.val(currentValue + 1);

            constantCalculation();
        }
    });

    $('.minus-btn').click(function() {
        var quantityInput = $(this).siblings('.quantity-input');
        var currentValue = parseInt(quantityInput.val());
        if (!isNaN(currentValue) && currentValue > 1) {
            quantityInput.val(currentValue - 1);
            constantCalculation();
        }
    });








    // ----------------product Slider ------------------- 
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    // ----------------product Slider ------------------- 


    // ----------------related Slider ------------------- 
    var swiper = new Swiper(".relatedSwiper", {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    $(document).on('change', '#i3', function(e) {

        if ($(this).val() == 'yes') {
            $('#side_location').show();
        } else {
            $('#side_location').hide();
        }
        constantCalculation();
    });





    $(document).on('change', '#k3', function(e) {

        if ($(this).val() == 'yes') {
            $('#back_location').show();
        } else {
            $('#back_location').hide();
        }
        constantCalculation();
    });


    // ----------------related Slider -------------------
</script>

<script src="{{ asset('assets/front/js/jquery.elevatezoom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/front/js/calculation.js') }}"></script>
<script src="{{ asset('assets/front/js/productDes.js') }}"></script>



@endsection