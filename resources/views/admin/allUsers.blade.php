@include ('includes.navbar')
<div class="dashboard_container row ">

    <div class="col-md-3 ps-4  d-flex align-items-center justify-content-center">
        <div class="left_panel mt-4 shadow">
            <h4 class="text-white fw-bold p-5">Ecommerce</h4>
            <a href="/dashboard">
                <p><i class="fa-solid fa-table-columns mx-2"></i> Dashboard </p>
            </a>

            <a href="/adminproducts">
                <p><i class="fa-solid fa-store mx-2"></i> My Products</p>
            </a>
            <a href="/all-orders">
                <p><i class="fa-solid fa-money-bill mx-2"></i> Orders</p>
            </a>
            <a href="/users">
                <p class="active-left"><i class="fa-solid fa-user mx-2"></i> Users</p>
            </a>
            <p>
                <a class="nav-link" href="{{ route('logout') }}"><i class="fa-solid fa-lock mx-2 mb-3"></i>Logout</a>
            </p>



        </div>
    </div>
    <div class="col-md-6 pt-4 d-flex  justify-content-start flex-column">

        <div class="container">
            <h2 class="mt-3">All Users</h2>
            <p class="text-success mb-5">You can block users from accessing your Website.</p>

            <table class="table-bordered table">
                <thead>
                    <tr>
                        <th>User id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->status == 1)
                            <button class="btn btn-danger block_user" data-user="{{$user->id}}">Block</button>
                            @else

                            <button class="btn btn-outline-success reactivate_user "
                                data-user="{{$user->id}}">Reactivate</button>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 pt-3 ps-0 px-4">



    </div>

</div>
<script>
    $(".block_user").click(function () {
        const user_id = $(this).data('user');
        console.log(user_id);
        $.ajax({
            type: "POST",
            url: "block-user",
            data: { user_id: user_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                show_toast(response);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function (error) {
                console.log(error);
                show_toast("There was an error Please try again.");

            }
        });
    });
    $(".reactivate_user").click(function () {
        const user_id = $(this).data('user');
        console.log(user_id);
        $.ajax({
            type: "POST",
            url: "reactivate-user",
            data: { user_id: user_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                show_toast(response);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function (error) {
                console.log(error);
                show_toast("There was an error Please try again.");

            }
        });
    });

</script>