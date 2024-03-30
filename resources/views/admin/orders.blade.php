@include ('includes.navbar')
<div class="dashboard_container row ">

    <div class="col-md-3 ps-4  d-flex align-items-center justify-content-center">
        <div class="left_panel mt-4 shadow">
            <h4 class="text-white fw-bold p-5">Ecommerce</h4>
            <a href="/dashboard">
                <p><i class="fa-solid fa-table-columns mx-2"></i> Dashboard </p>
            </a>

            <a href="/adminproducts">
                <p><i class="fa-solid fa-store mx-2"></i> My Products</p>
            </a>
            <a href="/all-orders">
                <p class="active-left"><i class="fa-solid fa-money-bill mx-2"></i> Orders</p>
            </a>
            <a href="/users">
                <p><i class="fa-solid fa-user mx-2"></i> Users</p>
            </a>
            <p>
                <a class="nav-link" href="{{ route('logout') }}"><i class="fa-solid fa-lock mx-2 mb-3"></i>Logout</a>
            </p>



        </div>
    </div>
    <div class="col-md-9 pt-4 d-flex  justify-content-start flex-column">

    <div class="latest_orders">
            <p class="text-secondary mt-3 ms-2">All Orders</p>

            <div class="order_column-1">
                @foreach($orders as $order)
                <a href="{{ route('order.details', ['order_id' => $order->id]) }}"
                    class="text-decoration-none text-dark">
                    <div class="upper_lo-1 mb-2">

                        <div class="col-md-2 mx-2">
                            <img src="{{ asset('images/' . $order->product->images->first()->image_url) }}"
                                alt="{{ $order->product->name }}" style="width: 100%;">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <p class=" ">{{$order->product->name}}</p>
                            <p class="ps-16 text-success">₹{{$order->total}}</p>
                            <p class="ps-14"><strong>Order date: </strong>18 March</p>
                            <p class="ps-14"><strong>Quantity: </strong>{{$order->quantity}}</p>
                        </div>

                        <div class="d-flex ms-auto  p-2 ">
                            <!-- <p><i class="fa-solid fa-user mx-2"></i>{{$order->user->name}}</p>
                <button class="btn btn-danger">Reject</button>
                <button class="btn btn-warning ms-2">Shipped</button> -->
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </div>
    

</div>