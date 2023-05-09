@extends("admin_layout")
@section("head")
<link rel="stylesheet" href="{{asset('css/Admin_Tables.css')}}">
<style>
    .error-id{
        font-size: 12px;
        margin-bottom: 0px;
        padding-bottom: 0px;
        /* word-spacing: 0.01em !important; */
    }
</style>

<link rel="stylesheet" href="{{asset('css/buttons.css')}}">

@section("title", "Assign")

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
                        <p>-This page shows the Properties that are listed for Rent/Sale, and you will need to assign
                            the
                            concerned customer to each Property.
                            <br>
                            -Input is an Integer
                            <br>
                            -Click on the property's row to see its details
                        </p>
                    </div>
                </div>
            </div>

            <div class="Table_Container">
            <div class="Group_container " id="Group_container">
                    <div class="pagination d-flex justify-content-between">
                        <button class="prev">&lt;</button>
                        <button id="add-item-btn" class="Add_Item_Button">add item</button>

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
                                <th>Seller ID</th>
                                <th>Customer ID</th>
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
            var formData="status[eq]=listed"; 
            window.onload = LoadData(currentPage);
            window.onload = LoadStatistics();
            const label = document.querySelector('.select-label');
            var ID_input = document.querySelectorAll(".ID_input");
            var Input;
            var View_Details_Button;
            var message = document.getElementById("message");
            var message_text = document.getElementById("message_text");

            var currentPage=1;
            var properties1;
            var formData="status[eq]=listed"; 
            const tbody = document.createElement('tbody');

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

            //Load Data 
            function LoadData(page) {

                const Requests_Table = document.getElementById('Requests_Table');

                $.ajax({
                    url: "/api/v1/properties?page="+page,
                    type: "GET",
                    data: formData,
                    success: function(properties) {
                        
                        tbody.innerHTML = '';
                        $.each(properties.data, function(index, property) {
                            var seller = property.user_id == "1000" ? "Dream Home" : property.user_id;
                            tbody.innerHTML += "<tr id='"+ property.id +"'>" +
                                                "<td>"+property.name+"</td>" +
                                                "<td>"+property.buy_or_rent+"</td>" +
                                                "<td>"+property.type+"</td>" +
                                                "<td>"+property.province+"</td>" +
                                                "<td>"+property.area+" mxm</td>" +
                                                "<td>"+property.built_in+"</td>" +
                                                "<td>"+property.bedrooms+"</td>" +
                                                "<td>"+property.bathrooms+"</td>" +
                                                "<td>"+property.parking+"</td>" +
                                                "<td>"+property.price.toLocaleString('en-US', {style: 'currency', currency: 'USD'})+"</td>" +
                                                "<td>"+seller+"</td>" +
                                                "<td>" +
                                                "<input class='p-1 ID_input' type='Number'  id='input_" + property.id  + "'></input>" +
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
                        });
                        //view details
                        const trs = document.querySelectorAll('tbody tr');
                        trs.forEach(tr => {
                        tr.addEventListener('click', () => {
                            // Extract the id from the clicked tr
                            if (event.target.tagName.toLowerCase() === 'input') {
                                return; // Do nothing and return from the function
                            }

                            const id = tr.getAttribute('id');
                            console.log(id); // Log the id to the console
                            window.location.href = "rent/Property_details?id=" + id;
                        });
                        });

                        //assign
                        const inputs = document.querySelectorAll('.ID_input');
                        inputs.forEach(function(input) {
                            input.addEventListener("keyup", function(event) {
                            if (event.key === "Enter") {
                                const inputId = event.target.id;
                                const userId = event.target.value;
                                const propertyId = inputId.substr(6) ;
                                // console.log(propertyId);
                                // console.log(userId);
                                assign(propertyId, userId, event.target);
                                
                            }
                            });
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                
            }

            

            const addItemBtn = document.getElementById('add-item-btn');

            addItemBtn.addEventListener('click', () => {
                window.location.href = "/sell";
            });

            function assign(propertyId, userId, target){
                $.ajax({
                    url: '/api/v1/properties/assign/' + propertyId,
                    type: 'PUT',
                    data: {
                    'buyer_id': userId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                    // console.log(response);
                        const textNode = document.createTextNode(userId);
                        target.parentNode.replaceChild(textNode, target);
                    },
                    error: function(jqXHR, xhr, status, error) {
                        var errorMessage = xhr.responseText;
                        if (jqXHR.status === 400) {
                            // Bad request error
                            console.log(jqXHR.responseText);
                            // Show_Message(userId);
                            const errorIdNode = target.nextSibling;
                            if (errorIdNode && errorIdNode.classList.contains('error-id')) {
                                // If an error message already exists, remove it
                                target.parentNode.removeChild(errorIdNode);
                            }
                            const errorNode = document.createElement('p');
                            errorNode.classList.add('error-message');
                            errorNode.classList.add('error-id');
                            errorNode.innerHTML = 'Invalid ID';
                            target.parentNode.insertBefore(errorNode, target.nextSibling);

                        }
                    }
                });
            }

            

            

        </script>
@endsection