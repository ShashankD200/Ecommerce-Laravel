<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
</head>
@if(!session()->has('is_admin'))
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#0a0a0a;position:fixed;top:0;right:0;left:0;z-index:1;">
    <div class="container p-3">
        <a class="navbar-brand" href="{{route('home')}}">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <div class="dropdown">
  <button class="btn btn-secondary bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa-solid fa-shoe-prints mx-2"></i> Category
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/casual"> Casual</a>
    <a class="dropdown-item" href="/sneakers">Sneakers</a>
    <a class="dropdown-item" href="/sports">Sports</a>
    <a class="dropdown-item" href="/formal">Formal</a>
  </div>
</div>
                @if (!session()->has('user_id') && !session()->has('user_email'))

                <li class="nav-item ms-2">
                    <a class=" btn btn-secondary bg-transparent" href="{{ route('login') }}">Log in</a>
                </li>
                <li class="nav-item ms-2">
                    <a class=" btn btn-secondary bg-transparent" href="{{ route('register') }}">Register</a>
                </li>

                @else
                <li class="nav-item ms-2">
                    <a class=" btn btn-secondary bg-transparent" href="{{ route('logout') }}">Logout</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-secondary bg-transparent" href="{{ route('myorders') }}">My Orders</a>
                </li>
               
                @endif
             

            </ul>
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link d-flex mt-1 ms-2" href="{{ route('cart') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        @php
                        $cartItemCount = \App\Models\Cart::where('user_id',
                        session('user_id'))->where('order_completed',0)->count();
                        @endphp
                        @if ($cartItemCount > 0)
                        <span class="badge bg-primary ms-1">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    
                </li>
                <div class="dropdown">
  <button class="btn btn-secondary bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa-solid fa-bars mx-2"></i> Menu 
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="{{ route('home') }}"><i class="fa-solid fa-home mx-2"></i>Home</a>

  @if (!session()->has('user_id') && !session()->has('user_email'))

               
                    <a class="dropdown-item" href="{{ route('login') }}"><i class="fa-solid fa-key mx-2"></i> Log in</a>
        
                    <a class="dropdown-item" href="{{ route('register') }}"><i class="fa-solid fa-fingerprint mx-2"></i> Register</a>
          

                @else
  <a class="dropdown-item" href="{{route('profile')}}"><i class="fa-solid fa-user mx-2"></i> Profile</a>

                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-key mx-2"></i> Logout</a>
              
               
                    <a class="dropdown-item" href="{{ route('myorders') }}"><i class="fa-solid fa-bag-shopping mx-2"></i>My Orders</a>
                    @if(session('is_admin'))
               
               <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fa-solid fa-circle mx-2"></i> Dashboard</a>
       
           @endif
               
                @endif

                    
                   

  </div>
</div>
            </ul>
        </div>
    </div>
</nav>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    
      $(document).ready(function(){
        $('.slick-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: false
        });
        
    });
function show_toast(response) {
    Toastify({
        text: response,
        duration: 3000,
        gravity: "top",
        position: "center",
        stopOnFocus: true,
        style: {
            background: "red",
        },

    }).showToast();

}
</script>