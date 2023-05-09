<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title")</title>

  <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
  <link rel="stylesheet" href="{{asset('css/footer.css')}}">
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
            <a class="nav-link p-lg-3" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
     

          <li class="nav-item  p-lg-2 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Properties
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('rent') }}">Buy\Rent</a></li>
            <li><a class="dropdown-item" href="/sell">Sell</a></li>

          </ul>
        </li>




          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('furniture') }}">Furniture</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('contact_designer') }}">Our designers</a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('profile') }}">profile</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link p-lg-3" href="{{ route('login') }}">Sign In</a>
          </li>
          @endauth

        </ul>

      </div>
    </div>
  </nav>
    
  @yield("content")

  <div class="footer pt-5 pb-5 text-white-50 text-center text-md-start">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="info mb-5">
                        <img src="{{asset('images/white_image_logo.png')}}" alt="" class="mb-4 img-fluid" height="40" width="30">
                        <p class="mb-5">Easiest Way to find your dream place</p>
                        <div class="copyright">
                            Created By <span>XXXX</span>
                            <div>&copy; 2023 - <span>Capstone Project</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="links">
                        <h5 class="text-light">Links</h5>
                        <ul class="list-unstyled lh-lg">
                            <li>Home</li>
                            <li>Rent</li>
                            <li>Buy</li>
                            <li>Furniture</li>
                            <li>Our Agents</li>
                            <li>Sign In</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="links">
                        <h5 class="text-light">Links</h5>
                        <ul class="list-unstyled lh-lg">
                            <li>Home</li>
                            <li>Rent</li>
                            <li>Buy</li>
                            <li>Furniture</li>
                            <li>Our Agents</li>
                            <li>Sign In</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contactUs">
                        <h5 class="text-light">Contact Us</h5>
                        <p class="lh-lg mt-3 mb-5">Get in touch with Us</p>
                        <a href="mailto:dreamhome@gmail.com" class="btn rounded-pill text-light">dreamhome@gmail.com</a>
                        <ul class="d-flex mt-5 list-unstyled gap-3">
                            <li>
                                <a href="https://www.facebook.com" class="d-block text-light">
                                    <i class="fa-brands fa-facebook fa-lg facebook p-2"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com" class="d-block text-light">
                                    <i class="fa-brands fa-instagram fa-lg instagram rounded-circle p-2"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com" class="d-block text-light">
                                    <i class="fa-brands fa-twitter fa-lg twitter rounded-circle p-2"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('bootstrap_js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('bootstrap_js/all.min.js')}}"></script>
    @yield("script")

   </body>
</html>