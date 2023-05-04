@extends("layout")
@section("title", "Home")

@section("head")
<link rel="stylesheet" href="{{asset('css/home.css')}}">
<link rel="stylesheet" href="{{asset('css/Home_1.css')}}">
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
<div style="height: 13.4%;"></div>
<div class="row">
  <div style="width: 40%;">
    <Header>
      Easiest Way to find your dream place
    </Header>
    <h7>find your dream home at affordable prices from anywhere in the world with us</h7>
    <div class="Buy_container">Buy</div>
    <div class="Rent_container Clicked">Rent</div>
  </div>
  <div style="width: 65%;margin-left: -5%;">
    <img src="images/Villa_Homepage.png" id="Main_Image" class="Home_Main_Image">
  </div>

</div>

<div class="About_Us_background"></div>

<div class="row">
  <div class="col-12">
    <div>
      <img src="images\furniture\Sofas\Homepage_Sofa_2.png" class="Furniture_Image" style="float: right;" id="Sofa_Image">
      <div class="Furniture_Title">
        <Header>
      Furnish Your Life with Style</Header>
      <div class="Furniture_Container Clicked">View Furniture</div>

</div>
    </div>
  </div>
</div>

<div class="Map_background">
  <Header_2>
    Discover Properties on the Map
  </Header_2>

  <div class="home-on-map mt-5 ">
    <div id="map" style="width: 80%; height: 520px; margin-bottom: 100px; margin-left:10%;border-radius:63px;z-index: 1; border:20px solid white">
    </div>
  </div>
</div>
<div class="Details_Container" id="Details_Container" style="position: relative; z-index: 2; cursor:mouse;">

  <div class="row">
    <div class="col-md-6 d-none d-md-block">
      <img src="images\properties\1\1.jpg" class="House_Image_1">
    </div>
    <div class="col-md-6 col-12 p-5">
      <div class="Properties_Information" id="Properties_Information" style="box-shadow: none;">


      </div>
    </div>
  </div>
</div>



<!-- <div class="mb-5" style="height: 500px;"></div> -->
@endsection

@section("script")

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  var Properties_Information = document.getElementById('Properties_Information');

  var map = L.map('map').setView([33.901701, 35.478835], 12);

  L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
    attribution: '© Google Maps',
    maxZoom: 18,
  }).addTo(map);

  // Add zoom control to bottom left
  L.control.zoom({
    position: 'bottomleft'
  }).addTo(map);

  // Remove zoom control from top left
  map.zoomControl.remove();

  function getMarkerIcon(propertyType) {
    const fill = propertyType === 'buy' ? 'red' : 'orange'; // Change the color based on the property type
    const markerIcon = L.icon({
      iconUrl: 'data:image/svg+xml,' + encodeURIComponent(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="${fill}" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>`),
      iconSize: [30, 30], // Size of the icon
      iconAnchor: [20, 40], // Point of the icon which will correspond to marker's location
      className: 'my-custom-icon' // Custom class name for the icon
    });
    return markerIcon;
  }
  const iconStyle = document.createElement('style');
  iconStyle.innerHTML = '.my-custom-icon path { fill: red; }';
  document.head.appendChild(iconStyle);


  var searchControl = new L.esri.Controls.Geosearch().addTo(map);
  searchControl.getContainer().style = "width:300px; background-color: #fff;border-radius:20px;margin-left:15%;box-shadow:0 0 3px rgba(0, 0, 0, 0.2);height:50;margin-top:35";
  var results = new L.LayerGroup().addTo(map);

  searchControl.on('results', function(data) {
    results.clearLayers();


  });
  window.onload = Nav_Editor("transparent");

  var searchInput = searchControl._input;
  searchInput.style.border = "0px";
  searchInput.style.borderRadius = "20px";
  searchInput.style.height = "50";
  searchInput.style.width = "95%";
  searchInput.style.marginLeft = "2%";
  searchInput.placeholder = "Search";
  // Add an event listener for the 'focus' event
  searchInput.addEventListener('focus', function() {
    // Modify the input element's styles to give it a modern look when in focus
    searchInput.style.outline = 'none';
    searchControl.getContainer().style.boxShadow = '0 0 3px rgba(0, 0, 0, 0.6)';
  });


  // Load Property
  window.onload = function() {
    var newPropertyHtml = "<h3 class='title'></h3><img src='images\\X_Button.png'  class='X_button' id='Close_Property_Details_button'><h5 class='description'>" +
      "</h5><div class='line-1'>" +
      "</div><h5 class='city'></h5><div class='line-1'></div><div class='row'>" +
      "<div class='col-xl-6 offset-xl-3  p-2'><button type='submit'" +
      " id='Details_Button' class='details_button_Profile_Page'>View Details</button></div>";
    Properties_Information.innerHTML += newPropertyHtml;

    var Details_Container = document.getElementById("Details_Container");
    var Close_Property_Details_button = document.getElementById("Close_Property_Details_button");
    Close_Property_Details_button.onclick = function() {
      Details_Container.style.animation = "Details_Out 0.7s forwards";
    }


  }
  $.ajax({
    url: '/api/v1/properties/getLocation',
    type: 'GET',
    // dataType: 'json',
    success: function(properties) {
      // Handle the successful response here
      console.log(properties);
      $.each(properties, function(index, property) {
        const marker = L.marker([property.latitude, property.longitude], {
          icon: getMarkerIcon(property.buy_or_rent)
        }).addTo(map);
        marker._icon.setAttribute('id', property.id);

        marker.on('click', function() {
          var Details_button = document.getElementById("Details_Button");
          Details_Container.style.animation = "Details_In 0.7s forwards";
          Details_button.onclick = function() {
            const propertyId = marker._icon.getAttribute('id');
            const url1 = "rent/Property_details?id=" + propertyId;
            window.location.href = url1;
          };



          var house_name = $('.title');
          house_name.html("");
          house_name.append(property.name);
          var description_details = $('.description');
          description_details.html("");
          description_details.append(property.description);
          var city = $('.city');
          city.html("");
          city.append(property.province + ", " + property.city);

        });
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Handle the error response here
      console.log(errorThrown);
    }
  });


  var searchControl = new L.esri.Controls.Geosearch().addTo(map);

  var results = new L.LayerGroup().addTo(map);

  searchControl.on('results', function(data) {
    results.clearLayers();



  });

  const box = document.querySelector('.home-on-map');
  const options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.3
  };

  const observer = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        var Nav_Buttons = document.querySelectorAll(".nav-link");
        for (var i = 0; i < Nav_Buttons.length; i++) {
          Nav_Buttons[i].style.color = "white";
        }
        var Navbar = document.getElementsByClassName("navbar")[0];
        Navbar.style.backgroundColor = "black";
        var Navbar_brand = document.querySelector(".navbar-brand img");
        Navbar_brand.setAttribute("src", "IMAGES\\image_logo.png");
        var Logo = document.getElementsByClassName("logo")[0];
        Logo.style.backgroundImage = " -webkit - linear - gradient(var(--gold1), var(--gold2));";
        Logo.style.backgroundClip = 'text';
        Logo.style.webkitBackgroundClip = 'transparent';
        Logo.style.color = 'transparent';
        Logo.style.webkitTextFillColor = 'transparent';
        Navbar.style.borderBottomLeftRadius = "15px";
        Navbar.style.borderBottomRightRadius = "15px";

      }
    });
  }, options);

  observer.observe(box);

  ///////////////////////////////////////////////////////////////////////////
  const Main_Image = document.getElementById("Main_Image");
  const options_1 = {
    root: null,
    rootMargin: '0px',
    threshold: 0.7
  };

  const observer_1 = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        Nav_Editor("transparent", "0");
      }
    });
  }, options_1);

  observer_1.observe(Main_Image);


  ///////////////////////////////////////////////////////////////////////
  const Sofa_Image = document.getElementById("Sofa_Image");
  const options_2 = {
    root: null,
    rootMargin: '0px',
    threshold: 0.75
  };

  const observer_2 = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        Nav_Editor("#f8f8f8", "0");
      }
    });
  }, options_2);

  observer_2.observe(Sofa_Image);

  function Nav_Editor(backgroundColor, borderBottom) {
    var Nav_Buttons = document.querySelectorAll(".nav-link");
    for (var i = 0; i < Nav_Buttons.length; i++) {
      Nav_Buttons[i].style.color = "black";
    }
    var Navbar = document.getElementsByClassName("navbar")[0];
    Navbar.style.backgroundColor = backgroundColor + "";
    var Navbar_brand = document.querySelector(".navbar-brand img");
    Navbar_brand.setAttribute("src", "IMAGES\\black_image_logo.png");
    var Logo = document.getElementsByClassName("logo")[0];
    Logo.style.backgroundImage = '';
    Logo.style.backgroundClip = '';
    Logo.style.webkitBackgroundClip = '';
    Logo.style.color = 'black';
    Logo.style.webkitTextFillColor = 'black';
    Logo.style.textShadow = 'none';
    Logo.style.textDecoration = "none";
    Logo.style.fontSize = "25";
    Logo.style.marginTop = "10";
    var Navbar = document.querySelector("nav");
    Navbar.style.borderBottomLeftRadius = borderBottom + "";
    Navbar.style.borderBottomRightRadius = borderBottom + "";
  }
</script>
@endsection