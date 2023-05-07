@php
    use Illuminate\Support\Str;
@endphp

@extends(auth()->check() && Str::endsWith(auth()->user()->email, '@Designer.org') ? "Designer_Layout" : "layout")

@section("title", "Chat")

@section("head")
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<!-- didnt work -->
<!-- <link rel="icon" href="{{ asset('images/image_logo.png') }}"> -->

@endsection

@section("content")
<div style="height: 10%;"></div>

@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header" style="margin-bottom:0">
            <nav >
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Chat</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            <!-- {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div> --}} -->
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container" style="margin-top:-50;">
            {{-- Lists [Users/Group] --}}
            {{-- ---------------- [ User Tab ] ---------------- --}}
            <div class="show messenger-tab users-tab app-scroll" data-view="users">
                {{-- Favorites --}}
                <div class="favorites-section">
                    <p class="messenger-title"><span>My Designers</span></p>
                    <div class="messenger-favorites app-scroll-hidden"></div>
                </div>
                {{-- Saved Messages --}}

            </div>
            {{-- ---------------- [ Search Tab ] ---------------- --}}
            <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}

    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging shadow_m_header">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el" id="Message_Hint"><span>Please select a chat to start messaging</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <p class="m-header">User Details</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Get the value of the 'House_id' parameter
    const houseId = urlParams.get('property_id');

    // Split the URL path to separate the two values
    const urlParts = window.location.pathname.split('/');

    // Extract the values
    const id = urlParts[urlParts.length - 1];
    const value = houseId;

    // alert('Designer_id: ' + id); // Output: id: 21
    // alert('House_id: ' + value); // Output: House_id: 3
    var Message_Hint = document.getElementById("Message_Hint");

    setTimeout(function() {
        var textarea_111 = document.getElementById("textarea_111");
        var message_form=document.getElementById("message-form");
        textarea_111.value = "Please Enter the below link to View the Property's Information.\nLocalhost:8000/rent/Property_details?id="+value;
        
    }, 5000);


    // const observerOptions = {
    //     attributes: true,
    //     attributeFilter: ['style'],
    //     childList: false,
    //     subtree: false
    // };

    // const observerCallback = function(mutationsList, observer) {
    //     for (let mutation of mutationsList) {
    //         if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
    //             const isHidden = mutation.target.style.display === 'none';
    //             if (isHidden) {
    //                 // call your function here
    //                 console.log('p element is hidden');
    //             }
    //         }
    //     }
    // };

    // const observer = new MutationObserver(observerCallback);
    // observer.observe(Message_Hint, observerOptions);






    // <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
</script>