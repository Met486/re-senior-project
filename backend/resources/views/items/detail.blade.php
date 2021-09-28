@extends('layout')


{{-- 多分イラン --}}
@section('styles')
  {{-- @include('share.flatpickr.styles') --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="/css/detail.css">
@endsection
{{-- 同じくイラン --}}
{{-- @section('scripts')
  @include('share.flatpickr.scripts')
@endsection --}}

@section('content')
    @if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">アイテムの詳細</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif

            <label for="photos">写真</label>

            {{-- <ul class="slider">
              @foreach ($photos as $i)
              <figure>
                <img src="{{ asset( $i->path )}}"  alt="">
              </figure>
              @endforeach
            </ul> --}}

            <div id="carouselPhotos" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                @foreach ($photos as $item)
                  <button data-bs-target="#carouselPhotos" data-bs-slide-to="{{ $item->index }}" <?php if ($item->index ==0) echo 'class="active" aria-current="true"'; ?> aria-label="Slide {{ $item->index+1 }}"></button>  
                @endforeach
              </div>
              <div class="carousel-inner">
                @foreach ($photos as $i)
                <div class="carousel-item c-div <?php if ($i->index == 0) echo "active"; ?>" >
                  <img src="{{ asset( $i->path )}}" class="d-block w-100 c-image" alt="">
                </div>
                @endforeach
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhotos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselPhotos" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>


            {{-- <div><a data-fancybox="gallery" data-src="https://lipsum.app/id/1/800x600">
              <img src="https://lipsum.app/id/1/300x225" class="slider" />
            </a></div> --}}

            <br>
            

            <label for="title">タイトル</label>
            <p>{{ $item->title }}</p>

            <label for="seller">出品者</label>
            <p><a href="{{ route('users.user',['id' => $user_id]) }}">{{ $user_name }}</a></p>

            <label for="status">状態</label>
            <p>{{ $item->status_label }}</p>

            <label for="category">カテゴリ</label>
            {{-- <p>{{ CategoryConsts::Category_List.$item->category }}</p> --}}
            {{-- @foreach (CategoryConsts::Category_List as $category => $number) --}}
              {{-- <p>{{ $category }} => {{ $number }}</p> --}}
              {{-- <option value="{{ $item->category}}">{{ $category }}</option> --}}
            {{-- @endforeach --}}
            <p>{{$category_name}}</p>

            <label for="sub_category">サブカテゴリ</label>
          <p>{{ $item->sub_category }}</p>

            <label for="isbn_13">ISBN-13</label>
            <p>{{ $item->isbn_13 }}</p>
            <div class="text-right">
                <a href="#" class="btn btn-primary">ほしい！</a>
            </div>
            {{-- <div class="text-right">
              <a href="" class="btn btn-primary">削除する</a>
            </div> --}}
            @if(Auth::id() == $item->seller_id) 
              @if($item->status == 3)
                <form action="{{ route('items.trade', $item->id) }}" method="post" class="float-right">
                  @csrf
                  @method('put')
                <input type="submit" value="取引！" class="btn btn-danger" onclick='return confirm("販売しますか？");'>
              </form>
              @else
                <form action="{{ route('items.destroy', $item->id) }}" method="post" class="float-right">
                  @csrf
                  @method('delete')
                <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
              </form>
              @endif
            @else
              @if (Auth::check())
              <form action="{{ route('items.buy', $item->id) }}" method="post" class="float-right">
                @method('put')
                @csrf
              <input type="submit" value="購入" class="btn btn-danger" onclick='return confirm("購入しますか？");'>
              </form>
              @endif

            @endif

        </nav>
      </div>    
      </div>
    </div>
@endsection
    
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
{{-- <script src="{{ mix('assets/js/slick.min.js') }}"></script>    --}}
<script src="{{ mix('js/detail.js') }}"></script>   

@endsection
