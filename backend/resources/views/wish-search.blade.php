@extends('layout')

@section('content')

    {{-- <div class="d-flex"> --}}
    <div class="row row-cols-2">
        
      <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
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

      <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
        <div class="d-flex flex-wrap d-center">
          @foreach($items as $item)
          <div class="card shadow-sm m-2 " >
            <a  href="{{ route('wish_items.detail',['id' => $item->id]) }}">
              <img src="{{ asset( $item->cover_path )}}" class="card-img-top s-image">
              <div class="card-body">
                <h5 class="card-title">{{ $item->title }}</h5>
                <a href="{{ route('wish_items.detail',['id' => $item->id]) }}" class="btn btn-primary">詳細</a>
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