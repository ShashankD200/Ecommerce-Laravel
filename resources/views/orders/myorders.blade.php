@include('includes.navbar')

<div class="container top-margin">
    <h1 class="mb-4">My Orders</h1>
    <div class="row">
        @if($orders->isEmpty())
        @if(session()->has('user_id'))

        <div class="container p-5 d-flex align-items-center justify-content-center alert alert-success">
            <h4>Currently you dont have any orders !</h4>
        </div>
        @else

        <div class="container p-5 d-flex align-items-center justify-content-center alert alert-success">
            <h4>Please Login to see your orders <a href="{{route('login')}}">Login here</a></h4>
            @endif
            @else
            @foreach($orders as $order)
            <a href="{{route('viewOrder', $order->id)}}" class="text-decoration-none">
                <div class="card mt-2">
                    <div class="container">
                        <div class="row justify-content-center align-items-center p-3">
                            <div class="col-md-2">
                                <img src="{{ asset('images/' . $order->product->images->first()->image_url) }}"
                                    alt="{{ $order->product->name }}" style="width: 100%;">
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column align-items-start justify-content-center">
                                    <p class="text-secondary" style="font-size:14px">Order placed on
                                        {{ date('j F', strtotime($order->created_at)) }}</p>

                                    <h5 class="mt-2 mb-0 ">{{ $order->product->name }}</h4>
                                        <span class="text-secondary mb-2" style="font-size:12px">{{
                                            $order->product->description }}</span>
                                        <p>Quantity : {{$order->quantity}}</p>
                                        <div class="d-flex align-items-center">
                                            <h5 class="product-price fw-bold">₹{{ $order->total }}</h5>
                                            <h6
                                                class="product-offer-price text-secondary ms-2 text-decoration-line-through">
                                                {{ $order->product->offer_price }}</h6>
                                            <h6 class="product-offer-price text-success fw-bold ms-2">
                                                {{ $order->product->discount }}%</h6>
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="d-flex align-items-center flex-column">


                                        <div class="d-flex align-items-center justify-content-evenly flex-column">
                                            @if($order->order_delivery_status == 4)
                                            <div class="d-flex flex-column justify-content-center align-items-center">

                                                <i class="fa-solid fa-ban text-danger"></i>
                                                <p class="text-danger fw-bold">Order Cancelled.</p>
                                                <p class="ps-14 text-danger">Order was Cancelled</p>
                                            </div>
                                            @endif
                                            @if($order->order_delivery_status == 0)
                                            <div class="d-flex flex-column justify-content-center align-items-center">

                                                <i class="fa-solid fa-thumbs-up text-success"></i>
                                                <p class="text-success fw-bold">Order placed. </p>
                                                <p class="ps-14 text-success">We will update
                                                    you soon.</p>
                                            </div>
                                            @else
                                            @if($order->order_delivery_status == 1)
                                            <div class="d-flex flex-column justify-content-center align-items-center">

                                                <i class="fa-solid fa-boxes-packing text-warning"></i>
                                                <p class="text-warning fw-bold"> Item Shipped</p>
                                                <p class="ps-14 text-warning">You item has been shipped.</p>
                                            </div>

                                            @endif
                                            @if($order->order_delivery_status == 2)
                                            <div class="d-flex flex-column justify-content-center align-items-center">

                                                <i class="fa-solid fa-check text-success fw-bold"></i>
                                                <p class="text-success fw-bold"> Delivered</p>
                                            </div>
                                            @endif

                                            @endif
                                        </div>



                                    

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
        <p style="font-size:14px" class="text-center text-secondary mt-5 mb-4">Have any issue ? <span
                class="text-primary">contact us</span></p>
    </div>