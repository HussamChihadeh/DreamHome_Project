<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title")</title>

  <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
  <link rel="stylesheet" href="{{asset('css/buttons.css')}}">

  <link rel="stylesheet" href="{{asset('bootstrap_css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('bootstrap_css/bootstrap.min.css')}}">
  @yield('head')
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Luckiest Guy' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&family=Signika:wght@500;600&display=swap" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@600&family=Signika:wght@500;600&display=swap" rel="stylesheet">

  
  <style>body::-webkit-scrollbar {
  z-index: 0;
  width: 10px;
  background-color:#f8f8f8;

}

body::-webkit-scrollbar-track {
  background: transparent;
}

body::-webkit-scrollbar-thumb {
  background-image: -webkit-linear-gradient(var(--gold1), var(--gold2));
  border-radius: 20px;
  border: 3px solid #f8f8f8;
  z-index: 0;

}
body{

background-color: #e9e9e9;}</style>

  
</head>

<body>

  <!--RESPONSIVE NAV-->
  <nav class="navbar navbar-expand-lg fixed-top ">
    <div class="container">
      <a class="navbar-brand me-4" href="#">
        <img src="{{asset('images/black_image_logo.png')}}" alt="" height="40" width="30">
      </a>
      <a href="" class="logo me-4 d-none d-md-block">Dream Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main" aria-controls="main"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="main">
        <ul class="navbar-nav ms-auto mb-2 mt-1 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link p-lg-3 active" aria-current="page" href="{{ route('customers') }}">Customers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('requests') }}">Requests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('assign') }}">Assign</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('admin_furniture') }}">Furniture</a>
          </li>
          <li class="nav-item">
            <form class="nav-link p-lg-3" action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="logout_nav_button" type="submit">LOG OUT</button>
            </form>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('contact_designer') }}">Our Agents</a>
          </li> -->
          <!-- @auth
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('profile') }}">profile</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('login') }}">Sign In</a>
          </li>
          @endauth -->

        </ul>

      </div>
    </div>
  </nav>
    
  @yield("content")

</body>