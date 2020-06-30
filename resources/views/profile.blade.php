@extends('layouts.main')

@section('content')
{{$hsl=false}}
<?php  $idlikes=0; ?>
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Following</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">{{Auth::user()->username}}</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span>Your Status</h5>
                             <table class="table bg-tb">
                                <tbody>
                                @foreach($st as $s)
                                @if($s->id_user == Auth::user()->id)
                                <tr><td>
                                <div class="user-timeline">
                                    <div class="delete-icon">
                                        <a href="/deletestatus/{{$s->id_status}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                    <div class="tgl-stat">
                                        {{$s->tgl}}
                                    </div>
                                    <a href="{{ route('profile') }}"><b>{{ $s->username }}</b></a>
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
                                                    <i class="fas fa-thumbs-up likes-profile"></i>
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
                                                <span class="badge likes-profile">{{$lk->t_likes}}</span>
                                                @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    <div class="status-support">
                                        <a href="#">
                                            <i class="far fa-comment komen"></i>
                                        </a>
                                    </div>
                                    <td></tr>

                                        <tr><td>
                                    @foreach($km as $k)
                                        @if($s->id_status == $k->id_status)
                                        <div class="user-timeline profile-komen">
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
                            <form method="POST" action="/addkomen/{{$s->id_status}}/{{Auth::user()->id}}">
                            @csrf
                            <div class="comment-control">
                                <input class="form-control" type="text" name="isikomen" placeholder="Comment here..">
                            </div>
                            <button type="submit" class="btn btn-secondary btn-komen">Post</button>
                            </form>
                                    @endif
                            </div>
                                @endforeach
                            </td></tr>
                            </tbody>
                            </table>   

                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
                    <table class="table table-hover table-striped">
                        <tbody>      
                        @foreach ($dt as $fr)                     
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold"><a href="/deletefriend/{{$fr->id}}"><button class="btn btn-primary btn-control">Unfollow</button></a></span> <a href="/user/{{$fr->id_friends}}"><b>{{ $fr->username }}</b></a>
                            </tr>
                            @endforeach
                        </tbody> 
                    </table>
                </div>
                <div class="tab-pane" id="edit">
                    <form role="form" method="POST" action="updateprofile">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="username" type="text" value="{{Auth::user()->username}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <form method="POST" enctype="multipart/form-data" action="/updatedata">
            @csrf
            @foreach($pp as $p)
            @if($p->id == Auth::user()->id)
                <img src="{{asset('/imgProfile/'.$p->foto)}}" class="mx-auto img-fluid img-circle d-block pp" alt="avatar">
            @endif
            @endforeach
                <h6 class="mt-4 mb-3">Upload profile picture</h6>
                <label class="custom-file">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text mb-3" id="inputGroupFileAddon01">Upload</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input input @error('foto') is-invalid @enderror" id="my-file-selector inputGroupFile01" aria-describedby="inputGroupFileAddon01"  name="foto"style="display:none" 
                    onchange="$('#upload-file-info').html(this.files[0].name)">
                        <span class='label label-info custom-file-label' id="upload-file-info"></span>
                      </div>
                    </div>
                    @error('foto')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                <input type="submit" value="Upload" class="btn btn-dark btn-block">
                </label>
            </form>

            <br>
            <br>
            <br>
            @if(session('sukses'))
            <div class="alert alert-success">
                {{session('sukses')}}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection