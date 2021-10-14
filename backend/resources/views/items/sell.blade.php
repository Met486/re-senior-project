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
                <div id="d1_category">
                  <label for="s1_category">カテゴリ1</label>
                  <br>
                  {{-- <input type="text" class="form-control" name="category" id="category" value="{{ old('category') }}" /> --}}
                  <select  name="s1_category" id='s1_category'>
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                    {{-- <option value="{{$category->id}}">{{$category->name}}</option> --}}
                    
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    
                    @endforeach
                  </select>
                  <br>
                </div>
                <div id="d2_category">
                  <label for="s2_category">カテゴリ2</label>
                  <br>
                  <select  name="s2_category" id="s2_category">
                    <option value="">選択してください</option>
                  </select>
                  <br>
                </div>
                <div id="d3_category">
                  <label for="category">カテゴリ3</label>
                  <br>
                  <select  name="category" id="category">
                    <option value="">選択してください</option>
                  </select>
                </div>
                  <br>
                <label for="isbn_13">ISBN-13</label>
                <input type="tel" class="form-control" name="isbn_13" id="isbn_13" value="{{ old('isbn_13') }}" maxlength="13"/>
                <label for="photo">画像ファイル（複数可）:</label>
                <input type="file" required class="form-control" name="files[][photo]" id="files[][photo]" multiple>
                {{-- <label for="comment">アズカリの約束メモ記入欄(300文字まで）</label>
                <textarea class="form-control" name="comment" if="comment" maxlength="300" cols="50" rows="10" value={{ old('comment')}}></textarea> --}}
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