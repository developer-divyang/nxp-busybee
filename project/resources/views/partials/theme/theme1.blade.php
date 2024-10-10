
@extends('layouts.front')
@section('content')

    @include('partials.global.search-section')



@if($ps->slider == 1)
    <!-- <div class="position-relative">
        <span class="nextBtn"></span>
        <span class="prevBtn"></span>
        <section class="home-slider owl-theme owl-carousel">
            @foreach($sliders as $data)
            <div class="banner-slide-item" style="background: url('{{asset('assets/images/sliders/'.$data->photo)}}') no-repeat center center / cover ;">
                <div class="container">
                    <div class="banner-wrapper-item text-{{ $data->position }}">
                        <div class="banner-content text-dark ">
                            <h5 class="subtitle text-dark slide-h5">{{$data->subtitle_text}}</h5>

                            <h2 class="title text-dark slide-h5">{{$data->title_text}}</h2>

                            <p class="slide-h5">{{$data->details_text}}</p>

                            <a href="{{$data->link}}" class="cmn--btn ">{{ __('SHOP NOW') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </div> -->
    <div class="banner-section">
        <div class="text">
            <p>Order your essentials with embroidery</p>
            <h1>Custom <br> <span>Embroidery</span></h1>
            <h6>In Converse, Texas</h6>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{ asset('assets/front/images/banner.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/front/images/banner.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/front/images/banner.png') }}" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @endif



<div class="brand-stats">
        <div class="stats-box">
            <h2>2.5<span>M</span><span>+</span></h2>
            <p>Products produced</p>
        </div>
        <div class="stats-box">
            <h2>80<span>K</span><span>+</span></h2>
            <p>Orders completed</p>
        </div>
        <div class="stats-box">
            <h2>38<span>K</span><span>+</span></h2>
            <p>Total customers</p>
        </div>
    </div>

    <div class="explore">
        <div class="explore-content">
            <h2 class="explore-heading">Explore <span> by Category</span></h2>
            <div class="cat-slider">
                <div class="swiper cat-slider-main">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="top cap"><img src="{{ asset('assets/front/images/cap.png') }}" alt=""></div>
                            <div class="bottom">
                                <h4>Custom <span>Caps</span></h4>
                                <p>Stylish headwear for every occasion, customizable for your needs.</p>
                                <button>Explore <img src="{{ asset('assets/front/images/arrow.png') }}" alt=""></button>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="top"><img src="{{ asset('assets/front/images/tShirt.png') }}" alt=""></div>
                            <div class="bottom">
                                <h4>Custom <span>Caps</span></h4>
                                <p>Stylish headwear for every occasion, customizable for your needs.</p>
                                <button>Explore <img src="{{ asset('assets/front/images/arrow.png') }}" alt=""></button>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="top"><img src="{{ asset('assets/front/images/polo.png') }}" alt=""></div>
                            <div class="bottom">
                                <h4>Custom <span>Caps</span></h4>
                                <p>Stylish headwear for every occasion, customizable for your needs.</p>
                                <button>Explore <img src="{{ asset('assets/front/images/arrow.png') }}" alt=""></button>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="top cap"><img src="{{ asset('assets/front/images/tShirt.png') }}" alt=""></div>
                            <div class="bottom">
                                <h4>Custom <span>Caps</span></h4>
                                <p>Stylish headwear for every occasion, customizable for your needs.</p>
                                <button>Explore <img src="{{ asset('assets/front/images/arrow.png') }}" alt=""></button>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="customers">
        <div class="cu-cont">
            <div class="cont-text">
                <h2>Happy <br> <span>Customers</span></h2>
                <p>Join our satisfied customers and
                    discover your perfect custom look!</p>

                <h6><img src="{{ asset('assets/front/images/facebook.png') }}" alt="">Facebook Reviews</h6>
                <h6><img src="{{ asset('assets/front/images/google.png') }}" alt="">Google Reviews</h6>
            </div>

            <div class="cont-slider">
                <div class="swiper reviews">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">

                            <div class="top-cont">

                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>

                                <p>"I absolutely love my new FlexFit 110 Trucker Snapback! The design is sleek and stylish, and the adjustable snapback allows for a great fit. It’s comfortable enough for all-day wear, and I’ve received so many compliments. Highly recommend this hat for anyone!"</p>
                            </div>

                            <div class="bottom-cont">
                                <div class="image-cont"></div>
                                <div class="img-name">
                                    <h5>Laura b.</h5>
                                    <p>07/07/24</p>
                                </div>
                            </div>

                        </div>
                        <div class="swiper-slide">

                            <div class="top-cont">

                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>

                                <p>"I absolutely love my new FlexFit 110 Trucker Snapback! The design is sleek and stylish, and the adjustable snapback allows for a great fit. It’s comfortable enough for all-day wear, and I’ve received so many compliments. Highly recommend this hat for anyone!"</p>
                            </div>

                            <div class="bottom-cont">
                                <div class="image-cont"></div>
                                <div class="img-name">
                                    <h5>Laura b.</h5>
                                    <p>07/07/24</p>
                                </div>
                            </div>

                        </div>
                        <div class="swiper-slide">

                            <div class="top-cont">

                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>

                                <p>"I absolutely love my new FlexFit 110 Trucker Snapback! The design is sleek and stylish, and the adjustable snapback allows for a great fit. It’s comfortable enough for all-day wear, and I’ve received so many compliments. Highly recommend this hat for anyone!"</p>
                            </div>

                            <div class="bottom-cont">
                                <div class="image-cont"></div>
                                <div class="img-name">
                                    <h5>Laura b.</h5>
                                    <p>07/07/24</p>
                                </div>
                            </div>

                        </div>
                        <div class="swiper-slide">

                            <div class="top-cont">

                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>

                                <p>"I absolutely love my new FlexFit 110 Trucker Snapback! The design is sleek and stylish, and the adjustable snapback allows for a great fit. It’s comfortable enough for all-day wear, and I’ve received so many compliments. Highly recommend this hat for anyone!"</p>
                            </div>

                            <div class="bottom-cont">
                                <div class="image-cont"></div>
                                <div class="img-name">
                                    <h5>Laura b.</h5>
                                    <p>07/07/24</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--<div class="swiper-pagination"></div>-->
                </div>
            </div>
        </div>
    </div>

    <div class="brands">
        <div class="brand-content">
            <h2>Brands We Have <br> <span>Worket With</span></h2>
            <div class="brand-image">
                <div class="swiper brandSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand1.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand7.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand2.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand8.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand3.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand3.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand10.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand4.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand11.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand5.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand12.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand6.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand1.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand11.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand12.png') }}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/front/images/brand7.png') }}" alt=""></div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="about">
        <div class="about-content">

            <div class="video-container">
                <h2 class="about-heading">
                    Why are the <br> <span>hats so good?</span>
                </h2>
                <img src="{{ asset('assets/front/images/video-banner.png') }}" alt="">
            </div>

            <div class="work">
                <h2 class="work-heading">
                    How <span>It Works</span>
                </h2>
                <p>From selecting to delivered your quality products, our process ensures your custom embroidery order is easy.</p>

                <div class="work-slider">
                    <!-- <img class="divider" src="{{ asset('assets/front/images/divider.png') }}" alt=""> -->
                    <div class="box">
                        <img src="{{ asset('assets/front/images/work1.png') }}" alt="">
                        <h5>Order <span>Placed</span></h5>
                        <p>Choose the products that work best for your brand using our very simple online order.</p>
                    </div>
                    <div class="box">
                        <img src="{{ asset('assets/front/images/work2.png') }}" alt="">
                        <h5>Artwork <span>Setup</span></h5>
                        <p>We hand convert every logo into a file our machines can read your documents.</p>
                    </div>
                    <div class="box">
                        <img src="{{ asset('assets/front/images/work3.png') }}" alt="">
                        <h5>In-House <span>Production</span></h5>
                        <p>Each product is stitched in house on one of our commercial embroidery machines.</p>
                    </div>
                    <div class="box">
                        <img src="{{ asset('assets/front/images/work4.png') }}" alt="">
                        <h5>Fast <span>Delivery</span></h5>
                        <p>Your order is shipped securely wrapped in plastic in a cardboard box.</p>
                    </div>
                </div>

                <div class="work-button">
                    <button>Learn more</button>
                    <button>order now</button>
                </div>

            </div>

        </div>
    </div>


    <div class="story">
        <div class="story-wrapper">
            <div class="left">
                <h5>About our story</p>
                    <h2>Local Embroidery <br> <span>Store in Texas</span></h2>
                    <p>We are a local American embroidery shop based in San Antonio, Texas and we want to provide YOU with a high-quality embroidery service for any custom embroidery project you have.
                        <br><br>
                        Our goal is to ensure that the need of your custom embroidery project is met in a timely and efficient manner, because our quality of our work can only be defined by YOUR satisfaction.
                    </p>
                    <button>Read More</button>
            </div>
            <div class="right">
                <img src="{{ asset('assets/front/images/couple.png') }}" alt="">
            </div>
        </div>
    </div>


    <div class="blogs">
        <div class="blogs-cont">
            <h2>Read <span>the Blogs</span></h2>
            <div class="blog-slider">
                <div class="swiper blogSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="blog-img"><img src="{{ asset('assets/front/images/blog1.png') }}" alt=""></div>
                            <div class="blog-text">
                                <h2>Jun 20, 2022 • <span>Embroidery</span></h2>
                                <h3>How to remove <br> <span>Embroidery</span></h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-img"><img src="{{ asset('assets/front/images/blog2.png') }}" alt=""></div>
                            <div class="blog-text">
                                <h2>April 17, 2023 • <span>Business</span></h2>
                                <h3>What is the purpose of <br> <span>your business</span></h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-img"><img src="{{ asset('assets/front/images/blog3.png') }}" alt=""></div>
                            <div class="blog-text">
                                <h2>April 24, 2023 • <span>Hand Bags</span></h2>
                                <h3>Women's want embroidery <br> <span>Bags?What?</span></h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-img"><img src="{{ asset('assets/front/images/blog2.png') }}" alt=""></div>
                            <div class="blog-text">
                                <h2>Jun 20, 2022 • <span>Embroidery</span></h2>
                                <h3>How to remove <br> <span>Embroidery</span></h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-img"><img src="{{ asset('assets/front/images/blog1.png') }}" alt=""></div>
                            <div class="blog-text">
                                <h2>Jun 20, 2022 • <span>Embroidery</span></h2>
                                <h3>How to remove <br> <span>Embroidery</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>



    <!-- @if(isset($visited))
    @if($gs->is_cookie == 1)
        <div class="cookie-bar-wrap show">
            <div class="container d-flex justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="row justify-content-center">
                        <div class="cookie-bar">
                            <div class="cookie-bar-text">
                                {{ __('The website uses cookies to ensure you get the best experience on our website.') }}
                            </div>
                            <div class="cookie-bar-action">
                                <button class="btn btn-primary btn-accept">
                                {{ __('GOT IT!') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endif -->
<!-- Scroll to top -->
<a href="#" class="scroller text-white" id="scroll"><i class="fa fa-angle-up"></i></a>
<!-- End Scroll To top -->

@endsection
@section('script')
	<script>
		let checkTrur = 0;
		$(window).on('scroll', function(){

		if(checkTrur == 0){
			$('#extraData').load('{{route('front.extraIndex')}}');
			checkTrur = 1;
		}
		});
        var owl = $('.home-slider').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        autoplay: true,
        margin: 0,
        animateIn: 'fadeInDown',
        animateOut: 'fadeOutUp',
        mouseDrag: false,
    })
    $('.nextBtn').click(function() {
        owl.trigger('next.owl.carousel', [300]);
    })
    $('.prevBtn').click(function() {
        owl.trigger('prev.owl.carousel', [300]);
    })
	</script>

    
@endsection
