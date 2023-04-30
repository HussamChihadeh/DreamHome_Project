@extends("layout")
@section("title", "Sign in")

@section("head")
<link rel="stylesheet" href="{{asset('css/logIn.css')}}">
<style>
    
    .alert{
        color: red;
        padding: 0;
        margin: 0;
    }
</style>
@endsection

@section("content")

    <div class="pt-5 pb-5 login container mb-5 position-relative">
        <div class="row align-items-center">

            <div class="d-none d-lg-block col-lg-5 text-center">
                <h3>Welcome to</h3>
                <p>nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff
                    nsdff nsdff nsdff nsdff nsdff nsdff nsdff nsdff</p>
            </div>
            <div class="col-lg-7">
                <div class="welcoming mb-4">
                    <div class="mb-3"><img src="IMAGES/image_logo.png" alt="" width="50" height="50"></div>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <p class="text-black-50">Don't have an account? <a href="{{ route('signup') }}">Sign up</a></p>

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
    </script>
    @endsection