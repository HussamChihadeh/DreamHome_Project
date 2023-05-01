@extends("admin_layout")
@section("head")
<link rel="stylesheet" href="{{asset('css/Admin_Tables.css')}}">

@endsection
@section("content")

    <div style="height: 10%;"></div>
    <div class="message" id="message">
        <h2 class="h22" id="message_text"></h2>
    </div>

    <div class="row" style="height: 100%;">

        <div class="col-1">

        </div>

        <div class="col-xl-10 col-10 p-2">
            <Header>
                Assign Property
            </Header>

            <div class="row">
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2>300</h2>
                        <h6>Total Customers</h6>
                    </div>
                </div>
                <div class="col-sm-3 col-6 p-2">
                    <div class="Top_Container">
                        <h2>200</h2>
                        <h6>Currently Available Properties</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-12 p-2">
                    <div class="Top_Container Information">
                        <h4>Information</h4>
                        <p>-This page shows the Properties that are listed for Rent/Sale, and you will need to assign
                            the
                            concerned customer to each Property.
                            <br>
                            -Input is an Integer
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
                                <th>Furniture Name</th>
                                <th>Style</th>
                                <th>Material</th>
                                <th>Made in</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Designer ID</th>
                                <th>Quantity</th>
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
            // var formData="status[eq]=listed"; 
            window.onload = LoadData(currentPage);
            var currentPage=1;
            var properties1;
            // var formData="status[eq]=listed"; 
            const tbody = document.createElement('tbody');

            //Load Data 
            function LoadData(page) {

                const Requests_Table = document.getElementById('Requests_Table');

                $.ajax({
                    url: "/api/v1/furniture?page="+page,
                    type: "GET",
                    // data: formData,
                    success: function(properties) {
                        // console.log(formData);
                        console.log(properties);
                        tbody.innerHTML = '';
                        $.each(properties.data, function(index, property) {
                            const date = new Date(property.date);
                            tbody.innerHTML += "<tr>" +
                                                "<td>"+property.name+"</td>" +
                                                "<td>"+property.style+"</td>" +
                                                "<td>"+property.material+"</td>" +
                                                "<td>"+property.place+"</td>" +
                                                "<td>"+date.getFullYear()+"</td>" +
                                                "<td>"+property.price.toLocaleString('en-US', {style: 'currency', currency: 'USD'})+"</td>" +
                                                "<td>"+property.designer_id+"</td>" +
                                                "<td>"+property.quantity+"</td>" +
                                                "<td> <button class='Request_View_Details' id='View_Details_" + property.id + "'>Details</button></td>" +
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
                                                    View_Details_Button = document.getElementById("View_Details_" + property.id);
                                                    View_Details_Button.onclick = function () {
                                                        url1 = "/furniture/furniture_details?id=" + property.id;
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


                  

        </script>
@endsection