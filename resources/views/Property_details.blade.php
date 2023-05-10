@extends("layout")
@section("title", "Sign in")

@section("head")
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/Property_details.css')}}">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Luckiest Guy' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

  <script
    src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

  <script
    src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

  <link rel="stylesheet" type="text/css"
    href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

@endsection

@section("content")

    <div class="mt-5 pt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center">
                    <div class="slider">
                        <div class="slides" id="slides">
                          <!--radio buttons start-->
                          <!-- <input type="radio" name="radio-btn" id="radio1">
                          <input type="radio" name="radio-btn" id="radio2">
                          <input type="radio" name="radio-btn" id="radio3">
                          <input type="radio" name="radio-btn" id="radio4"> -->
                          <!--radio buttons end-->
                          <!--slide images start-->
                            <div class="slide first">
                              <img>
                            </div>
                            <div class="slide">
                              <img>
                            </div>
                            <div class="slide">
                              <img>
                            </div>
                            <!-- <div class="slide ">
                              <img src="..\images\properties\building.jpg" alt="">
                            </div> -->
                          <!--slide images end-->
                          <!--automatic navigation start-->
                          <div class="navigation-auto" id="navigation-auto">
                            <!-- <div class="auto-btn1"></div>
                            <div class="auto-btn2"></div>
                            <div class="auto-btn3"></div>
                            <div class="auto-btn4"></div> -->
                          </div>
                          <!--automatic navigation end-->
                        </div>
                        <!--manual navigation start-->
                        <div class="navigation-manual" id="navigation-manual">
                          <!-- <label for="radio1" class="manual-btn"></label>
                          <label for="radio2" class="manual-btn"></label>
                          <label for="radio3" class="manual-btn"></label>
                          <label for="radio4" class="manual-btn"></label> -->
                        </div>
                        <!--manual navigation end-->
                        <!--image slider end-->
                      </div>
                </div>
                <div class="col-lg-6 mb-4 text-center text-md-start">
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
  var propertyId = new URLSearchParams(window.location.search).get('id');
  var longitude, latitude;

  $.ajax({
    url: "/api/v1/properties/" + propertyId,
    type: "GET",
    success: function(property) {
     
      const imgElements = document.querySelectorAll('.slide img');
      const navAuto = document.getElementById('navigation-auto');
      const navMan = document.getElementById('navigation-manual');
      const myDiv = document.getElementById('slides');
      // <input type="radio" name="radio-btn" id="radio1">
      console.log(imgElements);
      for (let index = 0; index < imgElements.length; index++) {
        imgElements[index].src = "/images/properties/" + property.id + "/"+(index+1)+".jpg";

        const radioBtn = document.createElement('input');
        radioBtn.type = 'radio';
        radioBtn.name = 'radio-btn';
        radioBtn.id = 'radio'+(index+1);
        myDiv.insertBefore(radioBtn, myDiv.firstChild);

        const label = document.createElement('label');
        label.setAttribute('for', 'radio'+(index+1));
        label.classList.add('manual-btn');
        navMan.append(label);

        const div = document.createElement('label');
        div.classList.add('auto-btn'+(index+1));
        navAuto.append(div);
      }
    
    
        console.log(property);
        var house_name = $('.house_name');
        house_name.append(property.name);
        var description_details = $('.description_details');
        description_details.append(property.description);
        var city = $('.city');
        city.append(property.province + ", " +property.city);
        var bedroom_num = $('.bedroom_num');
        bedroom_num.append(property.bedrooms);
        var bathroom_num = $('.bathroom_num');
        bathroom_num.append(property.bathrooms);
        var property_type_data = $('.property_type_data');
        property_type_data.append(property.type);
        var price_details = $('.price_details');
        price_details.append(property.price.toLocaleString('en-US', {style: 'currency', currency: 'USD'}));
        var build_date1 = $('.build_date1');
        build_date1.append(property.built_in);
        var area = $('.size1');
        area.append(property.area);
        var Parking_lots = $('.Parking_lot1');
        Parking_lots.append(property.parking);

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
      marker.bindTooltip("Home location", { permanent: true, className: "my-label", offset: [0, 0] });
      marker.addTo(map);

      var searchControl = new L.esri.Controls.Geosearch().addTo(map);

      var results = new L.LayerGroup().addTo(map);

      searchControl.on('results', function (data) {
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




</script>

<script type="text/javascript">
        var counter = 1;
        setInterval(function () {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
    </script>

@endsection