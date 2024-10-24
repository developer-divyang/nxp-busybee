@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/purchaseOpt.css') }}">
@endsection
@section('content')

<div id="myCustomModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close">&times;</span>

        <!-- Custom Tab Header -->
        <div class="custom-tab-header">
            <button class="custom-tab-button active" data-target="custom-signin">Sign In</button>
            <button class="custom-tab-button" data-target="custom-singup">Sign Up</button>
        </div>

        <!-- Custom Tab Content -->
        <div class="custom-tab-content">
            <div id="custom-signin" class="custom-tab-pane active">
                <div class="signin-container">
                    <h1>Welcome Back!</h1>
                    <p>Login to your account using below details</p>
                    <form id="loginform" class="signin-form" action="{{ route('user.login.submit') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email Address" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <p class="forgot-password"><a href="#">Forgot Password?</a></p>
                        <button type="submit" class="login-btn">LOG IN</button>
                    </form>
                    <p class="signup-prompt">Don’t have an account? <a href="#">Sign up!</a></p>
                </div>
            </div>



            <!-- signup model------------------- -->
            <div id="custom-singup" class="custom-tab-pane">
                <div class="registration-container">
                    <h1>Create an Account</h1>
                    <p>Register your new account with us.</p>
                    <form id="registerform" class="registration-form" action="{{route('user-register-submit')}}" method="POST">
                        @csrf

                        <input type="text" name="name" placeholder="Full Name" required>
                        <input type="email" name="email" placeholder="Email Address" required>
                        <input type="tel" name="phone" placeholder="Phone" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <button type="submit" class="register-btn">REGISTER</button>
                    </form>
                    <p class="login-prompt">Already have an account? <a href="#">Login</a></p>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="purchase-section">
    <div class="tabsSection">
        <div class="tab-container">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <ul class="tabs">
                <li class="tab active" data-target="select-type">Select Type</li>
                <li class="tab disabled" data-target="items">Items</li>
                <li class="tab disabled" data-target="artwork">Artwork</li>
                <li class="tab disabled" data-target="checkout">Checkout</li>
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
                        <button class="next" style="margin: 0 auto; margin-top: 10px; white-space: nowrap; display:none" id="next" class="next">NEXT</button>

                    </div>
                </div>
                <div id="items" class="content">

                    <button class="accordion-toggle faqactive">
                        <h4>{{ $productt->name }}</h4>
                    </button>

                    <div class="accordion-content">

                        <input type="hidden" name="product_id" value="{{ $productt->id }}">
                        <input type="hidden" name="price" value="{{ $productt->current_price }}">
                        <div class="accorTop">
                            <!-- Price Calculator -->
                            @includeIf('partials.global.price-calculator-section')
                            <!-- Price Calculator -->

                            <div class="points">
                                <ul>
                                    <li>Add more items to save up-to $5 per item.</li>
                                    <li>Price (Excluding Shipping) </li>
                                </ul>
                            </div>
                        </div>

                        <div class="accorBottom" id="itemDetails">

                            <!---------------- before line product --------------->







                        </div>


                    </div>
                    <div class="" style="display: flex; gap: 15px; max-width: 300px; margin: 0 auto;">
                        <button style="margin: 0 auto; margin-top: 20px; white-space: nowrap;" id="next" class="next">BACK</button>
                        <button style="margin: 0 auto; margin-top: 20px; white-space: nowrap;" id="next" class="next">NEXT</button>

                    </div>

                </div>
                <div id="artwork" class="content">
                    <form id="cartform" action="{{ route('product.cart.add',$productt->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/uploadImg.png') }}" alt="uploadImg">Upload <span>Your Logo</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="uploadTop" style="display: flex; justify-content: space-between;">
                                <!-- Upload Left Section -->
                                <div class="uploadLeft">
                                    <div class="radio-group">
                                        @if (Auth::check())
                                        <label class="radio-container">
                                            <input type="radio" name="order" value="previous" id="previousRadio">
                                            <span class="checkmark"></span>
                                            I Have Ordered With This Logo Before
                                        </label>
                                        @else
                                        <label class="radio-container">
                                            <input type="radio" name="order" class="user_login" value="previous" id="previousRadio">
                                            <span class="checkmark"></span>
                                            I Have Ordered With This Logo Before
                                        </label>
                                        @endif
                                        <label class="radio-container">
                                            <input type="radio" name="order" value="first-time" id="firstTimeRadio" checked>
                                            <span class="checkmark checked"></span>
                                            This Is My First Time Ordering
                                        </label>
                                    </div>

                                    <div class="uploadCont">
                                        <div class="contentOne" id="contentOne">
                                            <div class="uploadTextWrapper">
                                                <h3>Upload Your Logo</h3>
                                                <ul>
                                                    <li>Any image of your logo will work (even a screenshot or photo). We redraw and recreate all designs during artwork setup.</li>
                                                    <li>Every logo must be hand converted by one of our designers into a new file that works for our machines.</li>
                                                    <li>We test and tweak every logo until the output meets or exceeds our very high quality standards.</li>
                                                    <li>We keep your artwork on file for all future orders.</li>
                                                    <li>Upload file size should be max 5MB and we support file formats like .jpg, .png, .svg, .eps, .ai etc...</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="contentTwo" id="contentTwo" style="display:none;">
                                            <div class="container">
                                                <h2>Choose Your Logo</h2>
                                                <div class="logo-wrapper">
                                                    @if (Auth::check())
                                                    @if(Auth::user()->logos->count() > 0)
                                                    @foreach(Auth::user()->logos as $logo)
                                                    <div class="logo-container" onclick="selectLogo(this)">
                                                        <img src="{{ Storage::url($logo->logo) }}" alt="Logo 1" class="inactive-logo">
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <div class="no-logo">
                                                        <h3>No Logos Found</h3>
                                                        <p>You have not uploaded any logos yet. Please upload a logo to continue.</p>
                                                    </div>
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="file-upload-container">
                                        <div id="drop-area" style="display: flex;">
                                            <span class="drag-text">Drag and drop here</span>
                                        </div>
                                        <div id="file-list" style="display: flex;">

                                        </div>
                                        <label class="file-upload-button">
                                            <input type="file" name="front_logo[]" id="logo-upload" hidden="" multiple>
                                            UPLOAD YOUR LOGO
                                        </label>
                                        <span class="file-name">No File Selected</span>
                                    </div>

                                    <div class="logotextarea" style="margin-top: 10px;">
                                        <textarea class="logotextareamain" name="front_multi_logo_note" id="" placeholder="Front logo Notes"></textarea>
                                    </div>

                                    <div class="checkbox-group">
                                        <label class="checkbox-container">
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                            I own the rights to the artwork being used or have permission from the owner to use it
                                        </label>
                                    </div>
                                </div> <!-- .uploadLeft ends -->

                                <!-- Upload Right Section -->
                                <div class="uploadRight" id="uploadRight">
                                    <img src="{{ asset('assets/front/images/uploadLogo.png') }}" alt="">
                                </div> <!-- .uploadRight ends -->
                            </div> <!-- .uploadTop ends -->



                        </div>


                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/bird.png') }}" alt="bird">Embroidery <span>Options</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="accorTop stickyClass" style="transition: all 0.4s ease-in-out;">
                                <!-- Price Calculator -->
                                @includeIf('partials.global.price-calculator-section')
                                <!-- Price Calculator -->
                                <div class="points">
                                    <ul>
                                        <li>Add more items to save up-to $5 per item.</li>
                                        <li>Price includes decoration.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="accorBottom">
                                <div class="embBox" data-value="regular" onclick="selectEmbroBox(this)">
                                    <div class="checkbox"></div>
                                    <img src="{{ asset('assets/front/images/standard.png') }}" alt="">
                                    <div class="embText">
                                        <h3>Standard <br><span>Flat Embroidery</span></h3>
                                        <p>This method is the most common embroidery type. It is what most customers choose and works well for smaller details and intricate designs.</p>
                                    </div>
                                </div>
                                <div class="embBox" data-value="3D" onclick="selectEmbroBox(this)">
                                    <div class="checkbox"></div>
                                    <img src="{{ asset('assets/front/images/3dpuff.png') }}" alt="">
                                    <div class="embText">
                                        <h3>3D <br><span> Embroidery</span></h3>
                                        <p>This method creates a raised look that makes the design pop off the panel of the hat. Only certain designs or larger blocky elements inside a design are able to be puffed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/bird.png') }}" alt="bird">Logo <span>Placement & size</span></h4>
                        </button>
                        <div class="accordion-content">

                            <div class="accorBottom">
                                <div class="logowrapper">
                                    <div class="LogoBox LogoPlaceBox" data-value="front-right" onclick="selectLogoPlaceBox(this)">
                                        <div class="checkbox"></div>
                                        <img src="{{ asset('assets/front/images/logoRight.png') }}" alt="">
                                        <h3>Right <span>Eye</span></h3>
                                    </div>
                                    <div class="LogoBox LogoPlaceBox" data-value="front-center" onclick="selectLogoPlaceBox(this)">
                                        <div class="checkbox"></div>
                                        <img src="{{ asset('assets/front/images/logoCenter.png') }}" alt="">
                                        <h3>Centered <span>Eye</span></h3>
                                    </div>
                                    <div class="LogoBox LogoPlaceBox" data-value="front-left" onclick="selectLogoPlaceBox(this)">
                                        <div class="checkbox"></div>
                                        <img src="{{ asset('assets/front/images/logoLeft.png') }}" alt="">
                                        <h3>Left <span>Eye</span></h3>
                                    </div>
                                </div>

                                <div class="logotext">
                                    <div class="text">
                                        <div class="Subtext">
                                            <h5>Centered Designs</h5>
                                            <p>Standard sizing for Centered designs is 2.3" tall and 4.2" wide (while keeping your designs proportions). The maximum embroidery field size is 6.3" wide by 2.3" tall.</p>
                                        </div>
                                        <div class="Subtext">
                                            <h5>Offset Designs</h5>
                                            <p>Maximum 2.3" tall and 3" wide. We will use the maximum space we can on the side panel (while keeping your designs proportions).</p>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <div class="Subtext">
                                            <h5>Optional</h5>
                                            <p>Use the Placement & Size Notes below to give us any specific sizing or
                                                placement you may want.</p>
                                        </div>
                                        <div class="Subtext">
                                            <h5>Note</h5>
                                            <p>Placement can only change 1 time for every 6 or more hats ordered and
                                                must stay the same size.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="logotextarea">
                                    <textarea class="logotextareamain" name="front_logo_note" id="" placeholder="Placement and Size Notes"></textarea>
                                </div>
                            </div>
                        </div>


                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/bird.png') }}" alt="bird">Thread <span>Colors</span></h4>
                        </button>
                        <div class="accordion-content">

                            <div class="accorBottom">
                                <div class="thread">
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color1.png') }}" alt=""></div>
                                        <div class="colortext">Black</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color2.png') }}" alt=""></div>
                                        <div class="colortext">White</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color3.png') }}" alt=""></div>
                                        <div class="colortext">Silver</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color4.png') }}" alt=""></div>
                                        <div class="colortext">Gray</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color5.png') }}" alt=""></div>
                                        <div class="colortext">Light Blue</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color6.png') }}" alt=""></div>
                                        <div class="colortext">Neon Blue</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color7.png') }}" alt=""></div>
                                        <div class="colortext">Blue</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color9.png') }}" alt=""></div>
                                        <div class="colortext">Navy</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color10.png') }}" alt=""></div>
                                        <div class="colortext">Purple</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color11.png') }}" alt=""></div>
                                        <div class="colortext">Neon Green</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color12.png') }}" alt=""></div>
                                        <div class="colortext">Green</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color13.png') }}" alt=""></div>
                                        <div class="colortext">Olive Green</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color14.png') }}" alt=""></div>
                                        <div class="colortext">Neon Yellow</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color15.png') }}" alt=""></div>
                                        <div class="colortext">Yellow</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color16.png') }}" alt=""></div>
                                        <div class="colortext">Neon Orange</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color17.png') }}" alt=""></div>
                                        <div class="colortext">Gold</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color18.png')}}" alt=""></div>
                                        <div class="colortext">Tan</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color19.png') }}" alt=""></div>
                                        <div class="colortext">Brown</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color20.png') }}" alt=""></div>
                                        <div class="colortext">Dark Brown</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/color21.png') }}" alt=""></div>
                                        <div class="colortext">Neon Pink</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/red.png') }}" alt=""></div>
                                        <div class="colortext">Red</div>
                                    </div>
                                    <div class="threadBox">
                                        <div class="colorBox"><img src="{{ asset('assets/front/images/silver.png') }}" alt=""></div>
                                        <div class="colortext">Black</div>
                                    </div>
                                </div>

                                <div class="threadtext">
                                    <div class="text">
                                        <div class="Subtext">
                                            <h5>These are the thread colors we use</h5>
                                            <p>Designs can have up to 15 different colors in them. We recommend keeping designs to the fewest numbers of colors possible.</p>
                                        </div>
                                        <div class="Subtext">
                                            <h5>Optional</h5>
                                            <p>Let us know in the color notes below any specific colors you would like us to
                                                use in your design.</p>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <div class="Subtext">
                                            <h5>Note</h5>
                                            <p>Use the Placement & Size Notes below to give us any specific sizing or
                                                placement you may want.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="logotextarea">
                                    <textarea class="logotextareamain" name="thread_color_note" id="" placeholder="Placement and Size Notes"></textarea>
                                </div>
                            </div>
                        </div>

                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/bird.png') }}" alt="bird">Additional <span>Addons</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="accorTop">
                                <div class="additionTop">
                                    <h3>Back & Side Stitching</h3>
                                    <p>You can add back, left side and right side stitching to your hats. These locations can be additional small logos or text. Each separate location is an additional charge.</p>
                                </div>

                                <div class="points">
                                    <ul>
                                        <li>Add more items to save up-to $5 per item.</li>
                                        <li>Price includes decoration.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="accorBottom">
                                <div class="logowrapper">
                                    <div class="LogoBox" data-id="logo1" data-value="right" onclick="selectlogoBox(this)">
                                        <div class="checkbox"></div>
                                        <img src="{{ asset('assets/front/images/rightSide.png') }}" alt="">
                                        <h3>Right Side <span>Stitching</span></h3>
                                    </div>
                                    <div class="LogoBox" data-id="logo2" data-value="center" onclick="selectlogoBox(this)">
                                        <div class="checkbox"></div>
                                        <img src="{{ asset('assets/front/images/backSide.png') }}" alt="">
                                        <h3>Back Center <span>Stitching</span></h3>
                                    </div>
                                    <div class="LogoBox" data-id="logo3" data-value="left" onclick="selectlogoBox(this)">
                                        <div class="checkbox"></div>
                                        <img src="{{ asset('assets/front/images/leftSide.png') }}" alt="">
                                        <h3>Left Side <span>Stitching</span></h3>
                                    </div>
                                </div>

                                <div class="Additionaltextarea">

                                </div>
                            </div>
                        </div>

                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/bird.png') }}" alt="bird">General <span>Order Notes</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="accorTop">
                                <div class="additionTop">
                                    <h3>Optional</h3>
                                    <p>Please use this space to let us know any other special details about this order that you think we should know.</p>
                                </div>
                            </div>

                            <div class="accorBottom">

                                <div class="Generaltextarea">
                                    <textarea class="Generaltextareamain" name="order_note" id="" placeholder="Order here"></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="" style="display: flex; gap: 15px; max-width: 300px; margin: 0 auto;    margin-bottom: 10px;">
                            <button type="submit" style="margin: 0 auto; margin-top: 20px; white-space: nowrap;" id="next" class="next">ADD TO CART</button>
                            <button style="margin: 0 auto; margin-top: 20px; white-space: nowrap;  background-color: #DD9F44;" id="next" class="next">CHECKOUT</button>
                        </div>
                    </form>
                </div>

            </div>


            <div id="checkout" class="content">
                <form id="checkoutForm" action="{{ route('front.cod.submit') }}" method="POST" class="checkoutform">
                    @csrf
                    <button class="accordion-toggle">
                        @if($products)
                        <h4><img src="{{ asset('assets/front/images/orderSum.png') }}" alt=""> Order <span>Summary</span></h4>
                        @else
                        <h4 class="text-center"><img src="{{ asset('assets/front/images/orderSum.png') }}" alt="">{{ __('Cart is Empty!! Add some products in your Cart') }}</h4>
                        @endif
                    </button>
                    @if($products)
                    <div class="accordion-content">
                        <div class="order-summary">
                            <div class="accorTop">
                                <div class="order-container">
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th>Your Order Items</th>
                                                <th>Logo File</th>
                                                <th>Size</th>
                                                <th>Qty</th>
                                                <th>Item Price</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($products)

                                            @foreach($products as $key => $product)
                                            @php

                                            $productData = App\Models\Product::find($product['item']->id);
                                            $color = App\Models\Color::where('color_name',$product['color'])->first()?->id;
                                            $size = App\Models\Size::where('size_name',$product['size'])->first()?->id;
                                            $pkey = $productData->id.'_'.$color.'_'.$size;
                                            $productColorImages = App\Models\ProductColorImage::where('color_id',$color)->where('product_id',$productData->id)->first()?->image_path;
                                            $images = json_decode($productColorImages);

                                            @endphp
                                            <!-- First Row -->
                                            <tr class="item-row item_{{ $productData->modelNumber->id }}" data-model-id="{{ $productData->modelNumber->id }}" data-id="{{ $pkey }}" data-color-id="{{ $color }}" data-size-id="{{ $size }}" data-product-id="{{ $productData->id }}">
                                                <td>
                                                    <div class="item-details">
                                                        <div class="img">
                                                            <img src="{{ (isset($images[0]))?Storage::url($images[0]): asset('assets/front/images/frost.png') }}" alt="Olive Hat" class="item-img">
                                                        </div>
                                                        <div class="item-info">
                                                            <p>{{ $productData->modelNumber->model_number }}</p>
                                                            <p>{{ $product['color'] }}</p>
                                                            <p>Logo Placement: {{ ($product['front_location'])??'' }}</p>
                                                            <p>Embroidery: {{ ($product['embroidery_type'])??'' }}</p>
                                                            <p>Back & Side Stitching: {{ ($product['side_location'])??'' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="frostimg">
                                                        <img src="{{ asset('assets/front/images/frost.png') }}" alt="Logo" class="logo-file">
                                                    </div>
                                                </td>
                                                <td>{{ $product['size'] }}</td>
                                                <td>
                                                    <div class="qty-control">
                                                        <button type="button" onclick="decreaseQty('{{ $pkey }}')">−</button>
                                                        <input type="text" class="item-qty" data-id="{{ $pkey }}" data-model-id="{{ $productData->modelNumber->id }}" data-c-id="{{ $color }}" data-color-id="{{ $product['color'] }}" data-size-id="{{ $product['size'] }}" data-product-id="{{ $productData->id }}" value="{{ $product['qty'] }}" readonly name="qty[{{ $pkey }}]">
                                                        <button type="button" onclick="increaseQty('{{ $pkey }}')">+</button>
                                                    </div>
                                                </td>
                                                <td class="item_price_{{ $productData->modelNumber->id }}" id="price-{{ $pkey }}">$24.00
                                                    <input type="hidden" id="price-input-{{ $pkey }}" name="price[{{ $pkey }}]" value="24.00">
                                                </td>
                                                <td class="subtotal sub_total_{{ $productData->modelNumber->id }}" data-value="240.00" id="subtotal-{{ $pkey }}">$240.00
                                                    <input type="hidden" id="subtotal-input-{{ $pkey }}" name="subtotal[{{ $pkey }}]" value="240.00">
                                                </td>

                                                <td>
                                                    <button type="button" data-color-id="{{ $color }}" data-size-id="{{ $size }}" class="cancel-btn" onclick="removeItem(2)">&#x2715;</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            <!-- Second Row -->

                                        </tbody>
                                    </table>

                                    <div class="total-container">
                                        <p>Total: <span id="total">$720.00</span></p>
                                        <input type="hidden" name="total_amount" id="total_amount" value="720.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!Auth::check())
                    <button class="accordion-toggle">
                        <h4><img src="{{ asset('assets/front/images/haveAcc.png') }}" alt=""> Have an <span>Account?</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="haveAnAccount">
                            <div class="accorTop">
                                <div class="auth-container">
                                    <div class="login-section">
                                        <h2>Login to Your Account</h2>
                                        <div class="alert alert-info validation" style="display: none;">
                                            <p class="text-left"></p>
                                        </div>
                                        <div class="alert alert-success validation" style="display: none;">
                                            <button type="button" class="close alert-close"><span>×</span></button>
                                            <p class="text-left"></p>
                                        </div>
                                        <div class="alert alert-danger validation" style="display: none;">
                                            <button type="button" class="close alert-close"><span>×</span></button>
                                            <p class="text-left"></p>
                                        </div>
                                        <form id="loginform1" class="login-form" action="{{ route('user.login.submit') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" placeholder="Password" required>
                                            </div>
                                            <button type="submit" class="haveAnAccountBtn">Login</button>
                                        </form>
                                    </div>

                                    <div class="or-divider">
                                        <span>or</span>
                                    </div>

                                    <div class="register-section">
                                        <h2>Register New Account</h2>
                                        <p>You don't have an account with Busy Bee Embroidery?<br> Create a new account using the button below.</p>
                                        <a href="{{ route('user.register') }}" class="haveAnAccountBtn">Register</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif






                    <button class="accordion-toggle">
                        <h4><img src="{{ asset('assets/front/images/shippingAdd.png') }}" alt=""> Shipping & Billing <span>Address</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="billingSection">
                            <div class="accorTop">
                                <div class="form-container">
                                    <p style="margin-bottom: 10px;">Shipping Address</p>
                                    <div class="row">
                                        <div class="form-group">
                                            <input type="text" id="shipping_name" placeholder="Full Name" name="shipping_name">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group full-width">
                                            <input type="text" id="shipping_address1" name="shipping_address1" placeholder="Address Line 1" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group full-width">
                                            <input type="text" id="shipping_address2" name="shipping_address2" placeholder="Address Line 2">
                                        </div>
                                    </div>

                                    <<<<<<< HEAD=======>>>>>>> 9f509426e4b81697ea47f80d2acc136fda684c48

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="shipping_country" name="shipping_country" value="USA" placeholder="Country">
                                            </div>
                                            <div class="form-group d-none select_state">
                                                <input type="text" id="shipping_state" name="shipping_state" placeholder="State">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" name="shipping_city" id="shipping_city" placeholder="Suburb/City">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="shipping_postcode" id="shipping_postcode" placeholder="Postcode">
                                            </div>
                                        </div>

                                        <div class="row checkbox-group">
                                            <input type="checkbox" id="same-address" name="same_address">
                                            <label for="same-address">Shipping and Billing address are same</label>
                                        </div>



                                </div>
                                <div class="form-container">
                                    <!-- <div class="row checkbox-group">
                                        <input type="checkbox" id="same-address" name="same_address">
                                        <label for="same-address">Shipping and Billing address are same</label>
                                    </div> -->

                                    <<<<<<< HEAD=======<p style="margin-bottom: 10px;">Billing Address</p>

                                        >>>>>>> 9f509426e4b81697ea47f80d2acc136fda684c48
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="billing_name" name="billing_name" placeholder="Full Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="billing_address1" name="billing_address1" placeholder="Address Line 1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="billing__address2" name="billing_address2" placeholder="Address Line 2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="billing_country" name="billing_country" placeholder="Country">
                                            </div>
                                            <div class="form-group d-none select_state">
                                                <input type="text" id="billing_state" name="billing_state" placeholder="State">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" name="billing_city" id="billing_city" placeholder="Suburb/City">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="billing_postcode" id="billing_postcode" placeholder="Postcode">
                                            </div>
                                        </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 
                    <button class="accordion-toggle">
                        <h4><img src="{{ asset('assets/front/images/billingAdd.png') }}" alt=""> Billing <span>Address</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="billingSection">
                            <div class="accorTop">
                                <div class="form-container">
                                    <div class="row checkbox-group">
                                        <input type="checkbox" id="same-address" name="same_address">
                                        <label for="same-address">Shipping and Billing address are same</label>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <input type="text" id="billing_name" name="billing_name" placeholder="Full Name">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group full-width">
                                            <input type="text" id="billing_address1" name="billing_address1" placeholder="Address Line 1">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group full-width">
                                            <input type="text" id="billing__address2" name="billing_address2" placeholder="Address Line 2">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <input type="text" id="billing_country" name="billing_country" placeholder="Country">
                                        </div>
                                        <div class="form-group d-none select_state">
                                            <input type="text" id="billing_state" name="billing_state" placeholder="State">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <input type="text" name="billing_city" id="billing_city" placeholder="Suburb/City">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="billing_postcode" id="billing_postcode" placeholder="Postcode">
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div> -->

                    <button class="accordion-toggle shipping_method" style="display: flex;">
                        <h4><img src="{{ asset('assets/front/images/billingAdd.png') }}" alt=""> Shipping <span>Method</span></h4>
                    </button>
                    <div class="accordion-content shipping_method" style="display: block;">
                        <div class="billingSection">
                            <div class="accorTop">
                                <div class="form-container payment-options label-container" id="shipping_method_list">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="accordion-toggle">
                        <h4><img src="{{ asset('assets/front/images/billingAdd.png') }}" alt=""> Make a <span>Payment</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="makeAPayment" style="display: none;">
                            <div class="accorTop">
                                <div class="payment-form-container">

                                    <div class="total-container" id="amount_div">
                                        <p style="margin-bottom: 10px;">Total: <span style="font-weight:800;" id="paytotal" data-value="720.00">$720.00</span></p>
                                        <p style="margin-bottom: 10px;">Shipping Charge: <span style="font-weight:800;" id="shipping_charge">$720.00</span></p>
                                        <p>-------------------------------------</p>
                                        <p style="margin-bottom: 10px;">Total Payable Amount: <span style="font-weight:800;" id="payable_amount">$720.00</span></p>
                                        <input type="hidden" name="total_amount" id="total_pay_amount" value="720.00">
                                    </div>

                                    <!-- Payment Options -->
                                    <div class="payment-options">
                                        <label>
                                            <input type="radio" name="payment_type" value="full" checked>
                                            <span>Make Full Payment</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="payment_type" value="half">
                                            <span>Place a $30 deposit to secure your order</span>
                                        </label>

                                    </div>



                                    <!-- Card Details -->




                                    <!-- Place Order Button -->
                                    <div class="row">
                                        <p><strong>You will receive a mockup from one of our professional digital graphic designers to ensure your custom apparel order is exactly what you want it before production begins. We will make as many edits as it takes to get it right. If you are still not satisfied with the result at the end of the mockup approval, we will issue a 100% refund.</strong></p>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <input type="hidden" id="shipping-cost" name="shipping_cost" value="0">
                                        <input type="hidden" id="shipping-name" name="shipping_lebel" value="">
                                        <input type="hidden" id="packing-cost" name="packing_cost" value="0">
                                        <input type="hidden" id="shipping-title" name="shipping_title" value="0">
                                        <input type="hidden" id="packing-title" name="packing_title" value="0">
                                        <input type="hidden" id="input_tax" name="tax" value="">
                                        <input type="hidden" id="input_tax_type" name="tax_type" value="">
                                        <input type="hidden" name="currency_sign" value="{{ $curr->sign }}">
                                        <input type="hidden" name="currency_name" value="{{ $curr->name }}">
                                        <input type="hidden" name="currency_value" value="{{ $curr->value }}">
                                        <input type="hidden" name="amount" id="payment-amount" value="1">
                                        <!-- <button type="submit" class="btn-place-order">Place Order</button> -->
                                    </div>

                </form>

                <form id="payment-form">


                    <div id="card-element"><!-- Stripe card input element --></div>
                    <br>
                    <br>

                    <div id="card-errors" role="alert"></div>
                    <br>

                    <br>

                    <button id="submit" class="btn-place-order">Place Order</button>
                </form>


            </div>
        </div>
    </div>
</div>
@endif
</div>
</div>

</div>
</div>

<!-- <div class="relatedProd">
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
</div> -->
</div>




@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmcmf6w_4MAPQkuyvAZylbf28XvsO4kzs&libraries=places"></script>


@php
$const = $productt->constant;
@endphp
<script>
    var pid = $('.customize_product_id').val();
    var token = '{{ csrf_token() }}'
    var stripe_key = '{{ \Config::get("services.stripe.key") }}';
    // alert(stripe_key);
    var constant = @php echo $const;
    @endphp;


    if (document.getElementById('card-element')) {




        const stripe = Stripe(stripe_key);
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '18px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Get the total amount from the hidden input

        let totalAmount = parseFloat($('#total_pay_amount').val());
        // Update payment amount based on selected payment type
        document.querySelectorAll('input[name="payment_type"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                let amount;
                if (this.value === 'full') {
                    totalAmount = totalAmount; // Full payment
                } else {
                    totalAmount = 30; // Deposit amount
                }
                document.getElementById('payment-amount').value = totalAmount.toFixed(2);
            });
        });

        const paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData($('#checkoutForm')[0]);
            // Create a token using card details

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    formData.append('stripeToken', result.token.id);
                    //totalAmount
                    formData.append('pay_amount', totalAmount);

                }
            }).then(function() {
                $.ajax({
                    type: "POST",
                    url: mainurl + '/checkout/payment/stripe-submit',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        if (response.is_success) {
                            toastr.success(response.message);
                            window.location.href = response.url;
                            // $('.card-body').html(
                            //     '<div class="text-center gallery" id="success_loader"> <img src="{{ asset('
                            //     assets / images / success.gif ') }}" class="" /><br><br><h2 class="w-100 ">' +
                            //     response.message + '</h2></div>');
                            // // alert('here');

                            // $('#nextBtn').removeAttr('disabled');
                            // $('#nextBtn').html(' Submit');
                        } else {
                            toastr.error(response.message);
                            // $('#nextBtn').removeAttr('disabled');
                            // $('#nextBtn').html(' Submit')
                            // showTab(0);
                        }
                    },
                    error: function(error) {
                        toastr.error('Something went wrong');
                    }
                });
            });


        });

    }


    function initAutocomplete() {
        // Create the autocomplete object, restricting to addresses in the USA
        var autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('shipping_address1'), {
                types: ['address'], // Restrict to address types
                componentRestrictions: {
                    country: 'US'
                }, // Restrict to the USA
                fields: ['address_components', 'geometry'] // Fetch address components and geometry
            }
        );

        // Add listener for place changed event
        autocomplete.addListener('place_changed', function() {
            // Get the place details from the autocomplete object
            var place = autocomplete.getPlace();

            if (!place.address_components) {
                return;
            }

            // Variables to store parsed address components
            var city = '',
                state = '',
                postcode = '';

            // console.log('Place:', place);


            // Loop through address components and assign them to appropriate variables
            $.each(place.address_components, function(i, component) {

                var place = autocomplete.getPlace();
                var types = component.types;
                for (var i = 0; i < place.address_components.length; i++) {
                    // console.log(place.address_components);

                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {
                            console.log(place.address_components[i]);
                            postcode = place.address_components[i].long_name;

                        }
                        if (place.address_components[i].types[j] == "locality") {
                            console.log(place.address_components[i]);
                            city = place.address_components[i].long_name;

                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_1") {
                            console.log(place.address_components[i]);
                            state = place.address_components[i].short_name;

                        }
                    }
                }

                // console.log('Component:', component, 'Types:', types);

                // if ($.inArray('locality', types) !== -1) {
                //     city = component.long_name; // Extract city
                // }
                // if ($.inArray('administrative_area_level_1', types) !== -1) {
                //     state = component.short_name; // Extract state (short name, like 'CA' for California)
                // }
                // if ($.inArray('postal_code', types) !== -1) {
                //     postcode = component.long_name; // Extract postal code
                // }
            });

            console.log('City:', city, 'State:', state, 'Postal Code:', postcode);


            // Create or update form fields for state, city, and postcode
            updateOrAppendField('#shipping_state', 'State', state);
            updateOrAppendField('#shipping_city', 'City', city);
            updateOrAppendField('#shipping_postcode', 'Postal Code', postcode);

            getShippingMethods(city, state, postcode);
        });
    }


    function getShippingMethods(city, state, postcode) {

        var totalQty = 0;

        $('.item-qty').each(function() {
            totalQty += parseInt($(this).val());
        });



        $.ajax({
            url: mainurl + '/user/get-shipping-methods', // Laravel route to get shipping methods
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                total_qty: totalQty,
                city: city,
                state: state,
                postcode: postcode

            },
            success: function(response) {
                if (response.is_success) {
                    console.log('Shipping methods retrieved');
                    console.log(response.data);

                    // Clear the shipping method list
                    $('#shipping_method_list').empty();

                    // Loop through the shipping methods and append them to the list
                    $.each(response.data, function(index, method) {
                        var methodHtml = `<label>
                                            <input type="radio" id="shipping_method_${method.serviceCode}" name="shipping_method" value="${method.serviceCode}" data-cost="${method.shipmentCost}">
                                            <span>${method.serviceName} - ${method.shipmentCost}</span>
                                        </label>
                                <label>`;
                        $('#shipping_method_list').append(methodHtml);
                    });

                    // Show the shipping method section
                    $('.shipping_method').show();
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }

    $(document).on('change', 'input[name="shipping_method"]', function() {

        let baseTotal = parseFloat($('#paytotal').data('value'));
        // Get the shipping cost from the selected radio button's data-cost attribute
        let shippingCost = parseFloat($(this).data('cost'));

        $('#shipping-cost').val(shippingCost);
        //set lable text in hidden input
        $('#shipping-name').val($(this).next().text());

        // Update the shipping charge display
        $('#shipping_charge').text('$' + shippingCost.toFixed(2));

        // Calculate the new total payable amount
        // alert(baseTotal);
        // alert(shippingCost);
        let totalPayable = baseTotal + shippingCost;

        // Update the total payable amount display
        $('#payable_amount').text('$' + totalPayable.toFixed(2));

        // Update the hidden total amount input field
        $('#total_pay_amount').val(totalPayable.toFixed(2));

        // Show the amount div if it is hidden
        $('.makeAPayment').show();
    });

    // Function to append or update form fields dynamically
    function updateOrAppendField(selector, label, value) {
        // Check if the field already exists
        if ($(selector).length) {
            $(selector).val(value); // Update the value if the field exists
        } else {
            // If the field doesn't exist, append it
            var fieldHtml = `
        <div class="row appended-field">
          <div class="form-group full-width">
            <label>${label}</label>
            <input type="text" id="${selector.substring(1)}" name="${selector.substring(1)}" value="${value}" readonly>
          </div>
        </div>`;
            $('#shipping_address1').closest('.form-container').append(fieldHtml);
        }
    }

    function getProductSession(productId) {

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
                        var selected_colorIds = response.data.color_ids;
                        // alert(sideEmbroideryLocation)
                        $('.qty').val(1);
                        $('.g3').val(embroideryType);
                        $('.h3').val(frontEmbroidery);
                        $('.i3').val(sideEmbroidery);
                        $('.j3').val(sideEmbroideryLocation);
                        $('.k3').val(backEmbroidery);
                        $('.l3').val(backEmbroideryLocation);

                        // Set the selected colors in hidden input
                        //set selected_colorIds array in local storage product id wise
                        var itemsavedData = localStorage.getItem('selected_colors_' + pid);
                        // alert(itemsavedData);
                        if (itemsavedData) {
                            let colorIdsArray = JSON.parse(itemsavedData);
                        } else {
                            let colorIdsArray = [];
                            //selected_colorIds push in array
                            colorIdsArray.push(selected_colorIds);
                            //set array in local storage
                            localStorage.setItem('selected_colors_' + pid, JSON.stringify(colorIdsArray));
                        }




                        if (sideEmbroidery == 'yes') {
                            $('.side_location').show();
                        } else {
                            $('.side_location').hide();
                        }

                        if (backEmbroidery == 'yes') {
                            $('.back_location').show();
                        } else {
                            $('.back_location').hide();
                        }


                        // alert(colorIdsArray);
                        getallItems();
                    }


                    constantCalculation();

                }
            }
        });
    }

    $(document).ready(function() {



        var pid = $('.customize_product_id').val();
        getProductSession(pid);

        initAutocomplete();

        setTimeout(() => {


            $('.item-row').each(function() {
                var model = $(this).data('model-id');
                var totalmodelqty = 0;
                $('.item-row').each(function() {
                    if ($(this).data('model-id') == model) {
                        totalmodelqty += parseInt($(this).find('.item-qty').val());
                    }
                });
                let pid = $(this).find('.item-qty').data('product-id');
                let index = $(this).find('.item-qty').data('id');
                constantCalculation(totalmodelqty, pid, index, model);
            });

            const totalAmount = parseFloat($('#total_amount').val());

            $('#payment-amount').val(totalAmount);

        }, 500);



        $(document).on('change', '#same-address', function() {
            if ($(this).is(':checked')) {
                $('#billing_name').val($('#shipping_name').val());
                $('#billing_address1').val($('#shipping_address1').val());
                $('#billing_address2').val($('#shipping_address2').val());
                $('#billing_country').val($('#shipping_country').val());
                $('#billing_state').val($('#shipping_state').val());
                $('#billing_city').val($('#shipping_city').val());
                $('#billing_postcode').val($('#shipping_postcode').val());
            } else {
                $('#shipping_name').val('');
                $('#shipping_address1').val('');
                $('#shipping_address2').val('');
                $('#shipping_country').val('USA');
                $('#shipping_state').val('');
                $('#shipping_city').val('');
                $('#shipping_postcode').val('');
            }
        });


        let original_tax = 0;

        // var mship = $('.shipping').length > 0 ? $('.shipping').first().val() : 0;
        // var mpack = $('.packing').length > 0 ? $('.packing').first().val() : 0;


        // var ship_title = $('.shipping').length > 0 ? $('.shipping').first().attr('data-form') : '';
        // var pack_title = $('.packing').length > 0 ? $('.packing').first().attr('data-form') : '';


        // mship = parseFloat(mship);
        // mpack = parseFloat(mpack);

        // $(document).on('change', '#select_country', function() {

        //     $(this).attr('data-href');
        //     let state_id = 0;
        //     let country_id = $('#select_country option:selected').attr('data');
        //     let is_state = $('option:selected', this).attr('rel');
        //     let is_auth = $('option:selected', this).attr('rel1');
        //     let is_user = $('option:selected', this).attr('rel5');
        //     let state_url = $('option:selected', this).attr('data-href');
        //     if (is_auth == 1 || is_state == 1) {
        //         if (is_state == 1) {
        //             $('.select_state').show();
        //             $.get(state_url, function(response) {
        //                 $('#show_state').html(response.data);
        //                 // if (is_user == 1) {
        //                 //     tax_submit(country_id, response.state);
        //                 // } else {
        //                 //     tax_submit(country_id, state_id);
        //                 // }

        //             });

        //         } else {
        //             tax_submit(country_id, state_id);
        //             hide_state();
        //         }

        //     } else {

        //         tax_submit(country_id, state_id);
        //         hide_state();
        //     }

        // });



        $('#logo-upload').on('change', function(e) {
            var files = e.target.files; // Get the list of files
            $('.file-name').text(files.length + (files.length > 1 ? ' files selected' : ' file selected'));

            // Clear existing logo containers
            // $('#file-list').empty();

            if (files.length > 0) {
                // Loop through each file
                Array.from(files).forEach(function(file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // Create a new logo container for each image
                        var logoContainer = $('<div>', {
                            class: 'logo-container'
                        });

                        // Create an image preview
                        var preview = $('<img>', {
                            src: e.target.result,
                            class: 'logo-preview',
                            alt: 'Logo Preview',
                            css: {
                                width: '100px',
                                height: '100px',
                                margin: '5px'
                            } // Optional: set size and spacing
                        });

                        // Append the image to the logo container
                        logoContainer.append(preview);

                        // Append the logo container to the drop area
                        $('#file-list').append(logoContainer);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                $('#drop-area').html('<span class="drag-text">Drag and drop here</span>');
                $('.file-name').text('No File Selected');
            }
        });




    });







    function removeCart(size, color, p_id = 0) {
        if (p_id != 0) {
            var pid = p_id;
        } else {
            var pid = '{{ $productt->id }}';
        }

        var itemid = pid + size + color;
        var size_qty = '';
        var size_price = 0;

        // var qty = parseInt($("#qty" + itemid).val());

        var minimum_qty = 1
        // $(".gocover").show();

        // $(".gocover").show();

        // $("#qty" + itemid).val(qty);
        $.ajax({
            type: "GET",
            url: mainurl + "/reducebyone",
            data: {
                id: pid,
                itemid: itemid,
                size_qty: size_qty,
                size_price: size_price,
            },
            success: function(data) {
                if (data.qty >= 1) {
                    $.get(mainurl + "/carts", function(response) {
                        $(".load_cart").html(response);
                    });
                } else {
                    return false;
                }
            },
        });

    }


    function addCart(qty = 1, size, color) {
        var pid = '{{ $productt->id }}';
        var size_qty = null;
        var size_price = null;
        var size_key = null;
        var values = '';
        var keys = '';
        if ($(".product-attr").length > 0) {
            values = $(".product-attr:checked")
                .map(function() {
                    return $(this).val();
                })
                .get();

            keys = $(".product-attr:checked")
                .map(function() {
                    return $(this).data("key");
                })
                .get();

            prices = $(".product-attr:checked")
                .map(function() {
                    return $(this).data("price");
                })
                .get();

            if (!isNaN(size_qty)) {
                if (size_qty == "0") {
                    toastr.error(lang.cart_out);
                    return false;
                }
            } else {
                size_qty = null;
            }
        }

        $.ajax({
            type: "GET",
            url: mainurl + "/addnumcart",
            data: {
                id: pid,
                qty: qty,
                size: size,
                color: color,
                size_qty: size_qty,
                size_price: size_price,
                size_key: size_key,
                keys: keys,
                values: values,
                prices: prices,
            },
            success: function(data) {
                if (data == "digital") {
                    toastr.error("Already Added To Cart");
                } else if (data == 0) {
                    toastr.error("Out Of Stock");
                } else if (data[3]) {
                    toastr.error(lang.minimum_qty_error + " " + data[4]);
                } else {
                    $("#cart-count").html(data[0]);
                    $("#cart-count1").html(data[0]);
                    $(".cart-popup").load(mainurl + "/carts/view");
                    $("#cart-items").load(mainurl + "/carts/view");
                    toastr.success("Successfully Added To Cart");
                }
            },
        });
    }


    function updateProductSession(productId, selectedColorid = '') {

        var quantity = $('.qty').val();
        var embroideryType = $('.g3').val();
        var frontEmbroidery = $('.h3').val();
        var sideEmbroidery = $('.i3').val();
        var sideEmbroideryLocation = $('.j3').val();
        var backEmbroidery = $('.k3').val();
        var backEmbroideryLocation = $('.l3').val();


        //selectedColor push to array only sleected color



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
                color_ids: selectedColorid
            },
            success: function(response) {
                if (response.success) {
                    console.log('Product session updated');
                    constantCalculation();
                }
            }
        });
    }








    var f3 = parseInt($('.qty').val()) || 0;





    $(document).on('click', '.plus-btn', function(e) {
        var quantityInput = $(this).siblings('.quantity-input');
        var currentValue = parseInt(quantityInput.val());
        let qty = 0;
        if (!isNaN(currentValue)) {
            quantityInput.val(currentValue + 1);
            newqty = currentValue + 1
            f3 += 1;
            totalQty();
            // $('.qty').val(f3);
            var pid = '{{ $productt->id }}';
            let color = $(quantityInput).data('color-id');
            let size = $(quantityInput).data('size-id');
            qty = $(quantityInput).val();
            addCart(1, size, color);
            let selectedColorId = $(this).closest('.accorBoxRight').find('input[name="color_id[]"]').val(); // Get the color ID
            // alert(selectedColorId);
            updateProductSession(pid, selectedColorId);

            constantCalculation();

            updateColorId(selectedColorId, qty);



        }
        // let colorId = $(quantityInput).data('id');
        // updatecolorIds(pid, colorId, qty, token);
    });


    function updateColorId(selectedColorId, qty) {
        setTimeout(() => {
            var colorIds = [];
            var itemsavedData = localStorage.getItem('selected_colors_' + pid);
            // alert(itemsavedData);

            if (itemsavedData) {
                let colorIdsArray = JSON.parse(itemsavedData);
                if (!colorIdsArray.includes(selectedColorId)) {
                    // If the new colorId doesn't exist, push it to the array
                    colorIdsArray.push(selectedColorId);

                    // Update localStorage with the updated array
                    localStorage.setItem('selected_colors_' + pid, JSON.stringify(colorIdsArray));
                    console.log('Color ID added and localStorage updated:', colorIdsArray);
                } else {
                    //if qty is 0 then remove color id from array
                    if (qty == 0) {
                        colorIdsArray = colorIdsArray.filter(function(item) {
                            return item !== selectedColorId;
                        });
                        localStorage.setItem('selected_colors_' + pid, JSON.stringify(colorIdsArray));
                        console.log('Color ID removed and localStorage updated:', colorIdsArray);
                    }
                    console.log('Color ID already exists:', selectedColorId);
                }
            }


            getallItems();

        }, 500);
    }

    function totalQty() {
        setTimeout(() => {
            var sum = 0;
            $('.color-quantity').each(function() {
                var value = parseInt($(this).val());
                if (!isNaN(value)) {
                    sum += parseInt(value);
                }
            });
            // alert(sum);
            $('.qty').val(sum);
        }, 500);
    }


    function getallItems(colorIds = [], qty = 0, token = '') {


        var colorIdsArray = localStorage.getItem('selected_colors_' + pid);
        // alert(colorIdsArray);
        colorIdsArray = JSON.parse(colorIdsArray);
        // alert(colorIdsArray);


        $.ajax({
            url: mainurl + "/get-all-items",
            type: 'POST',
            data: {
                selected_color: colorIdsArray,
                product_id: pid,
                _token: '{{ csrf_token() }}',
                qty: qty,


            },
            success: function(response) {
                // Assuming the response contains an array of image URLs
                if (response.success) {

                    $('#itemDetails').html(response.html);

                    totalQty();
                    // console.log(itemsavedData);


                    var swiper = new Swiper(".hatQuantitySlider", {
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });


                } else {
                    console.log('Error:', response);
                }


            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });

    }

    $(document).on('click', '.minus-btn', function(e) {
        var quantityInput = $(this).siblings('.quantity-input');
        var currentValue = parseInt(quantityInput.val());
        let qty = 0;
        if (!isNaN(currentValue) && currentValue > 0) {
            quantityInput.val(currentValue - 1);

            f3 -= 1;
            totalQty();
            // $('.qty').val(f3);
            var pid = '{{ $productt->id }}';

            let color = $(quantityInput).data('color-id');
            let size = $(quantityInput).data('size-id');
            qty = $(quantityInput).val();
            removeCart(size, color);
            let selectedColorId = $(this).closest('.accorBoxRight').find('input[name="color_id[]"]').val(); // Get the color ID

            updateProductSession(pid, selectedColorId);


            constantCalculation();


            updateColorId(selectedColorId, qty);


        }
        let colorId = $(quantityInput).data('id');
        // updatecolorIds(pid, colorId, qty, token);
    });
    $(document).on('change', '.k3, .h3, .g3, .i3, .j3, .l3', function(e) {
        // alert($(this).val());
        var pid = $('.customize_product_id').val();

        updateProductSession(pid);
        constantCalculation();
    });

    $(document).on('change', '.k3', function(e) {

        if ($(this).val() == 'yes') {
            $('.back_location').show();
            $('.l3').val('');

        } else {
            $('.back_location').hide();
            $('.l3').val('');
        }
        constantCalculation();
    });



    function selectEmbBox(selectedBox) {
        var selectedBox = $(selectedBox);
        selectedBox.toggleClass('selected');
        selectedBox.siblings().removeClass('selected');

        //checkbox toggle selected class
        var checkbox = selectedBox.find('.checkbox');
        checkbox.toggleClass('selected');
        checkbox.siblings().removeClass('selected');

    }

    function selectlogoBox(selectedBox) {
        var selectedBox = $(selectedBox);
        selectedBox.toggleClass('selected');
        selectedBox.siblings().removeClass('selected');

        //checkbox toggle selected class
        var checkbox = selectedBox.find('.checkbox');
        checkbox.toggleClass('selected');
        checkbox.siblings().removeClass('selected');
    }






    $(document).on('change', '.i3', function(e) {
        // alert('yes');
        if ($(this).val() == 'yes') {
            $('.side_location').show();
            $('.j3').val('');
        } else {
            $('.side_location').hide();
            $('.j3').val('');
        }
        constantCalculation();
    });






    function updateF3Value() {
        var totalQuantity = 0;

        // Loop through all quantity inputs and calculate the total
        $('.quantity-input').each(function() {
            var currentValue = parseInt($(this).val());
            if (!isNaN(currentValue)) {
                totalQuantity += currentValue;
            }
        });

        // Update the global f3 value
        $('.qty').val(totalQuantity); // Assuming #f3 is an input or element that holds the f3 value
    }








    // ----------------product Slider ------------------- 
    var swiper = new Swiper(".hatQuantitySlider", {
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








    window.addEventListener('scroll', function() {
        const stickyElement = document.querySelector('.stickyClass');
        const points = document.querySelector('.stickyClass .points');
        const stickyParent = stickyElement.parentElement;



        const stickyOffset = stickyParent.offsetTop;

        const screenWidth = window.innerWidth;

        if (screenWidth > 1206) {
            if (window.pageYOffset > stickyOffset) {
                stickyElement.classList.add('sticky');
                points.classList.add('pointsHidden');

            } else {
                stickyElement.classList.remove('sticky');
                points.classList.remove('pointsHidden');
            }
        } else {
            stickyElement.classList.remove('sticky');
            points.classList.remove('pointsHidden');
        }
    });


    // ----------------related Slider -------------------
</script>

<script src="{{ asset('assets/front/js/jquery.elevatezoom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/front/js/calculation.js') }}"></script>
<script src="{{ asset('assets/front/js/purchase.js') }}"></script>



@endsection