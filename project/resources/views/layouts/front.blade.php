<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="GeniusCart-New - Multivendor Ecommerce system">
    <meta name="author" content="GeniusOcean">

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
    <meta name="author" content="GeniusOcean">
    <title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>

    @else

    <meta property="og:title" content="{{$gs->title}}" />
    <meta property="og:image" content="{{asset('assets/images/'.$gs->logo)}}" />
    <meta name="keywords" content="{{ $seo->meta_keys }}">
    <meta name="author" content="GeniusOcean">
    <title>{{$gs->title}}</title>

    @endif

    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}" />
    <!-- Google Font -->
    @if ($default_font->font_value)
    <link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @else
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','', $gs->colors).'&header_color='.$gs->header_color) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Import the Inter font with specified weights and styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/style1.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/flaticon/flaticon.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}">

    @if ($default_font->font_family)
    <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
    @else
    <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='."Open Sans") }}">
    @endif

    @if(!empty($seo->google_analytics))
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ $seo->google_analytics }}');
    </script>
    @endif
    @if(!empty($seo->facebook_pixel))
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $seo->facebook_pixel }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ $seo->facebook_pixel }}&ev=PageView&noscript=1" />
    </noscript>
    @endif


    @yield('css')
</head>

<body>
    <div id="page_wrapper" class="bg-white">

        <div class="loader">
            <div class="spinner"></div>
        </div>

        <div class="navbar">
            {{-- Top header currency and Language --}}
            @include('partials.global.top-header')
        </div>

        @yield('content')



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

    <script src="{{ asset('assets/front/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>

document.addEventListener('DOMContentLoaded', function() {
    var activePage = localStorage.getItem('activePage');
    if (activePage) {
        document.querySelectorAll('.center-nav ul li').forEach(function(navItem) {
            navItem.classList.remove('navActive');
        });
        document.querySelector(`.center-nav ul li[data-page="${activePage}"]`).classList.add('navActive');
    }
});

// Add event listener to set navActive class and store in localStorage
document.querySelectorAll('.center-nav ul li').forEach(function(navItem) {
    navItem.addEventListener('click', function() {
        var page = this.getAttribute('data-page');
        localStorage.setItem('activePage', page);
    });
});

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
    <script>
        var mainurl = "{{ url('/') }}";
        var gs = {!!json_encode(DB::table('generalsettings')->where('id', '=', 1)->first(['is_loader', 'decimal_separator', 'thousand_separator', 'is_cookie', 'is_talkto', 'talkto'])) !!};
        var ps_category = {{$ps->category}};

        var lang = {
            'days': '{{ __('Days ') }}',
            'hrs': '{{ __('Hrs ') }}',
            'min': '{{ __('Min ') }}',
            'sec': '{{ __('Sec ') }}',
            'cart_already': '{{ __('Already Added To Card.') }}',
            'cart_out': '{{ __('Out Of Stock ') }}',
            'cart_success': '{{ __('Successfully Added To Cart.') }}',
            'cart_empty': '{{ __('Cart is empty.') }}',
            'coupon_found': '{{ __('Coupon Found.') }}',
            'no_coupon': '{{ __('No Coupon Found.') }}',
            'already_coupon': '{{ __('Coupon Already Applied.') }}',
            'enter_coupon': '{{ __('Enter Coupon First ') }}',
            'minimum_qty_error': '{{ __('Minimum Quantity is: ') }}',
            'affiliate_link_copy': '{{ __('Affiliate Link Copied Successfully ') }}'
        };
    </script>
    <!-- Include Scripts -->
    <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/front/js/waypoint.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/wow.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/front/js/lazy.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/front/js/lazy.plugin.js')}}"></script>
    <script src="{{ asset('assets/front/js/jquery.countdown.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    @yield('zoom')
    <script src="{{ asset('assets/front/js/paraxify.js') }}"></script>
    <script src="{{ asset('assets/front/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>

    <script>
        $('.select2').select2();
        lazy();

        function lazy() {
            $(".lazy").Lazy({
                scrollDirection: 'vertical',
                effect: "fadeIn",
                effectTime: 1000,
                threshold: 0,
                visibleOnly: false,
                onError: function(element) {
                    console.log('error loading ' + element.data('src'));
                }
            });
        }


          document.addEventListener('DOMContentLoaded', function() {
            const colorChoices = document.querySelectorAll('.color-choice');

            colorChoices.forEach(container => {
                container.addEventListener('click', function(event) {
                    const clickedElement = event.target;

                    if (clickedElement.tagName.toLowerCase() === 'img') {
                        if (clickedElement.classList.contains('prod_color_active')) {
                            clickedElement.classList.remove('prod_color_active');
                        } else {
                            container.querySelectorAll('.color img').forEach(img => {
                                img.classList.remove('prod_color_active');
                            });

                            clickedElement.classList.add('prod_color_active');
                        }
                    }
                });
            });
        });
    </script>




    @php
    echo Toastr::message();
    @endphp
    @yield('script')



</body>

</html>