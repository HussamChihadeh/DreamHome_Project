@extends("layout")
@section("title", "rent")
@section("head")
<link rel="stylesheet" href="{{asset('css/rent.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<style>
  :root {
    --gold1: #AE8625;
  }

  .pages {
    list-style: none;
    display: flex;
  }

  .pagination {
    margin-top: -50px;
    display: flex;
    width: 70%;
    margin-left: auto;
    margin-right: auto;
    justify-content: center;
    margin-bottom: 30px;

  }

  .pagination ul {
    margin: 0px;
    padding: 0px;

  }

  .pagination li,
  .pagination button {
    height: 50px;
    margin-top: 2.5;
    width: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    /* background-color: white; */
    border: none;

  }

  .pagination li,
  .pagination li button {
    background-color: white;
  }

  .prev,
  .next {
    font-size: 16px;
    color: var(--gold1);
    background-color: black;

  }

  .prev {
    border-bottom-left-radius: 15px;
    border-top-left-radius: 15px;

  }

  .next {
    border-bottom-right-radius: 15px;
    border-top-right-radius: 15px;

  }

  .pages .active {
    background-color: black;
    color: var(--gold1);

  }
</style>
@endsection
@section("content")

<!-- <div class="All_Containers"> -->
  <!-- FILTER CONTAINER -->
  <div class="filter_container" id="filter_container">
    <h3> Filter by Province</h3>
    <div class="line-1"></div>


    <form id="filterForm">
      <div id="Filter_By_Province">
        <input type="radio" id="Akkar" name="province[eq]" value="Akkar" class="me-1"><label>Akkar</label><br>
        <input type="radio" id="Baalbeck" name="province[eq]" value="Baalbeck" class="me-1"><label>Baalbeck</label><br>
        <input type="radio" id="Beirut" name="province[eq]" value="Beirut" class="me-1"><label>Beirut</label><br>
        <input type="radio" id="Bekaa" name="province[eq]" value="Bekaa" class="me-1"><label>Bekaa</label><br>
        <input type="radio" id="Mount_Lebanon" name="province[eq]" value="Mount Lebanon" class="me-1"><label>Mount
          Lebanon</label><br>
        <input type="radio" id="North_Lebanon" name="province[eq]" value="North Lebanon" class="me-1"><label>North
          Lebanon</label><br>
        <input type="radio" id="Nabatiyeh" name="province[eq]" value="Nabatiyeh" class="me-1"><label>Nabatiyeh</label><br>
        <input type="radio" id="South_Lebanon" name="province[eq]" value="South Lebanon" class="me-1"><label>South
          Lebanon</label><br>
      </div>

      <div class="space"></div>
      <h3> Filter by Buy/Rent</h3>
      <div class="line-1"></div>
      <!-- <div id="Filter_by_price">
            <div class="left">400$</div>
            <input type="range" min="400" max="10000" value="1000" class="slider1" id="myRange">
            <div class="left">10,000$</div>
          </div> -->
      <div class="d-flex align-items-center">
        <div class="form-check form-check-inline mb-3 d-flex align-items-center">
          <input class="form-check-input me-1" type="radio" name="buy_or_rent[eq]" id="inlineRadio1" value="buy">
          <label class="form-check-label" for="inlineRadio1">Buy</label>
        </div>
        <div class="form-check form-check-inline mb-3 d-flex align-items-center">
          <input class="form-check-input me-1" type="radio" name="buy_or_rent[eq]" id="inlineRadio2" value="rent">
          <label class="form-check-label" for="inlineRadio2">Rent</label>
        </div>
      </div>
      <!-- <div class="space"></div> -->
      <!-- <div class="space"></div> -->

      <div class="space"></div>
      <h3> Filter by Property type</h3>
      <div id="Filter_By_Property">
        <div class="line-1"></div>

        <input type="radio" id="Apartment" name="type[eq]" value="apartments" class="me-1"><label>Apartment</label><br>
        <input type="radio" id="villa" name="type[eq]" value="villa" class="me-1"><label>Villa</label><br>
        <input type="radio" id="flat" name="type[eq]" value="flat" class="me-1"><label>flat</label><br>
      </div>
      <a> <img src="IMAGES\image_logo.png" width="50" height="100" style="margin-bottom :-14;margin-top:14px; margin-left: -20; border-bottom-left-radius: 15px;"></a>

      <button type="submit" class="filter_button" name="filter">Filter</button>
      <button type="reset" class="Reset_button" name="Reset">Reset</button>


    </form>
  </div>


  <!-- SEARCH BAR-->
  <!-- <div class="search_bar" id="search_bar">

    <img src="IMAGES\search-icon-simple-free-illustration-free-vector.webp"
      class="search_image">
    <input class="input_search" type="text" id="search_bar" name="search_bar" placeholder="Search"><br>
    <button type="submit" id="search_btn" hidden></button>

  </div> -->


  <!-- GROUP CONTAINER -->

  <div class="Group_container" id="Group_container">
    
  </div>


  <!-- DETAILS CONTAINER -->

  <div style="height:200px"></div>
  <div class="pagination">
      <button class="prev">&lt;</button>
      <ul class="pages"></ul>
      <button class="next">&gt;</button>
    </div>
</div>
@endsection

@section("script")

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  var currentPage = 1;
  var properties1;
  var formData = "status[eq]=listed";

  var propertyList = $('#Group_container');

  function fetchProperties(page) {
    $.ajax({
      url: "/api/v1/properties?page=" + page,
      type: "GET",
      data: formData,
      success: function(properties) {
        console.log(formData);
        properties1 = properties;

        // propertyList.empty();
        $('.item_container').remove();
        $.each(properties.data, function(index, property) {
          console.log(property)
          var item_container = $('<div class="item_container">');
          var item = $('<div class="item">');
          var item_container_part2 = $('<div class="item_container_part2">');
          var house_row = $('<div class="house_row">');
          var house_image = document.createElement("img");
          house_image.src = "/images/properties/" + property.id + "/1.jpg";
          // house_image.src = "/images/properties/1.jpg";
          house_image.classList.add("house_image");
          var title = $('<h3 class="title">').text(property.name)
          var desc = $('<h5 class="description">').text(property.description);
          var city = $('<h5 class="city">').text(property.province + ", " + property.city);
          var bedroom_image = document.createElement("img");
          bedroom_image.src = "/images/bedroom.png";
          bedroom_image.classList.add("bedroom_image");
          var bedroom_title = $('<div class="bedroom_title">').text("BEDROOM");
          var nb_of_bedrooms = $('<div class="nb_of_bedrooms">').text(property.bedrooms);
          var bathroom_image = document.createElement("img");
          bathroom_image.src = "/images/bathroom.png";
          bathroom_image.classList.add("bathroom_image");
          var bathroom_title = $('<div class="bathroom_title">').text("BATHROOM");;
          var nb_of_bathrooms = $('<div class="nb_of_bathrooms">').text(property.bathrooms);
          var for_Rent = $('<div class="for_Rent">').text("For Rent: ");;
          var price = $('<div class="price">').text(property.price.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD'
          }));
          var tour_button = $('<button type="submit" class="Request_a_Tour_button">').attr('id', property.id).text("Request a tour");

          var details_button = $('<button type="submit" class="details_button">').attr('id', property.id).text("View Details");

          item_container_part2.append(title);
          item_container_part2.append(desc);
          item_container_part2.append('<div class="line-1">');
          item_container_part2.append(city);
          item_container_part2.append('<div class="line-1">');
          item_container_part2.append(bedroom_image);
          item_container_part2.append(bedroom_title);
          item_container_part2.append(nb_of_bedrooms);
          item_container_part2.append(bathroom_image);
          item_container_part2.append(bathroom_title);
          item_container_part2.append(nb_of_bathrooms);
          item_container_part2.append(for_Rent);
          item_container_part2.append(price);
          item_container_part2.append(tour_button);
          item_container_part2.append(details_button);
          house_row.append(house_image);
          item.append(house_row);
          item.append(item_container_part2);

          item_container.append(item);

          propertyList.append(item_container);

          // var propertyItem = $('<li>').text(property.name);
          // propertyList.append(propertyItem);
        });
        currentPage = properties.current_page;
        var pages = $(".pagination .pages");
        pages.empty();
        var numPagesToShow = 5;
        var startPage = Math.max(currentPage - Math.floor(numPagesToShow / 2), 1);
        var endPage = Math.min(startPage + numPagesToShow - 1, properties.last_page);
        if (startPage > 1) {
          pages.append($('<li>').append($('<span>').text('...')));
        }
        for (var i = startPage; i <= endPage; i++) {
          var button = $("<button>").text(i).data("page", i);
          if (i === currentPage) {
            button.addClass("active");
          }
          pages.append($("<li>").append(button));
        }
        if (endPage < properties.last_page) {
          pages.append($('<li>').append($('<span>').text('...')));
        }
      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  $('#filterForm').submit(function(event) {
    event.preventDefault();

    // Serialize the form data to send as a query parameter
    formData = $('#filterForm').serialize();
    formData += "&status[eq]=listed";
    fetchProperties(currentPage);
    console.log(formData);
  });

  fetchProperties(currentPage);

  $(".pagination .prev").click(function() {
    if (currentPage > 1) {
      window.scrollTo(0, 0);
      currentPage--;
      fetchProperties(currentPage);   

    }
  });

  $(".pagination .next").click(function() {
    if (currentPage < properties1.last_page) {
      currentPage++;
      fetchProperties(currentPage);
      window.scrollTo(0, 0);

    }
  });

  //clicking on the number
  $(".pagination .pages").on("click", "button", function() {
    var page = $(this).data("page");
    if (page !== currentPage) {
      window.scrollTo(0, 0);

      currentPage = page;
      fetchProperties(currentPage);
    }
  });

  $(document).on('click', '.details_button', function() {
    var propertyId = $(this).attr('id');
    var url1 = "/rent/Property_details?id=" + propertyId;
    window.location.href = url1;
  });

  $(document).on('click', '.Request_a_Tour_button', function() {
    var propertyId = $(this).attr('id');
    var url1 = "/rent/request_tour?id=" + propertyId;
    window.location.href = url1;
  });
</script>
@endsection