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



<script>
    // window.onload = LoadData();

    // function LoadData() {

    //     for (var i = 0; i < 5; i++) {
    //         Container.innerHTML += "<div class='col-md-6 col-12  p-3'>" +
    //             "<div class='Designer_Container' id='Container_'" + i + ">" +
    //             "<div class='row'>" +
    //             "<div class='col-sm-5 col-5'><img src='IMAGES\\Designers\\Johnny Floyd.png' class='ID_Image'>" +

    //             "</div>" +
    //             "<div class='col-sm-7 col-7 '>" +
    //             "<div class='Info1'>" +
    //             "<h6>Lee Parker</h6>" +
    //             "<h6>Age: 28</h6>" +
    //             "<h6>Location: Beirut</h6>" +

    //             "</div>" +
    //             "<div class='Info2'>" +
    //             "<h6>Experience: 8 </h6>" +
    //             "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
    //             "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
    //             "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
    //             "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
    //             "<img src='IMAGES\\unfilled_star.png' width='15' height='15'>" +
    //             "</div>" +
    //             "</div>" +

    //             "<div class='row'>" +
    //             "<div class='col-sm-12 col-12 '>" +
    //             "<div class='Info3' hidden></div>" +
    //             "</div>" +
    //             "</div>" +
    //             "<div class='row'>" +
    //             "<div class='col-sm-6 col-6 '>" +
    //             "<div class='Info4' hidden></div>" +
    //             "</div>" +
    //             "<div class='col-sm-6 col-6 '>" +
    //             "<div class='Info5' hidden></div>" +
    //             "</div>" +

    //             "</div>" +

    //             "</div>" +

    //             "<div class='row'>" +
    //             "<div class='col-sm-4 col-4 '></div>" +
    //             "<div class='col-sm-5 col-5 '>" +
    //             "<button class='Designer_View_Details'>Show More</button>" +
    //             "</div>" +
    //             "<div class='col-sm-3 col-3'></div>" +
    //             "</div>" +
    //             "</div>" +
    //             "</div>";
    //     }
    // }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var Container = document.getElementById("Designers");
    $.ajax({
        url: "/api/v1/designers",
        type: "GET",
        success: function(designers) {
            // console.log(designers);
            $.each(designers, function(index, designer) {
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
                    "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
                    "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
                    "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
                    "<img src='IMAGES\\filled_star.png' width='15' height='15'>" +
                    "<img src='IMAGES\\unfilled_star.png' width='15' height='15'>" +
                    "</div>" +
                    "</div>" +

                    "<div class='row'>" +
                    "<div class='col-sm-12 col-12 '>" +
                    "<div class='Info3' hidden></div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='row'>" +
                    "<div class='col-sm-6 col-6 '>" +
                    "<div class='Info4' hidden></div>" +
                    "</div>" +
                    "<div class='col-sm-6 col-6 '>" +
                    "<div class='Info5' hidden></div>" +
                    "</div>" +

                    "</div>" +

                    "</div>" +

                    "<div class='row'>" +
                    "<div class='col-sm-4 col-4 '></div>" +
                    "<div class='col-sm-5 col-5 '>" +
                    "<button class='Designer_View_Details' id='" + designer.id + "'>Show More</button>" +
                    "</div>" +
                    "<div class='col-sm-3 col-3'></div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
            });

            var Designer_Container = document.querySelectorAll(".Designer_Container");
            var Info1 = document.querySelectorAll(".Info1");
            var Info2 = document.querySelectorAll(".Info2");
            var Info3 = document.querySelectorAll(".Info3");
            var Info4 = document.querySelectorAll(".Info4");
            var Info5 = document.querySelectorAll(".Info5");
            var View_Details_Button = document.querySelectorAll(".Designer_View_Details");


            for (var i = 0; i < View_Details_Button.length; i++) {
                (function(i) {
                    View_Details_Button[i].onclick = function() {
                        var buttonId = this.id;
                        // alert(buttonId);
                        const url1 = "/chatify/" + buttonId+"";
                            window.location.href = url1;
                        if (View_Details_Button[i].innerHTML == "Show More") {

                            Designer_Container[i].style.animation = "Designer_Details 0.6s forwards";
                            Info3[i].hidden = false;
                            Info4[i].hidden = false;
                            Info5[i].hidden = false;
                            Info3[i].style.animation = "appear 0.3s forwards";
                            Info4[i].style.animation = "appear 1s forwards";
                            Info5[i].style.animation = "appear 1s forwards";
                            View_Details_Button[i].hidden = true;
                            setTimeout(function() {
                                View_Details_Button[i].hidden = false;
                                View_Details_Button[i].style.animation = "appear 0.5s forwards";
                                View_Details_Button[i].innerHTML = "Show Less";
                            }, 350);

                        } else if (View_Details_Button[i].innerHTML == "Show Less") {
                            Designer_Container[i].style.animation = "Designer_Container 0.6s forwards";

                            Info3[i].style.animation = "disappear 0.3s forwards";
                            Info4[i].style.animation = "disappear 0.4s forwards";
                            Info5[i].style.animation = "disappear 0.5s forwards";

                            View_Details_Button[i].hidden = true;
                            setTimeout(function() {
                                View_Details_Button[i].hidden = false;
                                View_Details_Button[i].style.animation = "appear 0.5s forwards";
                                View_Details_Button[i].innerHTML = "Show More";
                                Info3[i].hidden = true;
                                Info4[i].hidden = true;
                                Info5[i].hidden = true;
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
</script>
<script>
    var View_Designer = document.querySelectorAll(".Designer_View_Details");
    var i = 0;

    $.ajax({
        url: "/api/v1/designers",
        type: "GET",
        success: function(designers) {
            // console.log(designers);
            $.each(designers, function(index, designer) {
                console.log("THISSSSSSSSSSSSS" + designer.id);
                View_Designer[i].onclick = function() {
                    alert(designer.id);
                    // const url1 = "/chatify?id=" + designer.id;
                    // window.location.href = url1;

                }
                i++;
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
</script>
</body>