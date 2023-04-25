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
                        <h2>300</h2>
                        <h6>Total Requests</h6>
                    </div>
                </div>
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2>200</h2>
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

            <div class="Table_Container">
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
       
        <script>
          

            window.onload = LoadData();
            const label = document.querySelector('.select-label');
            var Accept_Decline = document.querySelectorAll(".Accept_Decline");
            
            function LoadData() {

                const Requests_Table = document.getElementById('Requests_Table');
                const tbody = document.createElement('tbody');

                for (var i = 0; i < 9; i++) {
                    tbody.innerHTML += "<tr>" +
                        "<td>House A</td>" +
                        "<td>Rent</td>" +
                        "<td>Apartment</td>" +
                        "<td>Beirut, Lebanon</td>" +
                        "<td>200 mxm</td>" +
                        "<td>2010</td>" +
                        "<td>3</td>" +
                        "<td>3</td>" +
                        "<td>2</td>" +
                        "<td>2,000$</td>" +
                        "<td> <button class='Request_View_Details' id='View_Details_" + i + "'>Details</button></td>" +
                        "<td>" +
                        "<label class='select-label'>" +
                        "<select name='accept-decline' class='p-sm-1 p-md-1 p-lg-2 p-1 Accept_Decline' id='accept-decline_" + i + "'>" +
                        "<option value='Pending'>Pending</option>" +
                        "<option value='accept'>Accept</option>" +
                        "<option value='decline'>Decline</option>" +
                        "</select>" +
                        "</label>" +
                        "</td>" +
                        "</tr>";
                }
                Requests_Table.appendChild(tbody);

            }


            var statusSelect;
            var View_Details_Button;
            for (var i = 0; i < Accept_Decline.length; i++) {
                (function (i) {
                    Accept_Decline[i].onchange = function () {
                        // To work with the Accept and Decline 
                        statusSelect = document.getElementById("accept-decline_" + i);
                        var selectedStatus = statusSelect.value;

                        if (selectedStatus == "decline") {
                            statusSelect.style.color = "red";
                        }
                        if (selectedStatus == "accept") {
                            statusSelect.style.color = "Green";
                        }
                        if (selectedStatus == "Pending") {
                            statusSelect.style.color = "Black";
                        }
                    }
                    // To work with the View Details Button
                    View_Details_Button = document.getElementById("View_Details_" + i);
                    View_Details_Button.onclick = function () {
                        alert("Button id: " + this.id + " has been Cliked ");
                    }
                })(i);
            }






        </script>
@endsection