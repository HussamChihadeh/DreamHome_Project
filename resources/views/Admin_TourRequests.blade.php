@extends("admin_layout")
@section("head")
<link rel="stylesheet" href="{{asset('css/Admin_Tables.css')}}">

@endsection
@section("content")


    <div style="height: 10%;"></div>
  

    <div class="row" style="height: 100%;">

        <div class="col-1">

        </div>

        <div class="col-xl-10 col-10 p-2">
            <Header>
                Customers
            </Header>

            <div class="row">
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2 id="customers_number"></h2>
                        <h6>Total Customers</h6>
                    </div>
                </div>
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2 id="properties_number"></h2>
                        <h6>Currently Available Properties</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-12 p-2">
                    <div class="Top_Container Information">
                        <h4>Information</h4>
                        <p>-This page shows the Tour Requests.
                                                    </p>
                    </div>
                </div>
            </div>

            <div class="Table_Container">
            <div class="Group_container " id="Group_container">
                    <div class="pagination d-flex justify-content-between">
                        <button class="prev">&lt;</button>
                        <button class="next">&gt;</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" style="font-size: 0.9vw; text-align: center;" id="Requests_Table">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Property ID</th>
                                <th>Property Name</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-1">

        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
              var currentPage = 1;

            window.onload = LoadData(currentPage);
            window.onload = LoadStatistics();
            const label = document.querySelector('.select-label');
            var ID_input = document.querySelectorAll(".ID_input");
            var Input;
            var View_Details_Button;

            function LoadStatistics() {
                var customers_number = document.getElementById("customers_number");
                var properties_number = document.getElementById("properties_number");
                $.ajax({
                    url: "/api/v1/properties/getPropertiesCount",
                    type: "GET",
                    success: function(response) {
                        properties_number.innerHTML=response.count;
                    },
                    error: function(error){
                        console.log(error);
                    }
                });

                $.ajax({
                    url: "/api/v1/users/getCustomersCount",
                    type: "GET",
                    success: function(response) {
                        customers_number.innerHTML=response.count;
                    },
                    error: function(error){
                        console.log(error);
                    }
                });

            }
        

            const tbody = document.createElement('tbody');
            //Load Data 
            function LoadData(page) {
                const Requests_Table = document.getElementById('Requests_Table');
                

                $.ajax({
                    url: "/api/v1/property/tourRequests?page=" + page,
                    type: "GET",
                    success: function(tours) {
                        tbody.innerHTML = '';
                        $.each(tours.data, function(index, tour) {
                            console.log(tour);
                            tbody.innerHTML += "<tr>" +
                        // "<td>"+tour.id+"</td>" +
                        "<td>"+tour.user_id+"</td>" +
                        "<td>"+tour.user.name+"</td>" +
                        "<td>"+tour.property_id+"</td>" +
                        "<td>"+tour.property.name+"</td>" +
                        "<td>"+tour.tour_date+"</td>" +
                        "<td>"+tour.tour_time+"</td></tr>" ;

                        // "<td><div class='dropdown'>" +
                        // "<button class='dropbtn'>House A</button>" +
                        // "<div class='dropdown-content'>" +
                        // "<a href='#'>House A</a>" +
                        // "<a href='#'>House B</a>" +
                        // "<a href='#'>House C</a>" +
                        // "</div></td >"+
                        // "<td><div class='dropdown'>" +
                        // "<button class='dropbtn'>Eny lee</button>" +
                        // "<div class='dropdown-content'>" +
                        // "<a href='#'>Designer 1</a>" +
                        // "<a href='#'>Designer 2</a>" +
                        // "<a href='#'>Designer 3</a>" +
                        // "</div></td >";

                        Requests_Table.appendChild(tbody);
                        $(".pagination .prev").prop('disabled', page == 1);
                                                $(".pagination .next").prop('disabled', page == tours.last_page);
                                                $(".pagination .prev").off();
                                                $(".pagination .next").off();

                                                // Bind event handlers
                                                $(".pagination .prev").click(function () {
                                                    if (currentPage > 1) {
                                                        currentPage--;
                                                        LoadData(currentPage);
                                                    }
                                                });

                                                $(".pagination .next").click(function () {
                                                    if (currentPage < tours.last_page) {
                                                        currentPage++;
                                                        LoadData(currentPage);
                                                    }
                                                });

                        });
                    },
                    error: function(error){
                        console.log(error)
                    }

                });

            }

          

          

        </script>
@endsection