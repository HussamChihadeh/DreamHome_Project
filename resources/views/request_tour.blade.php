@extends("layout")
@section("title", "request tour")
@section("head")
  <link rel="stylesheet" href="{{asset('css/request_tour.css')}}">
  <link rel="stylesheet" href="{{asset('css/buttons.css')}}">
  <style>
    .disabled-time {
      opacity: 0.5; /* set the opacity as per your preference */
      cursor: not-allowed;
      pointer-events: none;
    }
  </style>
@endsection

@section("content")
  <!-- Are You Sure Message! -->
  <div hidden id="Message" style="opacity: 0;">
  <div  class="Confirmation_Message">
    <h2 class="title_in_message" id="Title">Are you sure of this Tour Reservation?</h2>

    <div style="margin-left: 13%;margin-right: 15%;margin-bottom: 0;" class="line-1"></div>

    <div class="row" style=" margin-bottom: 0%; height:20%;">
      <div class="col-lg-5"></div>
      <div class="col-lg-1 d-flex justify-content-center">
        <button class="No_button" id="No_button">No</button>
      </div>
      <div class="col-lg-1  d-flex justify-content-center">
        <div class="col-lg-5"></div>
        <button class="Yes_button" id="Yes_button">Yes</button>
      </div>
    </div>

    <a> <img src="IMAGES\image_logo.png" width="100px" class="logo_image"></a>

  </div>


  <div class="Background"  id="Background"></div>
</div>

  <div class="mb-5" style="height: 7.5%;"></div>

  
  <!-- Main Containers! -->
  <div class="row" style="width:100%;height: fit-content; margin-bottom:4%;margin-left:0;" id="All">
    <div class="col-md-1 d-none d-lg-block flex p-4"></div>
    <div class="col-md-6 flex p-4 ">
      <div class="d-none d-lg-block"><img class="image_container" src="{{asset('images/modern_building.jpg')}}" height="100%"
          id="Image_container" /></div>


    </div>
    <div class="col-lg-4 flex p-4 ">
      <div class="Date_And_Time_container" id="main_container">
        <h1 class="title" id="title">Request a Tour</h1>
        <form method="POST" action="{{ route('request_tour1') }}">
          @csrf
          <input type="date" id="date_input" name="tour_date">
          <input name="user_id" value="{{ auth()->user()->id }}" hidden>
          <input name="property_id" id="property_id" hidden>
          <div class="time_box" id="time_box">
          <button class="time_button" id="time-08-00-00" value="08:00:00">08:00 AM</button>
          <button class="time_button" id="time-09-00-00" value="09:00:00">09:00 AM</button>
          <button class="time_button" id="time-10-00-00" value="10:00:00">10:00 AM</button>
          <button class="time_button" id="time-11-00-00" value="11:00:00">11:00 AM</button>
          <button class="time_button" id="time-12-00-00" value="12:00:00">12:00 PM</button>
          <button class="time_button" id="time-01-00-00" value="01:00:00">01:00 PM</button>
          <button class="time_button" id="time-02-00-00" value="02:00:00">02:00 PM</button>
          <button class="time_button" id="time-03-00-00" value="03:00:00">03:00 PM</button>

          </div>

          <!-- <div class="line-1" style="width: 80%;margin-left: 10%;" id="line"></div> -->
          <!-- <button type="submit" class="Register_Tour" id="Register_Tour_Button">Request Tour</button> -->
        </form>
      </div>
    </div>
  </div>



  </div>

  <!--RESPONSIVE FOOTER-->
  
@endsection

@section("script")

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>

  var Time_button = document.querySelectorAll(".time_button");
  var main_container = document.getElementById("main_container");
  var Register_Tour_Button = document.getElementById("Register_Tour_Button");
  var Image_container_replaced = document.getElementById("Image_container_replaced");
  var Image_container = document.getElementById("Image_container");
  var title = document.getElementById("title");
  var date_input = document.getElementById("date_input");
  var time_box = document.getElementById("time_box");
  var line = document.getElementById("line");
  var Yes_No = document.getElementById("Yes_No");
  var Background = document.getElementById("Background");
  var Message = document.getElementById("Message");
  var No_button = document.getElementById("No_button");
  var Yes_button = document.getElementById("Yes_button");

  //Time Buttons Handler:
  // for (var i = 0; i < Time_button.length; i++) {

  //   Time_button[i].onclick = function () {
  //     var checked = "false";
  //     for (var j = 0; j < Time_button.length; j++) {
  //       if (Time_button[j].classList.contains("time_button_active")) {
  //         checked = "true";
  //         Time_button[j].classList.remove("time_button_active");
  //       }

  //     }
  //     this.classList.add("time_button_active");
  //     checked = "false";
  //   }
  // }

  // Register_Tour_Button.onclick = function () {
  //   Register_Tour_Button.classList.add("Register_button_active");
  //   Message.hidden = false;
  //   Message.style.animation = "appear 0.5s Forwards 0.05s";

  // }
  // No_button.onclick = function () {

  //   Message.style.animation = "disappear 0.5s Forwards";
  //   setTimeout(function () {
  //     Message.hidden = true;
  //   }, 300);
  //   Register_Tour_Button.classList.remove("Register_button_active");
  // }
</script>

<script>
  $(document).ready(function() {

    $('.time_button').click(function() {
  // Remove the active class from all buttons
      $('.time_button').removeClass('active');
      $('.time_button').removeAttr('name');
      // Add the active class to the clicked button
      $(this).addClass('active');
      
      // Set the name attribute of the clicked button to 'tour_time'
      $('.time_button.active').attr('name', 'tour_time');
    });
    var propertyId = new URLSearchParams(window.location.search).get('id');
    console.log(propertyId);
    $('#property_id').attr('value', propertyId);
    // Set the date input value to today's date by default
    $('#date_input').val(new Date().toISOString().substr(0, 10));

    // Send an AJAX request to the updateSlots method and disable the booked time slots
    $('#date_input').on('change', function() {
      var selectedDate = $(this).val();
      $('.disabled-time').prop('disabled', false).removeClass('disabled-time');
      $.ajax({
        type: 'GET',
        url: '/api/v1/property/updateSlots',
        data: {date: selectedDate, property_id: propertyId},
        success: function(response) {
          var bookedTimes = response.bookedTimes;
          console.log(response);
          console.log(bookedTimes);

          // Disable the booked time slots
          $.each(bookedTimes, function(index, value) {
            var x = '#time-' + value.replace(/:/g, '-');
            console.log(x);
            $(x).prop('disabled', true).addClass('disabled-time');
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    });
  });

</script>

@endsection