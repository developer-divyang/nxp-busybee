@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/purchaseOpt.css') }}">
@endsection
@section('content')



<div class="purchase-section">
    <div class="tabsSection">
        <div class="tab-container">
            <ul class="tabs">
                <li class="tab active" data-target="select-type">Select Type</li>
                <li class="tab" data-target="items">Items</li>
                <li class="tab" data-target="artwork">Artwork</li>
                <li class="tab" data-target="checkout">Checkout</li>
            </ul>
            <div class="tab-content">
                <div id="select-type" class="content active">
                    <div class="x-scroll">
                        <div class="itemTypeBox">
                            <div class="imageBox"><img src="{{ asset('assets/front/images/caps/cap1.png') }}" alt=""></div>
                            <div class="textCont">
                                <h4>Add <span>Embroidery</span></h4>
                                <p>No Minimum Order and Lowest Price Option</p>
                            </div>
                            <div class="hoverSelect">select</div>
                        </div>
                        <div class="itemTypeBox">
                            <div class="imageBox"><img src="{{ asset('assets/front/images/caps/cap2.png') }}" alt=""></div>
                            <div class="textCont">
                                <h4>Add <span>Leather Patches</span></h4>
                                <p>No Minimum Order with
                                    Synthetic Water Resistant Leather</p>
                            </div>
                            <div class="hoverSelect">select</div>
                        </div>
                        <div class="itemTypeBox">
                            <div class="imageBox"><img src="{{ asset('assets/front/images/caps/cap3.png') }}" alt=""></div>
                            <div class="textCont">
                                <h4>Custom <span>Text</span></h4>
                                <p>Add your writing on cap with no extra charge</p>
                            </div>
                            <div class="hoverSelect">select</div>
                        </div>

                    </div>
                    <div class="" style="display: flex; gap: 15px; max-width: 300px; margin: 0 auto;">
                        <a href=""><button style="margin: 0 auto; margin-top: 10px; white-space: nowrap;display:none" id="next">NEXT STEP</button></a>

                    </div>
                </div>
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
                                    @foreach($related_product->getColorImages as $pcolor)
                                    @php
                                    $color = App\Models\Color::find($pcolor->color_id);
                                    @endphp
                                    <div data-id="{{ $color->id }}" data-product="{{ $related_product->id }}" class="color related_select_color">
                                        <img src="{{ Storage::url($color->color_image) }}" class="img-fluid image-circle" alt="">
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
    </script>

    <script src="{{ asset('assets/front/js/jquery.elevatezoom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/front/js/purchase.js') }}"></script>



    @endsection