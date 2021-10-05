@extends('layout')

@section('content')

    <div class="d-flex">
        
      <div class="mx-2">
        <label for="d1_category">カテゴリ</label>
        <select name="category" id="category">
          <option value="">選択してください</option>  
        @foreach ($categories as $category)
          @if ($category->parent_id == 1)
          <option value="{{$category->id}}"  <?php if($category->id == $k1_category){ echo "selected";} else{ echo old('category');}  ?>>{{$category->name}}</option>            
          @endif
        @endforeach
        </select>
        
        <div id="d2_category">
        <label for="category">カテゴリ2</label>
        <select name="category2" id="category2">
        <option value="">選択してください</option>  
        @foreach ($categories as $category)
          @if ($category->parent_id == $k1_category)
          <option value="{{$category->id}}"   <?php if($category->id == $k2_category){ echo "selected";} else{ echo old('category2');}  ?>>{{$category->name}}</option>            
          @endif
        @endforeach
        </select>
        </div>

        <div id="d3_category">
          <label for="category">カテゴリ3</label>
          <select name="category3" id="category3">
          <option value="">選択してください</option>  
          @foreach ($categories as $category)
            @if ($category->parent_id == $k2_category)
            <option value="{{$category->id}}"  <?php if($category->id == $k3_category){ echo "selected";} else{ echo old('category3');}  ?>>{{$category->name}}</option>            
            @endif
          @endforeach
          </select>
        </div>
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
  <script src="{{ mix('/js/search.js') }}"></script>
@endsection