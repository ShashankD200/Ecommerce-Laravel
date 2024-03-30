@include ('includes.navbar')

<div class="container mt-4">
    <h1>User Profile</h1>
<div class="row align-items-center ">
    <div class="col-md-6">
    <div class="card mt-4 w-75 ">
       
            

        <div class="card-body ">
        <h3>
       Account Details
       </h3>
            <div class="default_account">
            <p><strong class="fs-5">Name :</strong> {{$account->name}}</p>
            <p><strong class="fs-5">Email :</strong> {{$account->email}}</p>
            </div>
            <div class="edit_account">
                <label for="name">Name :</label>
                <input type="text" id="account_name" class="form-control" value="{{$account->name}}">
                <label for="email">Email :</label>
                <input type="email" id="account_email" class="form-control" value="{{$account->email}}">
                <div class="d-flex mt-2">
                <button class="cancel btn btn-danger"><i class="fa-solid fa-cancel"></i> Cancel</button>
                <button class="update_account btn btn-success ms-2"><i class="fa-solid fa-right"></i> Update</button>
                </div>
               
            </div>
           
            <button class="btn btn-primary mt-2" id="edit_profile">Edit Profile  <i class="fa-solid fa-pen"></i></button>
        </div>
    </div>

    </div>
    <div class="col-md-6">
    <div class="card mt-4 w-75">
     
        <div class="card-body">
           <h3>  Reset Password</h3>
             
<div class="alert alert-warning">Password was last changed on {{\Carbon\Carbon::parse($account->updated_at)->format('d M Y')  }}</div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm New Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button  class="btn mt-2 btn-primary" id="reset_password">Reset Password</button>
           
        </div>
    </div>
    </div>
</div>
    
    
</div>
<script>
$("#reset_password").click(function(e){
    e.preventDefault();
    const password = $("#password").val();
    const password_confirm = $("#password-confirm").val();

    if(password != password_confirm ) {
        show_toast("Passwords don't match");
        return; // Stop execution if passwords don't match
    }
    if(password === "" ) {
        show_toast("Passwords cannot be empty");
        return; // Stop execution if passwords don't match
    }

    $.ajax({
        type: "POST",
        url: "{{ route('reset_password') }}",
        data: { password: password },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            show_toast("Password has been successfully changed.");
        },
        error: function(error) {
            // Display the error message
            show_toast(error);
        }
    });
});
$("#edit_profile").click(function(){

$(".default_account").hide();
$(".edit_account").show();
$(this).hide();

});
$(".cancel").click(function(){
    $("#edit_profile").show();
$(".default_account").show();

$(".edit_account").hide();

});
$(".update_account").click(function(){
    const updated_name =  $("#account_name").val();
  const updated_email = $("#account_email").val();
  console.log(updated_name,' ',updated_email);
$.ajax({
    type: "POST",
    url: "{{ route('updateAccount') }}",
    data: {name:updated_name,
    email:updated_email},
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    success: function (response) {
        show_toast("Account has been succesfully updated.");
        
        setTimeout(() => {
            location.reload(); 
        }, 1000);
    },
    error:function(error){
        show_toast(error);
    }
});

});

</script>