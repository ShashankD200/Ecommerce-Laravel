<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $user = User::find($user_id);

        $orders = Order::latest()->get();

        $order_total = Order::whereMonth('created_at', 3)
            ->whereYear('created_at', date('Y'))
            ->get();
        $total_for_march = $order_total->sum('total');

        $top_selling_products = Order::select('product_id', DB::raw('count(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->take(3)
            ->get();

        $products = [];
        foreach ($top_selling_products as $order) {
            $product = Product::find($order->product_id);
            $products[] = $product;
        }

        return view('admin.dashboard', compact('user', 'orders', 'total_for_march', 'products'));
    }
    public function show($order_id)
    {



        $order = Order::findOrFail($order_id);

        $order_data = Order::where('id', $order_id)->first();
        $product_details = Product::where('id', $order_data->product_id)->first();
        $user_details = User::where('id', $order_data->user_id)->first();


        return view('admin.AdminorderDetails', compact('product_details', 'user_details', 'order_data'));
    }
    public function products()
    {
        $user_id = Session::get('user_id');
        $user = User::find($user_id);

        $orders = Order::latest()->get();

        $order_total = Order::whereMonth('created_at', 3)
            ->whereYear('created_at', date('Y'))
            ->get();
        $total_for_march = $order_total->sum('total');

        $top_selling_products = Order::select('product_id', DB::raw('count(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->take(3)
            ->get();

        $products = [];
        foreach ($top_selling_products as $order) {
            $product = Product::find($order->product_id);
            $products[] = $product;
        }
        $product_data = Product::get();
        return view('admin.products', compact('user', 'orders', 'total_for_march', 'products', 'product_data'));

    }
    public function orders()
    {
        $user_id = Session::get('user_id');
        $user = User::find($user_id);

        $orders = Order::latest()->get();

        $order_total = Order::whereMonth('created_at', 3)
            ->whereYear('created_at', date('Y'))
            ->get();
        $total_for_march = $order_total->sum('total');

        $top_selling_products = Order::select('product_id', DB::raw('count(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->take(3)
            ->get();

        $products = [];
        foreach ($top_selling_products as $order) {
            $product = Product::find($order->product_id);
            $products[] = $product;
        }

        return view('admin.orders', compact('user', 'orders', 'total_for_march', 'products'));
    }
    public function all_users()
    {
        $users = User::get();
        return view('admin.allUsers',compact('users'));
    }

}