@include ('includes.navbar')

<div class="container top-margin">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="d-flex login-container shadow rounded">
        <div class="col-md-6">
          <img src="{{asset('images/bg-login.jpg')}}" class="rounded" width="100%" height="100%"
            style="object-fit:cover" alt="">
        </div>
        <div class="col-md-6">
          <div class="container d-flex flex-column p-3">
            <h1 class="fw-bold">Register</h1>
            <form action="" id="registerForm">
              @csrf
              <div class="" id="response"></div>

              <label for="text" >Full Name :</label>
              <input type="text" class="form-control " id="full_name" name="full_name"
                placeholder="Enter Full Name">


          <label for="email" >Email address :</label>
          <input type="email" class="form-control " id="email" name="email" placeholder="Enter email">

          <label for="password" >Password :</label>
          <input type="password" class="form-control" id="password" name="password"
            placeholder="Password">
          <label for="password" >Confirm Password :</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password"
            placeholder="Confirm Password">

          <button type="submit" class="btn btn-dark mt-2 w-100">Register</button>



          </form>

          <!-- <button class="btn btn-outline-danger w-100 pt-3 pb-3 " style="font-size:18px"><i class="fa-brands fa-google mx-2"></i> Login with Google</button>
            <button class="btn btn-outline-primary w-100 pt-3 pb-3 mt-2" style="font-size:18px"><i class="fa-brands fa-facebook"></i> Login with Facebook</button> -->
        </div>
      </div>
    </div>
    
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('#registerForm').submit(function (e) {
    e.preventDefault();
    const full_name = $('#full_name').val();
    const email = $('#email').val();
    const password = $('#password').val();
    const confirm_password = $('#confirm_password').val();

    if (password.trim() != confirm_password.trim()) {
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
          window.location.href = '/login';
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