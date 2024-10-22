@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/dashboard.css')}}">
@endsection
@section('content')
<div class="dashboardMain">
   <div class="dashcontMain">
      <div class="dashtabs">
         <div class="dashtab " data-target="dashboard">DASHBOARD</div>
         <div class="dashtab" data-target="orders">MY ORDERS</div>
         <div class="dashtab" data-target="addresses">ADDRESSES</div>
         <div class="dashtab notification_tab" onclick="showNotifications();" data-target="notification">NOTIFICATION </div>
         <div class="dashtab" data-target="logout">LOGOUT</div>
         <div class="underline"></div>
      </div>

      <div class="dashtab-content " id="dashboard">
         <div class="dashProfile">
            <div class="profile-container">
               <div class="profile-info">
                  <div class="profile-image">
                     <img src="https://via.placeholder.com/80" alt="Profile Image">
                  </div>
                  <div class="profile-details">
                     <h2>{{ Auth::user()->name }}</h2>
                     <p>{{ Auth::user()->email }}</p>
                  </div>
               </div>
               <p>You can edit your profile and addresses. Also, find the latest order you placed.</p>
               <div class="edit-profile">
                  <a href="{{ route('user-profile') }}">
                     <img src="{{asset('assets/front/images/profileEdit.png') }}" alt="Edit Icon">
                     <span>EDIT PROFILE</span>
                  </a>
               </div>
            </div>
         </div>

         <div class="dashrecentOrder">
            <div class="orders-container">
               <div class="orders-header">
                  <h2>Recent <span>Orders</span></h2>
                  <a href="#"><img style="height: 18px; margin-right: 6px;" src="{{asset('assets/front/images/checklist.png') }}" alt="checklist">VIEW ALL ORDERS</a>
               </div>

               <div class="recentordertable">
                  <table class="orders-table">
                     <thead>
                        <tr>
                           <th>Order Number</th>
                           <th>Order Items</th>
                           <th>Order Date</th>
                           <th>Total</th>
                           <th>Delivery Date</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>

                        @if(count(Auth::user()->orders()->latest()->take(5)->get()) > 0)
                        @foreach(Auth::user()->orders()->latest()->take(5)->get() as $order)
                        @php

                        $cart = json_decode($order->cart, true);
                        $firstItemKey = key($cart['items']);
                        $product = reset($cart['items']);
                        $productData = App\Models\Product::find($product['item']['id']);
                        $color = App\Models\Color::where('color_name',$product['color'])->first()?->id;
                        $size = App\Models\Size::where('size_name',$product['size'])->first()?->id;
                        $pkey = $productData->id.'_'.$color.'_'.$size;
                        $productColorImages = App\Models\ProductColorImage::where('color_id',$color)->where('product_id',$productData->id)->first()?->image_path;
                        $images = json_decode($productColorImages);
                        @endphp
                        <tr>
                           <td> <a href="{{ route('user-order',$order->id) }}"> {{$order->order_number}} </a></td>
                           <td class="order-item">
                              <div class="orderImg">
                                 <img src="{{ Storage::url($images[0]) }}" alt="Olive Hat">
                              </div>
                              <div>
                                 <h4>{{ $product['color'] }}</h4>
                                 <p>Size: {{ $product['size'] }}<br>Items: {{ $cart['totalQty'] }}</p>
                              </div>
                           </td>
                           <td>{{date('d M Y',strtotime($order->created_at))}}</td>
                           <td>{{ \PriceHelper::showAdminCurrencyPrice(($order->pay_amount  * $order->currency_value),$order->currency_sign) }}</td>
                           <td></td>
                           <td><span class="status confirmed">{{ucwords($order->status)}}</span></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                           <td colspan="6">
                              <p>No Orders Found</p>
                           </td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

         <div class="additionalPayment">
            <div class="container">
               <h2>Additional <span>Payment</span></h2>
               <p class="subtitle">if applicable only</p>
               <div class="addPayWrapper">
                  <table>
                     <thead>
                        <tr>
                           <th>Order Number</th>
                           <th>Order Items</th>
                           <th>Order Date</th>
                           <th class="right">Pending</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>#BBE10000584850</td>
                           <td>3 items</td>
                           <td>20/08/2024</td>
                           <td class="right">$240.00</td>
                           <td>Pending</td>
                           <td><button class="action-button">PAY NOW</button></td>
                        </tr>
                        <tr>
                           <td>#BBE10000584849</td>
                           <td>5 items</td>
                           <td>15/08/2024</td>
                           <td class="right">$240.00</td>
                           <td>Pending</td>
                           <td><button class="action-button highlight">PAY NOW</button></td>
                        </tr>
                        <tr>
                           <td>#BBE10000584848</td>
                           <td>8 items</td>
                           <td>10/08/2024</td>
                           <td class="right">$240.00</td>
                           <td>Pending</td>
                           <td><button class="action-button">PAY NOW</button></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

         <div class="dashMyAdd">
            <div class="dashMyAddcontainer">
               <div class="dashAddHeading">
                  <h2>My <span>Address</span></h2>
                  <button>
                     <img src="{{ asset('assets/front/images/locationEdit.png') }}" alt="Edit Icon">
                     EDIT ADDRESS
                  </button>
               </div>
               <div class="address-container">
                  <div class="address-box">
                     <h2>Billing Address</h2>
                     <p>David Wilson</p>
                     <p>800 S Seguin Rd, Converse,</p>
                     <p>San Antonio, TX 78109, United States</p>
                  </div>
                  <div class="address-box">
                     <h2>Shipping Address</h2>
                     <p>David Wilson</p>
                     <p>800 S Seguin Rd, Converse,</p>
                     <p>San Antonio, TX 78109, United States</p>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div class="dashtab-content" id="orders">
         @if(count(Auth::user()->orders()->latest()->get()) > 0)
         @foreach(Auth::user()->orders()->latest()->get() as $order)
         <div class="overlay order_details_{{ $order->id }}" id="orderOverlay">
            <div class="overlay-content">
               <span class="close-btn close-order" data-id="{{ $order->id }}" id="closeOverlay">X</span>
               <div class="order-page">
                  <a href="#" class="back-link">← Back to Order</a>
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
                                       <img src="{{ asset('assets/front/images/frostTwo.png') }}" alt="Logo" class="logo-file">
                                       <p>Center <br> Logo</p>
                                    </div>
                                    <div class="frosting-container">
                                       <img src="{{ asset('assets/front/images/frostTwo.png') }}" alt="Logo" class="logo-file">
                                       <p>Center <br> Logo</p>
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


               <div class="mockups-container" data-id="{{ $order->id }}">
                  <div class="header">
                     <h1><strong>Mockups</strong> Files</h1>
                     <a href="#" class="refresh">
                        <span class="refresh-icon">⟳</span> Refresh
                     </a>
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


         @endforeach
         @endif

         <div class="ordersContainer">

            <h2>Order <span>History</span></h2>
            <div class="order-table-div">
               <table class="order-history-table">
                  <thead>
                     <tr>
                        <th>Order Number</th>
                        <th>Order Items</th>
                        <th>Order Date</th>
                        <th>Total</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Mockup</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count(Auth::user()->orders()->latest()->get()) > 0)
                     @foreach(Auth::user()->orders()->latest()->get() as $order)

                     <tr>
                        <td>{{ $order->order_number }}</td>
                        @php
                        $cart = json_decode($order->cart, true);;
                        $firstItemKey = key($cart['items']);
                        $product = reset($cart['items']);


                        $productData = App\Models\Product::find($product['item']['id']);
                        $color = App\Models\Color::where('color_name',$product['color'])->first()?->id;
                        $size = App\Models\Size::where('size_name',$product['size'])->first()?->id;
                        $pkey = $productData->id.'_'.$color.'_'.$size;
                        $productColorImages = App\Models\ProductColorImage::where('color_id',$color)->where('product_id',$productData->id)->first()?->image_path;
                        $images = json_decode($productColorImages);


                        @endphp
                        <td>
                           <div class=" order-item-info">
                              <div class="order-item-img">
                                 <img src="{{ Storage::url($images[0]) }}" alt="Olive Hat" class="order-item-image">
                              </div>
                              <div>
                                 <strong>{{ $product['color'] }}</strong><br>
                                 Size: {{ $product['size'] }}<br>
                                 Items: {{ $cart['totalQty'] }}
                              </div>
                           </div>
                        </td>
                        <td>{{ date('d M Y',strtotime($order->created_at)) }}</td>
                        <td>{{ \PriceHelper::showAdminCurrencyPrice(($order->pay_amount  * $order->currency_value),$order->currency_sign) }}</td>
                        <td></td>
                        <td><span class="order-status-button order-status-confirmed">{{ ucwords($order->status) }}</span></td>
                        <td class="view-td">
                           <div class="view-wrapper" data-id="{{ $order->id }}">
                              <img src="{{ asset('assets/front/images/image-icon.png') }}" alt="view">
                              <p>view</p>
                           </div>
                        </td>
                     </tr>



                     @endforeach
                     @else
                     <tr>
                        <td colspan="7">
                           <p>No Orders Found</p>
                        </td>
                     </tr>
                     @endif

                  </tbody>
               </table>
            </div>
            <!-- <div class="orderpagination">
               <span class="circle active" id="circle-1">1</span>
               <span class="circle" id="circle-2">2</span>
               <span class="circle" id="circle-3">3</span>
               <span class="circle" id="circle-4">4</span>
               <span class="circle" id="circle-4">
                  <span class="arrow" id="next">&#x27A4;</span>
               </span>

            </div> -->
         </div>


      </div>
      <div class="dashtab-content" id="addresses">
         <div class="billing-container">
            <h2>Billing <span>Address</span></h2>
            <form id="billing-form">
               <div class="form-row">
                  <input type="text" id="first-name" placeholder="First Name" value="David">
                  <input type="text" id="last-name" placeholder="Last Name" value="Wilson">
               </div>
               <input type="text" id="address-line-1" placeholder="Address Line 1" value="800 S Seguin Rd, Converse">
               <input type="text" id="address-line-2" placeholder="Address Line 2">
               <div class="form-row">
                  <select id="country">
                     <option value="US" selected>United States</option>
                  </select>
                  <select id="state">
                     <option value="TX" selected>Texas</option>
                  </select>
               </div>
               <div class="form-row">
                  <input type="text" id="city" placeholder="City" value="San Antonio">
                  <input type="text" id="zip" placeholder="ZIP Code" value="78109">
               </div>
               <div class="form-row checkbox">
                  <input type="checkbox" id="same-address" checked>
                  <label for="same-address">Shipping and Billing address are same</label>
               </div>
            </form>
         </div>
         <div class="shipping-container">
            <h2>Shipping <span>Address</span></h2>
            <form id="shipping-form">
               <div class="form-row">
                  <input type="text" id="first-name" placeholder="First Name" value="David">
                  <input type="text" id="last-name" placeholder="Last Name" value="Wilson">
               </div>
               <input type="text" id="address-line-1" placeholder="Address Line 1" value="800 S Seguin Rd, Converse">
               <input type="text" id="address-line-2" placeholder="Address Line 2">
               <div class="form-row">
                  <select id="country">
                     <option value="US" selected>United States</option>
                  </select>
                  <select id="state">
                     <option value="TX" selected>Texas</option>
                  </select>
               </div>
               <div class="form-row">
                  <input type="text" id="city" placeholder="City" value="San Antonio">
                  <input type="text" id="zip" placeholder="ZIP Code" value="78109">
               </div>
               <div class="form-row checkbox">
                  <input type="checkbox" id="same-address" checked>
                  <label for="same-address">Shipping and Billing address are same</label>
               </div>
            </form>
         </div>
      </div>
      <div class="dashtab-content" id="notification">

      </div>
      <div class="dashtab-content" id="logout">

         <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
         <form id="logout-form" action="{{ route('user-logout') }}" method="GET" style="display: none;">
            @csrf
         </form>

      </div>
   </div>
</div>
@endsection
@section('script')
<script>
   $(document).ready(function() {
      $('.chat-container').hide();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
         }
      });


      function loadNotifications() {
         $.ajax({
            url: mainurl + "/user/load-notifications", // Endpoint to fetch notifications
            type: 'GET',
            success: function(response) {
               // $('#notification-area').html(response.html); // Append notifications to the correct container
               if (response.count > 0) {
                  $('.notification_tab').html('NOTIFICATION <span class="notify-count">' + response.count + '</span>');
               } else {
                  $('.notification_tab').html('NOTIFICATION');
               }
            }
         });
      }



      function loadChat(orderId) {
         $.ajax({
            url: mainurl + "/user/load-chat/" + orderId, // Endpoint to fetch chat for the specific order
            type: 'GET',
            success: function(response) {
               $(`#chat-container${orderId}`).html(response.html); // Append chat messages to the correct container
               if (response.count > 0) {
                  $(`#chat-container${orderId}`).show();
                  $(`#chat-container${orderId}`).scrollTop($(`#chat-container${orderId}`)[0].scrollHeight);
               }
            }
         });
      }

      function checkAndLoadChat(orderId) {
         var orderDetailsElement = $(`.order_details_${orderId}`);
         if (orderDetailsElement.css('display') === 'flex') {
            loadChat(orderId);
         }
      }

      // Handle the send button click
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
                  checkAndLoadChat(orderId); // Reload chat messages after sending
               }
            }
         });
      });

      // Optionally, refresh chat messages every 5 seconds
      setInterval(function() {
         $('.mockups-container').each(function() {
            var orderId = $(this).data('id'); // Extract order ID from the data-id attribute
            checkAndLoadChat(orderId);
         });
         loadNotifications();
      }, 5000);


      function counttotalQty() {
         var totalQty = 0;
         $('.item-qty').each(function() {
            totalQty += parseInt($(this).val());
         });
         $('#totalQty').text(totalQty);
      }
   });
   $('.view-wrapper, .view-order').click(function() {
      var id = $(this).data('id');
      $('.order_details_' + id).css('display', 'flex');
   });

   $('.close-order').click(function() {
      var id = $(this).data('id');
      $('.order_details_' + id).css('display', 'none');
   });

   function showNotifications() {
      $.ajax({
         url: mainurl + "/user/show-notifications", // Endpoint to fetch notifications
         type: 'GET',
         success: function(response) {
            $('#notification-area').html(response.html); // Append notifications to the correct container
            if (response.count > 0) {
               $('#notification').html(response.html);
               $('.notification_tab').html('NOTIFICATION <span class="notify-count">' + response.count + '</span>');
            } else {
               $('#notification').html(response.html);
               $('.notification_tab').html('NOTIFICATION');

            }
         }
      });
   }
</script>
<script src="{{ asset('assets/front/js/dashboard.js') }}"></script>
@endsection