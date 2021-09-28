@extends('layout')

@section('content')

    <div class="d-flex">
        
      <div>
        <label for="category">カテゴリ</label>
        <select name="category" id="category">
        <option value="">すべて</option>  
        @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>            
        @endforeach
      </select></div>

      <div>
        
        <div class="alubum py-5 bg-light">
          <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
              @foreach($items as $item)
              <div class="col">
                <div class="card shadow-sm" >
                  <a  href="{{ route('items.detail',['id' => $item->item_id]) }}">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    {{-- @foreach ($photos as $i)
                    <img src="{{ asset( $i->path )}}" class="card-img-top">
                  @endforeach --}}
                    <img src="{{ asset( $item->path )}}" class="card-img-top s-image">
                    {{-- <img src="{{ asset( $item->path )}}" class="card-img-top"> --}}
                    
                    {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>Placeholder</title>
                      <rect width="100%" height="100%" fill="#55595c"></rect>
                      <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                    </svg> --}}
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->title }}</h5>
                      <a href="{{ route('items.detail',['id' => $item->id]) }}" class="btn btn-primary">詳細</a>
                    </div>
                  </a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        
      </div>
      </div>
      
  {{ $items->onEachSide(2)->links() }}

@endsection