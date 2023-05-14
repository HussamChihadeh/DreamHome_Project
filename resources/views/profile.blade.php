@extends("layout")
@section("title", "My Profile")

@section("head")
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">
<link rel="stylesheet" href="{{asset('css/main.css')}}">

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&family=Signika:wght@500;600&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Sentic+Display&display=swap" rel="stylesheet">

<style>

</style>
@endsection

@section("content")


<div style="height: 10%;"></div>
<div class="message" id="message">
    <h2 class="h22" hidden id="message_text"></h2>
</div>
<div class="row" style="height: 100%;">
    <div class="col-1">

    </div>

    <div class="col-xl-6 col-10 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <Header>My Profile</Header>
            <form class="nav-item" action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="Log_Out_button" type="submit">Logout</button>
            </form>
        </div>
        <!-- Main Info Column -->

        <div class="Main_Information">

            <p>{{ auth()->user()->name}}<img src="images\\cliparts\\Edit_Button.png" id="Edit_button" class="Edit_Button"></p>



            <div class="row">
                <div class="col-lg-6 col-12">
                    <span><img src="IMAGES\cliparts\Email_Address.png" class="Logo_1"></span>
                    <User_Details id="email">{{ auth()->user()->email }}</User_Details>
                </div>
                <div class="col-lg-6 col-12">
                    <span> <img src="IMAGES\cliparts\Phone_Nb.png" class="Logo_1 "></span>
                    <User_Details id="phone">{{ auth()->user()->phone_number }}</User_Details>
                </div>
                <div class="col-lg-6 col-12">
                    <span><img src="IMAGES\cliparts\Address.png" class="Logo_1"></span></span>
                    <User_Details id="address">{{ auth()->user()->address }}</User_Details>
                </div>
            </div>

        </div>
        <!-- Properties Column -->
        <div class="Properties_Information" id="Properties_Information">

            <p style="margin-left: -30;">My Properties</p>
            <h7>You can contact a designer to customize furniture for your dream home.</h7>

            @foreach ($boughtProperties as $property)
            <div class='row item'>
                <div class='col-lg-6 col-12 p-0 d-flex align-items-center'>
                    <img src="{{asset('images/properties/'.$property->id.'/1.jpg')}}" class="house_image h-100">
                </div>
                <div class='col-lg-6 col-12 p-3'>
                    <h3 class='title'>{{ $property->name }}</h3>
                    <h5 class='description'>
                        {{ $property->description }}
                    </h5>
                    <div class='line-1'></div>
                    <h5 class='city'>{{ $property->province }}</h5>
                    <div class='line-1'></div>
                    <div class='row'>
                        <div class='col-xl-6 col-12 p-2'>
                            <button class='Contact_Designer_button_Profile_Page' id="{{$property->id}}">Contact Designer</button>
                        </div>
                        <div class='col-xl-6 col-12 p-2'>
                            <button class='details_button_Profile_Page' id="{{$property->id}}">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="col-1 d-xl-none d-block"></div>

    <div class="col-md-3 col-1 d-xl-none d-block"></div>

    <!-- Designers Column -->
    <div class="col-xl-4 col-md-6 col-10 p-4">
        <!-- <form class="nav-item" action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="" type="submit">Logout</button>
                </form> -->
        <script>
            var designer;
        </script>
        <div class="My_Designers_Information" id="My_Designers_Information">
            <p style="margin-left: -20;">My Designers</p>
            @foreach ($designers as $d)
            <div class='row Container_1' id="{{$d->id}}">
                <div class='col-sm-3 col-3 p-0 mt-0 mb-0 pb-0'>
                    <img src="{{asset('images/designers/'.$d->id.'.png')}}" class='Designer_Image_11'>
                </div>
                <div class='col-sm-9 col-9'>
                    <!-- <img src='IMAGES\\X_Button.png' class='X_Button'> -->
                    <div class='Info1'>
                        <h7>{{$d->name}} </h7>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById("{{$d->id}}").onclick = function() {

                    var url = "/chatify/{{$d->id}}";
                    window.location.href = url;
                };
            </script>
            <!-- <p>{{ $d->name }}</p> -->
            @endforeach
        </div>
        <div class="Properties_Approval" id="Properties_Approval">
            <p style="margin-left: -20;">Properties Approval</p>
            @foreach ($ownedProperties as $property)
            <!-- @if($property->status == 'pending' ||$property->status == 'listed') -->
            <div class='row Container_1'>
                <div class='col-sm-3 col-3'><img src="{{asset('images/properties/'.$property->id.'/1.jpg')}}" class='Circular_Image Edit'></div>

                <div class='col-sm-9 col-9'>
                    <!-- <img src="{{asset('images/X_Button.png')}}" class='X_Button'> -->
                    <div class='Info1'>
                        <h6>{{ $property->name }}</h6>
                        <span> Status: {{ $property->status }}</span>
                    </div>
                </div>
            </div>
            <!-- @endif -->
            @endforeach
        </div>


    </div>
    <div class="col-1">

    </div>


    @endsection
    @section("script")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.details_button_Profile_Page', function() {
            var propertyId = $(this).attr('id');
            var url1 = "/rent/Property_details?id=" + propertyId;
            window.location.href = url1;
        });

        $(document).on('click', '.Contact_Designer_button_Profile_Page', function() {
            var propertyId = $(this).attr('id');
            var url1 = "/contact_designer?id=" + propertyId;
            window.location.href = url1;
        });


        var Properties_Information = document.getElementById('Properties_Information');



        var X_Button = document.querySelectorAll(".X_Button");
        var Container_1 = document.querySelectorAll(".Container_1");

        for (var i = 0; i < X_Button.length; i++) {
            X_Button[i].onclick = (function(index) {
                return function() {
                    Container_1[index].style.animation = "Delete 0.3s forwards";
                    setTimeout(function() {
                        Container_1[index].style.display = "none";

                    }, 500);

                };
            })(i);

        }

        window.onload = function() {
            var nav_items = document.querySelectorAll(".nav-item");
            for (var i = 0; i < nav_items.length; i++) {
                if (nav_items[i].innerHTML.includes("profile")) {
                    var link = nav_items[i].querySelector('a');
                    link.classList.add("active");
                }

            }
            var message = document.getElementById("message");
            var message_text = document.getElementById("message_text");
        }



        var Edit_button = document.getElementById("Edit_button");
        var email_input, phone_input, address_input, email_div, address_div, phone_div;

        Edit_button.onclick = function() {

            if (Edit_button.src.includes("Edit_Button.png")) {
                email_input = document.createElement("input");
                email_input.value = document.getElementById("email").textContent;
                document.getElementById("email").parentNode.replaceChild(email_input, document.getElementById("email"));
                email_input.id = "email_input";
                email_input.style = "border-radius:7px";


                phone_input = document.createElement("input");
                phone_input.value = document.getElementById("phone").textContent;
                document.getElementById("phone").parentNode.replaceChild(phone_input, document.getElementById("phone"));
                phone_input.id = "phone_input";
                phone_input.style = "border-radius:7px";


                address_input = document.createElement("input");
                address_input.value = document.getElementById("address").textContent;
                document.getElementById("address").parentNode.replaceChild(address_input, document.getElementById("address"));
                address_input.id = "address_input";
                address_input.style = "border-radius:7px";

                email_input.focus();
                Edit_button.src = "images\\X_Button.png";
                Edit_button.style.scale = "0.5";

            } else if (Edit_button.src.includes("X_Button.png")) {
                // Automatically focus on the input element

                // Get the updated values from the input fields
                // var updatedName = document.getElementById("name_input").value;
                // var updatedEmail = document.getElementById("email_input").value;
                // var updatedPhone = document.getElementById("phone_input").value;

                // Send the AJAX request to the controller
                $.ajax({
                    url: '/api/v1/updateUser',
                    method: 'PUT',
                    data: {
                        id: "{{auth()->user()->id}}",
                        address: address_input.value,
                        email: email_input.value,
                        phone: phone_input.value
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Show_Message();
                        message_text.innerHTML = "Saved";
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.error(error);
                    }
                });


                email_div = document.createElement("User_Details");
                email_div.textContent = email_input.value;
                email_input.parentNode.replaceChild(email_div, email_input);
                email_div.id = "email";

                phone_div = document.createElement("User_Details");
                phone_div.textContent = phone_input.value;
                phone_input.parentNode.replaceChild(phone_div, phone_input);
                phone_div.id = "phone";

                address_div = document.createElement("User_Details");
                address_div.textContent = address_input.value;
                address_input.parentNode.replaceChild(address_div, address_input);
                address_div.id = "address";
                Edit_button.src = "images\\cliparts\\Edit_Button.png";
                Edit_button.style.scale = "1";

            }

        }

        function Show_Message() {
            message.style.animation = "message_show 1.1s linear ";
            setTimeout(function() {

                message.style = " top:12%;left: 35%;right: 35%; width: 30%;height:60;z-index:2";

            }, 1050);

            setTimeout(function() {
                message_text.hidden = false;
                message_text.style.opacity = 1;

            }, 1100);

            setTimeout(function() {
                message_text.hidden = true;

                setTimeout(function() {
                    message.style.animation = "message_hide 1.1s linear";

                }, 100);
                setTimeout(function() {
                    message.style = "top:0%;width: 50;left: 50%; height: 50;right: 50%;";

                }, 1180);
            }, 2000);
        }
    </script>
    @endsection