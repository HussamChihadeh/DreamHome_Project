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
                        <p>-This page shows this Website's Customers.
                            <br>
                            -Hover over the Properties and Designers to view More details.
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>Age</th>
                                <th>Experience</th>
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
            window.onload = LoadData(currentPage);
            const label = document.querySelector('.select-label');
            var ID_input = document.querySelectorAll(".ID_input");
            var Input;
            var View_Details_Button;
            const tbody = document.createElement('tbody');

        

            //Load Data 
            function LoadData(page) {

                const Requests_Table = document.getElementById('Requests_Table');

                $.ajax({
                    url: "/api/v1/designers?page="+page,
                    type: "GET",
                    // data: formData,
                    success: function(designers) {
                        // console.log(formData);
                        console.log(designers);
                        tbody.innerHTML = '';
                        $.each(designers.data, function(index, designer) {
                            tbody.innerHTML += "<tr>" +
                            "<td>"+designer.id+"</td>" +
                            "<td>"+designer.name+"</td>" +
                            "<td>"+designer.email+"</td>" +
                            "<td>"+designer.phone_number+"</td>" +
                            "<td>"+designer.address+"</td>" +
                            "<td>"+designer.age+"</td>" +
                            "<td>"+designer.experience+"</td></tr>"; 

                            Requests_Table.appendChild(tbody);

                            

                        })
                        $(".pagination .prev").prop('disabled', page == 1);
                        $(".pagination .next").prop('disabled', page == designers.last_page);
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
                            if (currentPage < designers.last_page) {
                                currentPage++;
                                LoadData(currentPage);
                            }
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }

                });

                // for (var i = 0; i < 9; i++) {
                //     tbody.innerHTML += "<tr>" +
                //         "<td>1</td>" +
                //         "<td>John Smith</td>" +
                //         "<td>JohnSmith@hotail.com</td>" +
                //         "<td>76038762</td>" +
                //         "<td>Beirut, Lebanon</td>" +

                //         "<td><div class='dropdown'>" +
                //         "<button class='dropbtn'>House A</button>" +
                //         "<div class='dropdown-content'>" +
                //         "<a href='#'>House A</a>" +
                //         "<a href='#'>House B</a>" +
                //         "<a href='#'>House C</a>" +
                //         "</div></td >"+
                //         "<td><div class='dropdown'>" +
                //         "<button class='dropbtn'>Eny lee</button>" +
                //         "<div class='dropdown-content'>" +
                //         "<a href='#'>Designer 1</a>" +
                //         "<a href='#'>Designer 2</a>" +
                //         "<a href='#'>Designer 3</a>" +
                //         "</div></td >"
                   
                //     ;
                // }
                // Requests_Table.appendChild(tbody);

            }

          

          

        </script>

        <script>
            const table = document.getElementById('Requests_Table');
            
            const addItemBtn = document.getElementById('add-item-btn');
            console.log(table);
            // console.log(tbodyy);
            

            // Add an event listener to the button
            addItemBtn.addEventListener('click', () => {
                // Create a new row element
                const tbodyy = table.getElementsByTagName('tbody')[0];
                const newRow = document.createElement('tr');

                // Create three new cell elements with input fields
                const blankCell = document.createElement('td');
                blankCell.innerHTML = '<p></p>';

                const nameCell = document.createElement('td');
                nameCell.innerHTML = '<input type="text" name="name" id="name">';

                const emailCell = document.createElement('td');
                emailCell.innerHTML = '<input type="email" name="email" id="email">';

                const phoneCell = document.createElement('td');
                phoneCell.innerHTML = '<input type="text" name="phone_number" id="phone_number">';

                const addressCell = document.createElement('td');
                addressCell.innerHTML = '<input type="text" name="address" id="address">';

                const ageCell = document.createElement('td');
                ageCell.innerHTML = '<input type="number" name="age" id="age">';

                const experienceCell = document.createElement('td');
                experienceCell.innerHTML = '<input type="number" name="experience" id="experience">';

                const imageCell = document.createElement('td');
                imageCell.innerHTML = `
                    <button class="choose-file-btn">Choose File</button>
                    <input type="file" name="image" accept="image/*" style="display:none;">
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
                newRow.appendChild(blankCell);
                newRow.appendChild(nameCell);
                newRow.appendChild(emailCell);
                newRow.appendChild(phoneCell);
                newRow.appendChild(addressCell);
                newRow.appendChild(ageCell);
                newRow.appendChild(experienceCell);
                // newRow.appendChild(priceCell);
                // newRow.appendChild(designerCell);
                // newRow.appendChild(quantityCell);
                newRow.appendChild(imageCell);
                newRow.appendChild(saveCell);

                fileInput.addEventListener('change', () => {
                    const fileNames = Array.from(fileInput.files).map(file => file.name).join(', ');
                    chooseFileBtn.innerHTML = fileNames || 'Choose File';
                });

                // Add the new row to the table
                console.log(newRow);
                tbodyy.insertBefore(newRow, tbody.firstChild);

                // Add an event listener to the "Save" button
                const saveBtn = newRow.querySelector('.save-btn');
                saveBtn.addEventListener('click', () => {
                    const name = newRow.querySelector('input[name="name"]').value;
                    const email = newRow.querySelector('input[name="email"]').value;
                    const phone_number = newRow.querySelector('input[name="phone_number"]').value;
                    const address = newRow.querySelector('input[name="address"]').value;
                    const age = newRow.querySelector('input[name="age"]').value;
                    const experience = newRow.querySelector('input[name="experience"]').value;
                    // const date = newRow.querySelector('input[name="date"]').value;
                    // const designer_id = newRow.querySelector('input[name="designer_id"]').value;
                    // const quantity = newRow.querySelector('input[name="quantity"]').value;
                    const formData = new FormData();
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone_number', phone_number);
                    formData.append('address', address);
                    formData.append('age', age);
                    formData.append('experience', experience);
                    // formData.append('date', date);
                    // formData.append('designer_id', designer_id);
                    // formData.append('quantity', quantity);
                    console.log(fileInput);
                    if (fileInput.files.length > 0) {
                        formData.append('image', fileInput.files[0]);
                    }
                    $.ajax({
                        url: '/api/v1/designers/storeDesigner',
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
                                <td>${email}</td>
                                <td>${phone_number}</td>
                                <td>${address}</td>
                                <td>${age}</td>
                                <td>${experience}</td>
                                // <td>${date}</td>
                                // <td>${designer_id}</td>
                                // <td>${quantity}</td>
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