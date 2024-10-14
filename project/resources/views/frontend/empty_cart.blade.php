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
                        
                        <h4><img src="{{asset('assets/front/images/orderSum.png' )}}" alt=""> Your <span>Cart is Empty</span></h4>
                        
                    </button>
                   
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