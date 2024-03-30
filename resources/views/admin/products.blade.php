@include ('includes.navbar')


<div class="dashboard_container row ">
    <div class="col-md-3 ps-4  d-flex align-items-center justify-content-center">
        <div class="left_panel mt-4 shadow">
            <h4 class="text-white fw-bold p-5">Ecommerce</h4>
            <a href="/dashboard">
                <p><i class="fa-solid fa-table-columns mx-2"></i> Dashboard </p>
            </a>

            <a href="/adminproducts">
                <p class="active-left"><i class="fa-solid fa-store mx-2"></i> My Products</p>
            </a>
            <a href="/add-product">
                <p class="active-left-sub"><i class="fa-solid fa-plus"></i>Add Product</p>
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
    <div class="col-md-9 pt-4 d-flex  justify-content-start flex-column">


        <div class="row d-flex product_cont">
            <!-- Example Product Card -->
            @foreach ($product_data as $product)

            <div class="col-md-3 mb-4">
                <div class="card shadow product-card" style="height:400px;">
                    <img src="{{ asset('images/'.$product->images->first()->image_url) }}" class="card-img-top"
                        alt="Product Image">
                    <div class="card-body d-flex flex-column ">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>

                        <div class="d-flex align-items-center ">
                            <h5 class="fw-bold">₹{{$product->price}}</h5>
                            <h6 class="text-secondary text-decoration-line-through ms-2">₹{{$product->offer_price}}</h6>
                            <h6 class="text-success ms-2 fw-bold">{{$product->discount}}% off</h6>
                        </div>


                       
                    </div>
                    <div class="d-flex mt-auto justify-content-around m-0 ">
                            <a href="/edit/{{$product->id}}" class="btn btn-dark p-3 edit-product w-100" style="border-radius:0;" >Edit Item</a>
                            @if($product->is_allowed == 0)
                            <button class="btn btn-success access-product w-100 p-3 " style="border-radius:0;" data-id="{{$product->id}}">Reactivate
                                </button>
                                @else
                                <button class="btn btn-danger delete-product w-100  p-3 " style="border-radius:0;" data-id="{{$product->id}}">Delete
                                Item</button>
                                @endif
                        </div>
                </div>

            </div>
            @endforeach




            <!-- Repeat the above card for other featured products -->
        </div>

    </div>


</div>
<script>
$(".delete-product").click(function() {
    const product_id = $(this).data('id');
    console.log(product_id);

    const conf_dele = confirm("Confirm you want to Delete Item");
    if(conf_dele){
    $.ajax({
        type: "POST",
        url: "/delete_product",
        data: {product_id:product_id},
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

        success: function (response) {

            show_toast(response);
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
        ,error:function(error){
            show_toast(error);
        }
    });
}
});
$(".access-product").click(function() {
    const product_id = $(this).data('id');
    console.log(product_id);

    const conf_dele = confirm("Confirm you want to Reactivate Item");
    if(conf_dele){
    $.ajax({
        type: "POST",
        url: "/reactivate_product",
        data: {product_id:product_id},
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

        success: function (response) {

            show_toast(response);
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
        ,error:function(error){
            show_toast(error);
        }
    });
}
});
</script>