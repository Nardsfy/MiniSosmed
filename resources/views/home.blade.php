@extends('layouts.main')

@section('content')
{{$hsl=false}}
<?php  $idlikes=0; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header status-header">Timeline</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action=" {{route('status')}} ">
                        @csrf
                        <textarea class="form-control status-box" rows="4" name="status" placeholder="How is your day?"></textarea>
                        <button type="submit" class="btn btn-primary btn-post">POST</button> 
                    </form>
                </div>
                    
                <div class="status-control"></div>

                @foreach($dt as $st)
                    @if(Auth::user()->username == $st->username)
                    <div class="user-timeline">
                        <img src="{{asset('/imgProfile/'.$st->foto)}}" alt="Profile">
                        <div class="delete-icon">
                            <a href="/deletestatus/{{$st->id_status}}"><i class="fa fa-trash"></i></a>
                        </div>
                        <div class="tgl-stat">
                            {{$st->tgl}}
                        </div>
                        <a href="{{ route('profile') }}"><b>{{ $st->username }}</b></a>
                        <div class="timeline">
                            {{ $st->status }}
                        </div>

                        <div class="status-support">
                        @foreach($ceklikes as $cek)
                        @if($cek->id_user == Auth::user()->id && $cek->id_status == $st->id_status)
                            <?php $hsl=true; ?> 
                            <?php $idlikes = $cek->id_likes; ?>       
                            @break
                        @else
                            <?php $hsl=false; ?>    
                        @endif
                        @endforeach

                            @if($hsl)
                                @foreach($likes as $lk)
                                @if($lk->id_status == $st->id_status)
                                <a href="/deletelikes/{{$idlikes}}/{{$st->id_status}}"> 
                                    <i class="fas fa-thumbs-up"></i>
                                </a>
                                <span class="badge">{{$lk->t_likes}}</span>
                                @endif
                                @endforeach
                            @else
                                @foreach($likes as $lk)
                                @if($lk->id_status == $st->id_status)
                                <a href="/addlikes/{{$st->id_status}}">
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
                            @if($st->id_status == $k->id_status)
                            <div class="user-timeline komen-group">
                                <div class="tgl-stat">
                                    {{$k->tgl_komen}}
                                </div>
                                <div class="user-komen">
                                    <a href="{{ route('profile') }}"><b>{{ $k->username }}</b></a>
                                </div>
                                <div class="isi-comment clear">
                                        {{$k->komen}}
                                </div>
                            </div>
                            @endif
                        @endforeach


                        <form method="POST" action="/addkomen/{{$st->id_status}}/{{Auth::user()->id}}">
                            @csrf
                            <div class="comment-control">
                                <input class="form-control" type="text" name="isikomen" placeholder="Comment here..">
                            </div>
                            <button type="submit" class="btn btn-secondary btn-komen">Post</button>
                        </form>
                    </div>
                    @else 
                    <div class="user-timeline">
                        <img src="{{asset('/imgProfile/'.$st->foto)}}" alt="Profile">
                        <div class="tgl-stat">
                            {{$st->tgl}}
                        </div>
                        <a href="/user/{{$st->id}}"><b>{{ $st->username }}</b></a>
                        <div class="timeline">
                            {{ $st->status }}
                        </div>

                        <div class="status-support">
                        @foreach($ceklikes as $cek)
                        @if($cek->id_user == Auth::user()->id && $cek->id_status == $st->id_status)
                            <?php $hsl=true; ?>  
                            <?php $idlikes = $cek->id_likes; ?>  
                            @break
                        @else
                            <?php $hsl=false; ?>    
                        @endif
                        @endforeach

                            @if($hsl)
                                @foreach($likes as $lk)
                                @if($lk->id_status == $st->id_status)
                                <a href="/deletelikes/{{$idlikes}}/{{$st->id_status}}">
                                    <i class="fas fa-thumbs-up"></i>
                                </a>
                                <span class="badge">{{$lk->t_likes}}</span>
                                @endif
                                @endforeach
                            @else
                                @foreach($likes as $lk)
                                @if($lk->id_status == $st->id_status)
                                <a href="/addlikes/{{$st->id_status}}">
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
                            @if($st->id_status == $k->id_status)
                            <div class="user-timeline komen-group">
                                <div class="tgl-stat">
                                    {{$k->tgl_komen}}
                                </div>
                                <div class="user-komen">
                                    <a href="/user/{{$st->id}}"><b>{{ $k->username }}</b></a>
                                </div>
                                <div class="isi-comment clear">
                                        {{$k->komen}}
                                </div>
                            </div>
                            @endif
                        @endforeach

                        <form method="POST" action="/addkomen/{{$st->id_status}}/{{Auth::user()->id}}">
                            @csrf
                             <div class="comment-control">
                                <input class="form-control" type="text" name="isikomen" placeholder="Comment here..">
                            </div>
                            <button type="submit" class="btn btn-secondary btn-komen">Post</button>
                        </form>
                    </div>

                    @endif
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
