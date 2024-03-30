<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\Product;
use App\Models\Address;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
{
    $user_id = $request->user_id;
    $product_id = $request->product_id;

    $existingCartItem = Cart::where('user_id', $user_id)
                            ->where('product_id', $product_id)
                            ->where('order_completed',0)
                            ->first();

    if ($existingCartItem) {
        $existingCartItem->increment('quantity');
    } else {
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->quantity = 1;
        $cart->price = 400;
        $cart->valid = 0;
        $cart->save();
    }

    return response()->json('Item added to cart successfully');
}
public function show()
{
    $user_id = Session::get('user_id');

    if (!$user_id) {
        return redirect()->route('login')->with('error', 'Please log in to view your cart.');
    }

    $cartItems = Cart::where('user_id', $user_id)
        ->with('product.images')
        ->where('valid', 0)
        ->get();

    $total = $cartItems->sum(function ($item) {
        return $item->quantity * $item->product->price;
    });
    
    $address = Address::where('user_id', $user_id)->latest()->first();

    return view('product.cartShow', compact('cartItems', 'total', 'address'));
}

public function deleteItem_cart(Request $request)
{
    $user_id = Session::get('user_id');
    $cart_id = $request->cart_id;

    $cartItem = Cart::where('user_id', $user_id)
                    ->where('cart_id', $cart_id)
                    ->first();

    if ($cartItem) {
        if ($cartItem->quantity > 1) {
            // If quantity is greater than 1, decrement the quantity
            $cartItem->decrement('quantity');
        } else {
            // If quantity is 1, delete the cart item
            $cartItem->delete();
        }
        return response()->json('Item quantity updated successfully');
    } else {
        return response()->json('Cart item not found', 404);
    }
}
public function updateQuantity_cart(Request $request)
{
    $user_id = Session::get('user_id');
    $cart_id = $request->cart_id;

    $cartItem = Cart::where('user_id', $user_id)
                    ->where('cart_id', $cart_id)
                    ->first();

    if ($cartItem) {
        $cartItem->increment('quantity'); // Increment quantity by 1
        return response()->json('Item quantity updated successfully');
    } else {
        return response()->json('Cart item not found', 404);
    }
}
}
