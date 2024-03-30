@include ('includes.navbar')

<div class="container top-margin">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Register
        </div>
        <div class="card-body">
          <form action="" id="registerForm">
            @csrf
    <div class="" id="response"></div>
            <div class="input-group align-items-center d-flex">
              <label for="text" class="col-md-4">Full Name :</label>
              <input type="text" class="form-control ms-3 col-md-8" id="full_name" name="full_name" placeholder="Enter Full Name">
            </div>
            <div class="input-group align-items-center d-flex mt-2">
              <label for="email" class="col-md-4">Email address :</label>
              <input type="email" class="form-control ms-3 col-md-8" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="input-group align-items-center d-flex mt-2">
              <label for="password" class="col-md-4">Password :</label>
              <input type="password" class="form-control ms-3 col-md-8" id="password" name="password" placeholder="Password">
            </div>
            <div class="input-group align-items-center d-flex mt-2">
              <label for="password" class="col-md-4">Confirm Password :</label>
              <input type="password" class="form-control ms-3 col-md-8" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary mt-3 w-100">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
       $('#registerForm').submit(function (e) {
      e.preventDefault();
      const full_name = $('#full_name').val();
      const email = $('#email').val();
      const password = $('#password').val();
      const confirm_password = $('#confirm_password').val();

      if(password.trim() != confirm_password.trim()){
        $('#response').removeClass('alert alert-success').addClass('alert alert-danger').text("Password don't match");
        $('#password').val('');
        $('#confirm_password').val('');
        return;
      }

      if (email.trim() === '' || password.trim() === '') {
        $('#response').removeClass('alert alert-success').addClass('alert alert-danger').text("Please enter your email and password.");
        return;
      }

      const formdata = {
        email: email,
        password: password,
        full_name: full_name
      };


      console.log(formdata);
      $.ajax({
        url: 'userRegister',
        type: 'POST',
        data: formdata,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function (response) {
          
         show_toast("User Registered Succesfully !");
         setTimeout(() => {
          window.location.href ='/login';
         }, 1000);
         

        },

        error: function (xhr, status, error) {
          var response = JSON.parse(xhr.responseText);
    var errorMessage = response.message;

   show_toast(errorMessage);
}

      });

    });

</script>