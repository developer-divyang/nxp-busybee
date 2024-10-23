@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/order-details.css') }}">
@endsection
@section('content')




<div class="overlayWrapper">
    <div class="overlay" id="orderOverlay">
        <div class="overlay-content">
            <!-- <span class="close-btn" id="closeOverlay">X</span> -->
            <div class="order-page">
                <!-- <a href="#" class="back-link">← Back to Order</a> -->
                <h1 class="order-title">Order <span>#{{ $order->order_number }}</span></h1>
                <p class="order-info">Your order expected to be delivered on <strong>25/08/2024</strong>. You can order track using code <strong style="color:#764D2A;">"BBE484850"</strong></p>

                <div class="customer-details">
                    <div class="customer-info">
                        <h2>Customer Details</h2>
                        <div class="customer-detail-wrapper">
                            <div class="info-group">
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                <p><strong>Phone:</strong> {{ Auth::user()->phone }}</p>
                            </div>
                            <div class="info-group">
                                <p><strong>Paid Date:</strong> {{ date('d M Y',strtotime($order->created_at)) }}</p>
                                <p><strong>Payment terms:</strong> Full-payment</p>
                                <p><strong>Delivery method:</strong> delivery partner information</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="address-section">
                    <div class="shipping-address">
                        <div class="billingDet">
                            <h3>Billing Address</h3>
                            <p>David Wilson</p>
                            <p>800 S Seguin Rd, Converse,</p>
                            <p>San Antonio, TX 78109, United States</p>
                        </div>
                        <a href="#" class="edit-link"><img src="{{ asset('assets/front/images/editBtn.png') }}" alt="editBtn"> Edit</a>
                    </div>
                    <div class="shipping-address">
                        <div class="billingDet">
                            <h3>Shipping Address</h3>
                            <p>David Wilson</p>
                            <p>800 S Seguin Rd, Converse,</p>
                            <p>San Antonio, TX 78109, United States</p>
                        </div>
                        <a href="#" class="edit-link"><img src="{{ asset('assets/front/images/editBtn.png') }}" alt="editBtn"> Edit</a>
                    </div>
                </div>
            </div>

            <div class="order-container">

                <h2>Order <span>Items</span></h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Your Order Items</th>
                            <th>Logo File</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cart = json_decode($order->cart, true);
                        @endphp
                        <!-- First Row -->
                        @foreach($cart['items'] as $item)
                        @php
                        $product = App\Models\Product::find($item['item']['id']);
                        $color = App\Models\Color::where('color_name',$item['color'])->first()?->id;
                        $size = App\Models\Size::where('size_name',$item['size'])->first()?->id;
                        $pkey = $product->id.'_'.$color.'_'.$size;
                        $productColorImages = App\Models\ProductColorImage::where('color_id',$color)->where('product_id',$product->id)->first()?->image_path;
                        $images = json_decode($productColorImages);
                        @endphp
                        <tr>
                            <td>
                                <div class="item-details">
                                    <div class="img">
                                        <img src="{{ (isset($images[0]))?Storage::url($images[0]): asset('assets/front/images/caps/cap1.png') }}" alt="Olive Hat" class="item-img">
                                    </div>
                                    <div class="item-info">
                                        <p>{{ $item['color'] }}</p>
                                        <p>Logo Placement: Center</p>
                                        <p>Embroidery: 3D Puff</p>
                                        <p>Back & Side Stitching: Left Side</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="frostimg">
                                    <div class="frosting-cont">
                                        <div class="frosting-container">
                                            @php
                                            $logo = json_decode($item['front_logo']);
                                            @endphp
                                            <a href="{{ Storage::url($logo[0]) }}" target="_blank"> <img src="{{ Storage::url($logo[0]) }}" alt="Logo" class="logo-file"></a>
                                            <p>Front <br> Logo</p>
                                        </div>
                                        <div class="frosting-container">
                                            <a href="{{ Storage::url($item['back_logo']) }}" target="_blank"> <img src="{{ Storage::url($item['back_logo']) }}" alt="Logo" class="logo-file"></a>
                                            <p>Back <br> Logo</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>BBE15050</td>
                            <td>
                                {{ $item['qty'] }}
                            </td>
                            <td id="price-{{ $pkey }}">$ {{ $item['price'] }}</td>
                            <td id="subtotal-{{ $pkey }}">$ {{ $item['sub_total'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="total-container">
                    <div class="total-container-wrapper">
                        <div class="totals-row">
                            <p>Sub Total</p>
                            <p>$ {{ $order->pay_amount }}</p>
                        </div>
                        <div class="totals-row">
                            <p>Shipping</p>
                            <p>$0.00</p>
                        </div>
                        <div class="totals-row">
                            <p>Tax Amount</p>
                            <p>$0.00</p>
                        </div>
                        <div class="totals-row total-row">
                            <p>Total</p>
                            <p id="total">$ {{ $order->pay_amount }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="chat-container" style="min-height:300px;max-height:400px; overflow-y:scroll;border-right: 2px solid #00000040;border-left: 2px solid #00000040;" id="chat-container{{ $order->id }}">
                <!-- Chat messages will be appended here -->
                          
            </div>

            <div class="comment-input{{ $order->id }}">
                <div class="comment-wrapper">
                    <input type="text" id="comment-text{{ $order->id }}" placeholder="Enter Your Comments">
                    <input type="file" id="file-upload{{ $order->id }}" style="display: none;" onchange="updateFileName(this)">
                    <div style="display:flex; gap:10px;align-item-center;">
                        <label for="file-upload{{ $order->id }}" class="file-upload-button"><img src="{{ asset('assets/front/images/upload1.png') }}" height="15px"> </label>
                        <span style="font-size:14px;" class="file-name" id="file-name{{ $order->id }}">No file chosen</span>
                    </div>
                    <button class="comment-send-btn" data-id="{{ $order->id }}" id="send-comment{{ $order->id }}"><img src="http://localhost/nxp-busybee/assets/front/images/sendArrow.png" alt="">Send</button>
                </div>
            </div>

        </div>
    </div>
</div>








@endsection
@section('script')

<script type="text/javascript">
    (function($) {
        "use strict";

        $('.chat-container').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.comment-send-btn').click(function(e) {
            e.preventDefault();

            var orderId = $(this).data('id'); // Get order ID from data attribute
            var comment = $(`#comment-text${orderId}`).val();
            var fileData = $(`#file-upload${orderId}`)[0].files[0];

            if (comment == '' && !fileData) {
                toastr.error('Please enter a comment or select a file');
                return;
            }
            var formData = new FormData();

            formData.append('comment', comment);
            formData.append('user_type', 'user');

            formData.append('order_id', orderId); // Include the order ID in the form data
            if (fileData) {
                formData.append('file', fileData); // If a file is selected, append it
            }

            $.ajax({
                url: mainurl + '/user/send-chat',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $(`#comment-text${orderId}`).val(''); // Clear the comment input
                        $(`#file-upload${orderId}`).val(''); // Clear the file input
                        loadChat(orderId); // Reload chat messages after sending
                    }
                }
            });
        });



        function loadChat(orderId) {
            $.ajax({
                url: mainurl + "/user/load-chat/" + orderId, // Endpoint to fetch chat for the specific order
                type: 'GET',
                success: function(response) {
                    $(`#chat-container${orderId}`).html(response.html); // Append chat messages to the correct container
                    if (response.count > 0) {
                        $(`#chat-container${orderId}`).show();
                        //scroll to bottom
                        $(`#chat-container${orderId}`).scrollTop($(`#chat-container${orderId}`)[0].scrollHeight);
                    }
                }
            });
        }


        setInterval(function() {
            var orderId = '{{ $order->id }}';
            loadChat(orderId);
        }, 5000);

    })(jQuery);
</script>
@endsection