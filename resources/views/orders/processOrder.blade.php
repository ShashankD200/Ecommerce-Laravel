@include('includes.navbar')

<div class="card mt-2 top-margin rounded shadow">
    <div class="card-body bg-secondary">
        <h3 class="text-white fw-bold">Delivery Address </h3>
        <hr>

        @if($addresses->isNotEmpty())
    @foreach($addresses as $address)
        <div class="card">
            <div class="card-body">
                <p>{{ $address->line_1 }}, {{ $address->line_2 }}</p>
                <p></p>
                <p><strong>Pincode:</strong> {{ $address->pincode }}</p>
                <div class="d-flex">
                    <p><strong>State:</strong> {{ $address->state }}</p>
                    <p class="ms-2"><strong>City:</strong>{{ $address->city }}</p>
                </div>
                <p><strong>Mobile Number:</strong> {{ $address->mobile }}</p>
                <button class="btn btn-danger w-100" id="add_new_address_buton">Add new address</button>
            </div>
        </div>
    @endforeach
@else
    <p>No addresses found.</p>
@endif

        <!-- Show form to add new address --> 
        <div class="add_new_address card mt-3 card-body">

        
        <label for="address" class="mt-2">Address Line 1 :</label>
        <input type="text" name="address_1" class="form-control" placeholder="Address Line 1" id="address_1">
        <label for="address" class="mt-2">Address Line 2 :</label>
        <input type="text" name="address_2" class="form-control" placeholder="Address Line 2" id="address_2">
        <label for="pincode" class="mt-2">Pincode :</label>
        <input type="tel" name="pincode" class="form-control" placeholder="Pincode" id="pincode">
        <label for="state" class="mt-2">State :</label>
        <input type="text" name="state" class="form-control" placeholder="State" id="state">
        <label for="City" class="mt-2">City :</label>
        <input type="text" name="city" class="form-control" placeholder="City" id="city">
        <label for="Mobile" class="mt-2">Mobile Number :</label>
        <input type="text" name="mobile" class="form-control" placeholder="Mobile" id="mobile">
       

       

        <button class="btn btn-warning mt-3" id="address_button">Save Address</button>

        </div>
    </div>
</div>
