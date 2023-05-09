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
                <button id="add-item-btn">add item</button>
                <div class="table-responsive">
                    <table class="table" style="font-size: 0.9vw; text-align: center;" id="Requests_Table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Style</th>
                                <th>Type</th>
                                <th>Description</th>
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
            window.onload = LoadStatistics();
            var currentPage=1;
            var properties1;
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
                                                "<td>"+property.type+"</td>" +
                                                "<td>"+property.description+"</td>" +
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
            
        <script>
            const table = document.getElementById('Requests_Table');
            const tbodyyy = table.getElementsByTagName('tbody')[0];

            const addItemBtn = document.getElementById('add-item-btn');
            console.log(table);
            // console.log(tbodyy);
            
            if (!tbodyyy) {
                const newTbody = document.createElement('tbody');
                table.appendChild(newTbody);
                console.log("hello")
            }
            // Add an event listener to the button
            addItemBtn.addEventListener('click', () => {
                // Create a new row element
                const tbodyy = table.getElementsByTagName('tbody')[0];
                const newRow = document.createElement('tr');

                // Create three new cell elements with input fields
                const nameCell = document.createElement('td');
                nameCell.innerHTML = '<input type="text" name="name" id="name">';

                const styleCell = document.createElement('td');
                styleCell.innerHTML = '<input type="text" name="style" id="style">';

                const typeCell = document.createElement('td');
                typeCell.innerHTML = '<input type="text" name="type" id="type">';

                const descCell = document.createElement('td');
                descCell.innerHTML = '<input type="text" name="description" id="description">';

                const materialCell = document.createElement('td');
                materialCell.innerHTML = '<input type="text" name="material" id="material">';

                const placeCell = document.createElement('td');
                placeCell.innerHTML = '<input type="text" name="place" id="place">';

                const yearCell = document.createElement('td');
                yearCell.innerHTML = '<input type="number" name="date" id="date">';

                const priceCell = document.createElement('td');
                priceCell.innerHTML = '<input type="number" name="price" id="price">';

                const designerCell = document.createElement('td');
                designerCell.innerHTML = '<input type="number" name="designer_id" id="designer_id">';

                const quantityCell = document.createElement('td');
                quantityCell.innerHTML = '<input type="number" name="quantity" id="quantity">';

                const imageCell = document.createElement('td');
                imageCell.innerHTML = `
                    <button class="choose-file-btn">Choose File(s)</button>
                    <input type="file" name="images[]" multiple style="display:none;">
                `;

                const chooseFileBtn = imageCell.querySelector('.choose-file-btn');
                const fileInput = imageCell.querySelector('input[type="file"]');
                chooseFileBtn.addEventListener('click', () => {
                    fileInput.click();
                });


                // Create a new cell element with a "Save" button
                const saveCell = document.createElement('td');
                saveCell.innerHTML = '<button class="save-btn">Save</button>';

                // Add the new cell elements to the new row
                newRow.appendChild(nameCell);
                newRow.appendChild(styleCell);
                newRow.appendChild(typeCell);
                newRow.appendChild(descCell);
                newRow.appendChild(materialCell);
                newRow.appendChild(placeCell);
                newRow.appendChild(yearCell);
                newRow.appendChild(priceCell);
                newRow.appendChild(designerCell);
                newRow.appendChild(quantityCell);
                newRow.appendChild(imageCell);
                newRow.appendChild(saveCell);

                fileInput.addEventListener('change', () => {
                    const fileNames = Array.from(fileInput.files).map(file => file.name).join(', ');
                    chooseFileBtn.innerHTML = fileNames || 'Choose File(s)';
                });

                // Add the new row to the table
                console.log(newRow);
                if (tbodyy.firstChild) {
                    tbodyy.insertBefore(newRow, tbodyy.firstChild);
                } else {
                    tbodyy.appendChild(newRow);
                }

                // Add an event listener to the "Save" button
                const saveBtn = newRow.querySelector('.save-btn');
                saveBtn.addEventListener('click', () => {
                    const name = newRow.querySelector('input[name="name"]').value;
                    const style = newRow.querySelector('input[name="style"]').value;
                    const type = newRow.querySelector('input[name="type"]').value;
                    const description = newRow.querySelector('input[name="description"]').value;
                    const price = newRow.querySelector('input[name="price"]').value;
                    const material = newRow.querySelector('input[name="material"]').value;
                    const place = newRow.querySelector('input[name="place"]').value;
                    const date = newRow.querySelector('input[name="date"]').value;
                    const designer_id = newRow.querySelector('input[name="designer_id"]').value;
                    const quantity = newRow.querySelector('input[name="quantity"]').value;
                    const formData = new FormData();
                    formData.append('name', name);
                    formData.append('style', style);
                    formData.append('type', type);
                    formData.append('description', description);
                    formData.append('price', price);
                    formData.append('material', material);
                    formData.append('place', place);
                    formData.append('date', date);
                    formData.append('designer_id', designer_id);
                    formData.append('quantity', quantity);
                    console.log(fileInput);
                    Array.from(fileInput.files).forEach(file => {
                        formData.append('images[]', file);
                    });
                    $.ajax({
                        url: '/api/v1/furniture/storeItem',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Handle the success response here
                            console.log(response);
                            const newRow = document.createElement('tr');
    
    // Set the inner HTML of the new row to the entered data
                            newRow.innerHTML = `
                                <td>${name}</td>
                                <td>${style}</td>
                                <td>${type}</td>
                                <td>${description}</td>
                                <td>${price}</td>
                                <td>${material}</td>
                                <td>${place}</td>
                                <td>${date}</td>
                                <td>${designer_id}</td>
                                <td>${quantity}</td>
                            `;
                            
                            // Replace the row of inputs with the new row
                            newRow.id = 'row-' + response.id;
                            newRow.classList.add('furniture-row');
                            saveBtn.parentElement.parentElement.replaceWith(newRow);
                        },
                        error: function(xhr) {
                            $('.error-message').remove();
                            $('.is-invalid').removeClass('is-invalid');
                            // Handle the error response here
                            console.log(xhr.responseText);

                            var errors = xhr.responseJSON || {};
                            if (typeof errors === 'string') {
                                errors = JSON.parse(errors);
                            }
                            console.log(errors);
                            $.each(errors.errors, function(field, messages) {
                                console.log(field);
                                
                            var input = $('#' + field);
                            console.log(input);
                            var container = input.parent();
                            console.log(container);
                            input.addClass('is-invalid');
                            if (typeof errors.errors === 'object' && Object.keys(errors.errors).length > 0 && Array.isArray(messages) && messages.length > 0) {
                                $.each(messages, function(index, message) {
                                    $('<span>').addClass('error-message').html(message + "<br>").appendTo(container);
                                });
                            }else{
                                console.log(messages);
                                $('<span>').addClass('error-message').html(messages + "<br>").appendTo(container);
                                // alert(message);
                            }
                            });
                            
                        }
                    });
                });
            });
        </script>
@endsection