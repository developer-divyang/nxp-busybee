<?php

namespace App\Http\Controllers\Front;

use App\{
    Models\Cart,
    Models\Order,
    Models\PaymentGateway
};
use App\Models\Product;
use App\Models\State;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use Validator;


class CheckoutController extends FrontBaseController
{
    // Loading Payment Gateways

    public function loadpayment($slug1, $slug2)
    {
        $curr = $this->curr;
        $payment = $slug1;
        $pay_id = $slug2;
        $gateway = '';
        if ($pay_id != 0) {
            $gateway = PaymentGateway::findOrFail($pay_id);
        }
        return view('load.payment', compact('payment', 'pay_id', 'gateway', 'curr'));
    }

    // Wallet Amount Checking

    public function walletcheck()
    {
        $amount = (float)$_GET['code'];
        $total = (float)$_GET['total'];
        $balance = Auth::user()->balance;
        if ($amount <= $balance) {
            if ($amount > 0 && $amount <= $total) {
                $total -= $amount;
                $data[0] = $total;
                $data[1] = $amount;
                $data[2] = \PriceHelper::showCurrencyPrice($total);
                $data[3] = \PriceHelper::showCurrencyPrice($amount);
                return response()->json($data);
            } else {
                return response()->json(0);
            }
        } else {
            return response()->json(0);
        }
    }

    public function checkout()
    {

        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success', __("You don't have any product to checkout."));
        }
        $dp = 1;
        $vendor_shipping_id = 0;
        $vendor_packing_id = 0;
        $curr = $this->curr;
        $gateways =  PaymentGateway::scopeHasGateway($this->curr->id);
        $pickups =  DB::table('pickups')->whereLanguageId($this->language->id)->get();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $paystack = PaymentGateway::whereKeyword('paystack')->first();
        $paystackData = $paystack->convertAutoData();
        // $voguepay = PaymentGateway::whereKeyword('voguepay')->first();
        // $voguepayData = $voguepay->convertAutoData();
        // If a user is Authenticated then there is no problm user can go for checkout

        if (Auth::check()) {

            // Shipping Method

            if ($this->gs->multiple_shipping == 1) {
                $ship_data = Order::getShipData($cart, $this->language->id);
                $shipping_data = $ship_data['shipping_data'];
                $vendor_shipping_id = $ship_data['vendor_shipping_id'];
            } else {
                $shipping_data  = DB::table('shippings')->whereLanguageId($this->language->id)->whereUserId(0)->get();
            }

            // Packaging

            if ($this->gs->multiple_packaging == 1) {
                $pack_data = Order::getPackingData($cart, $this->language->id);
                $package_data = $pack_data['package_data'];
                $vendor_packing_id = $pack_data['vendor_packing_id'];
            } else {
                $package_data  = DB::table('packages')->whereLanguageId($this->language->id)->whereUserId(0)->get();
            }
            foreach ($products as $prod) {
                if ($prod['item']['type'] == 'Physical') {
                    $dp = 0;
                    break;
                }
            }
            $total = $cart->totalPrice;
            $coupon = Session::has('coupon') ? Session::get('coupon') : 0;

            if (!Session::has('coupon_total')) {
                $total = $total - $coupon;
                $total = $total + 0;
            } else {
                $total = Session::get('coupon_total');
                $total =  str_replace(',', '', str_replace($curr->sign, '', $total));
            }

            return view('frontend.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'paystack' => $paystackData]);
        } else {



            if ($this->gs->guest_checkout == 1) {
                if ($this->gs->multiple_shipping == 1) {
                    $ship_data = Order::getShipData($cart, $this->language->id);
                    $shipping_data = $ship_data['shipping_data'];
                    $vendor_shipping_id = $ship_data['vendor_shipping_id'];
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }

                // Packaging

                if ($this->gs->multiple_packaging == 1) {
                    $pack_data = Order::getPackingData($cart, $this->language->id);
                    $package_data = $pack_data['package_data'];
                    $vendor_packing_id = $pack_data['vendor_packing_id'];
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }

                foreach ($products as $prod) {
                    if ($prod['item']['type'] == 'Physical') {
                        $dp = 0;
                        break;
                    }
                }
                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;

                if (!Session::has('coupon_total')) {
                    $total = $total - $coupon;
                    $total = $total + 0;
                } else {
                    $total = Session::get('coupon_total');
                    $total =  str_replace($curr->sign, '', $total) + round(0 * $curr->value, 2);
                }
                foreach ($products as $prod) {
                    if ($prod['item']['type'] != 'Physical') {
                        if (!Auth::check()) {
                            $ck = 1;
                            return view('frontend.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'paystack' => $paystackData]);
                        }
                    }
                }
                return view('frontend.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'paystack' => $paystackData]);
            }

            // If guest checkout is Deactivated then display pop up form with proper error message

            else {

                // Shipping Method

                if ($this->gs->multiple_shipping == 1) {
                    $ship_data = Order::getShipData($cart, $this->language->id);
                    $shipping_data = $ship_data['shipping_data'];
                    $vendor_shipping_id = $ship_data['vendor_shipping_id'];
                } else {
                    $shipping_data  = DB::table('shippings')->where('user_id', '=', 0)->get();
                }

                // Packaging

                if ($this->gs->multiple_packaging == 1) {
                    $pack_data = Order::getPackingData($cart, $this->language->id);
                    $package_data = $pack_data['package_data'];
                    $vendor_packing_id = $pack_data['vendor_packing_id'];
                } else {
                    $package_data  = DB::table('packages')->where('user_id', '=', 0)->get();
                }

                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;

                if (!Session::has('coupon_total')) {
                    $total = $total - $coupon;
                    $total = $total + 0;
                } else {
                    $total = Session::get('coupon_total');
                    $total = $total;
                }
                $ck = 1;
                return view('frontend.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr, 'shipping_data' => $shipping_data, 'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'paystack' => $paystackData]);
            }
        }
    }


    public function getShippingMethod(Request $request)
    {
        $rules =
            [
                'city' => 'required',
                'state' => 'required',
                'postcode' => 'required',
                'total_qty' => 'required',

            ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['is_success' => false, 'message' => $validator->errors()->first()]);
        }

        $total_qty = $request->total_qty;
        $postcode = $request->postcode;
        $city = $request->city;
        $state = $request->state;



        //call post api to get shipping methods 


        $url = 'https://ssapi5.shipstation.com/shipments/getrates';

$length = 0;
$width = 0;
$height = 0;
if($total_qty >= 1 && $total_qty <= 6){
    $length = 10;
    $width = 8;
    $height = 8;
}else if($total_qty >= 7 && $total_qty <= 12){
    $length = 14;
    $width = 8;
    $height = 8;
}else if($total_qty >= 13 && $total_qty <= 30){
    $length = 15;
    $width = 16;
    $height = 7;
}else if($total_qty >= 31 && $total_qty <= 120){
    $length = 21;
    $width = 15.5;
    $height = 11.5;
}

    $data = [
            'carrierCode' => 'ups_walleted',
            'serviceCode' => '',
            'packageCode' => '',
            'fromPostalCode' => '78109',
            'toState' => $state,
            'toCountry' => 'US',
            'toPostalCode' => $postcode,
            'toCity' => $city,
            'weight' => [
                'value' => $total_qty * 3,
                'units' => 'ounces'
            ],
            'dimensions' => [
                'units' => 'inches',
                'length' => $length,
                'width' => $width,
                'height' => $height
            ],
            'confirmation' => 'delivery',
            'residential' => false
        ];

        // dd(json_encode($data));


        $headers = [
            'Content-Type: application/json',
            'Authorization: Basic NTA4OWU0YzA0ODE4NDg5MzlkNWZiY2M4OWNiM2JjYTc6NWM4MWYyMGQyNTlhNDNjMjllM2ExODM3OTM0MzRjZDE='
        ];

        //call api  using crl with try catch block
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response, true);
            
            if(isset($response['Message'])){
                return response()->json(['is_success' => false, 'message' => $response['Message'].' Enter valid City State Or Postcode.']);
            }else{
                return response()->json(['is_success' => true, 'data' => $response]);
            }
            
        }
        catch (\Exception $e) {
            return response()->json(['is_success' => false, 'message' => $e->getMessage()]);
        }



        

        
        

    }


    public function getState($country_id)
    {

        $states = State::where('country_id', $country_id)->get();

        if (Auth::user()) {
            $user_state = Auth::user()->state;
        } else {
            $user_state = 0;
        }


        $html_states = '<option value="" > Select State </option>';
        foreach ($states as $state) {
            if ($state->id == $user_state) {
                $check = 'selected';
            } else {

                $check = '';
            }
            $html_states .= '<option value="' . $state->id . '"   rel="' . $state->country->id . '" ' . $check . ' >' . $state->state . '</option>';
        }

        return response()->json(["data" => $html_states, "state" => $user_state]);
    }


    // Redirect To Checkout Page If Payment is Cancelled

    public function paycancle()
    {

        return redirect()->route('front.checkout')->with('unsuccess', __('Payment Cancelled.'));
    }


    // Redirect To Success Page If Payment is Comleted

    public function payreturn()
    {

        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }

        return view('frontend.success', compact('tempcart', 'order'));
    }
}
