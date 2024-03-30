@include ('includes.navbar')

<div class="container top-margin" >
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="d-flex login-container shadow rounded" >
        <div class="col-md-6">
          <img src="{{asset('images/bg-login.jpg')}}" class="rounded" width="100%" height="100%" style="object-fit:cover" alt="">
        </div>
        <div class="col-md-6">
          <div class="container d-flex flex-column p-3">
            <h1 class="fw-bold">Login</h1>
            <form action="" id="loginForm">
              @csrf
              <div class="" id="response"></div>

              <label for="email" class="col-md-4">Email address</label>
              <input type="email" class="form-control " id="email" name="email" placeholder="Enter email">


              <label for="password" class="col-md-4">Password</label>
              <input type="password" class="form-control " id="password" name="password" placeholder="Password">

              <button type="submit" class="btn btn-dark  mt-3 w-100">Login</button>
            </form>

            <button class="btn btn-outline-danger w-100 pt-3 pb-3 " style="font-size:18px"><i class="fa-brands fa-google mx-2"></i> Login with Google</button>
            <button class="btn btn-outline-primary w-100 pt-3 pb-3 mt-2" style="font-size:18px"><i class="fa-brands fa-facebook"></i> Login with Facebook</button>
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
  $('#loginForm').submit(function (e) {
    e.preventDefault();
    const email = $('#email').val();
    const password = $('#password').val();

    if (email.trim() === '' || password.trim() === '') {
      show_toast("Please enter your email and password.");
      return;
    }

    const formdata = {
      email: email,
      password: password
    };


    console.log(formdata);
    $.ajax({
      url: 'userCheck',
      type: 'POST',
      data: formdata,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        console.log(response.message);
        show_toast('Logged In Succesfully !');
        setTimeout(() => {
          window.location.href = '/';
        }, 1000);

      },

      error: function (response) {


        show_toast(response.responseJSON.message);
      }
    });

  });

</script>