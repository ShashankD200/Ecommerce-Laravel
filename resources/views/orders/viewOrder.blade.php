@include('includes.navbar')

<div class="container top-margin">
    <div class="col-md-12 p-4">
        <div class="row border p-5">
            <div class="col-md-8">
                <p class="fw-bold">Delivery address</p>
                <p class="fw-bold">{{ $user_details->name }}</p>
                <p>{{ $order_data->delivery_address }}</p>
                <div class="d-flex w-50 mt-3">
                @if($order_data->order_delivery_status == 4)
                    <button class="btn  w-100" disabled id="cancel_order" data-order="{{$order_data->id}}"><i
                            class="fa-solid fa-ban "></i> Order Cancelled </button>
                    <button class="btn btn-success ms-2 w-100 " data-order="{{$order_data->id}}" id="refund_order"><i
                            class="fa-solid fa-rotate-left "></i> Initiate Refund</button>
                    @else
                    <button class="btn btn-danger w-100" id="cancel_order" data-order="{{$order_data->id}}"><i
                            class="fa-solid fa-ban "></i> Cancel Order </button>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <h6><i class="fa-solid fa-truck"></i> Delivery status</h6>
                @if($order_data->order_delivery_status !== 4)
                <p class="ms-2">
                    @if(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($order_data->delivery_date)))

                    Delivered on {{ \Carbon\Carbon::parse($order_data->delivery_date)->format('d M') }}
                    @else
                    Expected Delivery on {{ \Carbon\Carbon::parse($order_data->delivery_date)->format('d M') }}
                    @endif
                </p>
                @else
                <p class="ms-2 text-danger">Cancelled on {{\Carbon\Carbon::parse($order_data->updated_at)->format('d
                    M')}}
                </p>
                @endif
                <div class="alert alert-secondary mt-2">
                    @if($order_data->order_delivery_status == 1)
                    Order has been Shipped.
                    @elseif($order_data->order_delivery_status == 0)
                    Order has been Placed.
                    @elseif($order_data->order_delivery_status == 2)
                    Order has been Delivered.
                    @elseif($order_data->order_delivery_status == 3)
                    Order is being Return.
                    @elseif($order_data->order_delivery_status == 4)
                    Order has been Cancelled
                    @endif

            </div>
        </div>


        <div class="card border mt-4">
            <div class="container">
                <div class="row justify-content-center align-items-center p-3">
                    <div class="col-md-2">
                        <img src="{{ asset('images/' . $order_data->product->images->first()->image_url) }}"
                            alt="{{ $order_data->product->name }}" style="width: 100%;">
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <p class="mt-2">{{ $order_data->product->name }}</p>
                            <p>{{ $order_data->product->description }}</p>
                            <p>₹{{ $order_data->total }}</p>
                        </div>

                    </div>
                    <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-evenly pt-3 ">
                                @if($order_data->order_delivery_status == 4)
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <i class="fa-solid fa-ban text-danger"></i>
                                    <p class="text-danger fw-bold">Order has been Cancelled.</p>
                                </div>
                                @endif
                                @if($order_data->order_delivery_status == 0)
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <i class="fa-solid fa-thumbs-up text-success"></i>
                                    <p class="text-success fw-bold">Order has been placed. We will update you soon.</p>
                                </div>
                                @else
                                @if($order_data->order_delivery_status == 1)
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <i class="fa-solid fa-boxes-packing text-success"></i>
                                    <p class="text-success fw-bold"> Item Shipped</p>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <i class="fa-solid fa-check text-secondary"></i>
                                    <p class="text-secondary fw-light"> Delivered</p>
                                </div>
                                @endif
                                @if($order_data->order_delivery_status == 2)
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <i class="fa-solid fa-boxes-packing text-secondary"></i>
                                    <p class="text-secondary fw-bold"> Item Shipped</p>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <i class="fa-solid fa-check text-success fw-bold"></i>
                                    <p class="text-success fw-bold"> Delivered</p>
                                </div>
                                @endif

                                @endif
                            </div>

                    </div>
                </div>
                <div class="container">
                    <div class="order-summary mb-4">
                        <h2 >Order Summary</h2>
                        <p class="mt-3">Unit Price: ₹ {{$order_data->product->price}}.00</p>
                        <p>Quantity: {{$order_data->quantity}} pieces</p>
                        <p>Total Amount: ₹ {{$order_data->total}}</p>
                        <p>Transaction ID: <span class="text-primary text-decoration-underline">{{$order_data->payment_id}}</span></p>
                        <p>Payment Details: <span class="text-success ">Done</span></p>
                        <p class="total">Total Amount: ₹ {{$order_data->total}}</p>
                        <button class="btn btn-dark mt-2">Download Invoice</button>
                    </div>
                </div>
            </div>
        </div>

        <h6 class="text-center mt-5">back to <a href="{{route('myorders')}}">My Orders >></a></h6>


    </div>
</div>
<script>
    $("#cancel_order").click(function () {
        const order_id = $(this).data("order");
        console.log(order_id);
        $.ajax({
            type: "POST",
            url: "cancel_order",
            data: { order_id: order_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                show_toast("Your order has been Cancelled.");
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function (error) {
                show_toast(error);
            }
        });
    });
</script>