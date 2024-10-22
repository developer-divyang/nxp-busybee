@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/checkout.css')}}">
@endsection
@section('content')

<div class="purchase-section">
    <div class="tabsSection">
        <div class="tab-container">
            <!-- <ul class="tabs">
                    <li class="tab active" data-target="select-type">Select Type</li>
                    <li class="tab disabled" data-target="items">Items</li>
                    <li class="tab disabled" data-target="artwork">Artwork</li>
                    <li class="tab disabled" data-target="checkout">Checkout</li>
                </ul> -->
            <div class="tab-content">

                <div id="checkout" class="content active">
                    <form id="" action="{{ route('front.cod.submit') }}" method="POST" class="checkoutform">
                        @csrf
                        <button class="accordion-toggle">
                            @if($products)
                            <h4><img src="{{asset('assets/front/images/orderSum.png' )}}" alt=""> Order <span>Summary</span></h4>
                            @else
                            <h4><img src="{{asset('assets/front/images/orderSum.png' )}}" alt=""> Your <span>Cart is Empty</span></h4>
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

                                                <tr class="item-row item_{{ $productData->modelNumber->id }}" data-model-id="{{ $productData->modelNumber->id }}" data-id="{{ $pkey }}" data-color-id="{{ $color }}" data-size-id="{{ $size }}" data-product-id="{{ $productData->id }}">
                                                    <td>
                                                        <div class="item-details">
                                                            <div class="img">
                                                                <input type="hidden" name="product_constant[]" id="constant_{{ $pkey }}" value="{{ $productData->constant }}">
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
                                                            <input type="text" class="item-qty" data-id="{{ $pkey }}" data-model-id="{{ $productData->modelNumber->id }}" data-color-id="{{ $product['color'] }}" data-size-id="{{ $product['size'] }}" data-product-id="{{ $productData->id }}" value="{{ $product['qty'] }}" readonly name="qty[{{ $pkey }}]">
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
                                                        <button data-color-id="{{ $color }}" data-size-id="{{ $size }}" class="cancel-btn" onclick="removeItem(2)">&#x2715;</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif

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

                        @if(!Auth::check())
                        <button class="accordion-toggle">
                            <h4><img src="images/haveAcc.png" alt=""> Have an <span>Account?</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="haveAnAccount">
                                <div class="accorTop">
                                    <div class="auth-container">
                                        <div class="login-section">
                                            <h2>Login to Your Account</h2>
                                            <form id="loginform1" class="login-form" action="{{ route('user.login.submit') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="email" placeholder="Email Address" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" placeholder="Password" required>
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
                            <h4><img src="images/billingAdd.png" alt=""> Billing <span>Address</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="billingSection">
                                <div class="accorTop">
                                    <div class="form-container">

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
                                                <select class="form-control" id="billing_country" name="billing_country" required="">
                                                    @include('includes.countries')
                                                </select>
                                            </div>
                                            <div class="form-group d-none select_state">
                                                <select class="form-control " id="billing_state" name="billing_state">

                                                </select>
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

                                        <div class="row checkbox-group">
                                            <input type="checkbox" id="same-address" name="same_address">
                                            <label for="same-address">Shipping and Billing address are same</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="accordion-toggle">
                            <h4><img src="{{ asset('assets/front/images/shippingAdd.png') }}" alt=""> Shipping <span>Address</span></h4>
                        </button>
                        <div class="accordion-content">
                            <div class="billingSection">
                                <div class="accorTop">
                                    <div class="form-container">

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="shipping_name" placeholder="Full Name" name="shipping_name">
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="shipping_address1" name="shipping_address1" placeholder="Address Line 1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="shipping_address2" name="shipping_address2" placeholder="Address Line 2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <select class="form-control" id="shipping_country" name="shipping__country" required="">
                                                    @include('includes.countries')
                                                </select>
                                            </div>
                                            <div class="form-group d-none select_state">
                                                <select class="form-control " id="shipping_state" name="shipping__state">

                                                </select>
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



                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="accordion-toggle">
                            <h4><img src="images/billingAdd.png" alt=""> Make a <span>Payment</span></h4>
                        </button>

                        <div class="accordion-content">
                            <div class="makeAPayment">
                                <div class="accorTop">
                                    <div class="payment-form-container">

                                        <!-- Payment Options -->
                                        <div class="payment-options">
                                            <label>
                                                <input type="radio" name="payment-type" value="full" checked>
                                                <span>Make Full Payment</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="payment-type" value="half">
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
                                            <input type="hidden" id="packing-cost" name="packing_cost" value="0">
                                            <input type="hidden" id="shipping-title" name="shipping_title" value="0">
                                            <input type="hidden" id="packing-title" name="packing_title" value="0">
                                            <input type="hidden" id="input_tax" name="tax" value="">
                                            <input type="hidden" id="input_tax_type" name="tax_type" value="">
                                            <input type="hidden" name="currency_sign" value="{{ $curr->sign }}">
                                            <input type="hidden" name="currency_name" value="{{ $curr->name }}">
                                            <input type="hidden" name="currency_value" value="{{ $curr->value }}">
                                            <!-- <button type="submit" class="btn-place-order">Place Order</button> -->
                                        </div>

                    </form>

                    <form id="payment-form">
                        <input type="hidden" name="amount" id="payment-amount" value="720.00"> <!-- Default to full amount -->

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
</div>

@endsection
@section('script')
<script src="https://js.stripe.com/v3/"></script>


<script>
    var token = '{{ csrf_token() }}'
    var stripe_key = '{{ \Config::get("services.stripe.key") }}';
    // alert(stripe_key);



    if (document.getElementById('card-element')) {




        const stripe = Stripe(stripe_key);
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Get the total amount from the hidden input
        const totalAmount = parseFloat(document.getElementById('total_amount').value);

        // Update payment amount based on selected payment type
        document.querySelectorAll('input[name="payment-type"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                let amount;
                if (this.value === 'full') {
                    amount = totalAmount; // Full payment
                } else {
                    amount = 30; // Deposit amount
                }
                document.getElementById('payment-amount').value = amount.toFixed(2);
            });
        });

        const paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Create a token using card details

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Show error in #card-errors
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // Send the token to your server
                    console.log(result.token);

                    const token = result.token.id;
                    const amount = parseFloat(document.getElementById('payment-amount').value);

                    // Make a request to your server with the token and amount
                    fetch(mainurl + '/checkout/payment/stripe-submit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                token: token,
                                amount: amount
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                // Handle server errors
                                document.getElementById('card-errors').textContent = data.message;
                            } else {
                                // Payment was successful, handle success
                                alert('Payment successful!');
                            }
                        })
                        .catch(error => {
                            document.getElementById('card-errors').textContent = error.message;
                        });
                }
            });
        });

    }
    $(document).ready(function() {


        constantCalculation();

        setTimeout(() => {


            $('.item-row').each(function() {
                var model = $(this).data('model-id');
                var totalmodelqty = 0;
                $('.item-row').each(function() {
                    if ($(this).data('model-id') == model) {
                        totalmodelqty += parseInt($(this).find('.item-qty').val());



                    }
                    let pid = $(this).find('.item-qty').data('product-id');
                    let index = $(this).find('.item-qty').data('id');
                    constantCalculation(totalmodelqty, pid, index, model);
                });




            });

        }, 500);



        $(document).on('change', '#same-address', function() {
            if ($(this).is(':checked')) {
                $('#shipping_name').val($('#billing_name').val());
                $('#shipping_address1').val($('#billing_address1').val());
                $('#shipping_address2').val($('#billing_address2').val());
                $('#shipping_country').val($('#billing_country').val()).trigger('change');
                $('#shipping_state').val($('#billing_state').val());
                $('#shipping_city').val($('#billing_city').val());
                $('#shipping_postcode').val($('#billing_postcode').val());
            } else {
                $('#shipping_name').val('');
                $('#shipping_address1').val('');
                $('#shipping_address2').val('');
                $('#shipping_country').val('').trigger('change');
                $('#shipping_state').val('');
                $('#shipping_city').val('');
                $('#shipping_postcode').val('');
            }
        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/front/js/calculation.js') }}"></script>

<script>
    var swiper = new Swiper(".hatQuantitySlider", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const accorBoxes = document.querySelectorAll('.accorBox');

        accorBoxes.forEach(accorBox => {

            const counterValueElement = accorBox.querySelector('.counter-value');
            const incrementButton = accorBox.querySelector('.increment');
            const decrementButton = accorBox.querySelector('.decrement');

            let counterValue = parseInt(counterValueElement.textContent);

            incrementButton.addEventListener('click', function() {
                counterValue++;
                counterValueElement.textContent = counterValue;
            });

            decrementButton.addEventListener('click', function() {
                if (counterValue > 1) {
                    counterValue--;
                    counterValueElement.textContent = counterValue;
                }
            });
        });
    });
</script>

<script src="{{asset('assets/front/js/checkout.js')}}"></script>

@endsection