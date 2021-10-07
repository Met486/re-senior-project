@extends('layout')

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="/css/detail.css">
@endsection

@section('content')
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
            <div id="carouselPhotos" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                @foreach ($photos as $i)
                  <button data-bs-target="#carouselPhotos" data-bs-slide-to="{{ $i->index }}" <?php if ($i->index ==0) echo 'class="active" aria-current="true"'; ?> aria-label="Slide {{ $i->index+1 }}"></button>  
                @endforeach
              </div>
              <div class="carousel-inner">
                @foreach ($photos as $i)
                <div class="carousel-item c-div <?php if ($i->index == 0) echo "active"; ?>" >
                  <a a data-bs-toggle="modal" data-bs-target="#lightboxModalFullscreen" data-bs-lightbox="{{ asset( $i->path ) }}" role="button">
                    <img src="{{ asset( $i->path )}}" class="d-block w-100 c-image" alt="">
                  </a>
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
            <label for="isbn_13">ISBN-13</label>
            <p>{{ $item->isbn_13 }}</p>
            

            @if (Auth::id() == $item->buyer_id && $item->status == 3)
              <label for="comment">約束メモ</label>
              <textarea name="comment" readonly cols="50" rows="10">{{ $item->comment }}</textarea>
              <br>
              <label for="url">URL</label>
              <a href="{{$item->url}}">取引メモはこちらからアクセスしてください</a>
   
            @endif

            @if(Auth::check())
              @if (Auth::id() == $item->seller_id)
                @if ($item->status == 3)
                  <form action="{{ route('items.trade', $item->id) }}" method="post" class="float-right">
                    @csrf
                    @method('put')
                  <input type="submit" value="取引！" class="btn btn-primary" onclick='return confirm("販売しますか？");'>
                  </form>
                @endif
                <form action="{{ route('items.destroy', $item->id) }}" method="post" class="float-right">
                  @csrf
                  @method('delete')
                <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                </form>
              @else
                @if ($item->status == 1)
                  <form action="{{ route('items.buy', $item->id) }}" method="post" class="float-right">
                    @method('put')
                    @csrf
                  <input type="submit" value="購入" class="btn btn-primary" onclick='return confirm("購入しますか？");'>
                  </form>
                @elseif($item->status == 3)
                  <p>この商品は取引中です</p>
                @endif
              @endif
            @endif

        </nav>
      </div>    
      </div>
    </div>

    {{-- classにfadeを適用するとmodalが表面に表示されなくなる --}}
      <div class="modal" id="lightboxModalFullscreen" tabindex="-1" aria-labelledby="lightboxModalFullscreenLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen" data-bs-dismiss="modal" aria-label="Close">
        <div class="modal-content">
          <div class="modal-body d-flex align-items-center justify-content-center">
            <img src="/item/item/photos/_0.png" class="img-fluid" id="LightboxImage" data-bs-dismiss="modal" aria-label="Close" />
          </div>
        </div>
      </div>
    </div>

@endsection
    
@section('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
<script src="{{ mix('js/detail.js') }}"></script>   

@endsection
