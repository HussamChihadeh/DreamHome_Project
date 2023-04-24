@extends("layout")
@section("title", "Home")

@section("head")
<link rel="stylesheet" href="{{asset('css/home.css')}}">
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

  <div class="mb-5" style="height: 50%;"></div>

  <div class="features text-center pt-5 pb-5">
    <div class="container">
      <div class="main-title mt-5 mb-5 position-relative">
        <img src="" alt="">
        @auth
            <p>Welcome back, {{ auth()->user()->name }}!</p>
        
        @else
        <p>Welcome!</p>
        @endauth
        <h2>We are good at</h2>
        <p class="text-black-50 text-uppercase">Some of the stuufffff</p>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="feat">
            <div class="icon-holder position-relative">
              <i class="fa-solid fa-1 position-absolute bottom-0 number"></i>
              <i class="fa-solid fa-pencil fa-4x position-absolute bottom-0 icon"></i>
            </div>
            <h4 class="mb-3 mt-3 text-uppercase">Real Estate</h4>
            <p class="text-black-50 lh-lg">asdjsjasjdsajdhasbasjbd asdjsjasjdsajdhasbasjbd asdjsjasjdsajdhasbasjbd
              asdjsjasjdsajdhasbasjbd
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="feat">
            <div class="icon-holder position-relative">
              <i class="fa-solid fa-2 position-absolute bottom-0 number"></i>
              <i class="fa-solid fa-pencil fa-4x position-absolute bottom-0 icon"></i>
            </div>
            <h4 class="mb-3 mt-3 text-uppercase">Real Estate</h4>
            <p class="text-black-50 lh-lg">asdjsjasjdsajdhasbasjbd asdjsjasjdsajdhasbasjbd asdjsjasjdsajdhasbasjbd
              asdjsjasjdsajdhasbasjbd
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="feat">
            <div class="icon-holder position-relative">
              <i class="fa-solid fa-3 position-absolute bottom-0 number"></i>
              <i class="fa-solid fa-pencil fa-4x position-absolute bottom-0 icon"></i>
            </div>
            <h4 class="mb-3 mt-3 text-uppercase">Real Estate</h4>
            <p class="text-black-50 lh-lg">asdjsjasjdsajdhasbasjbd asdjsjasjdsajdhasbasjbd asdjsjasjdsajdhasbasjbd
              asdjsjasjdsajdhasbasjbd
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="stuff pt-5">
    <div class="container">
      <div class="main-title mt-5 mb-5 position-relative text-center">
        <img src="" alt="">
        <h2>Stuff</h2>
        <p class="text-black-50 text-uppercase">Some of the stuufffff</p>
      </div>
      <p class="description text-center mb-5 text-black-50 m-auto">
        hasdhgh hasdhgh hasdhgh hasdhghhasdhghhasdhghhasdhghv vvvv hasdhgh hasdhgh hasdhgh hasdhghhasdhghhasdhghhasdhghv
      </p>
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 text-center text-md-start">
          <div class="text">
            <h4>Living Room</h4>
            <p class="text-black-50 fs-6">hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
              hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
              hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
              hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
            </p>
            <a href="" class="btn">Explore</a>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="../CSS/5375294_2755355.jpg" width="800px" height="800px" alt="" class="img-fluid">
        </div>
      </div>
    </div>
  </div>

  <div class="mobileApp pt-5">
    <div class="container">
      <div class="main-title mt-5 mb-5 position-relative text-center">
        <img src="" alt="">
        <h2>Dream in Home</h2>
        <p class="text-black-50 text-uppercase">Place furnishings in your space</p>
      </div>
      <!-- <p class="description text-center mb-5 text-black-50 m-auto">
        hasdhgh hasdhgh hasdhgh hasdhghhasdhghhasdhghhasdhghv vvvv hasdhgh hasdhgh hasdhgh hasdhghhasdhghhasdhghhasdhghv
      </p> -->
      <div class="row align-items-center">
        <div class="col-lg-6">
          <img src="../CSS/homepage-screens-hot-Ikea-Place.jpg" width="800px" height="800px" alt="" class="img-fluid">
        </div>
        <div class="col-lg-6 mb-4 text-center text-md-start">
          <div class="text">
            <h4>Living Room</h4>
            <p class="text-black-50 fs-6">hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
              hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
              hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
              hgadsghasgdhhga asdghagshd asdghasdgh basdhgas
            </p>
            <a href="" class="btn">Explore</a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="home-on-map mt-5">
    <div id="map" style="width: 100%; height: 400px;"></div>
  </div>

  <div class="facts pt-5 pb-5 mt-5 mb-5">
    <div class="container text-center">
      <div class="main-title mt-5 mb-5 position-relative">
        <img src="" alt="">
        <h2>Facts & Statistics</h2>
        <!-- <p class="text-black-50 text-uppercase">Some of the stuufffff</p> -->
      </div>
      <div class="d-flex justify-content-evenly align-items-center">
        <div class="properties">
          <div class="number fs-1">157</div>
          <div class="label">Properties listed</div>
        </div>
        <hr class="hr-blurry ">
        <div class="clients">
          <div class="number fs-1">2451</div>
          <div class="label">Satisfied Clients</div>
        </div>
        <hr class="hr-blurry">
        <div class="properties-sold">
          <div class="number fs-1">506</div>
          <div class="label">Properties Sold</div>
        </div>
      </div>
    </div>
  </div>

  <div class="subscribe mt-5 pt-4 pb-1 text-center text-md-start">
    <div class="container">
      <form action="" class="row align-items-center">
        <div class="col-md-6 col-lg-3">
          <div class="fw-bold fs-5 mb-3">Subscribe to our Newsletter:</div>
        </div>
        <div class="col-md-6 col-lg-7 mb-5">
          <input class="w-100 text-light bg-transparent p-2" type="email" placeholder="Enter E-mail Address">
        </div>
        <div class="col-md-6 col-lg-2">
          <input class="btn rounded-pill" type="submit" name="" id="" value="Subscribe">
        </div>
      </form>
    </div>
  </div>




  <!-- <div class="mb-5" style="height: 500px;"></div> -->
  @endsection

  @section("script")

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    var map = L.map('map').setView([33.892371, 35.478235], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

   
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
    console.log(properties);
    $.each(properties, function(index, property) {
      const marker = L.marker([property.latitude, property.longitude], {icon: getMarkerIcon(property.buy_or_rent)}).addTo(map);
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

    searchControl.on('results', function (data) {
      results.clearLayers();



    });



  </script>
@endsection