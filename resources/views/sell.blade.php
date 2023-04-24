@extends("layout")
@section("title", "sell")

@section("head")
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
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
    <div class="pt-5 pb-5 container">
        <form action="{{ route('sell') }}" method="POST">
        @csrf
            <div class="row mt-5 mb-5">
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <h3>Basic information</h3>
                    <hr>
                    <input name="user_id" value="{{ auth()->user()->id }}" hidden>
                    <input name="status" value="pending" hidden>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label ">Title</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label ">Price</label>
                        <input type="text" class="form-control" placeholder="$(USD)" required name="price">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label ">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <div class="col-lg-5">

                </div>
                <div class="col-lg-1"></div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <h3>Local information</h3>
                    <hr class="hr">
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label ">Province</label>
                        <select class="form-select" name="province" required>
                        <option value="" selected disabled>-- Select a province --</option>
                            <option value="Akkar">Akkar</option>
                            <option value="Baalbeck">Baalbeck</option>
                            <option value="Beirut">Beirut</option>
                            <option value="Bekaa">Bekaa</option>
                            <option value="Mount Lebanon">Mount Lebanon</option>
                            <option value="North Lebanon">North Lebanon</option>
                            <option value="Nabatiyeh">Nabatiyeh</option>
                            <option value="South Lebanon">South Lebanon</option>
                        </select>
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label ">Town / City</label>
                        <input type="text" class="form-control" placeholder="" required name="city">
                    </div>
                    <div class="mb-3 form-outline w-75">
                        <label class="form-label ">Street address</label>
                        <input type="text" class="form-control" placeholder="" required name="street">
                    </div>
                    <div class="row">
                        <div class="col-auto mb-3">
                            <label class="form-label ">Latitude</label>
                            <input type="text" id="latitude" class="form-control w-75" readonly name="latitude">
                        </div>
                        <div class="col-auto mb-3 ">
                            <label class="form-label ">Longitude</label>
                            <input type="text" id="longitude" class="form-control w-75" readonly name="longitude">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h3>Place on Map</h3>
                    <hr class="hr">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-lg-1"></div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <h4>Summary</h4>
                    <hr class="hr mb-4">



                    <div class="row">
                        <div class="col-auto mb-3 ">
                            <!-- should be made as list -->
                            <label class="form-label ">Property type</label>
                            <select class="form-select" name="type">
                                <option value="" selected disabled>-- Select a type --</option>
                                <option value="apartment">apartment</option>
                                <option value="flat">flat</option>
                                <option value="villa">villa</option>
                            </select>
                        </div>
                        <div class="col-auto mb-3 ">
                            <label class="form-label ">Parking lots</label>
                            <input type="text" class="form-control" placeholder="" required name="parking">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto mb-3 ">
                            <label class="form-label ">Bedrooms</label>
                            <input type="text" class="form-control" name="bedrooms">
                        </div>
                        <div class="col-auto mb-3 ">
                            <label class="form-label ">Bathrooms</label>
                            <input type="text" class="form-control" placeholder="" required name="bathrooms">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto mb-3 ">
                            <label class="form-label ">Area</label>
                            <input type="text" class="form-control" placeholder="m&#178;" name="area">
                        </div>
                        <div class="col-auto mb-3 ">
                            <label class="form-label ">Built in</label>
                            <input type="text" class="form-control" placeholder="Year" required name="built_in">
                        </div>
                    </div>

                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="buy_or_rent" id="inlineRadio1"
                            value="buy">
                        <label class="form-check-label" for="inlineRadio1">Buy</label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="buy_or_rent" id="inlineRadio2"
                            value="rent">
                        <label class="form-check-label" for="inlineRadio2">Rent</label>
                    </div>
                    <!-- <div class="mb-3 form-outline w-75">
                    <label class="form-label fw-bold">Street address</label>
                    <input type="text" class="form-control"  placeholder="" required>
                </div> -->
                </div>
                <div class="col-lg-5 ">
                    <h4>Set featured image</h4>
                    <hr class="hr">

                    <div
                        style="border: 1px solid black; width: 250px; height: 300px; margin-top: 20px; margin-bottom: 20px;">
                        <img id="image-preview" style="max-width: 100%; max-height: 100%;">
                    </div>
                    <input type="file" id="image-input" onchange="displayImage()">

                </div>
                <div class="col-lg-1"></div>
            </div>


            <div style="width: 80%; margin: auto;">
                <h3>Gallery</h3>
                <div class="image-container d-flex justify-content-center">

                    <i class="fa-solid fa-arrow-up-from-bracket uploadI"></i>
                    <input class="uploadInput" type="file" id="image-input" multiple onchange="displayMultipleImages()">

                </div>
                <span class="hint text-black-50 fw-bold">Hint: <span class="fw-normal">You can upload all images at
                        once</span></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @endsection

    @section("script")
    <!--FOOTER-->
    
    <!--display Images-->
    <script>
        function displayImage() {
            var fileInput = document.getElementById('image-input');
            var preview = document.getElementById('image-preview');

            preview.src = URL.createObjectURL(fileInput.files[0]);
        }

        function displayMultipleImages() {
            var fileInput = document.getElementById('image-input');
            var previewContainer = document.querySelector('div');
            previewContainer.innerHTML = '';

            for (var i = 0; i < fileInput.files.length; i++) {
                var file = fileInput.files[i];
                var preview = document.createElement('img');

                preview.style.maxWidth = '100%';
                preview.style.maxHeight = '100%';

                previewContainer.appendChild(preview);

                var reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    

    <!-- initialize the map -->
    <script>
        var map = L.map('map').setView([33.892371, 35.478235], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([33.892371, 35.478235], {
            draggable: true
        })
        marker.bindTooltip("Home location", { permanent: true, className: "my-label", offset: [0, 0] });
        marker.addTo(map);

        marker.on('dragend', function (event) {
            var latLng = event.target.getLatLng();
            // console.log(latLng.lat, latLng.lng);
            showPosition(latLng.lat, latLng.lng);
        });

        var searchControl = new L.esri.Controls.Geosearch().addTo(map);

        var results = new L.LayerGroup().addTo(map);

        searchControl.on('results', function (data) {
            results.clearLayers();
            for (var i = data.results.length - 1; i >= 0; i--) {
                //   results.addLayer(L.marker(data.results[i].latlng));
                // console.log(data.results[i].latlng.lat, data.results[i].latlng.lng);
                showPosition(data.results[i].latlng.lat, data.results[i].latlng.lng);
                // console.log(latLng.lat, latLng.lng);
                marker.setLatLng(data.results[i].latlng);
                //   marker.draggable = true;
            }


        });
        marker.on('moveend', function (e) {
            var latlng = e.target.getLatLng();
            // console.log(latlng.lat + ', ' + latlng.lng);
            e.target.dragging.enable();
        });

        function showPosition(x,y) {
            document.getElementById("latitude").value = x;
            document.getElementById("longitude").value = y;
        }
    </script>

@endsection