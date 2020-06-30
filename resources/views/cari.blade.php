@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header status-header">Hasil pencarian dari:<b> {{$cari}}</b></div>
                <div class="card-body">
            	@foreach($user as $u)
                	<div class="user-timeline">
                        <img src="{{asset('/imgProfile/'.$u->foto)}}" alt="Profile">
						 <a href="/user/{{$u->id}}"><b>{{ $u->username }}</b></a>
                	</div>
				@endforeach 
            </div>
        </div>
    </div>
</div>
@endsection
