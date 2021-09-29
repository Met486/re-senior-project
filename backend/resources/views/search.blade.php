@extends('layout')

@section('content')

    <div class="d-flex">
        
      <div class="mx-2">
        <label for="category">カテゴリ</label>
        <select name="category" id="category">
        <option value="">選択してください</option>  
        @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>            
        @endforeach
        </select>
      </div>

      <div>
          <div class="d-flex flex-wrap">
            @foreach($items as $item)
            <div class="card shadow-sm m-2 " >
              <a  href="{{ route('items.detail',['id' => $item->item_id]) }}">
                <img src="{{ asset( $item->path )}}" class="card-img-top s-image">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->title }}</h5>
                  {{-- <a href="{{ route('items.detail',['id' => $item->id]) }}" class="btn btn-primary">詳細</a> --}}
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>

    </div>
      
  {{ $items->links() }}
@endsection

@section('scripts')
  <script src="{{ mix('js/search.js') }}"></script>
@endsection