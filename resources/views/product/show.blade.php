
@include('includes.navbar')


<div class="container top-margin product_view_container p-4 ">
    
<nav aria-label="breadcrumb mt-0">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
  </ol>
</nav>
   
    <div class="row">
    <div class="col-md-6 left_image_container">
    <div class="slick-slider" style="min-height:200px">
                            @foreach($product->images as $image)
                            <div class="mt-3">
                                <img src="{{ asset('images/'.$image->image_url) }}" class="mt-3 card-img-top w-100"
                                    alt="Product Image">
                            </div>
                            @endforeach
                        </div>
</div>

        <div class="col-md-6 d-flex flex-column">
        <h5 class="product-description text-secondary">{{ $product->description }}</h5>

        <h1 class="">{{ $product->name }}</h1>
        <p class="text-success fw-bold">Special Price</p>

            <div class="d-flex align-items-center">
            <h4 class="product-price fw-bold"> ₹{{ $product->price }}</h4>
            <h6 class="product-offer-price text-secondary ms-2 text-decoration-line-through"> ₹{{ $product->offer_price }}</h6>
            <h6 class="product-offer-price text-success fw-bold ms-2">{{ $product->discount }}% discount</h6>

            </div>
            <p><span class="fw-bold">Size :</span> {{ $product->size}}</p>
            <div class="payment-methods-available">
                
            </div>
            <div class="img_preview mt-auto">
    @foreach($product->images as $image)
        <img src="{{ asset('images/' . $image->image_url) }}" alt="">
    @endforeach
</div>


           <div class="d-flex justify-content-between mt-auto">
            
<button class="add_to_cart bg-warning w-100" data-user-id="{{ session('user_id') }}" data-product-id="{{$product->id}}"><i class="fa-solid fa-cart-shopping mx-2"></i>Add to cart</button>

            <button class="buy_now w-100 bg-primary">Buy Now</button>
           </div>
        </div>
    </div>
</div>


<script>
   
    $('.add_to_cart').click(function(){
        var userId = $(this).data('user-id');
            var productId = $(this).data('product-id');
            

            const formdata = {
                user_id :userId,
                product_id: productId
            };
            console.log(formdata);

            $.ajax({
                url:'addCart',
                type:'POST',
                data: formdata,
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
                success:function(response){
                    
                    show_toast("Item Added to cart.")
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error:function(response){
                    console.log(response);
                }

            });
    });
</script>
