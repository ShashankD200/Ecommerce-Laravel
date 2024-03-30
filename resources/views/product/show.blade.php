
@include('includes.navbar')

<div class="container top-margin product_view_container p-4 ">
   
    <div class="row">
    <div class="col-md-6 left_image_container">
    @if($product->images->isNotEmpty())
        <img src="{{ asset('images/' . $product->images->first()->image_url) }}" class="img-fluid" alt="Product Image">
    @endif
</div>

        <div class="col-md-6 d-flex flex-column">
        <h1 class="my-4">{{ $product->name }}</h1>
        <p class="product-description">{{ $product->description }}</p>
            <div class="d-flex align-items-center">
            <h4 class="product-price fw-bold"> ₹{{ $product->price }}</h4>
            <h6 class="product-offer-price text-secondary ms-2 text-decoration-line-through"> ₹{{ $product->offer_price }}</h6>
            <h6 class="product-offer-price text-success fw-bold ms-2">{{ $product->discount }}% discount</h6>

            </div>
            <p><span class="fw-bold">Size :</span> {{ $product->size}}</p>
            <div class="img_preview mt-auto">
    @foreach($product->images as $image)
        <img src="{{ asset('images/' . $image->image_url) }}" alt="">
    @endforeach
</div>


           <div class="d-flex justify-content-between mt-auto">
            
<button class="add_to_cart w-100" data-user-id="{{ session('user_id') }}" data-product-id="{{$product->id}}">Add to cart</button>

            <button class="buy_now w-100">Buy Now</button>
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
