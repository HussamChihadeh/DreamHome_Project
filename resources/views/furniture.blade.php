@extends("layout_No_Footer")
@section("title", "Furniture")

@section("head")
<link rel="stylesheet" href="{{asset('css/furniture.css')}}">
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@600&family=Signika:wght@500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@700&family=Signika:wght@500;600&display=swap" rel="stylesheet">
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
@endsection

@section("content")
  <link rel="icon" type="image/x-icon" href="IMAGES\image_logo.png">

  <style>
    .filter-designers{
      height: 85px;
      width: 85px;
    }


  </style>


  <!-- -------------------------EXTRA --------------------------------------------------------->

  <div class="row" style="height:20%;"></div>

  <div class="col-md-12 flex p-4 ">
    <div class="Helper_container" id="Helper_Container">

      <button class="Filter_Furniture_button" id="Filter_Button">
        <img src="{{asset('images/Filter_logo.png')}}" class="filter_image" id="Filter_Image">Filters</button>

      <button class="cart_Furniture_button" id="My_Cart_Button" onclick="OpenCart();">
        <img src="{{asset('images/cart_logo.png')}}" class="Cart_image">My Cart</button>

      <button class="Favorites_Furniture_button" id="Favorites_button">
        <img src="{{asset('images/heart_image.png')}}" class="heart_image">My Favorites</button>

      <!-- <button class="Contact_Designer_button" id="Contact_Designer_button">
        <img src="IMAGES\designer_logo.png" class="Designer_image">Contact Designer</button> -->
    </div>

    <div style="height: 10%;"></div>
  </div>
  <!-- --------------------------------------------------------------------------------------- -->
  
<!-- Details-->
  <div class="row">
    <div class="col-md-12 flex p-4">
      <div class="furniture_grid" id="Furniture_Grid">

      </div>
    </div>
  </div>


  <div class="message" id="message">
    <h2 class="h22" hidden id="message_text"></h2>
  </div>


  

  <!---------------------------------- Filter Container -->
  <div class="Background" id="Background" hidden onclick="Exit_Filter()"></div>
  <div class="Filter_Container" id="Filter_Container" hidden>
    <div class="Filter_Title">
      <h1>Filters <img src="IMAGES\X_Button.png" height="15px" id="X_Button"
          style="float: right;margin-top: 10px; margin-right: 8px; cursor: pointer;" onclick="Exit_Filter()">
      </h1>
      <div class=" line-2"></div>
    </div>
    <div style="height: 80px;"></div>

    <h3>Types</h3>
    <!-- <div class="Configuration_container"> -->
      <form id="filterForm">
        <table id="types">
        </table>
        <div class=" line-2"></div>
    <!-- </div> -->

    <h3>Styles</h3>
      <table id="styles">

      </table>
        <div class=" line-2"></div>
   

    <h3>Designers</h3>
      <table id="designers">

        <!-- <tr>
          <td><img src="IMAGES\Designers\Eny Lee Parker.png" class="ID_Image" id="Bekaa">
            <div class="b"> Eny Lee
              Parker</div>
          </td>
        </tr>

        <tr>
          <td><img src="IMAGES\Designers\Fernando Mastrangelo.png" class="ID_Image" id="Bekaa">
            <div class="b">Fernando Mastrangelo</div>
          </td>
        </tr>
        <tr>
          <td><img src="IMAGES\Designers\Floyd  Floyd.png" class="ID_Image" id="Beirut">
            <div class="b">Floyd</div>
          </td>

        </tr>
        <tr>
          <td><img src="IMAGES\Designers\Amigo Modern.png" class="ID_Image" id="Akkar">
            <div class="b">Amigo Modern</div>
          </td>

        </tr> -->



      </table>


      <div class=" line-2"></div>
      <div style="height: 50px;"></div>

      <div class="button_Background" id="Button_In_Filter">
        <input type="submit" class="Button_In_Filter" value="Filter">
        <input type="reset" class="Button_In_Filter" value="Reset">
      </div>
</form>
  </div>
  <!-- ------------------------------------------------ -->

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
    var formData="";
    var Furniture_Grid = document.getElementById("Furniture_Grid");
    window.onload = fetchFurniture();

    var message = document.getElementById("message");
    var message_text = document.getElementById("message_text");
    var Favorites_button = document.getElementById("Favorites_button");
    var Favorites_Container = document.getElementById("Favorites_Container");
    var Filter_Image = document.getElementById("Filter_Image");
    var Filter_Button = document.getElementById("Filter_Button");
    var My_Cart_Button = document.getElementById("My_Cart_Button");
    // var Contact_Designer_button = document.getElementById("Contact_Designer_button");
    var Filter_Container = document.getElementById("Filter_Container");
    var Background = document.getElementById("Background");
    var Button_In_Filter = document.getElementById("Button_In_Filter");
    var furniture_container = document.querySelectorAll(".furniture_container");
    var X_button_Details = document.getElementById("X_button_Details");
    var Furniture_Name = document.getElementById("Furniture_Name");
    var Helper_Container = document.getElementById("Helper_Container");
    var Line = document.getElementById("Line");
    var Image_In_Details = document.getElementById("Image_In_Details");
    var loading_gif = document.getElementById("loading_gif");
    var Inner_container_1 = document.getElementById("Inner_container_1");
    var Inner_container_2 = document.getElementById("Inner_container_2");
    var Designer_Name = document.getElementById("Designer_Name");
    // loading_gif.style.display = "none";




      var wishlist;
      function favorites(wishlist){

      setTimeout(function () { Furniture_Grid.style.animation = ''; }, 1500);
      Furniture_Grid.style.animation = "Animate_Grid_In 1.5s forwards";
      
      Show_Message();
      message_text.innerHTML = "My Favorites";


      Filter_Button.innerHTML = "Our Shop";
      console.log(wishlist);
      var itemDivs = document.querySelectorAll('.item');
      console.log(itemDivs);
      itemDivs.forEach(function(itemDiv) {
        itemDiv.style.display = 'none';
        console.log(itemDiv);
      });
      setTimeout(function(){
      wishlist.forEach(function(itemId) {
        var item = document.querySelector('.item-' + itemId);
        if (item) {
          item.style.display = 'block';
        }
      });},500);

      Active_Button_Editor(Favorites_button);

    }
    
    Filter_Button.onclick = function () {


      if (Filter_Button.innerHTML == "Our Shop") {
        Show_Message();
        message_text.innerHTML = "Back to Shopping!!";


        Filter_Button.innerHTML = "<img src=\"IMAGES\\Filter_logo.png\" class=\"filter_image\" id=\"Filter_Image\">Filters";
        setTimeout(function () { Furniture_Grid.style.animation = ''; }, 1500);

        setTimeout(function () {

          Furniture_Grid.style.animation = "Animate_Grid_In_1 1.5s forwards";

        }, 100);

        //Just to show the favorites, to be removed/edited later.
        var itemDivs = document.querySelectorAll('.item');
        console.log(itemDivs);
        setTimeout(function(){
        itemDivs.forEach(function(itemDiv) {
          itemDiv.style.display = 'block';
          console.log(itemDiv);
        });
      },500);
        /////////////////////////////////////////////////////////
      }
      else {


        Filter_Container.hidden = false;
        Background.hidden = false;
        Filter_Container.style.animation = "Filter_In 0.4s forwards";
        Button_In_Filter.style.animation = "Filter_In 0.4s forwards";


      }
      Active_Button_Editor(Filter_Button);



    }

    

    //}, 100);

    function Show_Message() {


      // for (var i = 0; i < heart.length; i++) {
      //   heart[i].disabled=true;
      // }
      Filter_Button.disabled = true;
      My_Cart_Button.disabled = true;
      Favorites_button.disabled = true;
      // Contact_Designer_button.disabled = true;
      setTimeout(function () {
        Filter_Button.disabled = false;
        My_Cart_Button.disabled = false;
        Favorites_button.disabled = false;
        // Contact_Designer_button.disabled = false;
      }, 2600);

      message.style.animation = "message_show 1.1s linear ";
      setTimeout(function () {

        message.style = " top:12%;left: 35%;right: 35%; width: 30%;height:60;z-index:2";

      }, 1050);

      setTimeout(function () {
        message_text.hidden = false;
        message_text.style.opacity = 1;

      }, 1100);

      setTimeout(function () {
        message_text.hidden = true;

        setTimeout(function () {
          message.style.animation = "message_hide 1.1s linear";

        }, 100);
        setTimeout(function () {
          message.style = "top:0%;width: 50;left: 50%; height: 50;right: 50%;";

        }, 1180);
      }, 2000);
    }


    function OpenCart(){
      window.location.href = '/My_Cart';

    }
    function Exit_Filter() {

      Filter_Container.style.animation = "Filter_Out 0.4s forwards";
      Button_In_Filter.style.animation = "Filter_Out 0.4s forwards";
      setTimeout(function () {
        Filter_Container.hidden = true;
        Background.hidden = true;
      }, 400);

    }

    function Active_Button_Editor(button) {
      const array = [Favorites_button, My_Cart_Button];
      for (var i = 0; i < array.length; i++) {
        if (array[i] == button) {
          array[i].classList.add("active");
        }
        else {
             array[i].classList.remove("active");
        }

      }

    }
    
    function fetchFurniture(){
        $.ajax({
            url: "/api/v1/furniture",
            type: "GET",
            data: formData,
            success: function(furniture) {
                // console.log(furniture);
                $('.furniture_container').remove();
                $.each(furniture.data, function(index, furniture) {
                    console.log(furniture);

                    Furniture_Grid.innerHTML += "<div class='furniture_container item item-" +furniture.id+"'>" +
                    "<img src='{{asset('images/heart_unfilled.png')}}' class='heart heart-" + furniture.id + "' id='" +
                      furniture.id + "'>" +


                            "<img src='/images/furniture/"+furniture.id+"/1.png' height='100%' width='100%'" +
                            "class='image' id=" +
                            furniture.id + ">" +
                            furniture.name +
                            "<br>"+
                            furniture.price.toLocaleString('en-US', {style: 'currency', currency: 'USD'})
                            "</div>";
                });
                var userId = {!! auth()->check() ? auth()->user()->id : 'null' !!};
                if (userId!==null) {
                  updateWishlist(userId);
                }

                var Furniture_Image = document.querySelectorAll(".image");
                function handleClick() {
                    var furnitureId = this.getAttribute('id');
                    console.log(furnitureId);
                    var url1 = "/furniture/furniture_details?id=" + furnitureId;
                    window.location.href = url1;
                }

                for (var i = 0; i < Furniture_Image.length; i++) {
                    Furniture_Image[i].addEventListener('click', handleClick);
                }

                var heart = document.querySelectorAll(".heart");
    for (var i = 0; i < heart.length; i++) {
        heart[i].onclick = function () {
          var userId = {!! auth()->check() ? auth()->user()->id : 'null' !!};
            var itemId = this.id;
            var heartImg = this;
            if (userId!==null) {
              var index = wishlist.indexOf(itemId);
              if (index !== -1) {
                // Item already exists, remove it
                wishlist.splice(index, 1);
              } else {
                // Item doesn't exist, add it
                wishlist.push(itemId);
              }
              $.ajax({
                url: '/api/v1/add-to-wishlist/' + userId,
                type: 'POST',
                data: {
                    item: itemId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle the success response
                    setTimeout(heartImg.style.animation = '', 1000);
                    let getAttr = heartImg.getAttribute('src');
                    if (message_text.hidden == true) {
                        Show_Message();
                    }
                    if (getAttr == "{{asset('images/heart_filled.png')}}") {
                        heartImg.src = "{{asset('images/heart_unfilled.png')}}";
                        message_text.innerHTML = "Removed From My Favorites";
                    }
                    else {
                        heartImg.style.animation = " zoom_in .5s linear";
                        heartImg.src = "{{asset('images/heart_filled.png')}}";
                        message_text.innerHTML = "Added to My Favorites";
                    }
                },
                error: function(response) {
                    // Handle the error response
                    console.log(response);
                }
            });
            }

            
        }
      }
                                
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function updateWishlist(userId){
      
      $.ajax({
          url: '/api/v1/get-wishlist/' + userId,
          type: 'GET',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            console.log(response);
            wishlist = response;
            
            // Loop through the wishlist and update the heart image for each item
            wishlist.forEach(function(item) {
              console.log(item);
              // console.log(item.id);
              var heartImg = document.querySelector('.heart-' + item);
              // console.log(heartImg);
              if (heartImg) {
                heartImg.src = "{{asset('images/heart_filled.png')}}";
              }
            });
            Favorites_button.onclick = function() {
                favorites(wishlist);
            };
          },
          error: function(response) {
            // Handle the error response
            console.log(response);
          }
        }); 
    }

    window.onload = function() {
      var nav_items = document.querySelectorAll(".nav-item");
        for (var i = 0; i < nav_items.length; i++) {
            if (nav_items[i].innerHTML.includes("Furniture")) {
                var link = nav_items[i].querySelector('a');
                link.innerHTML = "Furniture";
                link.classList.add("active");
            }
        }
      //handle filter
      $.ajax({
                url: '/api/v1/furniture/filterData',
                type: 'GET',
                success: function(response) {
                  response.data.forEach(function(item) {
                  if (item.type === 'designers') {
                    var designers_table = document.getElementById("designers");
                      // Handle designers data
                      item.data.forEach(function(designer) {
                          // td, td, img, div
                          var tr = document.createElement('tr');
                          const td = document.createElement('td');
                          const img = document.createElement('img');
                          img.src = "IMAGES\\Designers\\" + designer.id + ".png";
                          img.classList.add('filter-designers');
                          const radio = document.createElement('input');
                          radio.type = 'radio';
                          radio.name = "designer_id[eq]";
                          radio.value = designer.id;
                          td.appendChild(radio);
                          td.appendChild(img);
                          td.appendChild(document.createTextNode(" "+designer.name+" "));
                          tr.appendChild(td);
                          designers_table.appendChild(tr);
                          
                      });
                  } else if (item.type === 'types') {
                      // Handle types data
                      var types_table = document.getElementById("types");
                      console.log(item);
                      var tr = document.createElement('tr');
                      var i = 0;
                      item.data.forEach(function(type) {
                          // Do something with each type
                          
                          if(i==3){
                            tr = document.createElement('tr');
                            i=0;
                          }
                          const td = document.createElement('td');
                          const radio = document.createElement('input');
                          radio.type = 'radio';
                          radio.name = "type[eq]";
                          // console.log(type);
                          radio.value = type;
                          td.appendChild(radio);
                          td.appendChild(document.createTextNode(" "+type+" "));
                          tr.appendChild(td);
                          types_table.appendChild(tr);
                          i++;
                      });
                  } else if (item.type === 'styles') {
                    var styles_table = document.getElementById("styles");
                    var tr = document.createElement('tr');
                      var i = 0;
                      // Handle styles data
                      item.data.forEach(function(style) {
                          // Do something with each style
                          if(i==2){
                            tr = document.createElement('tr');
                            i=0;
                          }
                          const td = document.createElement('td');
                          const radio = document.createElement('input');
                          radio.type = 'radio';
                          radio.name = "style[eq]";
                          // console.log(type);
                          radio.value = style;
                          td.appendChild(radio);
                          td.appendChild(document.createTextNode(" "+style+" "));
                          tr.appendChild(td);
                          styles_table.appendChild(tr);
                          i++;
                      });
                  }
              });
                },
                error: function(response){
                  console.log(response);
                }
              });


    };

    $('#filterForm').submit(function(event) {
    event.preventDefault();

    // Serialize the form data to send as a query parameter
    formData = $('#filterForm').serialize();
    fetchFurniture();
    console.log(formData);
  });


        </script>
  </script>
</body>