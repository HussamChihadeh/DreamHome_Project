@extends("layout")
@section("title", "Sign in")

@section("head")
<link rel="stylesheet" href="{{asset('css/logIn.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<style>
    .alert {
        color: red;
        padding: 0;
        margin: 0;
    }
</style>

@endsection

@section("content")
<div style="height: 0%;width:100%"></div>
<div class="pt-0 pb-0  p-0 mb-0 position-relative">
    <div class="row align-items-center">

        <div class="d-none p-0 d-lg-block col-lg-7">

            <img src="images\properties\Login_Property.png" style="margin-top:0" width="100%">

        </div>
        <div class="col-lg-5">
            <div class="welcoming mb-4">
                <div class="mb-3  d-none d-xl-block"><img src="IMAGES/image_logo.png" alt="" width="50" height="50"></div>
                <h2>Hello Again</h2>
                <p class="text-black-50">welcome back you've been missed!</p>
            </div>
            <form id="signin-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3 form-outline w-75">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="mb-3 form-outline w-75">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <button type="submit" class=" Sign_In_button">log In</button>
                <p class="text-black-50">Don't have an account? <a href="{{ route('signup') }}" class="Sign_Up">Sign up</a></p>

            </form>
        </div>
    </div>
    <!-- <span></span> -->
</div>

@endsection

@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //     $('#signin-form').submit(function(event) {

    //     event.preventDefault();
    //     var formData = $(this).serialize();
    //     console.log(formData);
    //     $.ajax({
    //         url: "/api/v1/users/authenticate",
    //         type: "POST",
    //         data: formData,
    //         success: function(response) {
    //             // Handle successful authentication
    //             window.location.href = '/';
    //         },
    //         error: function(xhr, status, error) {
    //             // Handle unsuccessful authentication
    //             var response = xhr.responseJSON;
    //             // console.log(response.error);
    //             console.log(error);
    //             // Display the error message on the page
    //             // $('#error-message').text(response.error);
    //         }
    //     });

    // });

    var Navbar = document.getElementsByClassName("navbar")[0];
    Navbar.style.backgroundColor = "transparent";
    Navbar.style.boxShadow = "none";

    var Nav_Buttons = document.querySelectorAll(".nav-link");
    for (var i = 0; i < Nav_Buttons.length; i++) {
        Nav_Buttons[i].style.transform = "translateX(88px)";
    }
    window.onload = function() {
        var nav_items = document.querySelectorAll(".nav-item");
        for (var i = 0; i < nav_items.length; i++) {
            if (nav_items[i].innerHTML.includes("Sign In")) {
                var link = nav_items[i].querySelector('a');
                link.classList.add("active");
            }

        }
    }
</script>
@endsection