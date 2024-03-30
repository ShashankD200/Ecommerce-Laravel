<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Store</title>

</head>

<body>
    @include('includes.navbar')



    <div class="container top-margin">
        <div class="jumbotron">
            <h1 class="display-4 fw-bold">Welcome to Ecommerce Store!</h1>
            <p style="color:#b4b4b4">Browse our wide range of products and find what you need.</p>
            <hr class="my-4">


        </div>
        <section id="category_selector">
            <h4 class="p-4"><i class="fa-solid fa-bars mx-3 text-warning"></i> Browse by Categories</h4>
            <div class="container category_container mb-5 mt-4">

                <a href="/casual">
                    <div class="d-flex category_card">
                        <img src="{{asset('images/Category/7562 1.png')}}" alt="">

                        <p>Casual</p>
                    </div>
                </a>
                <a href="/sports">
                    <div class="d-flex category_card" style="background-color:#32B950">
                        <img src="{{asset('images/Category/8176 1.png')}}" alt="">

                        <p>Sports</p>
                    </div>
                </a>
                <a href="/formal">
                    <div class="d-flex category_card" style="background-color:#E65454">
                        <img src="{{asset('images/Category/8180 1.png')}}" alt="">

                        <p>Formal</p>
                    </div>
                </a>
                <a href="/sneakers">
                    <div class="d-flex category_card" style="background-color:#387ADF">
                        <img src="{{asset('images/Category/131266 1.png')}}" alt="">

                        <p>Sneakers</p>
                    </div>
                </a>
            </div>

        </section>

        <section id="bestseller" class="mt-5 mb-5">
            <div class="container bestseller_container">
                <div class="bestseller_box">
                    <div class=" left-bestseller">
                        <h1>Bestseller of the Month</h1>
                        <h5 class="fw-bold">Nike Payback Grey</h5>
                        <div class="reviews">
                            <p class="review-left">4.7 <i class="fa-solid fa-star"></i>
                            <p>1,355 reviews</p>
                            </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-start rate">
                            <p class="fw-bold mx-2">₹2,599</p>
                            <p style="text-decoration:line-through;">₹3,999</p>
                            <p class="ms-2 text-success">38% off</p>
                        </div>

                        <Button>Buy Now</Button>
                    </div>
                    <img src="{{asset('images/Bestseller/7529 1.png')}}" alt="">


                </div>
            </div>
        </section>





        @if(session()->has('user_id') && session()->has('user_email'))
        Session is set
        @else
        Session is not set
        @endif

        <h2 class="mb-4 featured_products text-success">Featured Products</h2>
        <div class="featured_product_row">

            @foreach ($products as $product)

            <div class="col-md-3 mb-4">
                <a href="{{ route('product.show', $product->id) }}">
                    <div class="card shadow product-card">
                        @if($product->best_seller == 1)
                        <p class="product_filler">Bestseller</p>
                        @endif
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

        <section id="gender">
            <div class="gender_container">
                <div class="men">
                    <h4>For him</h4>
                    <h3>upto 40% off</h3>
                    <p>Explore stylish and trending shoes collection for men.</p>
                    <a href="/men">
                    <div class="goto_men">
                        <div class="">
                            <p class="fw-bold">Top Casual Shoes</p>
                            <p>upto 30% off on Men’s Casual Shoes</p>
                        </div>
                        <i class="fa-solid fa-arrow-right "></i>
                    </div>
                    </a>
                </div>
             
                <div class="women">
                    <h4>For her</h4>
                    <h3>upto 40% off</h3>
                    <p>Explore Beautiful Shoe Collection that matches yor outfit.</p>
                    <a href="/women">
                    <div class="goto_men">
                        <div class="">
                            <p class="fw-bold">Women Footwear</p>
                            <p>upto 40% off on Women’s Footwear</p>
                        </div>
                        <i class="fa-solid fa-arrow-right "></i>
                    </div>
                    </a>
                </div>
                
            </div>
        </section>

    </div>

    <footer>
        <div class="footer">
            <div class="footer-sec-1">
                <h2>Ecommerce</h2>
                <p>Evolve Design <br> @2024 copyright license</p>
            </div>
            <div class="footer-sec-2">
                <h2>Products</h2>
                <a href="/casual">Casual Shoes</a>
                <a href="/formal">Formal Shoes</a>
                <a href="/sports">Sports Shoes</a>
                <a href="/sneakers">Sneakers</a>
            </div>
            <div class="footer-sec-3">
                <h2>About us</h2>
                <a href="">Contact us</a>
                <a href="">Privacy Policy</a>
                <a href="">Returns & Replacement</a>
            </div>
            <div class="footer-sec-4">
                <h2>Get in Touch</h2>
                <a href="">Customer Helpline</a>
                <a href="">+1800-7676767</a>

            </div>
        </div>
    </footer>
</body>

</html>