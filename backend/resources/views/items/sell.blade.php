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
          <form action="{{ route('items.sell') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="title">アイテム名</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                <label for="category">カテゴリ</label><!-- TODO そのうちプルダウンに変更-->
                <input type="text" class="form-control" name="category" id="category" value="{{ old('category') }}" />
                <label for="sub_category">サブカテゴリ</label><!-- TODO そのうちプルダウンに変更-->
                <input type="text" class="form-control" name="sub_category" id="sub_category" value="{{ old('sub_category') }}" />
                <label for="isbn_13">ISBN-13</label>
                <input type="text" class="form-control" name="isbn_13" id="isbn_13" value="{{ old('isbn_13') }}" />
                
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