@extends("layout")
@section("title", " Designers")

@section("head")
<link rel="stylesheet" href="{{asset('css/Designers.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/main.css')}}">

<link rel="stylesheet" href="{{asset('css/animation.css')}}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>

<link rel="icon" type="image/x-icon" href="IMAGES\image_logo.png">
@endsection

@section("content")
<div style="height: 12%;"></div>

<div class="Middle_Container">
    <div class="row" id="Designers">
        <h2>Our Designers</h2>

    </div>
</div>



</div>


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const property_id = urlParams.get('id');
    var Container = document.getElementById("Designers");
    $.ajax({
        url: "/api/v1/designers",
        type: "GET",
        success: function(designers) {
            // console.log(designers);
            $.each(designers.data, function(index, designer) {
                console.log(designer);
                Container.innerHTML += "<div class='col-md-6 col-12  p-3'>" +
                    "<div class='Designer_Container' id='Container_'" + designer.id + ">" +
                    "<div class='row'>" +
                    "<div class='col-sm-5 col-5'><img src='IMAGES\\Designers\\" + designer.id + ".png' class='ID_Image'>" +

                    "</div>" +
                    "<div class='col-sm-7 col-7 '>" +
                    "<div class='Info1'>" +
                    "<h6>" + designer.name + "</h6>" +
                    "<h6>Age: " + designer.age + "</h6>" +
                    "<h6>Location: Beirut</h6>" +

                    "</div>" +
                    "<div class='Info2'>" +
                    "<h6>Experience: " + designer.experience + " years</h6>" +
                    "<h6 class=Info_Editor>LinkedIn: " + designer.linkedin +"</h6>" +

                    "</div>" +
                    "</div>" +

                    "<div class='row'>" +
                    "<div class='col-sm-12 col-12 '>" +
                    "<div class='Info3'style='height:fit-content' hidden><h6>Email: " + designer.email + "</h6>" +
                    "<h6 id='designer_phone_nb_1" + designer.id + "'>Phone Number: "+designer.phone_number+"</h6>" +

                  
                    "</div>" +
                    "</div>" +
                    "<div class='row'>" +
                    "<div class='col-sm-12'>" +
                    "<div class='Info4' style='width:105%;margin-left:3%' hidden>Bio:"+ designer.bio+"</div>" +
                    "</div>" +
                    "</div>" +

                    "<div class='row'>" +
                    "<div class='col-sm-5 col-5 offset-1'>" +
                    "<button class='Designer_Contact' id='" + designer.id + "'>Contact</button>" +
                    "</div>" +
                    "<div class='col-sm-5 col-5'>" +
                    "<button class='Designer_View_Details'>Show More</button>" +

                    "</div>" +

                    "</div>" +
                    "</div>";
            });
        
            var Designer_Container = document.querySelectorAll(".Designer_Container");
            var Info1 = document.querySelectorAll(".Info1");
            var Info2 = document.querySelectorAll(".Info2");
            var Info3 = document.querySelectorAll(".Info3");
            var Info4 = document.querySelectorAll(".Info4");
            var View_Details_Button = document.querySelectorAll(".Designer_View_Details");
            var Designer_Contact_Button = document.querySelectorAll(".Designer_Contact");
           
            for (var i = 0; i < View_Details_Button.length; i++) {
                (function(i) {

                    Designer_Contact_Button[i].onclick = function() {
                        var buttonId = this.id;
                        // alert(buttonId);
                        const url1 = "/chatify/" + buttonId + "?property_id=" + property_id;
                        window.location.href = url1;
                    }

                    View_Details_Button[i].onclick = function() {


                        if (View_Details_Button[i].innerHTML == "Show More") {

                            Designer_Container[i].style.animation = "Designer_Details 0.6s forwards";
                            Info3[i].hidden = false;
                            Info4[i].hidden = false;
                            Info3[i].style.animation = "appear 0.3s forwards";
                            Info4[i].style.animation = "appear 1s forwards";
                            View_Details_Button[i].hidden = true;
                            Designer_Contact_Button[i].hidden = true;
                            setTimeout(function() {
                                View_Details_Button[i].hidden = false;
                                View_Details_Button[i].style.animation = "appear 0.5s forwards";
                                Designer_Contact_Button[i].hidden = false;
                                Designer_Contact_Button[i].style.animation = "appear 0.5s forwards";
                                View_Details_Button[i].innerHTML = "Show Less";
                            }, 350);

                        } else if (View_Details_Button[i].innerHTML == "Show Less") {
                            Designer_Container[i].style.animation = "Designer_Container 0.6s forwards";

                            Info3[i].style.animation = "disappear 0.3s forwards";
                            Info4[i].style.animation = "disappear 0.4s forwards";
                            Designer_Contact_Button[i].hidden = true;
                            View_Details_Button[i].hidden = true;
                            setTimeout(function() {
                                View_Details_Button[i].hidden = false;
                                View_Details_Button[i].style.animation = "appear 0.5s forwards";
                                Designer_Contact_Button[i].hidden = false;
                                Designer_Contact_Button[i].style.animation = "appear 0.5s forwards";
                                View_Details_Button[i].innerHTML = "Show More";
                                Info3[i].hidden = true;
                                Info4[i].hidden = true;
                            }, 300);
                        }
                    };
                })(i);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });

    //     $(document).ready(function() {

    // });


    window.onload = function() {
        var nav_items = document.querySelectorAll(".nav-item");
        for (var i = 0; i < nav_items.length; i++) {
            if (nav_items[i].innerHTML.includes("Our designers")) {
                var link = nav_items[i].querySelector('a');
                link.innerHTML = "Our Designers";
                link.classList.add("active");
            }
        }
        }
</script>

@guest
    <script>
        // User is not authenticated, do something else
        $(document).ready(function() {
            var Designer_Contact_Button = document.querySelectorAll(".Designer_Contact");
            console.log("hello");
            console.log(Designer_Contact_Button);
            Designer_Contact_Button.forEach(function(button) {
                console.log(button);
                button.classList.add('d-none');
            });
        });

     
    </script>
@endguest


</body>