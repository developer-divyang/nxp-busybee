@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/product.css') }}">
@endsection
@section('content')
@includeIf('partials.global.search-section')
<!-- breadcrumb -->
<div class="productList">
  <div class="productContent">
    <div class="top-section">
      <div class="filterToggle"><img src="{{ asset('assets/front/images/filter.png') }}" alt="">FILTERS</div>
      <div>Our <span>Products</span></div>
      <div class="sort">SORT BY
        <select name="pets" id="pet-select">
          <option value="low_to_high">Low to High</option>
          <option value="high_to_low">High to Low</option>
        </select>
      </div>
    </div>
    <div class="wrapper">

      <div class="filter">



        <h2 class="cat">Price Range</h2>
        <div class="range-slider" data-field="price">
          @php
          $minPrice = App\Models\Product::min('min_price');
          $maxPrice = App\Models\Product::max('max_price');
          @endphp
          <input type="range" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{$minPrice}}" id="minRange" />
          <input type="range" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{$maxPrice}}" id="maxRange" />
          <div class="slider-track"></div>
          <div class="price-range">
            <span id="rangeMinValue">${{$minPrice}}</span> - <span id="rangeMaxValue">${{$maxPrice}}</span>
          </div>
        </div>


        <div class="accordion">
          <h2 class="cat" style="margin-top: 10px;">Profile
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="profile">
            <ul>
              <li><span><input type="checkbox" data-id="high" name="profile[]" id="highProfile">High Profile</span><span>{{ App\Helpers\ProductHelper::getProductCount('profile','high') }}</span></li>
              <li><span><input type=" checkbox" data-id="low" name="profile[]" id="lowProfile">Low Profile</span><span>{{ App\Helpers\ProductHelper::getProductCount('profile','low') }}</span></li>
              <li><span><input type="checkbox" data-id="mid" name="profile[]" id="midProfile">Mid Profile</span><span>{{ App\Helpers\ProductHelper::getProductCount('profile','mid') }}</span></li>
              <li><span><input type="checkbox" data-id="pro" name="profile[]" id="proStyle">Pro Style</span><span>{{ App\Helpers\ProductHelper::getProductCount('profile','pro') }}</span></li>
            </ul>
          </div>
        </div>


        <div class="accordion">
          <h2 class="cat" style="margin-top: 10px;">Color
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="color">
            <ul>
              @foreach (App\Models\Color::groupBy('color_group')->get() as $k => $color)
              @php
              $count = 0;
              if($k == 0){
              $count = 1;
              }
              @endphp
              <li><span><input type="checkbox" data-id="{{ $color->id }}" name="color[]" id="{{ $color->id }}">{{ $color->color_group }}</span><span>{{ App\Helpers\ProductHelper::getProductCount('color_id',$color->id,'product_color_images') }}</span></li>
              @endforeach
            </ul>
          </div>
        </div>


        <div class="accordion">
          <h2 class="cat" style="margin-top: 10px;">Fit
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="fit">
            <ul>
              <li><span><input type="checkbox" data-id="stretch" name="fit[]" id="stretch">Stretch Fit</span><span>{{ App\Helpers\ProductHelper::getProductCount('fit','stretch') }}</span></li>
              <li><span><input type="checkbox" data-id="adjustable" name="fit[]" id="adjustable">Adjustable</span><span>{{ App\Helpers\ProductHelper::getProductCount('fit','adjustable') }}</span></li>
            </ul>
          </div>
        </div>


        <div class="accordion">
          <h2 class="cat" style="margin-top: 10px;">Bill
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="bill">
            <ul>
              <li><span><input type="checkbox" data-id="curved" name="fit[]" id="curved">Curved</span><span>{{ App\Helpers\ProductHelper::getProductCount('bill','curved') }}</span></li>
              <li><span><input type="checkbox" data-id="flat" name="fit[]" id="flat">Flat</span><span>{{ App\Helpers\ProductHelper::getProductCount('bill','flat') }}</span></li>
            </ul>
          </div>
        </div>


        <div class="accordion">
          <h2 class="cat" style="margin-top: 10px;">Size
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="size">
            <ul>
              @foreach (App\Models\Size::groupBy('size_name')->get() as $size)
              <li><span><input type="checkbox" data-id="{{ $size->id }}" name="size[]" id="{{ $size->id }}">{{ $size->size_name }}</span><span>{{ App\Helpers\ProductHelper::getProductCount('size_id',$size->id,'product_size_colors') }}</span></li>
              @endforeach
            </ul>
          </div>
        </div>


        <div class="accordion">
          <h2 class="cat" style="margin-top: 10px;">Brand
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="brand">
            <ul>
              @foreach (App\Models\Brand::groupBy('brand')->get() as $brand)
              <li><span><input type="checkbox" data-id="{{ $brand->id }}" name="brand[]" id="{{ $brand->id }}">{{ $brand->brand }}</span><span>{{ App\Helpers\ProductHelper::getProductCount('brand_id',$brand->id) }}</span></li>
              @endforeach
            </ul>
          </div>
        </div>


        <!--<div class="accordion">-->
        <!--  <h2 class="cat" style="margin-top: 10px;">Model-->
        <!--    <span class="arrow">&#9654;</span> <!-- This is the arrow -->
        <!--  </h2>-->
        <!--  <div class="accordion-content checks" data-field="model_number">-->
        <!--    <ul>-->
        <!--      @foreach (App\Models\ModelNumber::groupBy('model_number')->get() as $model)-->
        <!--      <li><span><input type="checkbox" data-id="{{ $model->id }}" name="model_number[]" id="{{ $model->id }}">{{ $model->model_number }}</span><span>{{ ($model->model_number == 'GB998') ? 1 : 0 }}</span></li>-->
        <!--      @endforeach-->
        <!--    </ul>-->
        <!--  </div>-->
        <!--</div>-->


        <div class="accordion" id="closure_filter" style="display: none;">
          <h2 class="cat" style="margin-top: 10px;">Closure
            <span class="arrow">&#9654;</span> <!-- This is the arrow -->
          </h2>
          <div class="accordion-content checks" data-field="closure">
            <ul>
              <li><span><input type="checkbox" data-id="buckle" name="closure[]" id="buckle">Buckle</span><span>{{ App\Helpers\ProductHelper::getProductCount('closure','buckle') }}</span></li>
              <li><span><input type="checkbox" data-id="snapback" name="closure[]" id="snapback">Snapback</span><span>{{ App\Helpers\ProductHelper::getProductCount('closure','snapback') }}</span></li>
              <li><span><input type="checkbox" data-id="velcro" name="closure[]" id="velcro">Velcro</span><span>{{ App\Helpers\ProductHelper::getProductCount('closure','velcro') }}</span></li>
            </ul>
          </div>
        </div>
      </div>
















      <div class="product-section">
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

      </div>


    </div>



    <div class="pagination">
      {{ $prods->links() }}
    </div>
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



  document.querySelectorAll(".cat").forEach(function(heading) {
    heading.addEventListener("click", function() {
      const accordionContent = this.nextElementSibling;
      const arrow = this.querySelector(".arrow");

      accordionContent.classList.toggle("show");


      if (accordionContent.classList.contains("show")) {
        arrow.style.transform = "rotate(90deg)";
      } else {
        arrow.style.transform = "rotate(0deg)";
      }
    });
  });
  $(document).on('click', '.select_color', function(e) {

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

          $('.select_color img').removeClass('color_active');

          // Add 'active' class to the clicked color image
          $(this).addClass('color_active');






        } else {
          console.log('Error:', response);
        }


      },
      error: function(xhr) {
        console.log('Error:', xhr);
      }
    });
  });


  function sendFilters() {
    var filters = {};
    $('.checks, .left-menu').each(function() {
      var field = $(this).data('field');
      filters[field] = [];
      $(this).find('input[type="checkbox"]:checked').each(function() {
        if ($(this).data('id') == 'adjustable') {
          $('#closure_filter').show();
        } else {
          $('#closure_filter').hide();
        }
        filters[field].push($(this).data('id'));
      });
    });

    // Add range slider values
    if ($('#minRange').val() == '{{ $minPrice }}' && $('#maxRange').val() == '{{ $maxPrice }}') {
      filters['min_price'] = '{{ $minPrice }}';
      filters['max_price'] = '{{ $maxPrice }}';
    } else {

      filters['min_price'] = $('#minRange').val();
      filters['max_price'] = $('#maxRange').val();
    }

    // Add csrf token
    filters['_token'] = '{{ csrf_token() }}';

    filters['sort'] = $('#pet-select').val();


    // Fetch filtered products
    $.ajax({
      url: "{{ route('front.filter.products') }}", // Adjust the URL to your route
      method: 'POST',
      data: filters,
      success: function(response) {
        // Append filtered products to product-section
        if (response.success) {
          $('.product-section').html(response.html);
          $('.loader').fadeOut(1000);
          $('#pagination-links').html(response.pagination);

          // Reinitialize Swiper slider
          var swiper = new Swiper(".prodImageSlider", {
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        } else {
          $('.product-section').html('<div class="no-products w-100 text-center"><h3 class="center">' + response.message + '</h3></div>');
          $('.loader').fadeOut(1000);
          $('#pagination-links').html('');

          toastr.error('Error fetching products');
        }
      },
      error: function(xhr) {
        console.error('Error fetching products:', xhr);
      }
    });
  }

  // Event listener for checkboxes
  $('input[type="checkbox"]').on('change', function() {
    sendFilters();
  });

  // Event listeners for range sliders
  $('#minRange, #maxRange').on('blur', function() {
    $('#rangeMinValue').text('$' + $('#minRange').val() + '.00');
    $('#rangeMaxValue').text('$' + $('#maxRange').val() + '.00');
    sendFilters();
  });

  $('#pet-select').on('change', function() {
    sendFilters();
  });


  $(document).on('click', '#pagination-links a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      success: function(response) {
        if (response.success) {
          $('#product-section').html(response.data);
          $('#pagination-links').html(response.pagination);
        } else {
          $('#product-section').html('<p>No products found for the selected option.</p>');
          $('#pagination-links').html('');
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