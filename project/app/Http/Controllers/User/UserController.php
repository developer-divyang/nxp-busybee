<?php

namespace App\Http\Controllers\User;

use App\{
    Models\Order,
    Models\FavoriteSeller,
    Models\PaymentGateway
};
use App\Models\ChatMessage;
use Illuminate\{
    Http\Request,
    Support\Facades\Hash
};
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends UserBaseController
{

    public function index()
    {
        // dd('User Dashboard');
        $user = $this->user;
        //get all message login user order_id wise
       

        return view('user.dashboard', compact('user'));
    }

    public function loadNotifications()
    {
        $user = $this->user;
        $count = 0;
        $messages = ChatMessage::where('user_id', 1)->where('is_seen',0) // Admin replies
        ->whereIn('order_id', function ($query) use ($user) {
            $query->select('id')
                ->from('orders')
                ->where('user_id', $user->id); // Logged-in user's orders
        })
        ->get();
        $count += count($messages);

        $orders = Order::where('user_id', $user->id)->where('is_seen', 0)->get();
        // dd(count($orders));
        $count += count($orders);
        // dd($count);
        $html = view('user.order.notifications', compact('messages', 'orders'))->render();

        return response()->json(['count' => $count, 'html' => $html]);
    }

    public function showNotifications()
    {
        $user = $this->user;
        $count = 0;
        $messages = ChatMessage::where('user_id', 1)->where('is_seen', 0) // Admin replies
        ->whereIn('order_id', function ($query) use ($user) {
            $query->select('id')
                ->from('orders')
                ->where('user_id', $user->id); // Logged-in user's orders
        })
            ->get();
        $count = count($messages);

        if ($messages->count() > 0) {
            foreach ($messages as $data) {
                $data->is_seen = 1;
                $data->update();
            }
        }
        

        $count += count($messages);

        $orders = Order::where('user_id', $user->id)->where('is_seen',0)->get();

        foreach ($orders as $o) {
            $o->is_seen = 1;
            $o->update();
        }

        $count += count($orders);

        

        $html = view('user.order.notifications', compact('messages', 'orders'))->render();

        return response()->json(['count' => $count, 'html' => $html]);
    }
  

    public function profile()
    {
        $user = $this->user;
        return view('user.profile', compact('user'));
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section

        $rules =
            [
                'photo' => 'mimes:jpeg,jpg,png,svg',
                'email' => 'unique:users,email,' . $this->user->id
            ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = $this->user;
        if ($file = $request->file('photo')) {
            $extensions = ['jpeg', 'jpg', 'png', 'svg'];
            if (!in_array($file->getClientOriginalExtension(), $extensions)) {
                return response()->json(array('errors' => ['Image format not supported']));
            }

            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/users/', $name);
            if ($data->photo != null) {
                if (file_exists(public_path() . '/assets/images/users/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/users/' . $data->photo);
                }
            }
            $input['photo'] = $name;
        }

        if ($request->old_password) {
            if (Hash::check($request->old_password, $data->password)) {
                if ($request->password == $request->password_confirmation) {
                    $input['password'] = Hash::make($request->password);
                } else {
                    return response()->json(array('errors' => [0 => __('Confirm password does not match.')]));
                }
            } else {
                return response()->json(array('errors' => [0 => __('Current password Does not match.')]));
            }
        }

        $data->update($input);
        $msg = __('Successfully updated your profile');
        return response()->json($msg);
    }

    public function resetform()
    {
        return view('user.reset');
    }

    public function reset(Request $request)
    {
        $user = $this->user;
        if ($request->cpass) {
            if (Hash::check($request->cpass, $user->password)) {
                if ($request->newpass == $request->renewpass) {
                    $input['password'] = Hash::make($request->newpass);
                } else {
                    return response()->json(array('errors' => [0 => __('Confirm password does not match.')]));
                }
            } else {
                return response()->json(array('errors' => [0 => __('Current password Does not match.')]));
            }
        }
        $user->update($input);
        $msg = __('Successfully changed your password');
        return response()->json($msg);
    }

    public function loadpayment($slug1, $slug2)
    {
        $data['payment'] = $slug1;
        $data['pay_id'] = $slug2;
        $data['gateway'] = '';
        if ($data['pay_id'] != 0) {
            $data['gateway'] = PaymentGateway::findOrFail($data['pay_id']);
        }
        return view('load.payment-user', $data);
    }


    public function loadChat($orderId)
    {
        // dd('here');
        $messages = ChatMessage::where('order_id', $orderId)
            ->orderBy('created_at', 'asc')
            ->get();
        
        $html = view('user.order.messages', compact('messages'))->render();

        return response()->json(['count' => count($messages), 'html' => $html]);
    }

    public function sendChat(Request $request)
    {
        $message = new ChatMessage();
        $message->comment = $request->comment;
        $message->order_id = $request->order_id;
        if ($request->user_type == 'user') {
            $message->user_id = Auth::user()->id;
        } else {
            $message->user_id = Auth::guard('admin')->user()->id;
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('chat_files');
            $message->file_path = $path;
        }

        $message->save();

        return response()->json(['success' => true]);
    }

    public function favorite($id1, $id2)
    {
        $fav = new FavoriteSeller();
        $fav->user_id = $id1;
        $fav->vendor_id = $id2;
        $fav->save();
        $data['icon'] = '<i class="icofont-check"></i>';
        $data['text'] = __('Favorite');
        return response()->json($data);
    }

    public function favorites()
    {
        $user = $this->user;
        $favorites = FavoriteSeller::where('user_id', '=', $user->id)->get();
        return view('user.favorite', compact('user', 'favorites'));
    }


    public function favdelete($id)
    {
        $wish = FavoriteSeller::findOrFail($id);
        $wish->delete();
        return redirect()->route('user-favorites')->with('success', __('Successfully Removed The Seller.'));
    }

    public function affilate_code()
    {
        $user = $this->user;
        return view('user.affilate.affilate-program', compact('user'));
    }


    public function affilate_history()
    {
        $user = $this->user;
        $affilates = Order::where('status', '=', 'completed')->where('affilate_users', '!=', null)->get();
        $final_affilate_users = array();
        $i = 0;
        foreach ($affilates as $order) {
            $affilate_users = json_decode($order->affilate_users, true);
            foreach ($affilate_users as $key => $auser) {
                if ($auser['user_id'] == $user->id) {
                    $final_affilate_users[$i]['customer_name'] = $order->customer_name;
                    $final_affilate_users[$i]['product_id'] = $auser['product_id'];
                    $final_affilate_users[$i]['charge'] = \PriceHelper::showOrderCurrencyPrice(($auser['charge'] * $order->currency_value), $order->currency_sign);

                    $i++;
                }
            }
        }
        return view('user.affilate.affilate-history', compact('user', 'final_affilate_users'));
    }
}
