@extends("Designer_Layout")
@section("title", "My Profile")

@section("head")
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/Designers.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">
<link rel="stylesheet" href="{{asset('css/main.css')}}">

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&family=Signika:wght@500;600&display=swap"
    rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Sentic+Display&display=swap" rel="stylesheet">

<style>

</style>
@endsection

@section("content")


<div style="height: 10%;"></div>
<div class="row" style="height: 100%;">

    <div class="col-xl-6 offset-1 col-10 p-4 pb-0">
        <div class="d-flex justify-content-between align-items-center">
            <Header>My Profile</Header>
        </div>
        <!-- Main Info Column -->

    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <div class='col-md-6 offset-md-3 col-8 offset-2 p-0 pt-0'>
        <div class='Designer_Container' style='height:fit-content;' id='Container_' +designer.id>
            <div class='row'>
                <div class='col-sm-5 col-5'><img src='IMAGES/Designers/{{ auth()->user()->id }}.png' class='ID_Image'>

                </div>
                <div class='col-sm-7 col-7'>
                    <div class='Info1'
                        style="height: fit-content;width:91.5%;margin-left:4%;margin-bottom:0;margin-top:4%">
                        <h6> Name: {{ auth()->user()->name }}</h6>
                        <h6>Age: {{ $designer->age}}</h6>
                        <h6>Location: {{ auth()->user()->address }}</h6>


                    </div>
                    <div class='Info1'
                        style="height: fit-content;width:91.5%;margin-left:4%;margin-bottom:0;margin-top:5%">
                        <h6>Experience: {{ $designer->experience}} years</h6>

                        <h6> LinkedIn: {{ $designer->linkedin}}</h6>
                    </div>

                </div>
                <div class='col-sm-7 col-7'>

                </div>
                <div class='row p-0'>
                    <div class='col-sm-12 col-12'>
                        <div class='Info3'
                            style="opacity:1; height: fit-content;width:95%;margin-left:4%;margin-bottom:0;margin-top:2%">
                            <h6> Email: {{ auth()->user()->email }}</h6>
                            <h6>Phone Number: {{ auth()->user()->phone_number }}</h6>
                        </div>
                        <div class='Info3'
                            style="opacity:1; height: fit-content;width:95%;margin-left:4%;margin-bottom:0;margin-top:3%">


                            <h6> Bio: {{ $designer->bio}}</h6>
                        </div>
                    </div>
                </div>
                <div class='row pt-2 p-3' style="margin-bottom:-30">
                    <div class='col-sm-6 col-6'>

                    </div>


                </div>

            </div>


        </div>

    </div>
    <div class="col-xl-6  offset-1 col-10 p-4 pb-0">
        <div class="d-flex justify-content-between align-items-center">
            <Header>My Designs</Header>
        </div>

    </div>


    <div class='col-md-6 offset-md-3 col-8 offset-2 p-3 pt-0'>
        <div class="row">
            <div class="col-md-12 flex p-0">
                <div class="grid_container" id="Furniture_Grid">
                   
                @foreach ($furniture as $furn)
                    <div class="grid_item">
                        <img src="{{asset('images/furniture/'.$furn->id .'/1.png')}}" class="Furniture_Image">
                        <h6 class="p-2">Name: {{ $furn->name}}</h6>
                        <h6 class="p-2">Price: ${{ number_format($furn->price, 0) }}</h6>

                    </div>


                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<div>

@foreach ($users as $user)
<h6> {{ $user->name}}</h6>
@endforeach
</div>


@endsection
@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection