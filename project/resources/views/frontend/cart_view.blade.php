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
                                            <!-- First Row -->
                                            <tr>
                                                <td>
                                                    <div class="item-details">
                                                        <div class="img">
                                                            <img src="{{asset('assets/front/images/order1.png') }}" alt="Olive Hat" class="item-img">
                                                        </div>
                                                        <div class="item-info">
                                                            <p>Olive</p>
                                                            <p>Logo Placement: Center</p>
                                                            <p>Embroidery: 3D Puff</p>
                                                            <p>Back & Side Stitching: Left Side</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="frostimg">
                                                        <img src="{{asset('assets/front/images/frost.png' )}}" alt="Logo" class="logo-file">
                                                    </div>
                                                </td>
                                                <td>S/M</td>
                                                <td>
                                                    <div class="qty-control">
                                                        <button onclick="decreaseQty(0)">−</button>
                                                        <input type="text" value="10" id="qty-0" readonly>
                                                        <button onclick="increaseQty(0)">+</button>
                                                    </div>
                                                </td>
                                                <td>$24.00</td>
                                                <td id="subtotal-0">$240.00</td>
                                                <td>
                                                    <button class="cancel-btn">&#x2715;</button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="total-container">
                                        <p>Total: <span id="total">$720.00</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="accordion-toggle">
                        <h4><img src="images/haveAcc.png" alt=""> Have an <span>Account?</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="haveAnAccount">
                            <div class="accorTop">
                                <div class="auth-container">
                                    <div class="login-section">
                                        <h2>Login to Your Account</h2>
                                        <form class="login-form">
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
                                        <button class="haveAnAccountBtn">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <button class="accordion-toggle">
                        <h4><img src="images/billingAdd.png" alt=""> Billing <span>Address</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="billingSection">
                            <div class="accorTop">
                                <div class="form-container">
                                    <form>
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="first-name" placeholder="First Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="last-name" placeholder="Last Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="address-line-1" placeholder="Address Line 1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="address-line-2" placeholder="Address Line 2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <select id="country">
                                                    <option>Select Country</option>
                                                    <!-- Add country options here -->
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select id="state">
                                                    <option>Select State</option>
                                                    <!-- Add state options here -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="city" placeholder="Suburb/City">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="postcode" placeholder="Postcode">
                                            </div>
                                        </div>

                                        <div class="row checkbox-group">
                                            <input type="checkbox" id="same-address">
                                            <label for="same-address">Shipping and Billing address are same</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="accordion-toggle">
                        <h4><img src="images/shippingAdd.png" alt=""> Shipping <span>Address</span></h4>
                    </button>
                    <div class="accordion-content">
                        <div class="billingSection">
                            <div class="accorTop">
                                <div class="form-container">
                                    <form>
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="first-name" placeholder="First Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="last-name" placeholder="Last Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="address-line-1" placeholder="Address Line 1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group full-width">
                                                <input type="text" id="address-line-2" placeholder="Address Line 2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <select id="country">
                                                    <option>Select Country</option>
                                                    <!-- Add country options here -->
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select id="state">
                                                    <option>Select State</option>
                                                    <!-- Add state options here -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="city" placeholder="Suburb/City">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="postcode" placeholder="Postcode">
                                            </div>
                                        </div>

                                        <div class="row checkbox-group">
                                            <input type="checkbox" id="same-address">
                                            <label for="same-address">Shipping and Billing address are same</label>
                                        </div>
                                    </form>
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
                                    <form>
                                        <!-- Payment Options -->
                                        <div class="payment-options">
                                            <label>
                                                <input type="radio" name="payment-method" value="card" checked>
                                                <span>Credit/Debit Card</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="payment-method" value="paypal">
                                                <span>Paypal</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="payment-method" value="squarespace">
                                                <span>Squarespace</span>
                                            </label>
                                        </div>

                                        <!-- Card Details -->
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="card-number" placeholder="Card Number">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="card-name" placeholder="Name on Card">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" id="expiry-date" placeholder="MM/YY">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="cvv" placeholder="CVV">
                                            </div>
                                        </div>

                                        <!-- Place Order Button -->
                                        <div class="row">
                                            <button type="submit" class="btn-place-order">Place Order</button>
                                        </div>
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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