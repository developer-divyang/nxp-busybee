<?php

namespace App\Helpers;

use App\{
    Models\Cart,
    Models\User,
    Models\Coupon,
    Models\Product,
    Models\Transaction,
    Models\VendorOrder,
    Models\Notification,
    Models\UserNotification
};

use Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Str;

class ProductHelper
{
    public static function auth_check($data)
    {
        try{
            $resdata = array();
            $users = User::where('email','=',$data['personal_email'])->get();
            if(count($users) == 0) {
                if ($data['personal_pass'] == $data['personal_confirm']){
                    $user = new User;
                    $user->name = $data['personal_name'];
                    $user->email = $data['personal_email'];
                    $user->password = bcrypt($data['personal_pass']);
                    $token = md5(time().$data['personal_name'].$data['personal_email']);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($data['personal_name'].$data['personal_email']);
                    $user->email_verified = 'Yes';
                    $user->save();
                    Auth::login($user);
                    $resdata['auth_success'] = true;
                }else{
                    $resdata['auth_success'] = false;
                    $resdata['error_message'] = __("Confirm Password Doesn't Match.");
                }
            }
            else {
                $resdata['auth_success'] = false;
                $resdata['error_message'] = __("This Email Already Exist.");
            }
            return $resdata;
        }
        catch(\Exception $e){

        }
    }


    public static function getProductCount($fields, $where = null,$table = 'products')
    {
        try {
            
            if ($where == null) {
                return DB::table($table)->count($fields);
            } else {
                if($table == 'products'){
                    return DB::table($table)->where($fields, $where)->where('status',1)->count();
                }else{
                return DB::table($table)->where($fields, $where)->groupBy('product_id')->count();
                }

            }
        } catch (\Exception $e) {
        }
    }

}
