<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agreements;


class WishlistController extends Controller
{
    public function index(){
        $data = [
            'lists' => session()->get('wishlist'),
            'title' => 'Wishlist'
        ];

        return view('wishlist', $data);
    }

    public function addToWishlist(Request $request){
        $cart = session()->get('wishlist');
        $id = $request->product_id;
        $product = Agreements::where('id', $id)->first();

        if(isset($cart[$id])) {
            $quantityUpdate = $request->quantity;

            if($quantityUpdate > $product->stock){
                return response()->json(['status' => 'failed','count' => count((array) session('wishlist')), 'code' => 202], 202);
            }

            $cart[$id]["quantity"] = $quantityUpdate;
            session()->put('wishlist', $cart);
            return response()->json(['status' => 'success','count' => count((array) session('wishlist')), 'code' => 201], 201);
        }

        $cart[$id] = [
            "product_id" =>  $id,
            "title" => $product->title,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "product_stock" => $product->stock
        ];

        session()->put('wishlist', $cart);

        return response()->json(['status' => 'success', 'count' => count((array) session('wishlist')), 'code' => 200], 200);
    }

    public function updateWishlist(Request $request)
    {
        if($request->product_id and $request->quantity){
            $cart = session()->get('wishlist');
            $cart[$request->product_id]["quantity"] = $request->quantity;
            session()->put('wishlist', $cart);

            $total = 0;

            foreach((array) session('wishlist') as $id => $details){
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json(['message' => 'Success', 'total' => $total]);
        }
    }

    public function deleteWishlist(Request $request){
        if($request->id) {
            $cart = session()->get('wishlist');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('wishlist', $cart);
            }

            $total = 0;

            foreach((array) session('wishlist') as $id => $details){
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json(['message' => 'Success', 'total' => $total, 'count' => count((array) session('wishlist'))]);
        }
    }
}
