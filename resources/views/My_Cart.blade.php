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
<meta name="csrf-token" content="{{ csrf_token() }}">

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
    <div class="col-sm-6 col-12 p-5" id="Cart">
        <!-- -------------------------------------------------- -->


        <!-- ---------------------ROW INSIDE THE MAIN CART -->
        <!-- -------------------------------------------------------- -->

        @foreach ($furniture as $furn)
        @php $cart = $carts->where('furniture_id', $furn->id)->first();
        @endphp

        <div class="row container_1">

            <row class="Header1">{{ $furn->name }}</row>
            <row class="Header2">{{ $furn->type }}</row>

            <div class="col-4">
                <img src="images\furniture\{{$furn->id}}\1.png" onclick='Furniture_Details("{{$furn->id}}")' class="Furniture_Image">
            </div>

            <div class="col-lg-3 col-3 p-0" style="margin-top:9%">
                <div class="price">
                    $ {{ number_format($furn->price, 0, ',', ',') }}
                </div>
            </div>
            <div class="col-2 p-0" style="margin-top:9%">
                <div class="Delete" id="{{$cart->ids}}">Delete</div>
            </div>

            <div class="col-1 p-0" style="margin-top:9%">
                <button class="minus_btn">-</button>
            </div>
            <div class="col-1 p-0" style="margin-top:9%">
                <input id='{{$cart->id}}' type="number" class="input" min="1" max="9" value="{{$cart->quantity}}">
            </div>
            <div class="col-1 p-0" style="margin-top:9%">
                <button class="plus_btn">+</button>
            </div>
        </div>
        @endforeach



    </div>
    @php
    $totalPrice = 0;
    @endphp

    <div class="col-sm-4 col-12 p-2">
        <div class="Order_Summary" id="Order_Summary">
            <p style=" color: black;
                font-weight: 600;
                font-size: 1.1vw;">Order Summary</p>
            <div class="Orders" id="dataa">
                @foreach ($furniture as $furn)
                <div class="row p-1">
                    @php
                    $cart = $carts->where('furniture_id', $furn->id)->first();
                    $totalPrice += $furn->price * $cart->quantity;
                    $deliveryCost = 1;
                    $totalProducts = count($carts);
                    $totalDeliveryCost = $deliveryCost * $totalProducts;
                    @endphp
                    <div class="col-1">x{{ $cart->quantity }}</div>
                    <div class="col-7  p-0" style="margin-left:4px">
                        <div class="Name">{{ $furn->name}}</div>
                    </div>
                    <div class="col-1 p-0"></div>
                    <div class="col-2 price1 p-0 ">

                        <div style="text-align:right">
                            $ {{number_format($furn->price * $cart->quantity, 0, ',', ',')}}</div>
                    </div>
                </div>
                @endforeach

                <!-- 1 ROW IN RECEIPT -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->


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
                <p>
                    <img src="images\cliparts\Pin_Location.png" class="logos">
                    Delivery to:
                    <span style="color: black; font-weight: 400; font-style: italic;">
                        {{ strlen($user->address) > 20 ? substr($user->address, 0, 20) . '...' : $user->address }}
                    </span>
                </p>

            </div>
            <div class="Amount">
                <div class="row p-1" id="Total_Price">
                    <div class="col-8">Order Total</div>
                    <div class="col-4 p-0">$ {{ number_format($totalPrice+150, 2, '.',',') }}</div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 p-3"><button id="{{$user->id}}" class="Check_out">Check Out</button></div>
            </div>
        </div>
    </div>

</div>
<div class="message" id="message">
    <h2 class="h22" hidden id="message_text"></h2>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var message = document.getElementById("message");
    var message_text = document.getElementById("message_text");

    var minus_btn = document.querySelectorAll(".minus_btn");
    // var input = document.querySelectorAll(".input");
    var plus_btn = document.querySelectorAll(".plus_btn");
    var Delete = document.querySelectorAll(".Delete");
    // var container_1 = document.querySelectorAll(".container_1");

    // for (var i = 0; i < input.length; i++) {
    //     minus_btn[i].addEventListener('click', (function(index) {
    //         return function() {
    //             if (parseInt(input[index].value) >= 1)
    //                 input[index].value = parseInt(input[index].value) - 1;
    //         }
    //     })(i));

    //     plus_btn[i].addEventListener('click', (function(index) {
    //         return function() {
    //             if (parseInt(input[index].value) <= 9)
    //                 input[index].value = parseInt(input[index].value) + 1;
    //         }
    //     })(i));

    //     Delete[i].addEventListener('click', (function(index) {
    //         return function() {
    //             container_1[index].remove();
    //         }
    //     })(i));
    // }

    document.addEventListener('DOMContentLoaded', function() {
        // Refresh();
        $.ajax({
            url: '/api/v1/reviewCartQuantities',
            method: 'PUT',
            success: function(response) {
                // Handle the success response
                console.log(response);
                // Optionally, you can perform additional actions or update the UI
            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.error(error);
            }
        });
        refreshCart();
        refreshWholeCart();
        // Refresh();

        // Get the necessary elements
    });



    function updateCart(quantity, id) {

        $.ajax({
            url: '/api/v1/cart/' + id,
            type: 'PUT',
            data: {
                'quantity': quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log("success");
                refreshCart();
            },
            error: function(response) {
                console.log("unavailable");
                console.log(quantity);
                Show_Message();
                message_text.innerHTML = "Unavailable";

                quantity--; // Decrease the quantity after logging the error

                // Find the quantity input element based on the id
                const quantityInputElem = document.getElementById(id);
                if (quantityInputElem) {
                    quantityInputElem.value = quantity;
                    quantityInputElem.dispatchEvent(new Event('input'));
                    //console.log(quantityInputElem.value);

                }
            }
        });
    }



    function refreshCart() {
        $.ajax({
            url: '/My_Cart', // Replace with your cart route
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                var newContainer = $('<div>').html(response);
                $('#dataa').replaceWith(newContainer.find('#dataa'));
                newContainer = $('<div>').html(response);
                $('#Total_Price').replaceWith(newContainer.find('#Total_Price'));

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

    function refreshWholeCart() {
        $.ajax({
            url: '/My_Cart', // Replace with your cart route
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                var newContainer = $('<div>').html(response);
                $('#Cart').replaceWith(newContainer.find('#Cart'));
                newContainer = $('<div>').html(response);
                // $('#Total_Price').replaceWith(newContainer.find('#Total_Price'));
                var minusBtn;
                var plusBtn;
                var quantityInput;

                minusBtn = document.querySelectorAll('.minus_btn');
                plusBtn = document.querySelectorAll('.plus_btn');
                quantityInput = document.querySelectorAll('.input');

                for (let j = 0; j < quantityInput.length; j++) {
                    // Add event listener for subtracting from the quantity
                    minusBtn[j].addEventListener('click', (function(index) {
                        return function() {
                            let currentQuantity = parseInt(quantityInput[index].value);
                            if (currentQuantity > 1) {
                                quantityInput[index].value = currentQuantity - 1;
                            }
                            // Send an AJAX request to update the cart
                            updateCart(quantityInput[index].value, quantityInput[j].id);
                        };
                    })(j));

                    // Add event listener for adding to the quantity
                    plusBtn[j].addEventListener('click', (function(index) {
                        return function() {
                            let currentQuantity = parseInt(quantityInput[index].value);
                            if (currentQuantity < 9) {
                                quantityInput[index].value = currentQuantity + 1;
                            }
                            // Send an AJAX request to update the cart
                            updateCart(quantityInput[index].value, quantityInput[j].id);
                        };
                    })(j));

                
                    $('#{{$user->id}}').on('click', function() {
                        $.ajax({
                            url: '/api/v1/checkout',
                            method: 'PUT',
                            data: {
                                'user_id': 1,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Handle the success response
                                console.log(response);
                                window.location.href = '/Checkout?id={{$user->id}}';

                                // Optionally, you can perform additional actions or update the UI
                            },
                            error: function(xhr, status, error) {
                                // Handle the error response
                                console.error(error);
                            }
                        });
                    });
                }




                var deleteBtns;
                var container_1;
                deleteBtns = document.querySelectorAll('.Delete');
                container_1 = document.querySelectorAll(".container_1");

                function deleteCartItem(cartId) {
                    // Send an AJAX request to delete the cart item
                    $.ajax({
                        url: '/api/v1/cart/' + cartId,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Refresh the cart or update the UI as needed
                            // refreshCart();
                            console.log("done");
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });


                }


                for (let x = 0; x < deleteBtns.length; x++) {
                    deleteBtns[x].addEventListener('click', function() {
                        const index = Array.from(deleteBtns).indexOf(this);
                        const cartItemId = quantityInput[index].id;

                        deleteCartItem(cartItemId);
                        container_1[x].innerHTML = "";
                        // container_1[x].remove(); 
                        container_1[x].style.height = "0";
                        container_1[x].style.padding = "0";
                        container_1[x].style.borderBottom = "0.5px solid transparent";
                        refreshCart();
                    });


                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }


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

    function Furniture_Details(id) {
        window.location.href = '/furniture/furniture_details?id=' + id;

    }
</script>