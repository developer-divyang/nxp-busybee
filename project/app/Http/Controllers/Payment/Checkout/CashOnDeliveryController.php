<?php

namespace App\Http\Controllers\Payment\Checkout;

use App\{
    Models\Cart,
    Models\Order,
    Classes\GeniusMailer
};
use App\Models\Color;
use App\Models\Country;
use App\Models\Reward;
use App\Models\Size;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use OrderHelper;
use Illuminate\Support\Str;

class CashOnDeliveryController extends CheckoutBaseControlller
{
    public function store(Request $request)
    {
        // dd('here');
        // dd($request->all());
        $input = $request->all();
        if($request->pass_check) {
            $auth = OrderHelper::auth_check($input); // For Authentication Checking
            
            if(!$auth['auth_success']){
                return redirect()->back()->with('unsuccess',$auth['error_message']);
            }
        }

        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',__("You don't have any product to checkout."));
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // OrderHelper::license_check($cart); // For License Checking
        // dd($cart);
        $totalQty = 0;
        $totalPrice = 0;    
        foreach($cart->items as $key => $product){
            if($request->qty){
                foreach($request->qty as $k => $qty){
                    //$k explode uisng _
                    
                    $k = explode('_',$k);
                    $color = Color::where('id',$k[1])->first()->color_name;
                    $size = Size::where('id',$k[2])->first()->size_name;
                    if($key == $k[0].$size.$color){
                        $totalQty += $qty;
                        $totalPrice += $qty * $request->price[$k[0].'_'.$k[1].'_'.$k[2]];
                        $cart->items[$key]['qty'] = $qty;
                        $cart->items[$key]['price'] = $request->price[$k[0].'_'.$k[1].'_'.$k[2]];
                        $cart->items[$key]['sub_total'] = $request->subtotal[$k[0].'_'.$k[1].'_'.$k[2]];

                    }

                    
                    
                }
            }
            // $totalQty = $totalQty;
        }
        
        // dd($cart);
        // $t_oldCart = Session::get('cart');
        // $t_cart = new Cart($t_oldCart);
        $new_cart = [];
        
        $new_cart['totalQty'] = $totalQty;
        $new_cart['totalPrice'] = $totalPrice;
        $new_cart['items'] = $cart->items;
        // dd($new_cart);
        $new_cart = json_encode($new_cart);
        $temp_affilate_users = OrderHelper::product_affilate_check($cart); // For Product Based Affilate Checking
        $affilate_users = $temp_affilate_users == null ? null : json_encode($temp_affilate_users);

        $billing_address = [];
        $shipping_address = [];
        if($request->billing_name && $request->billing_address1){
            $billing_address = [
                'name' => $request->billing_name,
                'billing_address1' => $request->billing_address1,
                'billing_address2' => $request->billing_address2,
                'billing_country' => $request->billing_country,
                'billing_city' => $request->billing_city,
                'billing_postcode' => $request->billing_postcode,
            ];
        }

        if(isset($request->same_address) && $request->same_address == 'on'){
            $shipping_address = [
                'shipping_name' => $request->billing_name,
                'shipping_address1' => $request->billing_address1,
                'shipping_address2' => $request->billing_address2,
                'shipping_country' => $request->billing_country,
                'shipping_city' => $request->billing_city,
                'shipping_postcode' => $request->billing_postcode,
            ];
        }else{

            if($request->shipping_name && $request->shipping_address1){
                $shipping_address = [
                    'shipping_name' => $request->shipping_name,
                    'shipping_address1' => $request->shipping_address1,
                    'shipping_address2' => $request->shipping_address2,
                    'shipping_country' => $request->shipping_country,
                    'shipping_city' => $request->shipping_city,
                    'shipping_postcode' => $request->shipping_postcode,
                ];
            }
        }

        $order = new Order;
        
        $input['user_id'] = Auth::check() ? Auth::user()->id : NULL;
        $input['cart'] = $new_cart;
        $input['billing_address'] = json_encode($billing_address);
        $input['shipping_address'] = json_encode($shipping_address);
        $input['affilate_users'] = $affilate_users;
        $input['pay_amount'] = $request->total_amount;
        $input['order_number'] = Str::random(4).time();
        $input['wallet_price'] = $request->wallet_price / $this->curr->value;
        // if($input['tax_type'] == 'state_tax'){
        //     $input['tax_location'] = State::findOrFail($input['tax'])->state;
        // }else{
        //     $input['tax_location'] = Country::findOrFail($input['tax'])->country_name;
        // }
        $input['tax'] = 0;
        // dd($input);
        if (Session::has('affilate')) {
            $val = $request->total / $this->curr->value;
            $val = $val / 100;
            $sub = $val * $this->gs->affilate_charge;
            if($temp_affilate_users != null){
                $t_sub = 0;
                foreach($temp_affilate_users as $t_cost){
                    $t_sub += $t_cost['charge'];
                }
                $sub = $sub - $t_sub;
            }
            if($sub > 0){
                $user = OrderHelper::affilate_check(Session::get('affilate'),$sub,$input['dp']); // For Affiliate Checking
                $input['affilate_user'] = Session::get('affilate');
                $input['affilate_charge'] = $sub;
            }

        }

        $order->fill($input)->save();
        $order->tracks()->create(['title' => 'Pending', 'text' => 'You have successfully placed your order.' ]);
        // dd($order);
        $success_url = route('user-dashboard');
        $order->notifications()->create();

        // if($input['coupon_id'] != "") {
        //     OrderHelper::coupon_check($input['coupon_id']); // For Coupon Checking
        // }

        if(Auth::check()){
            if($this->gs->is_reward == 1){
                $num = $order->pay_amount;
                $rewards = Reward::get();
                foreach ($rewards as $i) {
                    $smallest[$i->order_amount] = abs($i->order_amount - $num);
                }

                asort($smallest);
                $final_reword = Reward::where('order_amount',key($smallest))->first();
                Auth::user()->update(['reward' => (Auth::user()->reward + $final_reword->reward)]);
            }
        }
        // dd($order);

        OrderHelper::size_qty_check($cart); // For Size Quantiy Checking
        OrderHelper::stock_check($cart); // For Stock Checking
        // OrderHelper::vendor_order_check($cart,$order); // For Vendor Order Checking

        Session::put('temporder',$order);
        Session::put('tempcart',$cart);
        Session::forget('cart');
        Session::forget('already');
        Session::forget('coupon');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('coupon_percentage');

        // if ($order->user_id != 0 && $order->wallet_price != 0) {
        //     OrderHelper::add_to_transaction($order,$order->wallet_price); // Store To Transactions
        // }

        //Sending Email To Buyer
        $data = [
            'to' => $order->customer_email,
            'type' => "new_order",
            'cname' => $order->customer_name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'wtitle' => "",
            'onumber' => $order->order_number,
        ];

        // $mailer = new GeniusMailer();
        // $mailer->sendAutoOrderMail($data,$order->id);

        //Sending Email To Admin
        $data = [
            'to' => $this->ps->contact_email,
            'subject' => "New Order Recieved!!",
            'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
        ];
        // $mailer = new GeniusMailer();
        // $mailer->sendCustomMail($data);
        // dd($success_url);
        return redirect($success_url);
    }
}
