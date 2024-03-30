@include('includes.navbar')

<div class="container top-margin">

<p class="mt-3" style="color:#FFC737">Shop latest Shoes collection</p>
<h1>Casual Shoes</h1>
<div class="row mt-3">

@foreach ($products as $product)

<div class="col-md-3 mb-4">
    <a href="{{ route('product.show', $product->id) }}">
        <div class="card shadow product-card">
            <p class="product_filler">Bestseller</p>
            <i class="fa-solid fa-heart wishlist"></i>

            <div class="slick-slider" style="min-height:200px">
                @foreach($product->images as $image)
                <div class="mt-3">
                    <img src="{{ asset('images/'.$image->image_url) }}" class="mt-3 card-img-top w-100"
                        alt="Product Image">
                </div>
                @endforeach
            </div>
            <div class="card-body d-flex flex-column ms-3">
                <p class="card-text" style="color:#b4b4b4">{{$product->description}}</p>

                <h5 class="card-title">{{$product->name}}</h5>

                <div class="d-flex align-items-center">
                    <h5 class="fw-bold">₹{{$product->price}}</h5>
                    <h6 class="text-secondary text-decoration-line-through ms-2">₹{{$product->offer_price}}
                    </h6>
                    <h6 class="text-success ms-2 fw-bold">{{$product->discount}}% off</h6>
                </div>


            </div>
        </div>
    </a>
</div>
@endforeach




<!-- Repeat the above card for other featured products -->
</div>
</div>