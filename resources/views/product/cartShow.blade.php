@include('includes.navbar')

<div class="container top-margin ">
<div class="response_cart"></div>
    @if ($cartItems->isEmpty())
        <h1 class="text-center p-5 text-secondary rounded   mt-5  border"><i class="fa-solid fa-cart-plus"></i>   Your cart is empty.</h1>
    @else
    <div class="row">
        <div class="col-md-8">
        <div class="container">
        @foreach($cartItems as $item)
                    
               
        <div class="row mt-2 rounded  border">
                <div class="col-md-3 p-2">
                   
                <img src="{{ asset('images/' . $item->product->images->first()->image_url) }}" alt="{{ $item->product->name }}" width="100%">
                    <div class="d-flex w-100 align-items-center justify-content-evenly mt-2">
                    <i class="fa-solid fa-minus minus_quantity delete_item" data-cart="{{$item->cart_id}}"></i>
                    <input type="number" value="{{ $item->quantity }}" class="form-control w-50 item-quantity">
                    <i class="fa-solid fa-plus add_quantity add_item" data-product="{{ $item->product_id}}" data-cart="{{$item->cart_id}}"></i>

                    </div>
                </div>
                <div class="col-md-9 d-flex flex-column p-3">
                    <h4>{{ $item->product->name }}</h4>
                    <p>{{ $item->product->description }}</p>
                    <div class="d-flex align-items-center">
                        <h5 class="product-price fw-bold">₹{{ $item->product->price }}</h5>
                        <h6 class="product-offer-price text-secondary ms-2 text-decoration-line-through"> {{ $item->product->offer_price }}</h6>
                        <h6 class="product-offer-price text-success fw-bold ms-2">{{ $item->product->discount }}%</h6>
                    </div>
                    
                    <div class="d-flex align-items-center mt-auto">
                   
                        <h6 class="add_item" data-product="{{$item->product_id}}" data-cart="{{$item->cart_id}}">ADD</h6>
                        <h6 class="delete_item ms-3 " data-cart="{{$item->cart_id}}">REMOVE</h6>
                    </div>     
                </div>
        </div>
        @endforeach
    </div>




<div class="modal fade" id="newAddress" tabindex="-1" role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newAddressLabel">Add New Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="add_new_address ">


    <label for="address" class="mt-2">Address Line 1 :</label>
<input type="text" name="address_1" class="form-control" placeholder="Address Line 1" id="address_1">
   
  
    <label for="address" class="mt-2">Address Line 2 :</label>
<input type="text" name="address_2" class="form-control" placeholder="Address Line 2" id="address_2">
    

<div class="row">
    <div class="col-md-4">
    <label for="pincode" class="mt-2">Pincode :</label>
<input type="tel" name="pincode" class="form-control" placeholder="Pincode" id="pincode">
    </div>
    <div class="col-md-4">
    <label for="state" class="mt-2">State :</label>
<input type="text" name="state" class="form-control" placeholder="State" id="state">
    </div>
    <div class="col-md-4">
    <label for="City" class="mt-2">City :</label>
<input type="text" name="city" class="form-control" placeholder="City" id="city">
    </div>
</div>
    <div class="col-md-12">
    <label for="Mobile" class="mt-2">Mobile Number :</label>
<input type="text" name="mobile" class="form-control" placeholder="Mobile" id="mobile">
    </div>
    











</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id="address_button">Save Address</button>
      </div>
    </div>
  </div>
</div>
    
        </div>
        <div class="col-md-4 ">
       

<div class="card mt-2 rounded shadow">
    <div class="card-body bg-light">
        <h3 class="text-dark fw-bold">Default address </h3>
        <hr>

            
        @if($address)
       <div class="card ">
<div class="card-body">
    <p>{{ $address->line_1 }}, {{ $address->line_2 }}</p>
    <p></p>
    <p><strong>Pincode:</strong> {{ $address->pincode }}</p>
    <div class="d-flex"><p><strong>State:</strong> {{ $address->state }}</p>
        <p class="ms-2"><strong>City:</strong>{{ $address->city }}</p></div>

        <p><strong>Mobile Number:</strong> {{ $address->mobile }}</p>
      
</div>

       </div>
        
       
        @endif 
        <button class="btn btn-danger  mt-3 w-100" id="add_new_address_buton" data-toggle="modal" data-target="#newAddress">Add new address</button>
        
    </div>
</div>

            <div class="card mt-2 rounded shadow">
                <div class="card-body">
                    <h3 class="text-secondary">Price Details</h3>
                    <hr>
                    <h4><span class="fw-bold" id="total_amount_cart" data-total="{{$total}}">Total Amount</span> : ₹{{ $total }}</h4>
                    <hr>
                    <p>Delivery :  <span class="text-success fw-bold">Free</span></p>
                    <button class="w-100 btn btn-primary pt-3 mt-2 pb-3" id="checkoutButton">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
  
    
    $("#address_button").click(function(){
        
    const line_1 = $("#address_1").val();
    const line_2 = $("#address_2").val();
    const pincode = $("#pincode").val();
    const state = $("#state").val();
    const city = $("#city").val();
    const mobile = $("#mobile").val();

    if (line_1.trim() === "") {
        show_toast("Address line 1 cannot be empty. ");
        exit();
    }
    
    if (pincode.trim() === "" || isNaN(pincode)) {
        show_toast("Pincode should be a numeric value and cannot be empty. ");
        exit();
    }
    
    if (state.trim() === "") {
        show_toast("State cannot be empty.");
        exit();
    }
    
    if (city.trim() === "") {
        show_toast("City cannot be empty.");
        exit();
    }
    
    if (mobile.trim() === "" || isNaN(mobile) || mobile.length !== 10) {
        show_toast("Mobile number should be a 10-digit numeric value and cannot be empty.");
        exit();
    }

    const address = {
    line_1: line_1,
    line_2: line_2,
    pincode: pincode,
    state: state,
    city: city,
    mobile: mobile
    };

    $.ajax({
        type: "POST",
        url: "add_address",
        data: address,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function (response) {
            
            show_toast("Address has been Successfully added !");
            
            setTimeout(() => {
                $("#newAddress").modal('hide'); 
                location.reload(); 
            }, 2000);
            
        },
        error:function(error, xhr){
            show_toast(error);
}   
 });

    });
    $(".delete_item").click(function(){
        const cart_id = $(this).data('cart');
        console.log(cart_id);
        $.ajax({
            type:'POST',
            url:'deleteItem_cart',
            data:{cart_id:cart_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response) {
                show_toast("Item Removed");
                    setTimeout(function() {
   
        location.reload(); 
    }, 1000);
                
            },
            error: function(xhr, status, error) {
                console.error(error);
                show_toast("An error occurred while processing your request. Please try again later.");
            },
        })
    });
    $(".add_item").click(function(){
            const cart_id = $(this).data('cart');
           
            $.ajax({
                type: 'POST',
                url: 'updateQuantity_cart',
                data: {cart_id: cart_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                   show_toast("Quantity Increased.");
                    setTimeout(function() {
      
        location.reload(); 
    }, 1000 );
                    
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred while processing your request. Please try again later.");
                },
            });
        });

    document.getElementById('checkoutButton').addEventListener('click', function() {
       
        $.ajax({
            type: 'POST',
            url: '{{ route('createRazorpayPayment') }}', 
            data: {
                total: {{$total}}
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var options = {
                    "key": 'rzp_test_OKVX8tNzUFDmQO', 
                    "amount": response.amount,
                    "currency": response.currency, 
                    "name": "Ecommerce",
                    "description": "Purchase Description",
                    "order_id": response.id, 
                    "handler": function (response){
                        
                        
                        add_order(response);
                    },
                    "prefill": {
                        // Pre-fill customer details (optional)
                    },
                    "notes": {
                        // Additional notes (optional)
                    },
                    "theme": {
                        "color": "#F37254" // Customize color (optional)
                    }
                };

                var rzp = new Razorpay(options);
                rzp.open();
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("An error occurred while processing your request. Please try again later.");
            },
        });
    });

    function add_order(response) {
    var cartId = $('.add_item').data('cart'); 
    var total_amount_cart = $('#total_amount_cart').data('total'); 
    var item_quantity = $('.item-quantity').val(); 

    var productId = [];

$('.add_item').each(function() {
   
    var currentProductId = $(this).data('product'); 
    productId.push(currentProductId); 
    console.log(currentProductId);
});

    
    $.ajax({
        type: 'POST',
        url: 'add_order',
        data: {
            payment_id: response.razorpay_payment_id,
            total_amount: total_amount_cart,
            item_quantity:item_quantity
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            show_toast(response.message);
            location.reload();

        },
        error: function(xhr, status, error) {
            console.error(error);
            show_toast("An error occurred while inserting data into orders table. Please try again later.");
        }
    });
}


</script>
</script>
