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
                <div style="width: 100%;">
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
                        <input type="hidden" id="constant-{{ $productt->id }}" name="constant" class="constant" value="{{ ($productt->constant)? $productt->constant : '' }}">
                        <input type="hidden" id="product_id" name="product_id" class="product_id" value="{{ $productt->id }}">
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
        getProductSession();
    });
    // Event listener for changes on select boxes and quantity input
    $('#g3, #h3, #i3, #j3, #k3, #l3, #f3').on('change', function() {
        updateProductSession();
    });

    $(document).on('click', '.select_color', function(e) {
        var selectedColorArray = [];
        var colorId = $(this).data('id');
        //set local storage color_id

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

                    updateProductSession();

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
            var productId = $('#product_id').val();
            updateProductSession();
        }
    });

    $('.minus-btn').click(function() {
        var quantityInput = $(this).siblings('.quantity-input');
        var currentValue = parseInt(quantityInput.val());
        if (!isNaN(currentValue) && currentValue > 1) {
            quantityInput.val(currentValue - 1);
            var productId = $('#product_id').val();
            updateProductSession();

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
            $('#j3').val('');
        } else {
            $('#side_location').hide();
            $('#j3').val('');
        }

    });





    $(document).on('change', '#k3', function(e) {

        if ($(this).val() == 'yes') {
            $('#back_location').show();
            $('#l3').val('');
        } else {
            $('#back_location').hide();
            $('#l3').val('');
        }

    });

    function getProductSession() {
        var productId = $('#product_id').val();
        $.ajax({
            url: mainurl + '/get-product-session', // Laravel route to handle session update
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function(response) {
                if (response.success) {
                    console.log('Product session retrieved');
                    console.log(response.data);

                    if (response.data) {


                        var product = response.data.product;
                        var embroideryType = response.data.embroidery_type;
                        var frontEmbroidery = response.data.front_embroidery;
                        var sideEmbroidery = response.data.side_embroidery;
                        var sideEmbroideryLocation = response.data.side_embroidery_location;
                        var backEmbroidery = response.data.back_embroidery;
                        var backEmbroideryLocation = response.data.back_embroidery_location;
                        var quantity = response.data.quantity;
                        var colorIds = response.data.color_ids;

                        $('#f3').val(quantity);
                        $('#g3').val(embroideryType);
                        $('#h3').val(frontEmbroidery);
                        $('#i3').val(sideEmbroidery);
                        $('#j3').val(sideEmbroideryLocation);
                        $('#k3').val(backEmbroidery);
                        $('#l3').val(backEmbroideryLocation);

                        // Set selected colors
                        $('.select_color').removeClass('prod_color_active');
                        colorIds.forEach(function(colorId) {
                            $('.select_color[data-id="' + colorId + '"] img').addClass('prod_color_active');
                        });


                        if (sideEmbroidery == 'yes') {
                            $('#side_location').show();
                        } else {
                            $('#side_location').hide();
                        }

                        if (backEmbroidery == 'yes') {
                            $('#back_location').show();
                        } else {
                            $('#back_location').hide();
                        }
                    }

                    constantCalculation(productId);

                }
            }
        });
    }

    function updateProductSession() {
        var productId = $('#product_id').val();
        var quantity = $('#f3').val();
        var embroideryType = $('#g3').val();
        var frontEmbroidery = $('#h3').val();
        var sideEmbroidery = $('#i3').val();
        var sideEmbroideryLocation = $('#j3').val();
        var backEmbroidery = $('#k3').val();
        var backEmbroideryLocation = $('#l3').val();


        //selectedColor push to array only sleected color
        var selectedColorArray = [];
        $('.select_color .prod_color_active').each(function() {
            selectedColorArray.push($(this).closest('.color').data('id'));
        });


        $.ajax({
            url: mainurl + '/update-product-session', // Laravel route to handle session update
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity,
                embroidery_type: embroideryType,
                front_embroidery: frontEmbroidery,
                side_embroidery: sideEmbroidery,
                side_embroidery_location: sideEmbroideryLocation,
                back_embroidery: backEmbroidery,
                back_embroidery_location: backEmbroideryLocation,
                color_ids: selectedColorArray
            },
            success: function(response) {
                if (response.success) {
                    console.log('Product session updated');

                    constantCalculation(response.data.product_id, response.data.constant);
                }
            }
        });
    }


    // ----------------related Slider -------------------
</script>

<script src="{{ asset('assets/front/js/jquery.elevatezoom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/front/js/single-calculation.js') }}"></script>
<script src="{{ asset('assets/front/js/productDes.js') }}"></script>



@endsection