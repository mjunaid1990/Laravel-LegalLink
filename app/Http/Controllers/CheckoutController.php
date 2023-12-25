<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreements;
use App\Models\Transactions;
use App\Models\User;
use App\Models\AgreementsPurchased;
use Auth;
class CheckoutController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $carts = session()->get('cart');
        
        if(empty($carts)) {
            return redirect('/');
        }
        
        if(!Auth::check()) {
            return redirect('/login');
        }
        
        $ids = [];
        $total = 0;
        
        if($carts) {
            foreach ($carts as $cart) {
                $ids[] = $cart['product_id'];
                $total += $cart['price'] * $cart['quantity'];
            }
        }
        
        if($ids) {
            $products = Agreements::whereIn('id', $ids)->get();
        }
        return view('checkout', compact('products', 'total'));
    }
    
    public function process(Request $request) {
        $data = $request->all();
        
        $is_yoco_live = get_setting_value_by_key('yoco_live_mode');
        if($is_yoco_live == 1) {
            $api_key = get_setting_value_by_key('yoco_live_secret_key');
        }else {
            $api_key = get_setting_value_by_key('yoco_test_secret_key');
        }

        $total = get_cart_total();
        
        $data['amount'] = $total * 100;
        $data['currency'] = 'ZAR';
        
        $req['amount'] = $total * 100;
        $req['currency'] = 'ZAR';
        
        

        $hash = base64_encode(serialize($data));
        
        $req['cancelUrl'] = url('/checkout/cancel?hash='.$hash);
        $req['successUrl'] = url('/checkout/success?hash='.$hash);

        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://payments.yoco.com/api/checkouts');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$api_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result);

        if($result->redirectUrl) {
            session()->put('paymentid', $result->id);
            return redirect()->away($result->redirectUrl);
        }
    }
    
    public function success(Request $request) {
        $id = session()->get('paymentid');
        $data = unserialize(base64_decode($request->get('hash')));
        if($id && $data) {

            $user = User::where('id', Auth::user()->id)->first();
            if($user) {
                $user->phone = $data['phone']?$data['phone']:null;
                $user->address = $data['address']?$data['address']:null;
                $user->city = $data['city']?$data['city']:null;
                $user->state = $data['state']?$data['state']:null;
                $user->zip = $data['zip']?$data['zip']:null;
                $user->save();
            }
            $transactionModel = Transactions::where('txn_id', $id)->where('added_from', Auth::user()->id)->first();
            if($transactionModel) {
                session()->put('cart', null);
                return redirect('/');
            }
            $transactionModel = new Transactions();
            $transactionModel->added_from = Auth::user()->id;
            $transactionModel->txn_id = $id;
            $transactionModel->amount = $data['amount'] / 100;
            $transactionModel->currency = 'ZAR';
            $transactionModel->status = 1;
            if($transactionModel->save()) {
                $carts = session()->get('cart');
                if($carts) {
                    foreach ($carts as $k=>$cart) {
                        $purchaseModel = new AgreementsPurchased();
                        $purchaseModel->added_from = Auth::user()->id;
                        $purchaseModel->agreement_id = $cart['product_id'];
                        $purchaseModel->transaction_id = $transactionModel->id;
                        $purchaseModel->txn_id = $id;
                        $purchaseModel->status = 'pending';
                        $purchaseModel->save();
                    }
                }
                session()->put('cart', null);
                return redirect('/user/agreements');
            }
        }
    }
    
    public function cancel(Request $request) {
        $request->session()->flash('message', 'Something went wrong! Payment is not made');
        return redirect('/checkout');
    }
    
    

}
