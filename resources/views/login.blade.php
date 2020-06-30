<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="/assets/css/login.css" rel="stylesheet" type="text/css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<title>Sociify | social media</title>

<section class="login-block">
    <div class="container">
  <div class="row">
    <div class="col-md-4 login-sec">
        <h2 class="text-center">Sociify</h2>
        <div class="login-form">
  <div class="form-group">
    <form method="post" action="{{ route('login') }}">
      @csrf

    <label for="email" class="text-uppercase">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
    @error('email')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
    
  </div>
  <div class="form-group">
    <label for="password" class="text-uppercase">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
    @error('password')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  
  
    <div class="form-check">
      <button type="submit" class="btn btn-login">Login</button>
    </form>

    <div class="data-separator">
      <span class="data-line"> </span>
      <span class="data-line-text">atau</span>
      <span class="data-line"></span>
   </div>

    <div class="data-user">

        <a href="{{ route('signup') }}"><button type="submit" class="btn btn-register">Register
        </button></a>

    </div>

  </div>
</div>

<div class="copy-text">Created with <i class="fa fa-heart"></i> by <b><i>Kentang</i></b>.</div>
    </div>
    <div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Easy to use</h2>
        </div>  
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Enjoy with friends.</h2>
        </div>  
    </div>
    </div>
            </div>     

    </div>
  </div>
</div>
</section>