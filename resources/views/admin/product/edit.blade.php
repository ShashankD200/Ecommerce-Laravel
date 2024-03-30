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
            <a >
                <p class="active-left-sub-active"><i class="fa-solid fa-minus"></i>Edit Product</p>
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
        <div class="row">
            <div class="col-md-8">

                <div class="container  d-flex align-items-center justify-content-center flex-column">



                <div class="add_product_container">
    <h4 class="head_col">Hey Admin <i class="fa-solid fa-circle"></i></h4>

    <div class="mb-2">
        <label for="images" class="form-label">Product Images</label>
        <div id="image-preview" class="d-flex mb-2">
        @foreach($product->images as $image)
                <div class="image-container" style="position: relative;">
                    <img src="{{ asset('images/'.$image->image_url)}}" alt="Product Image" style="width: 70px; height: 70px;object-fit:contain; margin-right: 5px;">
                    <i class="fa-solid fa-cancel remove-image text-danger" data-image="{{$image->image_id}}" style="position: absolute; top: 5px; right: 5px;cursor:pointer;"></i>
                </div>
            @endforeach
        </div>
        <input type="file" class="form-control" id="images" name="images[]" multiple>
    </div>
    <input type="text" class="d-none" id="product_id" value="{{$product->id}}">
    <div class="mb-1">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" placeholder="Product Name">
    </div>
    <div class="mb-2 d-flex">
        <div class="mx-2">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category">
            <option value="1" {{ $product->category == 1 ? 'selected' : '' }}>Sneakers</option>
            <option value="2" {{ $product->category == 2 ? 'selected' : '' }}>Casual</option>
            <option value="3" {{ $product->category == 3 ? 'selected' : '' }}>Sports</option>
        </select>
        </div>
      <div>
      <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="1" {{ $product->gender == 1 ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ $product->gender == 2 ? 'selected' : '' }}>Female</option>
                                <option value="3" {{ $product->gender == 3 ? 'selected' : '' }}>Unisex</option>
                            </select>
      </div>

  
</div>
    <div class="mb-2">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" placeholder="Product Description" rows="3">{{ $product->description }}</textarea>
    </div>
    <div class="mb-2">
        <label for="size" class="form-label">Size</label>
        <input type="text" class="form-control" value="{{ $product->size }}" placeholder="Product Size" id="size" name="size">
    </div>
    <div class="mb-2 d-flex" style="gap:8px">
        <div>
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" value="{{ $product->price }}" placeholder="Original Price" id="price" name="price">
        </div>
        <div>
            <label for="offer_price" class="form-label">Offer Price</label>
            <input type="number" class="form-control" value="{{ $product->offer_price }}" placeholder="Product Increased Price" id="offer_price" name="offer_price">
        </div>
        <div>
            <label for="discount" class="form-label">Discount %</label>
            <input type="number" disabled class="form-control" value="{{ $product->discount }}" id="discount" name="discount">
        </div>
    </div>
    <div class="mb-2">
        <label for="in_stock" class="form-label">In Stock</label>
        <select class="form-select" id="in_stock" name="in_stock">
            <option value="1" {{ $product->in_stock == 1 ? 'selected' : '' }}>Available</option>
            <option value="0" {{ $product->in_stock == 0 ? 'selected' : '' }}>Not Available</option>
        </select>
    </div>

    <button id="update_product" class=" btn-outline-dark btn mt-2 w-100">Update Product</button>
</div>


                </div>
            </div>

            <div class="col-md-4">

                <h4>Product View</h4>
                <h6 class="text-success">Your Product is now Live</h6>
                <div class="card shadow product-card">
                    <div class="slick-slider" style="min-height:200px">
                        @foreach($product->images as $image)
                        <div>
                            <img src="{{ asset('images/'.$image->image_url) }}" class="mt-3 card-img-top w-100"
                                alt="Product Image">
                        </div>
                        @endforeach
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>

                        <div class="d-flex align-items-center">
                            <h5 class="fw-bold">₹{{$product->price}}</h5>
                            <h6 class="text-secondary text-decoration-line-through ms-2">₹{{$product->offer_price}}</h6>
                            <h6 class="text-success ms-2 fw-bold">{{$product->discount}}% off</h6>
                        </div>

                        <p><span class="text-secondary">Size </span>{{$product->size}}</p>
                    </div>
                </div>



            </div>
        </div>
    </div>


</div>

<script>
$('#image-preview').on('click', '.remove-image', function() {
            var imageId = $(this).data('image');


            $(this).closest('.image-container').remove();


            $.ajax({
                url: '/remove-image',
                type: 'POST',
                data: {
                    image_id: imageId
                },
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success: function(response) {
                    show_toast(response);
                   
                },
                error: function(xhr, status, error) {
                    console.log(xhr, error);

                }
            });
        });





        $('#images').change(function () {
    for (let i = 0; i < this.files.length; i++) {
        const file = this.files[i];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    const img = $('<img>'); // Create img element
                    img.attr('src', e.target.result); // Set src attribute
                    img.attr('width', '50'); // Set width attribute
                    img.attr('height', '50'); // Set height attribute
                    img.css('margin-left', '10px'); // Set CSS margin-left property

                    // Create cancel button
                    const cancelBtn = $('<button>').text('Remove');
                    cancelBtn.addClass('cancel-btn');
                    cancelBtn.css('margin-left', '5px');
                    
                    // Append the image and cancel button to the preview container
                    const previewContainer = $('<div>').append(img, cancelBtn);
                    $('#image-preview').append(previewContainer);
                    
                    // Add click event to cancel button to remove the image
                    cancelBtn.on('click', function() {
                        previewContainer.remove(); // Remove the preview container
                    });
                };
            })(file);
            reader.readAsDataURL(file);
        }
    }
});


    $("#update_product").click(function (e) {
        e.preventDefault();

        const name = $("#name").val();
        const product_id = $("#product_id").val();
        const description = $("#description").val();
        const size = $("#size").val();
        const category = $("#category").val();
        const gender = $("#gender").val();
        const price = $("#price").val();
        const offer_price = $("#offer_price").val();
        const in_stock = $("#in_stock").val();
        const images = $('#images').prop('files');
        const discount = $('#discount').val();


        if (name == '' || description == '' || size == '' || price == '' || offer_price == '' ) {
            show_toast("Please fill all fields.");
            return;
        }


        const formData = new FormData();
        formData.append('name', name);
        formData.append('description', description);
        formData.append('size', size);
        formData.append('discount', discount);
        formData.append('product_id', product_id);

        formData.append('price', price);
        formData.append('offer_price', offer_price);
        formData.append('in_stock', in_stock);
        formData.append('category', category);
        formData.append('gender', gender);
        for (let i = 0; i < images.length; i++) {
            formData.append('images[]', images[i]);
        }

        // AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('product-update') }}", // Replace with your actual route URL
            data: formData,
            processData: false, // Prevent jQuery from automatically processing data
            contentType: false, // Prevent jQuery from automatically setting content type
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Handle success response
                console.log(response);
                show_toast("Product has been Added Successfully.");
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                show_toast("There was an error please try again");
            }
        });
    });

    $("#offer_price").on('input', function () {
        const offer_price = parseFloat($(this).val()); // Get the offer price value
        const price = parseFloat($("#price").val()); // Get the regular price value

        if (!isNaN(offer_price) && !isNaN(price)) {
            const discount_percentage = ((offer_price - price) / offer_price) * 100; // Calculate discount percentage
            $("#discount").val(discount_percentage.toFixed(2)); // Set the calculated discount percentage value in the discount input field
        } else {
            $("#discount").val('');
        }
    });


</script>