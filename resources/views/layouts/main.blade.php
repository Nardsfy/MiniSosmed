<!-- Include Style -->
<link href="/assets/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="{{ asset('js/app.js') }}" defer></script>
<link rel="stylesheet" type="text/css" href="assets/css/home.css">
<link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- End -->

<title>Sociify</title>
<nav class="navbar navbar-expand-lg navbar-dark bg-nav">
  <a class="navbar-brand" href=" {{route('home')}} ">Sociify</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href=" {{route('home') }}">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <!-- search form 1 -->
    <div class="searchbox">
      <form class="searchbox_1" action="/cari" method="GET">
        <input type="search" class="search_1" name="cari" placeholder="Search" />
        <button type="submit" class="submit_1" value="search">&nbsp;</button>
      </form>
    </div>

    <ul class="navbar-nav nav-menu">
      <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle profile-color" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{Auth::user()->username}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href=" {{route('profile')}} ">My Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href=" {{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="main-content">
@yield('content')
</div>