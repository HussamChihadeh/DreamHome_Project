@extends("layout_No_Footer")
@section("title", "Add Purchase Method")

@section("head")
<link rel="stylesheet" href="{{asset('css/Checkout.css')}}">
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    (function() {
        emailjs.init("eLucaHfEPZ2rkHJ9j");
    })();

    const urlParams = new URLSearchParams(window.location.search);

    // Get the value of the 'id' parameter
    const userId = urlParams.get('id');

    // Use the userId variable as needed
    console.log('User ID:', userId);
    var username, useremail, address;
    // Make an Ajax request to retrieve user details



    document.getElementById("Purchase").onclick = function() {
        var field1 = document.getElementById('1').value;
        var field2 = document.getElementById('2').value;
        var field3 = document.getElementById('3').value;
        var field4 = document.getElementById('4').value;
        var field5 = document.getElementById('5').value;

        if (field1 != "" && field2 != "" && field3 != "" && field4 != "" && field5 != "") {

            $.ajax({
                url: '/api/v1/getUserDetails/' + userId, // Update the URL to match the API route
                method: 'GET',
                success: function(response) {
                    // Handle the response
                    if (response.id) {
                        var user = response;
                        console.log('User Name:', user.name);
                        console.log('User Email:', user.email);
                        username = user.name;
                        useremail = user.email;
                        address = user.address;
                    } else {
                        console.error('Failed to retrieve user details');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request failed:', error);
                }
            });
            var params = {
                from_name: "Dream Home",
                Amount: "1222444",
                to_email: useremail,
                to_name: username,
                address: address
            };


            emailjs.send("service_ph6magm", "template_s3vb2go", params)
                .then(function(res) {
                    alert("Successfuly Checked Out");
                    window.location.href = '/';
                })
                .catch(function(error) {
                    console.error("Error sending email:", error);
                });
        } 
    };
</script>

@endsection

@section("content")
<div style="height: 2%;"></div>



<div class="container">


    <div class="container-form">



        <h2 style="font-weight: 600;">Add Purchase Method</h2>

        <form id="myForm">

            <div class="user-box-creditNum">
                <label for="creditNum" style="margin-top: 0;">Card Number</label>
                <span>Enter the 16-digit card number on the card</span>
                <div class="red"></div>
                <div class="orange"></div>
                <input type="text" id="1" placeholder="xxxx - xxxxx - xxxx - xxxx" name="creditNum" data-maxlength="16" oninput="this.value=this.value.slice(0, this.dataset.maxlength)" required>
            </div>

            <div class="user-box-name">
                <label for="name">Card Name Holder</label>
                <input type="text" id="2" name="name" placeholder="Name on card" required>
            </div>

            <div class="user-box">
                <label for="cvv">CVV Number</label>
                <input type="password" id="3" placeholder="3 or 4 digits number on the card" name="cvv" data-maxlength="4" oninput="this.value=this.value.slice(0, this.dataset.maxlength)" required>
            </div>

            <div class="user-box-expiry">
                <label for="expiryDate">Expiry Date</label>
                <input type="number" id="4" name="expiryDateM" max="12" min="1" required data-maxlength="2" placeholder="MM" oninput="this.value=this.value.slice(0, this.dataset.maxlength)" required>
                <strong>/</strong>
                <input type="number" id="5" placeholder="YY" name="expiryDateY" data-maxlength="2" oninput="this.value=this.value.slice(0, this.dataset.maxlength)" required>
            </div>
            <div class="row">
                <div class="col-8 offset-2 pt-3">
                    <Button type="submit" id="Purchase" class="Check_out" style="font-size: 16px;">Purchase</Button>
                </div>
            </div>
    </div>




</div>

</form>
<script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
                event.preventDefault();});
</script>
</div>

</div>
</body>

</html>