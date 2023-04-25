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
                <div class="table-responsive">
                    <table class="table" style="font-size: 0.9vw; text-align: center;" id="Requests_Table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>

                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>Properties</th>
                                <th>Designers</th>



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
            var ID_input = document.querySelectorAll(".ID_input");
            var Input;
            var View_Details_Button;
        

            //Load Data 
            function LoadData() {

                const Requests_Table = document.getElementById('Requests_Table');
                const tbody = document.createElement('tbody');

                for (var i = 0; i < 9; i++) {
                    tbody.innerHTML += "<tr>" +
                        "<td>1</td>" +
                        "<td>John Smith</td>" +
                        "<td>JohnSmith@hotail.com</td>" +
                        "<td>76038762</td>" +
                        "<td>Beirut, Lebanon</td>" +

                        "<td><div class='dropdown'>" +
                        "<button class='dropbtn'>House A</button>" +
                        "<div class='dropdown-content'>" +
                        "<a href='#'>House A</a>" +
                        "<a href='#'>House B</a>" +
                        "<a href='#'>House C</a>" +
                        "</div></td >"+
                        "<td><div class='dropdown'>" +
                        "<button class='dropbtn'>Eny lee</button>" +
                        "<div class='dropdown-content'>" +
                        "<a href='#'>Designer 1</a>" +
                        "<a href='#'>Designer 2</a>" +
                        "<a href='#'>Designer 3</a>" +
                        "</div></td >"
                   
                    ;
                }
                Requests_Table.appendChild(tbody);

            }

          

          

        </script>
@endsection