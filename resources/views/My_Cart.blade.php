@extends("layout_No_Footer")
@section("title", "My Cart")

@section("head")
<link rel="stylesheet" href="{{asset('css/My_Cart.css')}}">
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
    <div style="height: 5%;"></div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-sm-6 col-12 p-5">
            <Header>My Cart</Header>
        </div>
    </div>

       
    <div class="row">
        <div class="col-1"></div>
        <div class="col-sm-6 col-12 p-5">
            <!-- -------------------------------------------------- -->


            <!-- ---------------------ROW INSIDE THE MAIN CART -->
            <!-- -------------------------------------------------------- -->
            
    @foreach ($furniture as $furn)
            <div class="row container_1">
                <row class="Header1">{{ $furn->name}}
                </row>
                <row class="Header2">{{ $furn->type}}</row>

                <div class="col-4">
                    <img src="images\furniture\Sofas\Sofa2\1.png" class="Furniture_Image">
                </div>

                <div class="col-lg-3 col-3 p-0" style="margin-top:9%">
                    <div class="price">
                    $ {{ number_format($furn->price, 0, ',', ',') }}
                    </div>
                </div>
                <div class="col-2 p-0" style="margin-top:9%">
                    <div class="Delete">Delete</div>
                </div>

                <div class="col-1 p-0" style="margin-top:9%">


                    <button class="minus_btn">-</button>
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <input type="number" class="input" min="1" max="9" value="1">
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <button class="plus_btn">+</button>

                </div>
            </div>

            
    @endforeach
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->


            <!-- <div class="row container_1">
                <row class="Header1">22222222222222222222222222222222
                </row>
                <row class="Header2">Sofa</row>

                <div class="col-4">
                    <img src="images\furniture\Sofas\Sofa2\1.png" class="Furniture_Image">
                </div>

                <div class="col-lg-3 col-3 p-0" style="margin-top:9%">
                    <div class="price">
                        $2,895.99
                    </div>
                </div>
                <div class="col-2 p-0" style="margin-top:9%">
                    <div class="Delete">Delete</div>
                </div>

                <div class="col-1 p-0" style="margin-top:9%">


                    <button class="minus_btn">-</button>
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <input type="number" class="input" min="0" max="10" value="0">
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <button class="plus_btn">+</button>

                </div>
            </div>
            <div class="row container_1">
                <row class="Header1">333333333333333333333333333333
                </row>
                <row class="Header2">Sofa</row>

                <div class="col-4">
                    <img src="images\furniture\Sofas\Sofa2\1.png" class="Furniture_Image">
                </div>

                <div class="col-lg-3 col-3 p-0" style="margin-top:9%">
                    <div class="price">
                        $2,895.99
                    </div>
                </div>
                <div class="col-2 p-0" style="margin-top:9%">
                    <div class="Delete">Delete</div>
                </div>

                <div class="col-1 p-0" style="margin-top:9%">


                    <button class="minus_btn">-</button>
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <input type="number" class="input" min="0" max="10" value="0">
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <button class="plus_btn">+</button>

                </div>
            </div>

            <div class="row container_1">
                <row class="Header1">44444444444444444
                </row>
                <row class="Header2">Sofa</row>

                <div class="col-4">
                    <img src="images\furniture\Sofas\Sofa2\1.png" class="Furniture_Image">
                </div>

                <div class="col-lg-3 col-3 p-0" style="margin-top:9%">
                    <div class="price">
                        $2,895.99
                    </div>
                </div>
                <div class="col-2 p-0" style="margin-top:9%">
                    <div class="Delete">Delete</div>
                </div>

                <div class="col-1 p-0" style="margin-top:9%">


                    <button class="minus_btn">-</button>
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <input type="number" class="input" min="0" max="10" value="0">
                </div>
                <div class="col-1 p-0" style="margin-top:9%">
                    <button class="plus_btn">+</button>

                </div>
            </div> -->


        </div>
        <div class="col-sm-4 col-12 p-2">
            <div class="Order_Summary">
                <p style=" color: black;
                font-weight: 600;
                font-size: 1.1vw;">Order Summary</p>
                <div class="Orders">
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>

                    <!-- 1 ROW IN RECEIPT -->
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>

                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>
                    <div class="row p-1">
                        <div class="col-1">x2</div>
                        <div class="col-7  p-0" style="margin-left:4px">
                            <div class="Name">Curved Sofa in Blue Upholsteryyyyyyyyyyyyyyyyyyyyyy</div>
                        </div>
                        <div class="col-1 p-0"></div>
                        <div class="col-2 price1 p-0">$ 20,000</div>
                    </div>

                </div>


                <div class="Delivery">
                    <div class="row p-1">
                        <div class="col-9">
                            <p>Delivery today with</p>
                        </div>

                        <div class="col-3">
                            $ 150
                        </div>

                    </div>
                    <p><img src="images\cliparts\Truck.jpg" class="logos"> <span style="color: black; font-weight: 400; font-style: italic;">Skinny Express</span></p>
                    <p><img src="images\cliparts\Pin_Location.png" class="logos"> Delivery to <span style="color: black; font-weight: 400; font-style: italic;">Beirut, Lebanon</span></p>

                </div>
                <div class="Amount">
                    <div class="row p-1">
                        <div class="col-8">Order Total</div>
                        <div class="col-4 p-0">$ 1,120,000</div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 p-3"><button class="Check_out">Check Out</button></div>
                </div>
            </div>
        </div>

    </div>

    <script>
       var minus_btn = document.querySelectorAll(".minus_btn");
var input = document.querySelectorAll(".input");
var plus_btn = document.querySelectorAll(".plus_btn");
var Delete = document.querySelectorAll(".Delete");
var container_1 = document.querySelectorAll(".container_1");

for (var i = 0; i < input.length; i++) {
    minus_btn[i].addEventListener('click', (function(index) {
        return function() {
            if (parseInt(input[index].value) >= 1)
                input[index].value = parseInt(input[index].value) - 1;
        }
    })(i));

    plus_btn[i].addEventListener('click', (function(index) {
        return function() {
            if (parseInt(input[index].value) <= 9)
                input[index].value = parseInt(input[index].value) + 1;
        }
    })(i));

    Delete[i].addEventListener('click', (function(index) {
        return function() {
            container_1[index].remove();
        }
    })(i));
}

    </script>