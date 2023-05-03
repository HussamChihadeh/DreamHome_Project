@extends("layout")
@section("title", "Home")

@section("head")
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/chat.css')}}">
<link rel="stylesheet" href="{{asset('css/Home_1.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">


<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@600&family=Signika:wght@500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@700&family=Signika:wght@500;600&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="IMAGES\image_logo.png">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

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

<Header_2>
    Discover Properties on the Map
</Header_2>

<div class="home-on-map mt-5">
    <div id="map" style="width: 80%; height: 520px; margin-bottom: 100px; margin-left:10%;border-radius:63px;z-index: 1; border:20px solid white">
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

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/all.min.js"></script>
<script>
    var Properties_Information = document.getElementById('Properties_Information');
    // Load Property
    var newPropertyHtml = "<h3 class='title'>House 1</h3><img src='images\\X_Button.png'  class='X_button' id='Close_Property_Details_button'><h5 class='description'>" +
        "this house has a backyard 3 bedrooms and 3 bathrooms. this house has a backyard 3 bedrooms and 3 bathrooms. this house has" +
        " a backyard 3 bedrooms and 3 bathroomsthis house has a backyard 3 bedrooms and 3 bathroomshhhhhhhhh</h5><div class='line-1'>" +
        "</div><h5 class='city'>Beirut </h5><div class='line-1'></div><div class='row'>" +
        "<div class='col-xl-6 offset-xl-3  p-2'><button type='submit'" +
        " id='1' class='details_button_Profile_Page'>View Details</button></div>";
    Properties_Information.innerHTML += newPropertyHtml;


    window.onload = Transparent_Nav();

    ///////////////////////////////////////////////////////////////////////
    var map = L.map('map').setView([33.901701, 35.478835], 18);

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

    const markerIcon = L.icon({
        iconUrl: 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="red" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" style="color: red"/></svg>'),
        iconSize: [30, 30], // Size of the icon
        iconAnchor: [20, 40], // Point of the icon which will correspond to marker's location
        className: 'my-custom-icon' // Custom class name for the icon
    });

    const iconStyle = document.createElement('style');
    iconStyle.innerHTML = '.my-custom-icon path { fill: red; }';
    document.head.appendChild(iconStyle);



    var searchControl = new L.esri.Controls.Geosearch().addTo(map);
    searchControl.getContainer().style = "width:300px; background-color: #fff;border-radius:20px;margin-left:15%;box-shadow:0 0 3px rgba(0, 0, 0, 0.2);height:50;margin-top:35";
    var results = new L.LayerGroup().addTo(map);

    searchControl.on('results', function(data) {
        results.clearLayers();


    });

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

    const box = document.querySelector('.home-on-map');
    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.7
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
            }
        });
    }, options);

    observer.observe(box);

    const Main_Image = document.getElementById("Main_Image");
    const options_1 = {
        root: null,
        rootMargin: '0px',
        threshold: 0.3
    };

    const observer_1 = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                Transparent_Nav();
            }
        });
    }, options_1);

    observer_1.observe(Main_Image);



    function Transparent_Nav() {
        var Nav_Buttons = document.querySelectorAll(".nav-link");
        for (var i = 0; i < Nav_Buttons.length; i++) {
            Nav_Buttons[i].style.color = "black";
        }
        var Navbar = document.getElementsByClassName("navbar")[0];
        Navbar.style.backgroundColor = "transparent";
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
    }
    var Details_Container = document.getElementById("Details_Container");
    var Close_Property_Details_button = document.getElementById("Close_Property_Details_button");
    Close_Property_Details_button.onclick = function() {
        Details_Container.style.animation = "Details_Out 0.7s forwards";
    }






    var marker = L.marker([33.892371, 35.478235], {
        icon: markerIcon
    }).addTo(map);
    var marker2 = L.marker([33.899371, 35.478235], {
        icon: markerIcon
    }).addTo(map);
    //var marker3 = L.marker([33.901691, 35.478161], { icon: markerIcon }).addTo(map);
    L.marker([33.901691, 35.478161], {
        icon: markerIcon
    }).addTo(map).addEventListener('click', function() {
        // window.location.href = 'Request_tour.html'; // Replace with the URL of the desired page
        Details_Container.style.animation = "Details_In 0.7s forwards";

    });

    // marker.addEventListener('click', function () {
    //     // window.location.href = 'Request_tour.html'; // Replace with the URL of the desired page
    //     Details_Container.style.animation="Details_In 0.7s forwards";

    // });





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

    $.ajax({
        url: '/api/v1/properties/getLocation',
        type: 'GET',
        // dataType: 'json',
        success: function(properties) {
            // Handle the successful response here
            alert(properties + " ");
            $.each(properties, function(index, property) {
                const marker = L.marker([property.latitude, property.longitude], {
                    icon: getMarkerIcon(property.buy_or_rent)
                }).addTo(map);
                marker._icon.setAttribute('id', property.id);
                marker.on('click', function() {
                    const propertyId = this._icon.getAttribute('id');
                    const url1 = "rent/Property_details?id=" + propertyId;
                    window.location.href = url1;
                   
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
</script>
@endsection