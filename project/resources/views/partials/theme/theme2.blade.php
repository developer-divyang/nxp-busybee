<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if(isset($page->meta_tag) && isset($page->meta_description))

    <meta name="keywords" content="{{ $page->meta_tag }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <title>{{$gs->title}}</title>

    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))

    <meta property="og:title" content="{{$blog->title}}" />
    <meta property="og:description" content="{{ $blog->meta_description != null ? $blog->meta_description : strip_tags($blog->meta_description) }}" />
    <meta property="og:image" content="{{asset('assets/images/blogs/'.$blog->photo)}}" />
    <meta name="keywords" content="{{ $blog->meta_tag }}">
    <meta name="description" content="{{ $blog->meta_description }}">
    <title>{{$gs->title}}</title>

    @elseif(isset($productt))

    <meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
    <meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
    <meta property="og:title" content="{{$productt->name}}" />
    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
    <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
    <meta name="author" content="Easybee">
    <title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>

    @else

    <meta property="og:title" content="{{$gs->title}}" />
    <meta property="og:image" content="{{asset('assets/images/'.$gs->logo)}}" />
    <meta name="keywords" content="{{ $seo->meta_keys }}">
    <meta name="author" content="Easybee">
    <title>{{$gs->title}}</title>

    @endif

    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Import the Inter font with specified weights and styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/flaticon/flaticon.css') }}">

</head>

<body>
    <div class="navbar">
        <img class="small" src="{{ asset('assets/front/images/Logo.png') }}" alt="">
        <div class="center-nav">
            <ul>
                <a href="index.html">
                    <li class="" data-page="home">Home</li>
                </a>
                <a href="Product.html">
                    <li class="" data-page="product">Product</li>
                </a>
                <a href="">
                    <li class="" data-page="blog">Blog</li>
                </a>
                <a href="">
                    <li class="" data-page="about">About us</li>
                </a>
            </ul>
            <img src="{{ asset('assets/front/images/Logo.png') }}" alt="">
            <ul>
                <a href="">
                    <li class="" data-page="reviews">Reviews</li>
                </a>
                <a href="">
                    <li class="" data-page="blog2">Blog</li>
                </a>
                <a href="">
                    <li class="" data-page="faqs">FAQ's</li>
                </a>
                <a href="">
                    <li class="" data-page="contact">Contact Us</li>
                </a>
            </ul>
        </div>
        <div id="toggle" style="display: flex; justify-content: space-between; gap: 40px;">
            <div class="nav-end">
                <img src="{{ asset('assets/front/images/heart.png') }}" alt="">
                <img src="{{ asset('assets/front/images/user.png') }}" alt="">
                <img src="{{ asset('assets/front/images/shopping-cart.png') }}" alt="">
            </div>
            <img src="{{ asset('assets/front/images/ham.png') }}" alt="" class="ham">
        </div>
    </div>


    <div class="search-section">
        <div class="category-menu">
            <div class="category-item active" data-category="caps">
                <img src="{{ asset('assets/front/images/one.png') }}" alt="Caps Icon">
                <span>CAPS</span>
            </div>
            <div class="category-item" data-category="shirts">
                <img src="{{ asset('assets/front/images/two.png') }}" alt="Shirts Icon">
                <span>SHIRTS</span>
            </div>
            <div class="category-item" data-category="polo">
                <img src="{{ asset('assets/front/images/three.png') }}" alt="Polo Icon">
                <span>POLO</span>
            </div>
            <div class="category-item" data-category="jackets">
                <img src="{{ asset('assets/front/images/four.png') }}" alt="Jackets Icon">
                <span>JACKETS</span>
            </div>
            <div class="category-item" data-category="bags">
                <img src="{{ asset('assets/front/images/five.png') }}" alt="Bags Icon">
                <span>BAGS</span>
            </div>
            <div class="underline"></div>
        </div>

        <div class="inputFields">
            <div class="inputs">
                <div class="first">
                    <select name="fit" id="fit">
                        <option value="">Select fit</option>
                        <option value="s">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <select name="fit" id="fit">
                        <option value="">Bill Type</option>
                        <option value="s">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
                <div class="second">
                    <select name="fit" id="fit">
                        <option value="">Choose Your Style</option>
                        <option value="s">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <select name="fit" id="fit">
                        <option value="">Search by Color</option>
                        <option value="s">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
            </div>
            <button><img src="{{ asset('assets/front/images/search.png') }}" alt=""> <br>Show me recommendations</button>
        </div>

        <div class="howItWorks">Not sure where to start? <img src="{{ asset('assets/front/images/howItWorks.png') }}" alt=""></div>
    </div>

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
                    <div class="swiper-pagination"></div>
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


    <div class="footer">
        <div class="footer-cont">
            <h2>Don't Miss <span>Offers?</span></h2>
            <p>Subscribe to our Weekly Newsletter to get special offers, member deals, and so much more!</p>

            <div class="sub">
                <input type="email" placeholder="Email address">
                <button>subscribe now</button>

            </div>

            <div class="options">
                <div class="footerBox">
                    <h4>Explore By</h4>
                    <ul>
                        <li>Hat Embroidery</li>
                        <li>Custom Hats</li>
                        <li>Personalized Sweaters</li>
                        <li>Embroidered Polos</li>
                        <li>Embroidered Bags</li>
                    </ul>
                </div>
                <div class="footerBox">
                    <h4>Information</h4>
                    <ul>
                        <li>Reviews</li>
                        <li>About Us</li>
                        <li>FAQ’s</li>
                        <li>Contact Us</li>
                        <li>Embroidery Services</li>
                    </ul>
                </div>
                <div class="footerBox">
                    <h4>Accounts</h4>
                    <ul>
                        <li>Login/Register</li>
                        <li>Order History
                        </li>
                        <li>Returns</li>
                        <li>Terms & Conditions</li>
                        <li>Privacy Policy</li>
                    </ul>
                </div>
                <div class="footerBox">
                    <h4>Contact</h4>
                    <p>
                        We are located in <br>Converse, Texas
                        <br><br>
                        Need Help? <br>grrael@beeembroidery.com
                        <br>
                        210-879-7109
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2024 Busy Bee Embroidery. All Rights Reserved.</p>
                <div class="social">
                    <img src="{{ asset('assets/front/images/facebook.png') }}" alt="">
                    <img src="{{ asset('assets/front/images/twitter.png') }}" alt="">
                    <img src="{{ asset('assets/front/images/insta.png') }}" alt="">
                    <img src="{{ asset('assets/front/images/youtube.png') }}" alt="">
                    <img src="{{ asset('assets/front/images/telegram.png') }}" alt="">
                    <img src="{{ asset('assets/front/images/messanger.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>











    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".blogSlider", {
            slidesPerView: 'auto',
            spaceBetween: 30,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        var swiper = new Swiper(".reviews", {
            slidesPerView: 'auto',
            spaceBetween: 30,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    <script>
        var swiper = new Swiper(".brandSlider", {
            slidesPerView: 2, // Default to 2 slides per view
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            grid: {
                rows: 2, // Maintain 2 rows for all views
            },
            breakpoints: {
                768: { // For tablets and desktops
                    slidesPerView: 6, // Display 6 slides per view in grid
                    grid: {
                        rows: 2, // Maintain 2 rows in grid layout
                    },
                },
                481: { // For tablets and desktops
                    slidesPerView: 6, // Display 6 slides per view in grid
                    grid: {
                        rows: 2, // Maintain 2 rows in grid layout
                    },
                },
                480: { // For mobile view
                    slidesPerView: 2, // Adjust to fit 2 slides per view
                    grid: {
                        rows: 2, // Maintain 2 rows in grid layout
                    },
                    freeMode: true, // Enable free scrolling
                },
            },
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 2200,
                disableOnInteraction: false,
            },
            loop: true,
        });
    </script>

    <script>
        var swiper = new Swiper(".cat-slider-main", {
            slidesPerView: 'auto',
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

</body>

</html>