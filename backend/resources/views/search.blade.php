@extends('layout')

@section('content')

    {{-- <div class="d-flex"> --}}
    <div class="row row-cols-2">

      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
      <h4>詳細検索</h4>
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

        
              <form>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-12 col-form-label">キーワード</label>
                  <div class="col-12">
                    <input type="email" class="form-control" id="inputEmail3">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-12 col-form-label">価格</label>
                  <div class="col-12">
                    <input type="password" class="form-control" id="inputPassword3">
                  </div>
                </div>
                <fieldset class="row mb-3 justify-content-center">
                  <div class="col-sm-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        出品中のみ
                      </label>
                    </div>
                  </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">検索</button>
              </form>


      </div>

      <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <div class="d-flex flex-wrap d-center">
          @foreach($items as $item)
          <div class="card shadow-sm m-2">
            <a  href="{{ route('items.detail',['id' => $item->item_id]) }}">
              <img src="{{ asset( $item->path )}}" class="card-img-top s-image">
              <div class="card-body">
                <h5 class="card-title">{{ $item->title }}
                ￥1200
                </h5>
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