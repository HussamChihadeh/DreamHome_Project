@extends("layout")
@section("title", "Sign up")

@section("head")
<link rel="stylesheet" href="{{asset('css/signup.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
@endsection

@section("content")

    <div class="pt-5 pb-5 login container mb-5 position-relative ">
        <div class="row align-items-center">
            <div class="d-none d-lg-block col-lg-5 ">
            <div class="mb-3 text-center"><img src="IMAGES/image_logo.png" alt="" width="50" height="50"></div>
                <h3 class="text-center">Join the Dream Home Community</h3>
                <ul class="features mt-4 ">
                    <li><span class="gold ms-1">D</span>esign your dream living space.</li>
                    <li><span class="gold ms-1">R</span>ely on our experts and solutions.</li>
                    <li><span class="gold ms-1">E</span>xpect excellence with expert services.</li>
                    <li><span class="gold ms-1">A</span>chieve your dream home aesthetic.</li>
                    <li><span class="gold">M</span>ake your dream home a reality.</li>
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="welcoming mb-4">
                    <h2 class="mb-5">Create a Free Account</h2>
                    <!-- <p class="text-black-50">welcome back you've been missed!</p> -->
                </div>
                <form id="signup-form" method="post">
                @csrf
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label">Username</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label">Phone number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    <input type="submit" class="Sign_Up_Button" value="Register">
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// function fetchFurniture(){
    $('#signup-form').submit(function(event) {
        $('.error-message').remove();
    $('.is-invalid').removeClass('is-invalid');
    // Prevent the default form submission behavior
    event.preventDefault();

    // Serialize the form data into a JavaScript object
    var formData = $(this).serialize();
        $.ajax({
            url: "/api/v1/users",
            type: "POST",
            data: formData,
            success: function(furniture) {
                // console.log(furniture);

                window.location.href = "/signin";
                
            },
            error: function(xhr, status, error) {
        // Handle the error response from the API
                var errors = xhr.responseJSON || {};
                if (typeof errors === 'string') {
                    errors = JSON.parse(errors);
                }
                console.log(errors);
                $.each(errors.errors, function(field, messages) {
                    console.log(field);
                var input = $('#' + field);
                console.log(input);
                var container = input.parent();
                console.log(container);
                input.addClass('is-invalid');
                $.each(messages, function(index, message) {
                    $('<span>').addClass('error-message').html(message + "<br>").appendTo(container);
                });
                });
            }      
        });
    });
</script>
@endsection
   