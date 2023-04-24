@extends("layout")
@section("title", "Sign in")

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
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&family=Signika:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sentic+Display&display=swap" rel="stylesheet">
@endsection

@section("content")


    <div style="height: 10%;"></div>
    <div class="row" style="height: 100%;">
        <div class="col-1">

        </div>

        <div class="col-xl-6 col-10 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <Header>My Profile</Header>
                <form class="nav-item" action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="" type="submit">Logout</button>
                </form>
            </div>
            <!-- Main Info Column -->
            
            <div class="Main_Information">

                <p>{{ auth()->user()->name }}<img src="IMAGES\cliparts\Edit_Button.png" class="Edit_Button"></p>



                <div class="row">
                    <div class="col-lg-6 col-12">
                        <span><img src="IMAGES\cliparts\Email_Address.png" class="Logo_1"></span>
                        <User_Details>{{ auth()->user()->email }}</User_Details>
                    </div>
                    <div class="col-lg-6 col-12">
                        <span> <img src="IMAGES\cliparts\Phone_Nb.png" class="Logo_1 "></span>
                        <User_Details>{{ auth()->user()->phone_number }}</User_Details>
                    </div>
                    <div class="col-lg-6 col-12">
                        <span><img src="IMAGES\cliparts\Address.png" class="Logo_1"></span></span>
                        <User_Details>{{ auth()->user()->address }}</User_Details>
                    </div>
                </div>

            </div>
            <!-- Properties Column -->
            <div class="Properties_Information" id="Properties_Information">

                <p style="margin-left: -30;">My Properties</p>
                <h7>You can contact a designer to customize furniture for your dream home.</h7>

                @foreach ($boughtProperties as $property)
                <div class='row item'>
                    <div class='col-lg-6 col-12 p-0'>
                        <img class='house_image'src="{{asset('images/properties/1.jpg')}}">
                    </div>
                    <div class='col-lg-6 col-12 p-3'>
                        <h3 class='title'>{{ $property->name }}</h3>
                        <h5 class='description'>
                        {{ $property->description }}</h5>
                        <div class='line-1'></div>
                        <h5 class='city'>{{ $property->province }}</h5>
                        <div class='line-1'></div>
                        <div class='row'>
                            <div class='col-xl-6 col-12 p-2'>
                                <button type='submit'class='Contact_Designer_button_Profile_Page'>Contact Designer</button>
                            </div>
                            <div class='col-xl-6 col-12 p-2'>
                                <button type='submit' class='details_button_Profile_Page' id="{{$property->id}}">View Details</button>
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
            <div class="My_Designers_Information" id="My_Designers_Information">
                <p style="margin-left: -20;">My Designers</p>
            </div>
            <div class="Properties_Approval" id="Properties_Approval">
                <p style="margin-left: -20;">Properties Approval</p>
                @foreach ($ownedProperties as $property)
                    <!-- @if($property->status == 'pending' ||$property->status == 'listed') -->
                <div class='row Container_1'>
                    <div class='col-sm-3 col-3'><img src="{{asset('images/properties/1.jpg')}}" class='Circular_Image Edit'></div>
                    
                    <div class='col-sm-9 col-9'>
                        <img src="{{asset('images/X_Button.png')}}" class='X_Button'>
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

        //  $(document).ready(function() {
        //     $.ajax({
        //         url: "/api/v1/properties/" + propertyId,
        //         type: "GET",
        //         success: function(property) {
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        //  });

        var Properties_Information = document.getElementById('Properties_Information');
        // Load Properties
        // for (var i = 1; i < 5; i++) {
        //     var newPropertyHtml = "<div class='row item'><div class='col-lg-6 col-12 p-0'><img class='house_image'" +
        //         "src='IMAGES\\house.jpg'></div><div class='col-lg-6 col-12 p-3'><h3 class='title'>House " + i + "</h3><h5 class='description'>" +
        //         "this house has a backyard 3 bedrooms and 3 bathrooms. this house has a backyard 3 bedrooms and 3 bathrooms. this house has" +
        //         " a backyard 3 bedrooms and 3 bathroomsthis house has a backyard 3 bedrooms and 3 bathroomshhhhhhhhh</h5><div class='line-1'>" +
        //         "</div><h5 class='city'>Beirut </h5><div class='line-1'></div><div class='row'><div class='col-xl-6 col-12 p-2'><button type='submit'" +
        //         "class='Contact_Designer_button_Profile_Page'>" +
        //         "Contact Designer</button></div><div class='col-xl-6 col-12 p-2'><button type='submit'" +
        //         " id='1' class='details_button_Profile_Page'>View Details</button></div></div></div>";
        //     Properties_Information.innerHTML += newPropertyHtml;
        // }


        // var Contact_a_Designer_button = document.querySelectorAll(".Contact_Designer_button_Profile_Page");
        // for (var i = 0; i < Contact_a_Designer_button.length; i++) {
        //     Contact_a_Designer_button[i].onclick = function () {
        //         window.location = "Contact_a_Designer.html";
        //     }
        // }
   
        //Load Designers
        var My_Designers_Information = document.getElementById("My_Designers_Information");
        for (var i = 1; i < 2; i++) {
            var newDesignerHtml = "<div class='row Container_1'>" +
                "<div class='col-sm-3 col-3'><img src='people-collage-design - Copy.jpg' class='Circular_Image'>" +
                "</div>" +
                "<div class='col-sm-9 col-9'>" +
                "<img src='IMAGES\\X_Button.png' class='X_Button'>" +
                "<div class='Info1'>" +
                "<h7>Eny Lee </h7>" +
                "</div>" +
                "</div>" +
                "</div>";
            My_Designers_Information.innerHTML += newDesignerHtml;
        }

       
        var X_Button = document.querySelectorAll(".X_Button");
        var Container_1 = document.querySelectorAll(".Container_1");

        for (var i = 0; i < X_Button.length; i++) {
            X_Button[i].onclick = (function (index) {
                return function () {
                    Container_1[index].style.animation = "Delete 0.3s forwards";
                    setTimeout(function () {
                        Container_1[index].style.display = "none";

                    }, 500);

                };
            })(i);

        }

    </script>
    @endsection