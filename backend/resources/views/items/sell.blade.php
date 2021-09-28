@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">アイテムを追加する</div>
          <div class="panel-body">

          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $message)
                  <li>{{ $message }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action="{{ route('items.sell') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="title">アイテム名</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                <label for="category">カテゴリ</label>
                <br>
                {{-- <input type="text" class="form-control" name="category" id="category" value="{{ old('category') }}" /> --}}
                <select  name="category" id='category'>
                  <option value="">選択してください</option>
                  @foreach ($categories as $category)
                      {{-- <option value="{{$category->id}}">{{$category->name}}</option> --}}

                      <option value="{{$category->id}}">{{$category->name}}</option>

                  @endforeach
                </select>
                <br>
                <label for="sub_category">サブカテゴリ</label>
                <br>
                <select  name="sub_category" id="sub_category">
                  <option value="">選択してください</option>
                <label for="sub_category">サブカテゴリ</label><!-- TODO そのうちプルダウンに変更-->
                </select>
                <br>
                <label for="isbn_13">ISBN-13</label>
                <input type="tel" class="form-control" name="isbn_13" id="isbn_13" value="{{ old('isbn_13') }}" maxlength="13"/>
                <label for="photo">画像ファイル（複数可）:</label>
                <input type="file" class="form-control" name="files[][photo]" id="files[][photo]" multiple>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ mix('js/sell.js') }}"></script>  
@endsection