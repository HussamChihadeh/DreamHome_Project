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
                Property Requests
            </Header>
            <div class="row">
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2 id="customers_number"></h2>
                        <h6>Total Requests</h6>
                    </div>
                </div>
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2 id="properties_number"></h2>
                        <h6>Total Accepted</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-12 p-2">
                    <div class="Top_Container Information">
                        <h4>Information</h4>
                        <p>Please select the appropriate option: 'Pending' means the request is under review, 'Accept'
                            means the request is approved, and 'Decline' means the request is denied.</p>
                    </div>
                </div>
            </div>

            <div class="Table_Container ">
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
                                <th>House Name</th>
                                <th>Rent/Sell</th>
                                <th>Property Type</th>
                                <th>Location</th>
                                <th>House Size</th>
                                <th>Date Completed</th>
                                <th>Bedroom</th>
                                <th>Bathroom</th>
                                <th>Parking Lot</th>
                                <th>Price</th>
                                <th>User ID</th>
                                <th>Save</th>
                                <th>Request</th>


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
          
            var currentPage=1;
            var properties1;
            var formData="status[eq]=pending"; 
            // window.onload = LoadData(currentPage);
            const tbody = document.createElement('tbody');
            window.onload = LoadStatistics();
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

            function LoadData(page) {

                const Requests_Table = document.getElementById('Requests_Table');
                

                $.ajax({
                    url: "/api/v1/properties?page="+page,
                    type: "GET",
                    data: formData,
                    success: function(properties) {
                        console.log(formData);
                        console.log(properties);
                        tbody.innerHTML = '';
                        $.each(properties.data, function(index, property) {
                            tbody.innerHTML += "<tr>" +
                                                "<td>"+property.name+"</td>" +
                                                "<td>"+property.buy_or_rent+"</td>" +
                                                "<td>"+property.type+"</td>" +
                                                "<td>"+property.province+"</td>" +
                                                "<td>"+property.area+" m&#178;</td>" +
                                                "<td>"+property.built_in+"</td>" +
                                                "<td>"+property.bedrooms+"</td>" +
                                                "<td>"+property.bathrooms+"</td>" +
                                                "<td>"+property.parking+"</td>" +
                                                "<td>"+property.price.toLocaleString('en-US', {style: 'currency', currency: 'USD'})+"</td>" +
                                                "<td>"+property.user_id+"</td>" +
                                                "<td> <button class='Request_View_Details' id='View_Details_" + property.id + "'>Details</button></td>" +
                                                "<td>" +
                                                "<label class='select-label'>" +
                                                "<select name='accept-decline' class='p-sm-1 p-md-1 p-lg-2 p-1 Accept_Decline' id='accept-decline_" + property.id + "'>" +
                                                "<option value='Pending'>Pending</option>" +
                                                "<option value='accept'>Accept</option>" +
                                                "<option value='decline'>Decline</option>" +
                                                "</select>" +
                                                "</label>" +
                                                "</td>" +
                                                "</tr>";
                                                Requests_Table.appendChild(tbody);
                                                $(".pagination .prev").prop('disabled', page == 1);
                                                $(".pagination .next").prop('disabled', page == properties.last_page);
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
                                                    if (currentPage < properties.last_page) {
                                                        currentPage++;
                                                        LoadData(currentPage);
                                                    }
                                                });
                                                $(document).ready(function() {
                                                    

                                                //coloring the choice
                                                var statusSelect = document.getElementById("accept-decline_" + property.id);
                                                statusSelect.onchange = function () {
                                                    var selectedStatus = statusSelect.value;
                                                    var databaseStatus;
                                                    if (selectedStatus == "decline") {
                                                            statusSelect.style.color = "red";
                                                            databaseStatus= "rejected";
                                                        }
                                                        if (selectedStatus == "accept") {
                                                            statusSelect.style.color = "Green";
                                                            databaseStatus= "listed";
                                                        }
                                                        if (selectedStatus == "Pending") {
                                                            statusSelect.style.color = "Black";
                                                            databaseStatus= "pending";
                                                        }

                                                        updateStatus(property.id, databaseStatus);
                                                }

                                                View_Details_Button = document.getElementById("View_Details_" + property.id);
                                                    View_Details_Button.onclick = function () {
                                                        url1 = "/rent/Property_details?id=" + property.id;
                                                        window.location.href = url1;
                                                }
                                            });
                                                
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            }
            LoadData(currentPage);
           
            function updateStatus(propertyId, status){
                $.ajax({
                    url: '/api/v1/properties/' + propertyId,
                    type: 'PUT',
                    data: {
                    'accept-decline': status,
                    _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                    // console.log(response);
                        console.log("succ");
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        </script>
@endsection