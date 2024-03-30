@include ('includes.navbar')
<div class="dashboard_container row  m-0">

    <div class="col-md-3  d-flex align-items-center justify-content-center">
        <div class="left_panel mt-4 shadow">
            <h4 class="text-white fw-bold p-5">Ecommerce</h4>
            <a href="/dashboard">
                <p class="active-left"><i class="fa-solid fa-table-columns mx-2"></i> Dashboard </p>
            </a>

            <a href="/adminproducts">
                <p><i class="fa-solid fa-store mx-2"></i> My Products</p>
            </a>
            <a href="/all-orders">
                <p><i class="fa-solid fa-money-bill mx-2"></i> Orders</p>
            </a>
            <a href="/users">
                <p><i class="fa-solid fa-user mx-2"></i> Users</p>
            </a>
            <p>
                <a class="nav-link" href="{{ route('logout') }}"><i class="fa-solid fa-lock mx-2 mb-3"></i>Logout</a>
            </p>



        </div>
    </div>
    <div class="col-md-6 pt-4 d-flex  justify-content-start flex-column">
    <div class="input-group mb-2 search_input">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-search"></i></span>
                    <input type="text" placeholder="Search" class="form-control w-75 search_input">
                    </div>

        <!-- <h5 class="fw-bold "><i class="fa-solid fa-ghost"></i> Hey {{$user->name}} ! </h5> -->


        <div class="latest_orders">
            <p class="text-secondary mt-3 ms-2">Latest Orders</p>

            <div class="order_column">
                @foreach($orders as $order)
                <a href="{{ route('order.details', ['order_id' => $order->id]) }}"
                    class="text-decoration-none text-dark">
                    <div class="upper_lo">
                        
                        <div class="mx-2 " style="width:100%;height:90px">
                            <img src="{{ asset('images/' . $order->product->images->first()->image_url) }}"
                                alt="{{ $order->product->name }}" style="height: 100%;width:100%;display:block; object-fit:contain;">
                        </div>
                        <div class=" d-flex align-items-start flex-column justify-content-center mt-auto ">
                            <p class="ps-14">{{$order->product->name}}</p>
                            <div class="d-flex align-items-center">
                                            <p class="product-price fw-bold ps-14">₹{{ $order->total }}</p>
                                            <p
                                                class="product-offer-price text-secondary ms-2 ps-14 text-decoration-line-through">
                                                {{ $order->product->offer_price }}</p>
                                            <p class="product-offer-price text-success ps-14 fw-bold ms-2">
                                                {{ $order->product->discount }}%</p>
                                        </div>

                            
                        </div>

                        
                    </div>
                </a>
                @endforeach

            </div>
        </div>
        <div class="transaction">
        <p class="text-secondary mt-3 ms-2">Transaction History <i class="fa-solid fa-up-long"></i></p>

        </div>

    </div>
    <div class="col-md-3 p-4" style="background-color:#F9D949">
        <div class="right-container-top ">
            <div class="d-flex align-items-center justify-content-around mt-2">
                <div class="col-md-3">
                    <img src="{{asset('images/shopping.png')}}" width="100%" alt="">
                </div>
                <div class="d-flex flex-column ">
                    <p class="ps-14 m-0">Total Sales</p>
                    <h3 class="text-dark m-0">March</h3>
                    <h3 class="text-success m-0">₹{{$total_for_march}}.00</h3>
                </div>
            </div>
            <div class="bg-white mt-3 top_selling mb-3 ">
                <h6><i class="fa-solid fa-star text-warning mx-1"></i> Top Selling Products</h6>
                @foreach($products as $key => $product)
                <p class="m-0 text-wrap">{{$key + 1}}. {{$product->name}}</p>
                @endforeach
            </div>


        </div>
        <div class="order_details  mt-3">

            <div class="order_pending">

                <h5>{{$orders->where('order_delivery_status', 0)->count()}}</h5>

                <h5>Orders pending</h5>
            </div>

            <div class="order_shipped mt-2">

                <h5>{{$orders->where('order_delivery_status', 1)->count()}}</h5>

                <h5>Orders Shipped</h5>
            </div>
            <div class="order_delivered mt-2">

                <h5>{{$orders->where('order_delivery_status', 2)->count()}}</h5>

                <h5>Orders Delivered</h5>
            </div>
            <div class="order_cancelled mt-2">

                <h5>{{$orders->where('order_delivery_status', 4)->count()}}</h5>

                <h5>Orders Cancelled</h5>
            </div>
            <div class="order_returned mt-2">

                <h5>{{$orders->where('order_delivery_status', 5)->count()}}</h5>

                <h5>Orders Returned</h5>
            </div>





        </div>

    </div>

</div>