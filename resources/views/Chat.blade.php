@extends("layout")
@section("title", "Chat")

@section("head")
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/chat.css')}}">
<link rel="stylesheet" href="{{asset('css/contact_designer.css')}}">
@endsection

@section("content")
<div style="height: 12%;"></div>
<div class="row">

    <div class="col-10 offset-1" style="background-color: white;border-radius: 20px; height: fit-content; padding-left: 20;padding-right: 20;padding-top: 0; margin-bottom:30px;">
        <div class="row">
            <div class="col-xl-3 col-md-5 col-12" style="border-right: 1.7px solid #e9e9e98e;">
                <div class="List_Container" id="My_Designers_Information">
                    <Header_1>All Messages</Header_1>
                </div>
            </div>
            <div class="col-xl-5 col-md-7 col-12">
                <div class="Chat_Container">
                    <div class="Chat_Header">
                        <img id="Contact_Image_In_Header" src="images\Designers\Original_Photos\5.jpg" class='Circular_Image_1' />
                        <h6 id="Contact_Name_In_Header">Enn Lee</h6>
                    </div>
                    <div class="Chat" id="Chat">
                        <div class="Message_Recv">Hello hdhhd dhdhdh dhdhdhd dhdhdhd dhdhd dhdhdh hdhdh dhdh dhdhdh
                            hdhdhd dhdhdhd dhdh dhdhd hdhd hdhdhd dhdhd dhdhd dhdh </div>
                        <div class="Message_Send">Hello</div>
                        <div class="Message_Send">Hello</div>
                        <div class="Message_Recv">Hello</div>
                        <div class="Message_Recv">Hello</div>
                        <div class="Message_Send">Hello hdhhd dhdhdh dhdhdhd dhdhdhd dhdhd dhdhdh hdhdh dhdh dhdhdh
                            hdhdhd dhdhdhd dhdh dhdhd hdhd hdhdhd dhdhd dhdhd dhdh </div>

                    </div>
                    <div class="Message_Input">
                        <div id="myForm">
                            <input type="text" autocomplete="off" id="Input" name="inputField" required>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-4 d-none d-xl-block">
                <div class="Contact_Info_Container">
                    <Header_1 class="p-3">General Info</Header_1>

                    <div class='col-12 p-3'>
                        <div class='Designer_Container Radius'>
                            <div class='row'>
                                <div class='col-sm-5 col-5'><img src='images\Designers\5.png' class='ID_Image Radius_right'>

                                </div>
                                <div class='col-sm-7 col-7 '>
                                    <div class='Info1 Edits'>
                                        <h6>Lee Parker</h6>
                                        <h6>Age: 28</h6>
                                        <h6>Location: Beirut</h6>

                                    </div>
                                    <div class='Info2 Edits'>
                                        <h6>Experience: 8 </h6>
                                        <img src='IMAGES\\filled_star.png' width='15' height='15'>
                                        <img src='IMAGES\\filled_star.png' width='15' height='15'>
                                        <img src='IMAGES\\filled_star.png' width='15' height='15'>
                                        <img src='IMAGES\\filled_star.png' width='15' height='15'>
                                        <img src='IMAGES\\unfilled_star.png' width='15' height='15'>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        var My_Designers_Information = document.getElementById("My_Designers_Information");
        var Contact_row;
        var Contact_Name_In_Header = document.getElementById("Contact_Name_In_Header");
        var Contact_Image_In_Header = document.getElementById("Contact_Image_In_Header");


        for (var i = 1; i < 5; i++) {
            if (i == 1) {
                var newDesignerHtml = "<div class='row Row_Contact_Container activee' id='Name_'" + i + ">" +
                    "<div class='col-sm-3 col-3'><img src='images\\Designers\\Original_Photos\\5.jpg' class='Circular_Image'>" +
                    "</div>" +
                    "<div class='col-sm-9 col-9'>" +
                    "<div class='Info_in_row p-md-1'>" +
                    "<h7>Eny Lee </h7>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
            } else {
                var newDesignerHtml = "<div class='row Row_Contact_Container' id='Name_'" + i + ">" +
                    "<div class='col-sm-3 col-3'><img src='images\\Designers\\Original_Photos\\5.jpg' class='Circular_Image'>" +
                    "</div>" +
                    "<div class='col-sm-9 col-9'>" +
                    "<div class='Info_in_row  p-md-1 '>" +
                    "<h7>Johnny Floyd </h7>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
            }
            My_Designers_Information.innerHTML += newDesignerHtml;

        }
        const rows = document.querySelectorAll('.Row_Contact_Container');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                rows.forEach(row => {
                    row.classList.remove('activee');
                });
                row.classList.add('activee');
                // To CHANGE THE IMAGE AND THE NAME IN THE CHAT ON CLICK
                Contact_Image_In_Header.src = "images\\Designers\\Original_Photos\\5.jpg";
                Contact_Name_In_Header.innerHTML = "Johnny Floyd";
            });
        });


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////



        class Message {
            constructor(text, type) {
                // type = 0 for sent, 1 for received
                this.text = text;
                this.type = type;
            }
        }

        const chat = document.getElementById("Chat");

        function Send_Recv_Message(text, type) {
            const msg = new Message(text, type);

            if (msg.type === 0) {
                chat.innerHTML += "<div class='Message_Send'>" + msg.text + "</div>";
            } else {
                chat.innerHTML += "<div class='Message_Recv'>" + msg.text + "</div>";
            }
        }

        const form = document.getElementById("myForm");
        const input = document.getElementById("Input");
        input.addEventListener("input", function(event) {
            const text = input.value.trim();
            if (text) {
                localStorage.clear();
            }
        });

        input.addEventListener("keyup", function(event) {
            localStorage.clear();

            if (event.key === "Enter") {
                event.preventDefault();
                const text = input.value.trim(); // get input value and remove whitespace
                if (text) {
                    Send_Recv_Message(text, 0);
                    input.value = ""; // clear input field
                }

                // scroll to bottom of chat
                chat.scrollTop = chat.scrollHeight;
            }
        });


        // input.addEventListener("keyup", function (event) {
        //     if (event.key === "Enter") {
        //         event.preventDefault(); // prevent form from submitting
        //         //form.submit(); // submit the form
        //         //Send_Recv_Message(input., "1");
        //     }
        // });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajax({
            url: "/api/v1/chat",
            type: "GET",
            success: function(chat) {
                // console.log(designers);
                $.each(chat, function(index, chat) {
                    console.log(chat);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    </script>

    @endsection