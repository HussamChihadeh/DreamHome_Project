@php
use Illuminate\Support\Str;
@endphp

@extends(auth()->check() && Str::endsWith(auth()->user()->email, '@Designer.org') ? "Designer_Layout" : "layout")

@section("title", "Furniture Details")


@section("head")
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">
<link rel="stylesheet" href="{{asset('css/furniture_details.css')}}">


@endsection

@section("content")
<div style="height: 10%;"></div>

<div class="row" style="width:95%; margin-left: 2.5%;">
    <div class="col-md-5 col-10">
        <img class="Furniture_Image" id="Selected_Image">
    </div>
    <div class="col-md-1 col-2">
        <div class="vertical-line"></div>
        <img src="..\images\furniture\Sofas\Sofa1\sofa1.png" class="Furniture_Image_Vertical Furniture_Image_Vertical_Clicked" id="Image1">
        <img src="..\images\furniture\Sofas\Sofa1\sofa4.png" class="Furniture_Image_Vertical" id="Image2">
        <img src="..\images\furniture\Sofas\Sofa1\sofa3.png" class="Furniture_Image_Vertical" id="Image3">

    </div>

    <div class="col-md-6 col-12">
        <div class="Description_1_Container">
            <div class="row">

                <div class="col-12 p-4">
                    <div class="Info1">
                        <p class="Furniture_Name" id="Furniture_Name"></p>

                        <p class="Description"></p>


                    </div>

                    <div class="Rating_Info">
                        <stan class="Price"></stan>

                        <br><br>
                        <stan class="Gold"></stan> Available, Hurry, limited stock available!
                        <br><br>

                        <!-- <img src="IMAGES\filled_star_black.png" width="15" height="15">
                            <img src="IMAGES\filled_star_black.png" width="15" height="15">
                            <img src="IMAGES\filled_star_black.png" width="15" height="15">
                            <img src="IMAGES\filled_star_black.png" width="15" height="15">
                            <img src="IMAGES\unfilled_star.png" width="15" height="15"> -->

                    </div>


                </div>


            </div>
            <div class="row">
                <!-- <div class="col-3"></div> -->

                <div class="col-6">
                    <button class="Add_to_Favorites">Add to Favorites</button>
                </div>
                <!-- 
                    <div class="col-3"></div>
                    <div class="col-3"></div> -->

                <div class="col-6">
                    <button class="Order_Furniture">Add to Cart</button>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
<Header> More Details</Header>
<div class="row">
    <div class="col-md-1 col-xl-3"></div>

    <div class="col-sm-6 col-md-5 col-xl-3 col-12 p-5">
        <div class="Extra_Info_container">
            <img src="{{asset('images/furniture/Sofas/Sofa1/sofa4.png')}}" class="Image_In_Extra_Info">
            <div class="Inner_Container" style="line-height: 2.5;">
                <span class="title">Height:</span> 33.67 inch
                <br>
                <span class="title">Width:</span> 92.1 inch
                <br>
                <span class="title">Depth:</span> 70 inch
                <br>
                <span class="title">Weight:</span> 5 Kg
                <br>
                <span class="title">Made in: </span>Italy, 2019
                <br>
                <span class="title">Designed by: </span><span class="designer_name"></span>


            </div>
        </div>
    </div>


    <div class="col-sm-6 col-md-5 col-xl-3 col-12 p-5">
        <div class="Extra_Info_container">
            <img src="..\images\furniture\Sofas\Sofa1\sofa3.png" class="Image_In_Extra_Info">
            <div class="Inner_Container">
                <span class="title">Material:</span><span><br>Brass Fabric Metal</span>
                <br>
                <span class="title">Legs:</span>
                <span><br>Tapered legs have an elegant look created by
                    three metal rods that converge towards the brass ends. </span>
                <br>
                <span class="title">Style:</span><span><br>Mid-Century Modern</span>
                <br>


            </div>
        </div>

    </div>





</div>

<Header>Recommended Products</Header>
<div class="row" id="recommended-products" style="width: 90%;margin-left: 5%; margin-top: 30; margin-bottom: 50;">


    <!-- <div class="col-xl-3 col-lg-4 col-sm-6 col-12 p-4">
        <div class="Recommended_container">
            <img src="..\images\furniture\Chandelier\Chandelier_1\1.png" class="Image_In_Recommended">
            <div class="Inner_Container">
                <p class="Recommended_Product_Name">Stilnovo Large Chandelier</p>
                <button class="View_Furniture">View Furniture</button>
            </div>
        </div>

    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 col-12 p-4">
        <div class="Recommended_container">
            <img src="..\images\furniture\Seats\Seat1\1.png" class="Image_In_Recommended">
            <div class="Inner_Container">
                <p class="Recommended_Product_Name">Carlo De Carli '915' Lounge </p>
                <button class="View_Furniture">View Furniture</button>
            </div>
        </div>

    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 col-12 p-4">
        <div class="Recommended_container">
            <img src="..\images\furniture\Chandelier\Chandelier_2\1.png" class="Image_In_Recommended">
            <div class="Inner_Container">
                <p class="Recommended_Product_Name">Pyramid Pendants Opaline Glass</p>
                <button class="View_Furniture">View Furniture</button>
            </div>
        </div>

    </div> -->

    
    <div class="col-md-2"></div>

</div>
<div id="on_load">
</div>
<div class="message" id="message">
    <h2 class="h22" hidden id="message_text"></h2>
  </div>

@section("script")

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var Selected_Image = document.getElementById("Selected_Image");
    var Image1 = document.getElementById("Image1");
    var Image2 = document.getElementById("Image2");
    var Image3 = document.getElementById("Image3");
    var Images = [Image1, Image2, Image3];
    var on_load = document.getElementById("on_load");
    var title = document.getElementById("Title");
    title.innerText = Furniture_Name.innerHTML;
   

    window.addEventListener("load", function() {

 var message = document.getElementById("message");
    var message_text = document.getElementById("message_text");

    });

</script>
<script>
    $(document).ready(function() {
        var furnitureId = new URLSearchParams(window.location.search).get('id');
        var longitude, latitude;
        const element = document.querySelector('.Order_Furniture');
        element.setAttribute('id', furnitureId);

        var Selected_Image = document.getElementById("Selected_Image");
        var Image1 = document.getElementById("Image1");
        var Image2 = document.getElementById("Image2");
        var Image3 = document.getElementById("Image3");

        $.ajax({
            url: "/api/v1/furniture/" + furnitureId,
            type: "GET",
            success: function(furniture) {
                console.log(furniture);
                Selected_Image.src = "../images/furniture/"+furniture.id+"/1.png";
                Image1.src = "../images/furniture/"+furniture.id+"/1.png";
                Image2.src = "../images/furniture/"+furniture.id+"/1.png";
                // Image3.src = "../images/furniture/"+furniture.id+"/1.png";
                var furniture_name = $('.Furniture_Name');
                furniture_name.append(furniture.name);
                var description = $('.Description');
                description.append(furniture.description);
                var price = $('.Price');
                price.append(furniture.price.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }));
                var quantity = $('.Gold');
                quantity.append(furniture.quantity);
                var designer_name = $('.designer_name');
                console.log(furniture.designer_name)
                designer_name.append(furniture.designer_name);
            },
            error: function(error) {
                console.log(error);
            }
        });
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
        element.onclick = function() {
            var userId = {{ auth()->user()->id }};
            $.ajax({
                url: "/api/v1/furniture/addToCart",
                type: "POST",
                data: {
                    furniture_id: furnitureId,
                    user_id: userId
                },
                
                success: function(response) {
                    Show_Message();
                    message_text.innerHTML="Added to Cart";

                },


                error: function(error) {
                    console.log(furnitureId);
                    console.log(error);
                }
            });
        };
    });

    window.onload = function() {

        setTimeout(function() {
            on_load.style.display = "none";
        }, 1350);

        Selected_Image.src = Image1.src;

        for (var i = 0; i < Images.length; i++) {
            Images[i].onclick = function() {
                if (this.classList.item(this.classList.length - 1) != "Furniture_Image_Vertical_Clicked") {
                    for (var j = 0; j < Images.length; j++) {
                        if (Images[j].classList.item(Images[j].classList.length - 1) == "Furniture_Image_Vertical_Clicked")
                            Images[j].classList.remove("Furniture_Image_Vertical_Clicked");


                    }
                    this.classList.add("Furniture_Image_Vertical_Clicked");
                    Selected_Image.src = this.src;
                }



            }
        }
    };



   
</script>
<script>
     var furnitureId = new URLSearchParams(window.location.search).get('id');
    $.ajax({
            url: "/api/v1/furniture/getRecommendedProducts",
            type: "GET",
            data: {id: furnitureId},
            success: function(response) {
                console.log(response);
                const recommendedProducts = response.recommendedProducts;
                const recommendedProductsContainer = $('#recommended-products');
                recommendedProductsContainer.empty();
                $.each(recommendedProducts, function(index, product) {

                    const html = "<div class='col-xl-3 col-lg-4 col-sm-6 col-12 p-4'>"+
                "<div class='Recommended_container' >"+
                "<img src='..\\images\\furniture\\" + product.id  + "\\1.png' class='Image_In_Recommended'>"+
                    "<div class='Inner_Container'>"+
                        "<p class='Recommended_Product_Name'>" + product.name  + "</p>"+
                        "<button class='View_Furniture' id='"+product.id  + "'>View Furniture</button>"+
                    "</div>"+
                "</div>"+
            "</div>";
                    
                    recommendedProductsContainer.append(html);
                });

                $('.View_Furniture').click(function() {
                    const productId = $(this).attr('id');
                    window.location.href = '/furniture/furniture_details?id=' + productId;
                });
            },
            error: function(error) {
                    console.log(error);
            }
        });
</script>
@endsection