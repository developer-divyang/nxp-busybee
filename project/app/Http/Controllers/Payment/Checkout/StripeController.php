<?php

namespace App\Http\Controllers\Payment\Checkout;

use App\{
    Models\Cart,
    Models\Order,
    Models\PaymentGateway,
    Classes\GeniusMailer
};
use App\Models\Color;
use App\Models\Country;
use App\Models\Size;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use OrderHelper;
use Illuminate\Support\Str;

use Stripe\PaymentIntent;
use Stripe\Charge;
use Stripe\Stripe as StripeStripe;


use Mail;
use Stripe\Customer;


class StripeController extends CheckoutBaseControlller
{
    public function __construct()
    {
        parent::__construct();
        $data = PaymentGateway::whereKeyword('stripe')->first();
        $paydata = $data->convertAutoData();
        \Config::set('services.stripe.key', $paydata['key']);
        \Config::set('services.stripe.secret', $paydata['secret']);
    }


    // public function processPayment(Request $request)
    // {
    //     // dd($request->all());
    //     // $amount = $request->payment_type === 'full' ? 10000 : 3000; // Full payment = $100, Partial = $30
    //     // StripeStripe::setApiKey(\Config::get('services.stripe.secret'));


    //     // Step 3: Create a PaymentIntent with the partial amount ($30)



    //     // Charge the customer with the selected amount
    //     try {
    //         // dd($request->all());
    //         $payment_type = $request->payment_type;

    //         $amount = $request->total_amount;
    //         if($payment_type == 'half'){
    //             $amount = 30;
    //         }
    //         // $token = $request->input('token');
    //         $amountInCents = $amount * 100;
    //         // dd(\Config::get('services.stripe.secret'));
    //         StripeStripe::setApiKey('sk_test_51Q8nvQ06842rfI09yfqSwBVXBDuhmWJCj1Xriv8fObHn1jVs4cIIQbJ3TpInWNq1wPKBiXT6jZN0dwOFUONDTzEq00zgDJTo3z');







    //             $customer = Customer::create([
    //                 'name' => Auth::user()->name,
    //                 'email' => Auth::user()->email,
    //                 'address' => [
    //                     'line1' => '510 Townsend St',
    //                     'postal_code' => '98140',
    //                     'city' => 'San Francisco',
    //                     'state' => 'CA',
    //                     'country' => 'US',
    //                 ],
    //             ]);

    //             Customer::createSource(
    //                 $customer->id,
    //                 ['source' => $request->stripeToken]
    //             );

    //             $charge = Charge::create([
    //                 "customer" => $customer->id,
    //                 "amount" => $amountInCents,

    //                 "currency" => "usd",
    //                 "description" => "Partial payment for order of ".$amount,
    //                 "metadata" => ["order_id" => 6735],

    //             ]);



    //         return response()->json(['is_success' => false, 'message' => 'Payment successful']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => true, 'message' => $e->getMessage()]);
    //     }
    // }

    public function processPayment(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $data = PaymentGateway::whereKeyword('stripe')->first();
        $total = $request->total_amount;
        $total = $request->payment_type === 'half' ? 30 : $total;
        if ($request->pass_check) {
            $auth = OrderHelper::auth_check($input); // For Authentication Checking
            if (!$auth['auth_success']) {
                return response()->json(['is_success' => false, 'message' => $auth['message']]);

            }
        }

        if (!Session::has('cart')) {
            
            return response()->json(['is_success' => false, 'message' => 'Cart is empty']);


        }

        $item_name = $this->gs->title . " Order";
        $item_number = Str::random(4) . time();
        $item_amount = $total * 100;
        $success_url = route('front.payment.return');


        // Validate Card Data

        $validator = \Validator::make($request->all(), [
            'stripeToken' => 'required',
        ]);

        // dd($total);

        if ($validator->passes()) {
            StripeStripe::setApiKey('sk_test_51Q8nvQ06842rfI09yfqSwBVXBDuhmWJCj1Xriv8fObHn1jVs4cIIQbJ3TpInWNq1wPKBiXT6jZN0dwOFUONDTzEq00zgDJTo3z');

            try {


                $customer = Customer::create([
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'address' => [
                        'line1' => '510 Townsend St',
                        'postal_code' => '98140',
                        'city' => 'San Francisco',
                        'state' => 'CA',
                        'country' => 'US',
                    ],
                ]);



                Customer::createSource(
                    $customer->id,
                    ['source' => $request->stripeToken]
                );

                $charge = Charge::create([
                    "customer" => $customer->id,
                    "amount" => $item_amount,
                    "currency" => "usd",
                    "description" => "Payment for order #" . $item_number,
                    "metadata" => ["order_number" => $item_number],

                ]);



                // dd($charge);
                if ($charge->status == 'succeeded') {
                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);
                    $totalQty = 0;
                    $totalPrice = 0;
                    foreach ($cart->items as $key => $product) {
                        if ($request->qty) {
                            foreach ($request->qty as $k => $qty) {
                                //$k explode uisng _

                                $k = explode('_', $k);
                                $color = Color::where('id', $k[1])->first()->color_name;
                                $size = Size::where('id', $k[2])->first()->size_name;
                                if ($key == $k[0] . $size . $color) {
                                    $totalQty += $qty;
                                    $totalPrice += $qty * $request->price[$k[0] . '_' . $k[1] . '_' . $k[2]];
                                    $cart->items[$key]['qty'] = $qty;
                                    $cart->items[$key]['price'] = $request->price[$k[0] . '_' . $k[1] . '_' . $k[2]];
                                    $cart->items[$key]['sub_total'] = $request->subtotal[$k[0] . '_' . $k[1] . '_' . $k[2]];
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
                    if ($request->billing_name && $request->billing_address1) {
                        $billing_address = [
                            'name' => $request->billing_name,
                            'billing_address1' => $request->billing_address1,
                            'billing_address2' => $request->billing_address2,
                            'billing_country' => $request->billing_country,
                            'billing_city' => $request->billing_city,
                            'billing_postcode' => $request->billing_postcode,
                        ];
                    }

                    if (isset($request->same_address) && $request->same_address == 'on') {
                        $shipping_address = [
                            'shipping_name' => $request->billing_name,
                            'shipping_address1' => $request->billing_address1,
                            'shipping_address2' => $request->billing_address2,
                            'shipping_country' => $request->billing_country,
                            'shipping_city' => $request->billing_city,
                            'shipping_postcode' => $request->billing_postcode,
                        ];
                    } else {

                        if ($request->shipping_name && $request->shipping_address1) {
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
                    $input['cart'] = $new_cart;
                    $input['user_id'] = Auth::check() ? Auth::user()->id : NULL;
                    $input['affilate_users'] = $affilate_users;
                    $input['pay_amount'] = $total / $this->curr->value;
                    $input['order_number'] = $item_number;
                    $input['billing_address'] = json_encode($billing_address);
                    $input['shipping_address'] = json_encode($shipping_address);
                    $input['wallet_price'] = $request->wallet_price / $this->curr->value;
                    $input['payment_status'] = "Completed";
                    $input['txnid'] = $charge->balance_transaction;
                    $input['charge_id'] = $charge->id;
                    // if ($input['tax_type'] == 'state_tax') {
                    //     $input['tax_location'] = State::findOrFail($input['tax'])->state;
                    // } else {
                    //     $input['tax_location'] = Country::findOrFail($input['tax'])->country_name;
                    // }
                    $input['tax'] = 0;

                    // if ($input['dp'] == 1) {
                    //     $input['status'] = 'completed';
                    // }
                    if (Session::has('affilate')) {
                        $val = $request->total / $this->curr->value;
                        $val = $val / 100;
                        $sub = $val * $this->gs->affilate_charge;
                        if ($temp_affilate_users != null) {
                            $t_sub = 0;
                            foreach ($temp_affilate_users as $t_cost) {
                                $t_sub += $t_cost['charge'];
                            }
                            $sub = $sub - $t_sub;
                        }
                        if ($sub > 0) {
                            $user = OrderHelper::affilate_check(Session::get('affilate'), $sub, $input['dp']); // For Affiliate Checking
                            $input['affilate_user'] = Session::get('affilate');
                            $input['affilate_charge'] = $sub;
                        }
                    }

                    $order->fill($input)->save();
                    $order->tracks()->create(['title' => 'Pending', 'text' => 'You have successfully placed your order.']);
                    $order->notifications()->create();

                    // if ($input['coupon_id'] != "") {
                    //     OrderHelper::coupon_check($input['coupon_id']); // For Coupon Checking
                    // }

                    // OrderHelper::size_qty_check($cart); // For Size Quantiy Checking
                    // OrderHelper::stock_check($cart); // For Stock Checking
                    // OrderHelper::vendor_order_check($cart, $order); // For Vendor Order Checking

                    Session::put('temporder', $order);
                    Session::put('tempcart', $cart);
                    Session::forget('cart');
                    Session::forget('already');
                    Session::forget('coupon');
                    Session::forget('coupon_total');
                    Session::forget('coupon_total1');
                    Session::forget('coupon_percentage');

                    if ($order->user_id != 0 && $order->wallet_price != 0) {
                        OrderHelper::add_to_transaction($order, $order->wallet_price); // Store To Transactions
                    }

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

                    $mailer = new GeniusMailer();
                    // $mailer->sendAutoOrderMail($data, $order->id);

                    //Sending Email To Admin
                    $data = [
                        'to' => $this->ps->contact_email,
                        'subject' => "New Order Recieved!!",
                        'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ".Please login to your panel to check. <br>Thank you.",
                    ];
                    $mailer = new GeniusMailer();
                    // $mailer->sendCustomMail($data);
                    // dd('success');
                    return response()->json(['is_success' => true, 'message' => 'Payment successful','url' => $success_url]);
                }
            } catch (Exception $e) {
                return response()->json(['is_success' => false, 'message' => $e->getMessage()]);
            } 
        }
        return response()->json(['is_success' => false, 'message' => 'Payment failed']);
    }
}
