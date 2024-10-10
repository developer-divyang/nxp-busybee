@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/searchPage.css') }}">
@endsection
@section('content')
@includeIf('partials.global.search-section')
<!-- breadcrumb -->
<div class="productList">
    <div class="productContent">
        <div class="top-section">
            <div style="opacity: 0; display: none;" class="filterToggle"><img src="images/filter.png" alt="">FILTERS</div>
            <div>Results <span>Products</span></div>
            <div class="sort">SORT BY
                <select name="pets" id="pet-select">
                    <option value="dog">Best Match</option>
                    <option value="cat">Most Popular</option>
                    <option value="hamster">Best Rated</option>
                    <option value="parrot">Low to High</option>
                    <option value="spider">High to Low</option>
                    <option value="goldfish">Best Match</option>
                </select>
            </div>
        </div>
        <div class="wrapper">



            <div class="product-section">
                @if(count($prods) > 0)

                
                @foreach($prods as $product)
                <div class="prodBox">

                    <img class="wishlistImg" src="{{ asset('assets/front/images/wishlist.png') }}" alt="wishlist Image">
                    <div class="prod-image">
                        <div class="swiper prodImageSlider">
                            @if($product->getColors)

                            @php
                            $productColorImages = $product->getColors->first()->productColorImages;

                            @endphp

                            <div class="swiper-wrapper img_slide_{{ $product->id }}">
                                @foreach($productColorImages as $productColorImage)
                                <div class="swiper-slide"><img src="{{ Storage::url($productColorImage->image_path) }}" alt="Product Image"></div>
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
                                <h5 id="offerPrice">$100 -</h5>
                                <h5 id="oldPrice">$150</h5>
                            </div>
                        </a>
                        @if($product->getColors)

                        <div class="color-choice">
                            @foreach($product->getColors as $color)
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
                <div class="no-products">
                    <h3>No products found</h3>
                </div>
                @endif

            </div>


        </div>


        @if(count($prods) > 0)
        <div class="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">4</button>
            <button class="page-btn">&raquo;</button>
        </div>
        @endif
    </div>
</div>



@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".prodImageSlider", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    $('.select_color').on('click', function() {
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

                    images.forEach(function(imageUrl) {
                        var imgElement = '<div class="swiper-slide"><img src="' + imageUrl + '" alt="Product Image"></div>';
                        swiperWrapper.append(imgElement);
                    });
                } else {
                    console.log('Error:', response);
                }


            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });


    $('.sub_cate').on('change', function() {

        $('.loader').fadeOut(1000)
        // Get selected main category
        var mainCateId = $(this).closest('li#heading').find('.main_cate').data('id');

        // Get selected subcategories
        var selectedSubCates = [];
        $('input.sub_cate:checked').each(function() {
            selectedSubCates.push($(this).data('id'));
        });

        // Fetch filtered products
        $.ajax({
            url: "{{ route('front.filter.products') }}", // Adjust the URL to your route
            method: 'POST',
            data: {
                main_cate_id: mainCateId,
                sub_cate_ids: selectedSubCates,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Append filtered products to product-section
                if (response.success) {
                    $('.product-section').html(response.html);
                    $('.loader').fadeOut(1000)
                } else {
                    $('.product-section').html('<div class="no-products w-100 text-center"><h3 class="center">' + response.message + '</h3></div>');
                    $('.loader').fadeOut(1000)
                    toastr.error('Error fetching products');
                }

            },
            error: function(xhr) {
                console.error('Error fetching products:', xhr);
            }
        });
    });
</script>
<script>
    // const categoryItems = document.querySelectorAll('.category-item');
    const underline = document.querySelector('.underline');

    categoryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            categoryItems.forEach(cat => cat.classList.remove('active'));

            item.classList.add('active');

            const itemPosition = item.getBoundingClientRect();
            const menuPosition = document.querySelector('.category-menu').getBoundingClientRect();


            const leftPosition = itemPosition.left - menuPosition.left + 5;
            const itemWidth = item.offsetWidth;

            underline.style.left = `${leftPosition}px`;
            underline.style.width = `${itemWidth}px`;
        });
    });

    const initialActiveItem = document.querySelector('.category-item.active');
    if (initialActiveItem) {
        const initialPosition = initialActiveItem.getBoundingClientRect();
        const initialLeft = initialPosition.left - document.querySelector('.category-menu').getBoundingClientRect().left + 10;
        underline.style.left = `${initialLeft}px`;
        // underline.style.width = `${initialActiveItem.offsetWidth}px`;
        // underline.style.width = `${initialActiveItem.offsetWidth}px`;
    }
</script>


<script>
    document.querySelector('.filterToggle').addEventListener('click', function() {
        var filterDiv = document.querySelector('.filter');

        if (filterDiv.style.display === 'none' || filterDiv.style.display === '') {
            filterDiv.style.display = 'block';
        } else {
            filterDiv.style.display = 'none';
        }
    });
</script>
<script src="{{ asset('assets/front/js/product.js') }}"></script>
@endsection