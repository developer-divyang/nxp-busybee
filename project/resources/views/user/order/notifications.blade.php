 @if(count($messages) > 0 || count($orders) > 0)
 <h2>My <span>Notification</span></h2>
 @else
 <h2>No <span>Notification</span></h2>
 @endif
 <div class="noticationContainer" id="notification-area">


     <div class="notification-container">
         @if(count($messages) > 0)
         @foreach($messages as $message)
         @if($message->file_path)
         <div class="notification">
             <div class="content">
                 <div class="icon file-icon">
                     <a href="{{ Storage::url($message->file_path) }}" target="_blank"><img src="{{ asset('assets/front/images/notify1.png') }}" alt="notifylist"></a>
                 </div>
                 <div>
                     <p class="message"> {{ $message->comment ?? 'No comment' }}</p>
                     <p class="timestamp">{{ $message->created_at->format('d/m/Y h:i A') }} | <span>#{{ $message->order->order_number }}</span></p>
                 </div>
             </div>
             <div class="view-order" data-id="{{ $message->order_id }}">
                 <a href="{{ route('user-order',$message->order_id) }}"><img src="{{ asset('assets/front/images/notification-view.png') }}" alt="notifyViewBtn">View Order
                 </a>
             </div>
         </div>
         @endif


         <div class="notification">
             <div class="content">
                 <div class="icon message-icon"><img src="{{ asset('assets/front/images/notify2.png') }}" alt="notifylist"></div>
                 <div>
                     <p class="message">{{$message->comment}}</p>
                     <p class="timestamp">{{ $message->created_at->format('d/m/Y h:i A') }} | <span>#{{ $message->order->order_number }}</span></p>
                 </div>
             </div>
             <div class="view-order" data-id="{{ $message->order_id }}">
                 <a href="{{ route('user-order',$message->order_id) }}"><img src="{{ asset('assets/front/images/notification-view.png') }}" alt="notifyViewBtn">View Order
                 </a>
             </div>
         </div>
         @endforeach
         @endif



         @if(count($orders) > 0)
         @foreach($orders as $order)
         @if($order->status == 'pending')
         <div class="notification">
             <div class="content">
                 <div class="icon preparing-icon"><img src="{{ asset('assets/front/images/notify3.png' )}}" alt="notifylist"></div>
                 <div>
                     <p class="message">We are preparing your order mockup. Estimate delivered by 2024-10-25</p>
                     <p class="timestamp">{{ $order->updated_at->format('d/m/Y h:i A') }} | <span>#{{ $order->order_number }}</span></p>
                 </div>
             </div>
             <div class="view-order">
                 <a href="{{ route('user-order',$order->id) }}"> <img src="{{ asset('assets/front/images/notification-view.png') }}" alt="notifyViewBtn">View Order
                 </a>
             </div>
         </div>
         @elseif($order->status == 'delivered')
         <div class="notification">
             <div class="content">
                 <div class="icon delivered-icon"><img src="{{ asset('assets/front/images/notify4.png') }}" alt="notifylist"></div>
                 <div>
                     <p class="message">Your order has been Delivered today</p>
                     <p class="timestamp">{{ $order->updated_at->format('d/m/Y h:i A') }} | <span>#{{ $order->order_number }}</span></p>
                 </div>
             </div>
             <div class="view-order">
                 <a href="{{ route('user-order',$order->id) }}"><img src="{{ asset('assets/front/images/notification-view.png') }}" alt="notifyViewBtn">View Order
                 </a>
             </div>
         </div>
         @elseif($order->payment_status == 'pending' && $order->status != 'confirm')
         <div class="notification">
             <div class="content">
                 <div class="icon payment-icon"><img src="{{ asset('assets/front/images/notify5.png') }}" alt="notifylist"></div>
                 <div>
                     <p class="message">Pay ${{ $order->pay_amount - 30 }} pending amount for future process</p>
                     <p class="timestamp">{{ $order->updated_at->format('d/m/Y h:i A') }} | <span>#{{ $order->order_number }}</span></p>
                 </div>
             </div>
             <div class="view-order"><img src="{{ asset('assets/front/images/notification-view.png') }}" alt="notifyViewBtn">View Order</div>
         </div>
         @elseif($order->status == 'cancel')
         <div class="notification">
             <div class="content">
                 <div class="icon cancel-icon"><img src="{{ asset('assets/front/images/notify6.png') }}" alt="notifylist"></div>
                 <div>
                     <p class="message">Your order has been cancel by admin</p>
                     <p class="timestamp">{{ $order->updated_at->format('d/m/Y h:i A') }} | <span>#{{ $order->order_number }}</span></p>
                 </div>
             </div>
             <div class="view-order"><img src="{{ asset('assets/front/images/notification-view.png') }}" alt="notifyViewBtn">View Order</div>
         </div>
         @endif



         @endforeach
         @endif
     </div>
 </div>