<!-- Include Style -->
<link href="/assets/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="{{ asset('js/app.js') }}" defer></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/users.css')}}">
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

<!-- END OF NAVBAR -->

{{$hsl=false}}
<?php  $idlikes=0; ?>

<div class="main-content">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header status-header all-content">
                  <img src="{{asset('/imgProfile/'.$pp)}}" class="pp" alt="Profile">
                    <div class="data-control">
                      @if($f)
                      @foreach($fr as $fs)
                        <a href="/deletefriend/{{$fs->id_friends}}"><button class="btn btn-primary btn-control">Unfollow</button></a>
                        @break
                        @endforeach
                        @else
                        <form method="POST" action="/addfriend/{{$id}}">
                            @csrf
                        <button type="submit" class="btn btn-primary btn-control">Follow</button>
                        </form>
                        @endif
                        <div class="users-name"><b> {{$cek}} </b></div>    
                    </div>
                </div>
                <div class="card-body">
                  <div class="col-12">
                  @foreach ($st as $s) 
                    <div class="user-timeline">
                        <div class="tgl-stat">
                            {{$s->tgl}}
                        </div>
                        <div class="timeline">
                            {{ $s->status }}
                        </div>

                        <div class="status-support">
                        @foreach($ceklikes as $cek)
                        @if($cek->id_user == Auth::user()->id && $cek->id_status == $s->id_status)
                            <?php $hsl=true; ?> 
                            <?php $idlikes = $cek->id_likes; ?>       
                            @break
                        @else
                            <?php $hsl=false; ?>    
                        @endif
                        @endforeach

                            @if($hsl)
                                @foreach($likes as $lk)
                                @if($lk->id_status == $s->id_status)
                                <a href="/deletelikes/{{$idlikes}}/{{$s->id_status}}"> 
                                    <i class="fas fa-thumbs-up"></i>
                                </a>
                                <span class="badge">{{$lk->t_likes}}</span>
                                @endif
                                @endforeach
                            @else
                                @foreach($likes as $lk)
                                @if($lk->id_status == $s->id_status)
                                <a href="/addlikes/{{$s->id_status}}">
                                    <i class="far fa-thumbs-up"></i>
                                </a>
                                <span class="badge">{{$lk->t_likes}}</span>
                                @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="status-support">
                            <a href="#">
                                <i class="far fa-comment komen"></i>
                            </a>
                        </div>

                        @foreach($km as $k)
                            @if($s->id_status == $k->id_status)
                            <div class="user-timeline komen-group">
                                <div class="tgl-stat">
                                    {{$k->tgl_komen}}
                                </div>
                                <div class="user-komen">
                                    <a href="/user/{{$k->id}}"><b>{{ $k->username }}</b></a>
                                </div>
                                <div class="isi-comment clear">
                                        {{$k->komen}}
                                </div>
                            </div>
                            @endif
                        @endforeach


                        <form method="POST" action="/addkomen/{{$s->id_status}}/{{Auth::user()->id}}">
                            @csrf
                            <div class="comment-control">
                                <input class="form-control" type="text" name="isikomen" placeholder="Comment here..">
                            </div>
                            <button type="submit" class="btn btn-secondary btn-komen">Post</button>
                        </form>
                    </div>

                  @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
