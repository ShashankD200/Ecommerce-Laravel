<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{


    public function add_order(Request $request)
{
    $user_id = Session::get('user_id');
    $payment_id = $request->input('payment_id');
    $item_quantity = $request->input('item_quantity');

    $cart_items = Cart::where('user_id', $user_id)->where('valid', '0')->get();

    $address = Address::where('user_id', $user_id)->latest()->first();

    $delivery_date = Carbon::now()->addDays(5);

    $order_address = $address->line_1 . ', ' . $address->line_2 . ', ' . $address->city . ', ' . $address->state . ', ' . $address->mobile;

    foreach ($cart_items as $cart_item) {
        $product = Product::find($cart_item->product_id);

        $order = new Order();
        $order->user_id = $user_id;
        $order->total = $product->price * $item_quantity; // Calculate total based on product price and quantity
        $order->cart_id = $cart_item->cart_id;
        $order->payment_id = $payment_id;
        $order->product_id = $cart_item->product_id;
        $order->delivery_address = $order_address;
        $order->delivery_date = $delivery_date->toDateString(); 
        $order->quantity = $item_quantity; 
        $order->save();

        $cart_item->valid = 1;
        $cart_item->save();
    }

    Cart::where('user_id', $user_id)->whereIn('cart_id', $cart_items->pluck('cart_id'))->update(['order_completed' => 1]);

    return response()->json(['message' => 'Orders added successfully'], 200);
}


    public function index()
    {
        $user_id = Session::get('user_id');

        $orders = Order::where('user_id', $user_id)
            ->with('product')
            ->latest()
            ->get();

        return view('orders.myorders', ['orders' => $orders]);
    }
    public function viewOrder($id)
    {
        $user_id = Session::get('user_id');
        $order_details = Order::findOrFail($id);

        $order_data = Order::where('id', $id)->first();
        $product_details = Product::where('id', $order_details->product_id)->first();
        $user_details = User::where('id', $user_id)->first();


        return view('orders.viewOrder', compact('product_details', 'user_details', 'order_data'));
    }
    public function cancel_order(Request $request)
    {

        $order_id = $request->input('order_id');

        $order = Order::where('id', $order_id)->first();

        if ($order) {
            $order->order_delivery_status = 4; // Assuming 1 represents a cancelled order status
            $order->save();

            return response()->json(['message' => 'Your order has been Cancelled.'], 200);
        } else {
            return response()->json(['message' => 'Order not found or unauthorized.'], 404);
        }
    }
    public function update_shipped(Request $request)
    {

        $order_id = $request->input('order_id');

        $order = Order::where('id', $order_id)->first();

        if ($order) {
            $order->order_delivery_status = 1; // Assuming 1 represents a cancelled order status
            $order->save();

            return response()->json(['message' => 'Your order has been Shipped.'], 200);
        } else {
            return response()->json(['message' => 'Order not found or unauthorized.'], 404);
        }
    }

}