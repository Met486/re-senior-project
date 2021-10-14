@extends('layout')

@section('content')
  <div class="container">
      <p>{{ $user->name }}
      {{ $user->id }}</p>
    </div>
    <div class="d-flex">

			<div>
				<ul class="nav flex-column nav-tabs ">
					<li class="nav-item max-w-sm">
						<a class="nav-link" href="{{route('users.mypage.listings.listing')}}">出品中</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.mypage.listings.in_progress')}}">取引中</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.mypage.listings.with_comment')}}">入金待ち</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.mypage.listings.completed')}}">売却済</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.mypage.listings.buyed')}}">購入済</a>
					</li>
				</ul>

				{{-- <div class="list-group">
					<a class="nav-link" href="{{route('users.mypage.listings.listing')}}">出品中</a>
					<a class="nav-link" href="{{route('users.mypage.listings.in_progress')}}">取引中</a>
					<a class="nav-link" href="{{route('users.mypage.listings.listing')}}">売却済</a>
				</div> --}}
			</div>


			<div class="col">
				@yield('content-mypage')
			</div>
    </div>

@endsection


