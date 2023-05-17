@extends("layout")
@section("title", "Property details")

@section("head")
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/Property_details.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/furniture_details.css')}}"> -->
<!-- <link rel="stylesheet" href="{{asset('css/Furniture_details.css')}}"> -->
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Luckiest Guy' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

@endsection

@section("content")

<div class="mt-5 pt-4">
  <div class=""  >
    <div class="row p-4" style="width:100%!important;">
      <!-- <div class="col-md-5 col-10">
        <img class="Furniture_Image" id="Selected_Image">
      </div>
      <div class="col-md-1 col-2">
        <div class="vertical-line"></div>
        <div class="Vertical_Images p-0" id="showed_images"></div>
      </div> -->


      <!-- <div class="col-lg-6 text-center"> -->
        <div class="col-md-5 col-10" >
          <img class="Furniture_Image" id="Selected_Image">
        </div>
        <div class="col-md-1 col-2">
            <div class="vertical-line p-0"></div>
            <div class="Vertical_Images p-0" id="showed_images"></div>
        </div>
      <!-- </div> -->
          
    

      <div class="col-md-6 p-5 col-12 mb-4 text-center text-md-start">
        <div class="text1">
          <h2 class="house_name"></h2>
          <h6 class="description_details">
          </h6>
          <div class="line-1"></div>
          <h5 class="city"></h5>
          <div class="line-1"></div>


          <div class="d-flex">
            <img src="../images/bedroom.png" class="bedroom_image">
            <div class="room_title  ps-1 pe-1">BEDROOM</div>
            <div class="room_num bedroom_num pe-3"></div>
            <img src="../images/bathroom.png" class="bathroom_image">
            <div class="room_title ps-1 pe-1">BATHROOM</div>
            <div class="room_num bathroom_num"></div>
          </div>




          <div class="d-flex mt-2 mb-1 align-items-center">
            <div class="property_type_left fw-bold pe-1">Property Type:</div>
            <div class="property_type details property_type_data"></div>
          </div>


          <div class="d-flex mt-2 mb-1 align-items-center">
            <div class="for_Rent_details fw-bold pe-1">For:</div>
            <div class="price_details details"></div>
          </div>

          <div class="d-flex mt-2 mb-1 align-items-center">
            <div class="build_date fw-bold pe-1">Built in:</div>
            <div class="build_date1 details"></div>
          </div>

          <div class="d-flex mt-2 mb-1 align-items-center">
            <div class="size fw-bold pe-1">House size:</div>
            <div class="size1 details"></div>
          </div>


          <div class="d-flex mt-2 mb-1 align-items-center">
            <div class="Parking_lot fw-bold pe-1">Parking lot:</div>
            <div class="Parking_lot1 details"></div>
          </div>

          <button type="submit" class="Request_a_Tour_button_details" hidden>Request a Tour</button>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Location -->
<div class="home-on-map d-flex flex-column align-items-center mt-5 mb-5">
  <div class="main-title mt-5 mb-5 position-relative text-center">
    <img src="" alt="">
    <h2>Location</h2>
  </div>
  <div id="map" style="width: 50%; height: 400px;"></div>
</div>

<!-- Apartment Map -->
<div class="mt-5 mb-5 text-center" id="mapp">
  <div class="main-title mt-5 mb-5 position-relative text-center">
    <img src="" alt="">
    <h2>Apartment Map</h2>
  </div>
  <img src="{{asset('images/properties/apartment_map.jpg')}}" alt="">
</div>

@endsection

@section("script")



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  var longitude;
  var latitude;

  $(document).ready(function() {
    var Selected_Image = document.getElementById("Selected_Image");
        var details_image_1 = document.getElementById("details_image_1");
        var details_image_2 = document.getElementById("details_image_2");
        var showed_images = document.getElementById("showed_images");
    var propertyId = new URLSearchParams(window.location.search).get('id');
    var longitude, latitude;

    $.ajax({
      url: "/api/v1/properties/" + propertyId,
      type: "GET",
      success: function(property) {

        // <input type="radio" name="radio-btn" id="radio1">


        console.log(property);


        var house_name = $('.house_name');
        house_name.append(property.name);
        var description_details = $('.description_details');
        description_details.append(property.description);
        var city = $('.city');
        city.append(property.province + ", " + property.city);
        var bedroom_num = $('.bedroom_num');
        bedroom_num.append(property.bedrooms);
        var bathroom_num = $('.bathroom_num');
        bathroom_num.append(property.bathrooms);
        var property_type_data = $('.property_type_data');
        property_type_data.append(property.type);
        var price_details = $('.price_details');
        price_details.append(property.price.toLocaleString('en-US', {
          style: 'currency',
          currency: 'USD'
        }));
        var build_date1 = $('.build_date1');
        build_date1.append(property.built_in);
        var area = $('.size1');
        area.append(property.area);
        var Parking_lots = $('.Parking_lot1');
        Parking_lots.append(property.parking);
        // _______________________________________________________________________________________

        var images = property.image_names;
        console.log(property.image_names);
        Object.values(images).forEach((image, index) => {
                    console.log(image);
                    var img = document.createElement('img');
                    img.classList.add('Furniture_Image_Vertical');
                   
                    img.src = "../images/properties/"+property.id+"/"+image;
                    if (index === 0) {
                        img.classList.add('Furniture_Image_Vertical_Clicked');
                        img.style.marginTop="0";
                    }

                    
                    showed_images.append(img);
                });
                clickController();

        // var Selected_Image = document.getElementById("Selected_Image");
        // var showed_images = document.getElementById("showed_images");

        // if (Selected_Image) {
        //   Selected_Image.src = ".../images/properties/" + property.id + "/1.jpg";
        // } else {
        //   console.error("Selected_Image element not found");
        // }


        // _______________________________________________________________________________________

        if (property.status === 'listed') {
          $('.Request_a_Tour_button_details').removeAttr('hidden');
        }

        longitude = property.longitude;
        latitude = property.latitude;

        var map = L.map('map').setView([latitude, longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([latitude, longitude]);
        marker.bindTooltip("Home location", {
          permanent: true,
          className: "my-label",
          offset: [0, 0]
        });
        marker.addTo(map);

        var searchControl = new L.esri.Controls.Geosearch().addTo(map);

        var results = new L.LayerGroup().addTo(map);

        searchControl.on('results', function(data) {
          results.clearLayers();
        });
      },
      error: function(error) {
        console.log(error);
      }
    });

    $('.Request_a_Tour_button_details').click(function() {
      url1 = "/rent/request_tour?id=" + propertyId;
      window.location.href = url1;
    });
  });

  function clickController(){


var Selected_Image = document.getElementById("Selected_Image");
const Image1 = document.querySelector('.Furniture_Image_Vertical_Clicked');
Selected_Image.src = Image1.src;
const Images = document.querySelectorAll('.Furniture_Image_Vertical');

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


@endsection