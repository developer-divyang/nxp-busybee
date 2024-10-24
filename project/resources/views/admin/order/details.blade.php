@extends('layouts.admin')

@section('styles')

<style type="text/css">
    .order-table-wrap table#example2 {
        margin: 10px 20px;
    }

    .mockups-container {
        margin: 0 auto;
        padding: 20px;
        border-radius: 8px;
    }

    .download-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        padding: 10px 10px;
        text-decoration: none;
        opacity: 0;
        border-radius: 20px;
        background-color: #000;
        color: #fff;

    }



    .logo-img:hover {

        cursor: pointer;
        transition: all ease 0.3s;

    }

    .logo-img {

        display: flex;
        align-items: center;
        justify-content: center;

    }

    .logo-img:hover .download-btn {
        opacity: 1;
        color: #fff;
    }

    .download-btn:hover {
        text-decoration: none;
        color: #fff;
    }

    .header {
        display: flex;
        gap: 40px;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h1 {
        font-size: 24px;
    }

    .refresh {
        font-size: 16px;
        color: #ff9800;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .refresh-icon {
        margin-right: 5px;
        font-size: 18px;
    }

    .file-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-width: 45%;
        border: 1.5px solid #0000005c;
        padding: 9px 25px;
        border-radius: 13px;
        font-size: 18px;
        /* min-width: 320px; */
    }

    .img-file-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-left: -5px;
    }

    .file-item,
    .comment-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        padding: 10px 15px;
        border-radius: 6px;
        flex-direction: column;

    }

    .comment-info {
        min-width: 45%;
        border: 1.5px solid #0000005c;
        padding: 9px 25px 9px 20px;
        border-radius: 13px;
        font-size: 18px;
        background-color: #ECECEC;
    }

    .file-info,
    .comment-info {
        display: flex;
        align-items: center;
        width: 300px;
    }

    .files-icon,
    .comment-icon {
        margin-right: 15px;
        transform: scale(0.8);
    }

    .user_msg {
        align-items: start;
    }

    .admin_msg {
        align-items: end;
    }

    .download-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        /* margin-right: 15px; */
        transform: scale(0.8);
        transform: rotate(-90deg);
        cursor: pointer;
        border: none;
        outline: none;
        transition: all ease 0.3s;
    }

    .download-icon:hover {
        background-color: gray;
        border-radius: 50%;
    }

    .file-name,
    .comment-text {
        font-size: 16px;
        color: #333;
    }

    .file-meta,
    .comment-meta {
        font-size: 12px;
        color: #888;
    }

    .download-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #ff9800;
        text-decoration: none;
    }

    .download-btn img {
        height: 15px;
    }

    .comment-input {
        padding: 10px 15px;
        width: 100%;
    }

    .comment-wrapper {
        display: flex;
        padding: 8px 15px;
        /* max-width: 45%; */
        background-color: #ffffff;
        /* justify-content: space-between; */
        gap: 10px;
        border-radius: 14px;
        position: relative;
        align-items: center;
        min-height: 50px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .comment-input input {
        width: 100%;
        max-width: 80%;
        padding: 4px 20px;
        background-color: transparent;
        border: none;
        outline: none;
    }

    .comment-wrapper input:nth-child(1) {
        border: none !important;
        outline: none !important;
        font-size: 16px;
    }

    .comment-send-btn {
        display: flex;
        color: #bbb1a3;
        background-color: transparent;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        gap: 8px;
        position: absolute;
        right: 0;
    }

    .comment-send-btn img {
        height: 15px;
    }
</style>

@endsection


@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Orders') }}</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Order Details') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="order-table-wrap">
        @include('alerts.admin.form-both')
        @include('alerts.form-success')
        <div class="row">

            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Order Details') }}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="45%" width="45%">{{ __('Order ID') }}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{$order->order_number}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Total Product') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{$cart['totalQty']}}</td>
                                </tr>
                                @if($order->shipping_title != null)
                                <tr>
                                    <th width="45%">{{ __('Shipping Method') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $order->shipping_title }}</td>
                                </tr>
                                @endif

                                @if($order->shipping_cost != 0)
                                <tr>
                                    <th width="45%">{{ __('Shipping Method') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $order->shipping_method }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Shipping Title') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $order->shipping_lebel }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Shipping Cost') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice($order->shipping_cost,$order->currency_sign) }}</td>
                                </tr>
                                @endif

                                @if($order->tax != 0)
                                <tr>
                                    <th width="45%">{{ __('Tax :') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%"> {{ \PriceHelper::showOrderCurrencyPrice((($order->tax) / $order->currency_value),$order->currency_sign) }}</td>
                                </tr>
                                @endif

                                @if($order->packing_title != null)
                                <tr>
                                    <th width="45%">{{ __('Packaging Method') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $order->packing_title }}</td>
                                </tr>
                                @endif

                                @if($order->packing_cost != 0)

                                <tr>
                                    <th width="45%">{{ __('Packaging Cost') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice($order->packing_cost,$order->currency_sign) }}</td>
                                </tr>

                                @endif


                                @if($order->wallet_price != 0)
                                <tr>
                                    <th width="45%">{{ __('Paid From Wallet') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice(($order->wallet_price  * $order->currency_value),$order->currency_sign) }}</td>
                                </tr>

                                @if($order->method != "Wallet")
                                <tr>
                                    <th width="45%">{{$order->method}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice(($order->pay_amount  * $order->currency_value),$order->currency_sign) }}</td>
                                </tr>
                                @endif

                                @endif

                                <tr>
                                    <th width="45%">{{ __('Total Cost') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice((($order->pay_amount + $order->pending_amount)  * $order->currency_value),$order->currency_sign) }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Paied Amount') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice((($order->pay_amount + $order->wallet_price)  * $order->currency_value),$order->currency_sign) }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Pending Amount') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ \PriceHelper::showOrderCurrencyPrice((($order->pending_amount + $order->wallet_price)  * $order->currency_value),$order->currency_sign) }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Ordered Date') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($order->created_at))}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Payment Method') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{$order->method}}</td>
                                </tr>

                                @if($order->method != "Cash On Delivery" && $order->method != "Wallet")
                                @if($order->method=="Stripe")
                                <tr>
                                    <th width="45%">{{$order->method}} {{ __('Charge ID') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{$order->charge_id}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th width="45%">{{$order->method}} {{ __('Transaction ID') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{$order->txnid}}</td>
                                </tr>
                                @endif


                                <th width="45%">{{ __('Payment Status') }}</th>
                                <th width="10%">:</th>

                                @if($order->payment_status == 'Pending')
                                <span class='badge badge-danger'>{{__('Unpaid')}}</span>
                                @else
                                <span class='badge badge-success'>{{__('Paid')}}</span>
                                @endif

                                @if(!empty($order->order_note))
                                <th width="45%">{{ __('Order Note') }}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->order_note}}</td>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="footer-area">
                        <a href="{{ route('admin-order-invoice',$order->id) }}" class="mybtn1"><i class="fas fa-eye"></i> {{ __('View Invoice') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Billing Details') }}
                            <a class="f15" href="javascript:;" data-toggle="modal" data-target="#billing-details-edit"><i class="fas fa-edit"></i>{{ __("Edit") }}</a>
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="45%">{{ __('Name') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->user->name}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Email') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->user->email}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Phone') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->user->mobile}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Address') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->customer_address}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Country') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->customer_country}}</td>
                                </tr>
                                @if($order->customer_state != null)
                                <tr>
                                    <th width="45%">{{ __('State') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->customer_state}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th width="45%">{{ __('City') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->customer_city}}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Postal Code') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->customer_zip}}</td>
                                </tr>
                                @if($order->coupon_code != null)
                                <tr>
                                    <th width="45%">{{ __('Coupon Code') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->coupon_code}}</td>
                                </tr>
                                @endif
                                @if($order->coupon_discount != null)
                                <tr>
                                    <th width="45%">{{ __('Coupon Discount') }}</th>
                                    <th width="10%">:</th>
                                    @if($gs->currency_format == 0)
                                    <td width="45%">{{ $order->currency_sign }}{{ $order->coupon_discount }}</td>
                                    @else
                                    <td width="45%">{{ $order->coupon_discount }}{{ $order->currency_sign }}</td>
                                    @endif
                                </tr>
                                @endif
                                @if($order->affilate_user != null)
                                <tr>
                                    <th width="45%">{{ __('Affilate User') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        @if( App\Models\User::where('id', $order->affilate_user)->exists() )
                                        {{ App\Models\User::where('id', $order->affilate_user)->first()->name  }}
                                        @else
                                        {{ __('Deleted') }}
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @if($order->affilate_charge != null)
                                <tr>
                                    <th width="45%">{{ __('Affilate Charge') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ \PriceHelper::showOrderCurrencyPrice(($order->affilate_charge * $order->currency_value),$order->currency_sign) }}
                                    </td>

                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($order->dp == 0)
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Shipping Details') }}
                            <a class="f15" href="javascript:;" data-toggle="modal" data-target="#shipping-details-edit"><i class="fas fa-edit"></i>{{ __("Edit") }}</a>
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                @if($order->shipping == "pickup")
                                <tr>
                                    <th width="45%"><strong>{{ __('Pickup Location') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->pickup_location}}</td>
                                </tr>
                                @else
                                @php
                                $shipping = json_decode($order->shipping_address);
                                @endphp
                                <tr>
                                    <th width="45%"><strong>{{ __('Name') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td>{{$shipping->shipping_name == null ? $order->customer_name : $shipping->shipping_name}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Email') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Phone') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Address') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$shipping->shipping_address1 == null ? $order->customer_address : $shipping->shipping_address1.' '.$shipping->shipping_address2}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Country') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$shipping->shipping_country == null ? $order->customer_country : $shipping->shipping_country}}</td>
                                </tr>


                                <tr>
                                    <th width="45%">{{ __('State') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->shipping_state == null ?  $order->customer_state: $order->shipping_state }}</td>
                                </tr>



                                <tr>
                                    <th width="45%"><strong>{{ __('City') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Postal Code') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}</td>
                                </tr>


                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif



        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="special-box ">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Mockups Files & Comments') }}
                            <a href="#" class="refresh">
                                <span class="refresh-icon">⟳</span> Refresh
                            </a>
                        </h4>
                    </div>

                    <div class="mock" data-id="{{ $order->id }}">


                        <div class="chat-container" style="min-height:300px;max-height:400px; overflow-y:scroll;border-right: 2px solid #00000040;border-left: 2px solid #00000040;display:none" id="chat-container{{ $order->id }}">
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
        </div>

        <div class="row">
            <div class="col-lg-12 order-details-table">
                <div class="mr-table">
                    <h4 class="title">
                        {{ __('Products Ordered') }}
                        <a class="f15" href="javascript:;" data-toggle="modal" class="add-btn-small pl-2" data-target="#add-product"><i class="fas fa-plus"></i>{{ __("Add Product") }}</a>
                    </h4>
                    <div class="table-responsive">
                        <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <tr>
                                    <th>{{ __('Product ID#') }}</th>
                                    <th>{{ __('Order Detials') }}</th>
                                    <th>{{ __('Vendor Status') }}</th>
                                    <th>{{ __('Product Title') }}</th>
                                    <th>{{ __('Details') }}</th>
                                    <th>{{ __('Total Price') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($cart['items'] as $key1 => $product)
                                @php


                                $product_data = App\Models\Product::where('id',$product['item']['id'])->first();
                                @endphp

                                <tr>

                                    <td><input type="hidden" value="{{$key1}}">{{ $product['item']['id'] }}</td>

                                    <td>
                                        <p>

                                            <strong>{{ __('Model Number') }} :</strong> {{ $product_data->modelNumber->model_number }}
                                        </p>

                                        <p>
                                            <strong>{{ __('Front Logo Placement') }} :</strong> {{ ($product['front_location']) ?? '' }}
                                        </p>

                                        <p>
                                            <strong>{{ __('Back Logo Placement') }} :</strong> {{ ($product['back_location']) ?? '' }}
                                        </p>

                                        <p>
                                            <strong>{{ __('Side Logo Placement') }} :</strong> {{ ($product['side_location'])  ?? '' }}
                                        </p>

                                        <p>
                                            <strong>{{ __('Embroidery Type') }} :</strong> {{ ($product['embroidery_type']) ?? '' }}
                                        </p>



                                    </td>
                                    <td>
                                        @if($product['item']['user_id'] != 0)
                                        @php
                                        $user = App\Models\VendorOrder::where('order_id','=',$order->id)->where('user_id','=',$product['item']['user_id'])->first();


                                        @endphp

                                        @if($order->dp == 1 && $order->payment_status == 'Completed')

                                        <span class="badge badge-success">{{ __('Completed') }}</span>

                                        @else
                                        @if($user->status == 'pending')
                                        <span class="badge badge-warning">{{ucwords($user->status)}}</span>
                                        @elseif($user->status == 'processing')
                                        <span class="badge badge-info">{{ucwords($user->status)}}</span>
                                        @elseif($user->status == 'on delivery')
                                        <span class="badge badge-primary">{{ucwords($user->status)}}</span>
                                        @elseif($user->status == 'completed')
                                        <span class="badge badge-success">{{ucwords($user->status)}}</span>
                                        @elseif($user->status == 'declined')
                                        <span class="badge badge-danger">{{ucwords($user->status)}}</span>
                                        @endif
                                        @endif

                                        @endif
                                    </td>


                                    <td>
                                        <input type="hidden" value="{{ $product['license'] }}">

                                        @if($product['item']['user_id'] != 0)
                                        @php
                                        $user = App\Models\User::find($product['item']['user_id']);
                                        @endphp
                                        @if(isset($user))
                                        <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                        @else
                                        <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                        @endif
                                        @else

                                        <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>

                                        @endif


                                        @if($product['license'] != '')
                                        <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-info product-btn license" style="padding: 5px 12px;"><i class="fa fa-eye"></i> {{ __('View License') }}</a>
                                        @endif

                                        @if($product['affilate_user'] != 0)
                                        <p>
                                            <strong>{{ __('Referral User') }} :</strong> {{ \App\Models\User::find($product['affilate_user'])->name }}
                                        </p>
                                        @endif

                                    </td>
                                    <td>
                                        @if($product['size'])
                                        <p>
                                            <strong>{{ __('Size') }} :</strong> {{str_replace('-',' ',$product['size'])}}
                                        </p>
                                        @endif
                                        @if($product['color'])
                                        <p>
                                            <strong>{{ __('color') }} :</strong> {{str_replace('-',' ',$product['color'])}}
                                        </p>
                                        @endif
                                        <p>
                                            <strong>{{ __('Price') }} :</strong> {{ \PriceHelper::showCurrencyPrice(($product['price'] ) * $order->currency_value) }}
                                        </p>
                                        <p>
                                            <strong>{{ __('Qty') }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                                        </p>
                                        @if(!empty($product['keys']))

                                        @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                                        <p>

                                            <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }}

                                        </p>
                                        @endforeach

                                        @endif

                                        <a href="javascript:;" data-toggle="modal" data-target="#logo-modal{{$product['item']['id']}}">Logo Details</a>
                                        <div class="modal fade" id="logo-modal{{$product['item']['id']}}" tabindex="-1" role="dialog" aria-labelledby="stock-modal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Logo Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body p-5">
                                                        <div class="row text-center" style="border-bottom: #d1bcbc 1px solid;margin-bottom:10px;">
                                                            @if(isset($product['front_logo']))
                                                            <div class="col-md-12 ">
                                                                <h3>All Front Logos</h3>
                                                            </div>
                                                            <div class="col-md-12 text-center row p-3">
                                                                @foreach(json_decode($product['front_logo']) as $k => $front_image)
                                                                @php
                                                                $k = $k + 1;
                                                                @endphp
                                                                <div class="col-md-3 logo-img" style="position:relative">
                                                                    <img src="{{ Storage::url($front_image) }}" alt="" style="width:100%">

                                                                    <a class="download-btn" data-name="front-logo-{{ $k }}" href="{{ Storage::url($front_image) }}" download><i class="fas fa-download"></i></a>

                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="col-md-12 ">
                                                                <p class="text-center">Front logo Note : <strong>{{ $product['front_multi_logo_note'] }}</strong></p>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @if(isset($product['back_logo']))
                                                        <div class="row text-center" style="border-bottom: #d1bcbc 1px solid;margin-bottom:10px;">
                                                            <div class="col-md-12 ">
                                                                <h3> Back Logos</h3>
                                                            </div>
                                                            <div class="col-md-12 text-center row p-3">
                                                                <div class="col-md-3 logo-img" style="position:relative">
                                                                    <img src="{{ Storage::url($product['back_logo']) }}" alt="" style="width:100%">
                                                                    <a class="download-btn" data-name="back-logo" href=" {{ Storage::url($front_image) }}" download><i class="fas fa-download"></i></a>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 ">
                                                                <p class="text-center">Back logo Note : <strong>{{ $product['back_logo_note'] }}</strong></p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($product['left_logo']))
                                                        <div class="row text-center" style="border-bottom: #d1bcbc 1px solid;margin-bottom:10px;">
                                                            <div class="col-md-12 ">
                                                                <h3> Left Logos</h3>
                                                            </div>
                                                            <div class="col-md-12 text-center row p-3">
                                                                <div class="col-md-3 logo-img" style="position:relative">
                                                                    <img src="{{ Storage::url($product['left_logo']) }}" alt="" style="width:100%">
                                                                    <a class="download-btn" data-name="left-logo" href="{{ Storage::url($front_image) }}" download><i class="fas fa-download"></i></a>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 ">
                                                                <p class="text-center">Left logo Note : <strong>{{ $product['back_logo_note'] }}</strong></p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($product['right_logo']))
                                                        <div class="row text-center" style="border-bottom: #d1bcbc 1px solid;margin-bottom:10px;">
                                                            <div class="col-md-12 ">
                                                                <h3> Right Logos</h3>
                                                            </div>
                                                            <div class="col-md-12 text-center row p-3">
                                                                <div class="col-md-3 logo-img" style="position:relative">
                                                                    <img src="{{ Storage::url($product['right_logo']) }}" alt="" style="width:100%">
                                                                    <a class="download-btn" data-name="right-logo" href="{{ Storage::url($front_image) }}" download><i class="fas fa-download"></i></a>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 ">
                                                                <p class="text-center">Right logo Note : <strong>{{ $product['right_logo_note'] }}</strong></p>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        @if(isset($product['order_note']))
                                                        <div class="row text-center" style="border-bottom: #d1bcbc 1px solid;margin-bottom:10px;">
                                                            <div class="col-md-12 ">
                                                                <h3> Order Note:</h3>
                                                            </div>
                                                            <div class="col-md-12 text-center row p-3">
                                                                <div class="col-md-3">
                                                                    <p>{{ $product['order_note'] }}</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @endif

                                                        @if(isset($product['thread_color_note']))
                                                        <div class="row text-center" style="border-bottom: #d1bcbc 1px solid;margin-bottom:10px;">
                                                            <div class="col-md-12 ">
                                                                <h3> Thread Color Note:</h3>
                                                            </div>
                                                            <div class="col-md-12 text-center row p-3">
                                                                <div class="col-md-3">
                                                                    <p>{{ $product['thread_color_note'] }}</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                    <td> {{ \PriceHelper::showCurrencyPrice($product['sub_total'] * $order->currency_value)  }} <small>{{ $product['discount'] == 0 ? '' : '('.$product['discount'].'% '.__('Off').')' }}</small>
                                    </td>
                                    <td>

                                        <div class="action-list">

                                            <a class="add-btn edit-product" data-href="{{ route('admin-order-product-edit',[$key1, $product['item']['id'],$order->id]) }}" data-toggle="modal" data-target="#edit-product-modal">
                                                <i class="fas fa-edit"></i> {{ __("Edit") }}
                                            </a>

                                            <a class="add-btn delete-product" data-href="{{ route('admin-order-product-delete',[$key1,$order->id]) }}" data-toggle="modal" data-target="#delete-product-modal">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </div>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-2">
                <a class="btn sendEmail send" href="javascript:;" class="send" data-email="{{ $order->customer_email }}" data-toggle="modal" data-target="#vendorform">
                    <i class="fa fa-send"></i> {{ __('Send Email') }}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Area End -->
</div>
</div>


</div>

{{-- LICENSE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-center">{{ __('The Licenes Key is') }} : <span id="key"></span> <a href="javascript:;" id="license-edit">{{ __('Edit License') }}</a><a href="javascript:;" id="license-cancel" class="showbox">{{ __('Cancel') }}</a></p>
                <form method="POST" action="{{route('admin-order-license',$order->id)}}" id="edit-license" style="display: none;">
                    {{csrf_field()}}
                    <input type="hidden" name="license_key" id="license-key" value="">
                    <div class="form-group text-center">
                        <input type="text" name="license" placeholder="{{ __('Enter New License Key') }}" style="width: 40%; border: none;" required=""><input type="submit" name="submit" class="btn btn-primary" style="border-radius: 0; padding: 2px; margin-bottom: 2px;">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>



{{-- LICENSE MODAL ENDS --}}

{{-- BILLING DETAILS EDIT MODAL --}}

@include('admin.order.partials.billing-details')

{{-- BILLING DETAILS MODAL ENDS --}}

{{-- SHIPPING DETAILS EDIT MODAL --}}

@include('admin.order.partials.shipping-details')

{{-- SHIPPING DETAILS MODAL ENDS --}}

{{-- ADD PRODUCT MODAL --}}

@include('admin.order.partials.add-product')

{{-- ADD PRODUCT MODAL ENDS --}}


{{-- EDIT PRODUCT MODAL --}}

<div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
            </div>
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ __('Edit Item') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Close') }}
                </button>
            </div>
        </div>
    </div>

</div>

{{-- EDIT PRODUCT MODAL ENDS --}}

{{-- DELETE PRODUCT MODAL --}}

<div class="modal fade" id="delete-product-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __('You are about to delete this item from this cart.') }}</p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>

            </div>

        </div>
    </div>
</div>

{{-- DELETE PRODUCT MODAL ENDS --}}



{{-- MESSAGE MODAL --}}
<div class="sub-categori">
    <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorformLabel">{{ __('Send Email') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-form">
                                    <form id="emailreply">
                                        {{csrf_field()}}
                                        <ul>
                                            <li>
                                                <input type="email" class="input-field eml-val" id="eml" name="to" placeholder="{{ __('Email') }} *" value="" required="">
                                            </li>
                                            <li>
                                                <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ __('Subject') }} *" required="">
                                            </li>
                                            <li>
                                                <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ __('Your Message') }} *" required=""></textarea>
                                            </li>
                                        </ul>
                                        <button class="submit-btn" id="emlsub" type="submit">{{ __('Send Email') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MESSAGE MODAL ENDS --}}

{{-- ORDER MODAL --}}

<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
            </div>
            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('Update Status') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("You are about to update the order's status.") }}</p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-success btn-ok order-btn">{{ __('Proceed') }}</a>
            </div>

        </div>
    </div>
</div>

{{-- ORDER MODAL ENDS --}}


@endsection


@section('scripts')

<script type="text/javascript">
    (function($) {
        "use strict";


        $('.download-btn').on('click', function(event) {
            event.preventDefault(); // Prevent the default anchor behavior
            var imageUrl = $(this).attr('href');
            var link = document.createElement('a');
            link.href = imageUrl;
            link.download = $(this).data('name');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        function loadChat(orderId) {
            $.ajax({
                url: mainurl + "/admin/load-chat/" + orderId, // Endpoint to fetch chat for the specific order
                type: 'GET',
                success: function(response) {
                    $(`#chat-container${orderId}`).html(response.html); // Append chat messages to the correct container
                    if (response.count > 0) {
                        $(`#chat-container${orderId}`).show(); // Show the chat container if there are messages
                        $(`#chat-container${orderId}`).scrollTop($(`#chat-container${orderId}`)[0].scrollHeight);
                    }
                }
            });
        }

        function checkAndLoadChat(orderId) {
            loadChat(orderId);

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
            formData.append('order_id', orderId); // Include the order ID in the form data
            if (fileData) {
                formData.append('file', fileData); // If a file is selected, append it
            }

            $.ajax({
                url: mainurl + '/admin/send-chat',
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

            var orderId = '{{$order->id}}';
            checkAndLoadChat(orderId);

        }, 3000);

        function disablekey() {
            document.onkeydown = function(e) {
                return false;
            }
        }

        function enablekey() {
            document.onkeydown = function(e) {
                return true;
            }
        }

        $('#example2').dataTable({
            "ordering": false,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': false,
            'autoWidth': false,
            'responsive': true
        });

        $(document).on('click', '.license', function(e) {
            var id = $(this).parent().find('input[type=hidden]').val();
            var key = $(this).parent().parent().find('input[type=hidden]').val();
            $('#key').html(id);
            $('#license-key').val(key);
        });
        $(document).on('click', '#license-edit', function(e) {
            $(this).hide();
            $('#edit-license').show();
            $('#license-cancel').show();
        });
        $(document).on('click', '#license-cancel', function(e) {
            $(this).hide();
            $('#edit-license').hide();
            $('#license-edit').show();
        });

        @if(Session::has('license'))

        $.notify('{{  Session::get('
            license ')  }}', 'success');

        @endif

        // ADD OPERATION

        $(document).on('click', '.edit-product', function() {

            if (admin_loader == 1) {
                $('.submit-loader').show();
            }
            $('#edit-product-modal .modal-content .modal-body').html('').load($(this).data('href'), function(response, status, xhr) {
                if (status == "success") {
                    if (admin_loader == 1) {
                        $('.submit-loader').hide();
                    }
                }
            });
        });

        // ADD OPERATION END

        // SHOW PRODUCT FORM SUBMIT

        $(document).on('submit', '#show-product', function(e) {
            e.preventDefault();
            if (admin_loader == 1) {
                $('.submit-loader').show();
            }
            $('button.addProductSubmit-btn').prop('disabled', true);
            disablekey();
            $.ajax({
                method: "POST",
                url: $(this).prop('action'),
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data[0]) {
                        $('#product-show').html('').load(mainurl + "/admin/order/product-show/" + data[1], function(response, status, xhr) {
                            if (status == "success") {
                                if (admin_loader == 1) {
                                    $('.submit-loader').hide();
                                }
                            }
                        });
                    } else {
                        if (admin_loader == 1) {
                            $('.submit-loader').hide();
                        }
                        $('#product-show').html('<div class="col-lg-12 text-center"><h4>' + data[1] + '.</h4></div>')
                    }

                    $('button.addProductSubmit-btn').prop('disabled', false);

                    enablekey();
                }

            });

        });

        // SHOW PRODUCT FORM SUBMIT ENDS


        $('#delete-product-modal').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

    })(jQuery);
</script>

@endsection