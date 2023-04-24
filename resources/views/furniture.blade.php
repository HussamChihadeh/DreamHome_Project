<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Furniture</title>


  <link rel="stylesheet" href="..\CSS\Navbar.css">
  <link rel="stylesheet" href="..\CSS\Furniture.css">
  <link rel="stylesheet" href="..\CSS\Buttons.css">
  <link rel="stylesheet" href="..\CSS\Animation.css">
  <link rel="stylesheet" href="..\CSS\Main.css">
  
  <link rel="stylesheet" href="{{asset('css/furniture.css')}}">
  <link rel="stylesheet" href="..\bootstrap_css\all.min.css">
  <link rel="stylesheet" href="..\bootstrap_css\bootstrap.min.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>

  <link rel="icon" type="image/x-icon" href="IMAGES\image_logo.png">
</head>

<body>
  <!-- Nav BAR -->
  <!--RESPONSIVE NAV-->
  <nav class="navbar navbar-expand-lg fixed-top ">
    <div class="container">
      <a class="navbar-brand me-4" href="#">
        <img src="IMAGES/image_logo.png" alt="" height="40" width="30">
      </a>
      <a href="" class="logo me-4 d-none d-md-block">Dream Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main" aria-controls="main"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="main">
        <ul class="navbar-nav ms-auto mb-2 mt-1 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link p-lg-3 active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="#">Rent</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="#">Buy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="#">Furniture</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="#">Our Agents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="#">Sign In</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <!-- -------------------------EXTRA --------------------------------------------------------->

  <div class="row" style="height:20%;"></div>

  <div class="col-md-12 flex p-4 ">
    <div class="Helper_container" id="Helper_Container">

      <button class="Filter_Furniture_button" id="Filter_Button">
        <img src="{{asset('images/Filter_logo.png')}}" class="filter_image" id="Filter_Image">Filters</button>

      <button class="cart_Furniture_button" id="My_Cart_Button">
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
  <div class="Background" id="Background" onclick="Exit_Filter()" hidden></div>
  <div class="Filter_Container" id="Filter_Container" hidden>
    <div class="Filter_Title">
      <h1>Filters <img src="IMAGES\X_Button.png" height="15px" id="X_Button"
          style="float: right;margin-top: 10px; margin-right: 8px; cursor: pointer;" onclick="Exit_Filter()">
      </h1>
      <div class=" line-2"></div>
    </div>
    <div style="height: 80px;"></div>

    <h3>Configurations</h3>
    <div class="Configuration_container">
      <form method="post" action="/Tests/Post/">
        <table>


          <tr>
            <td><input type="checkbox" id="Akkar"><label>U Sectionals</label></td>
            <td><input type="checkbox" id="Baalbeck"><label>Corner Sectionals</label>
            </td>
          </tr>

          <tr>
            <td><input type="checkbox" id="Beirut"><label>Accent Chairs</label>
            </td>
            <td><input type="checkbox" id="Bekaa"><label>Loveseats</label></td>

          </tr>
          <tr>
            <td><input type="checkbox" id="Mount_Lebanon"><label>Sofas</label></td>
          </tr>


        </table>
        <div class=" line-2"></div>
    </div>

    <h3>Colors</h3>
    <form method="post" action="/Tests/Post/">
      <table>


        <tr>
          <td><img src="IMAGES\Colors\All_Colors.png" class="colors" id="All_colors" name="Beige">All Colors</td>
          <td><img src="IMAGES\Colors\Blue.png" class="colors" id="Blue_color"><label>Blue</label></td>
          <td><img src="IMAGES\Colors\Green.png" class="colors" id="Green_color"><label>Green</label></td>


        </tr>

        <tr>

          <td><img src="IMAGES\Colors\Black.png" class="colors" id="Black_color" name="Baalbeck"><label>Black</label>
          </td>
          <td><img src="IMAGES\Colors\Dark_Gray.png" class="colors" id="Dark_Gray_color"><label>Dark Gray</label></td>
          <td><img src="IMAGES\Colors\Gray.png" class="colors" id="Gray_color"><label>Gray</label></td>

        </tr>

        </tr>
        <tr>
          <td><img src="IMAGES\Colors\Beige.png" class="colors" id="Beige_color"><label>Beige</label></td>
          <td><img src="IMAGES\Colors\Pink.png" class="colors" id="Pink_color"><label>Pink</label>
          <td><img src="IMAGES\Colors\Red.png" class="colors" id="Red_color"><label>Red</label>

          </td>
        </tr>

        <tr>
          <td><img src="IMAGES\Colors\Purple.png" class="colors" id="Purple_color"><label>Purple</label></td>


        </tr>


      </table>



    </form>

    <div class=" line-2"></div>
    <h3>Designers</h3>
    <form method="post" action="/Tests/Post/">
      <table>

        <tr>
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

        </tr>



      </table>


      <div class=" line-2"></div>
      <div style="height: 50px;"></div>

      <div class="button_Background" id="Button_In_Filter">
        <button class="Button_In_Filter">Filter</button>
      </div>
  </div>
  <!-- ------------------------------------------------ -->

  
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
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



    My_Cart_Button.onclick = function () {

      setTimeout(function () { Furniture_Grid.style.animation = ''; }, 1500);

      Furniture_Grid.style.animation = "Animate_Grid_In 1.5s forwards";

      Show_Message();
      message_text.innerHTML = "My Cart";
      Filter_Button.innerHTML = "Our Shop";

      Active_Button_Editor(My_Cart_Button);


      //Just to show the favorites, to be removed/edited later.
      setTimeout(function () {
        for (var i = 0; i < heart.length; i++) {
          heart[i].src = "{{asset('images/heart_unfilled.png')}}";
        }
      }, 1200);
      /////////////////////////////////////////////////////////
    }


    Favorites_button.onclick = function () {

      setTimeout(function () { Furniture_Grid.style.animation = ''; }, 1500);

      Furniture_Grid.style.animation = "Animate_Grid_In 1.5s forwards";

      Show_Message();
      message_text.innerHTML = "My Favorites";


      Filter_Button.innerHTML = "Our Shop";





      //Just to show the favorites, to be removed/edited later.
      setTimeout(function () {
        for (var i = 0; i < heart.length; i++) {
          heart[i].src = "{{asset('images/heart_filled.png')}}";
        }
      }, 1200);
      /////////////////////////////////////////////////////////
      Active_Button_Editor(Favorites_button);

    }
    Filter_Button.onclick = function () {


      if (Filter_Button.innerHTML == "Our Shop") {
        Show_Message();
        message_text.innerHTML = "Back to Shopping!!";


        Filter_Button.innerHTML = "<img src=\"IMAGES\\Filter_logo.png\" class=\"filter_image\" id=\"Filter_Image\">Filters";
        setTimeout(function () { Furniture_Grid.style.animation = ''; }, 1500);

        setTimeout(function () {

          Furniture_Grid.style.animation = "Animate_Grid_In 1.5s forwards";

        }, 100);

        //Just to show the favorites, to be removed/edited later.
        setTimeout(function () {
          for (var i = 0; i < heart.length; i++) {
            heart[i].src = "{{asset('images/heart_unfilled.png')}}";
          }
        }, 1200);
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
            // data: formData,
            success: function(furniture) {
                // console.log(furniture);

                $.each(furniture.data, function(index, furniture) {
                    console.log(furniture);

                    Furniture_Grid.innerHTML += "<div class='furniture_container'>" +
                            "<img src='{{asset('images/heart_unfilled.png')}}' class='heart'>" +

                            "<img src='/images/furniture/1.png' height='100%' width='100%'" +
                            "class='image' id=" +
                            furniture.id + ">" +
                            furniture.name +
                            "<br>"+
                            furniture.price.toLocaleString('en-US', {style: 'currency', currency: 'USD'})
                            "</div>";
                });
                
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    window.onload = function() {
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
        setTimeout(this.style.animation = '', 1000);
        let getAttr = this.getAttribute('src');
        if (message_text.hidden == true) {
          Show_Message();
        }
        if (getAttr == "{{asset('images/heart_filled.png')}}") {

          this.src = "{{asset('images/heart_unfilled.png')}}";
          message_text.innerHTML = "Removed From My Favorites";
        }
        else {
          this.style.animation = " zoom_in .5s linear";
          this.src = "{{asset('images/heart_filled.png')}}";
          message_text.innerHTML = "Added to My Favorites";
        }
      }
    }
    };

  </script>
</body>