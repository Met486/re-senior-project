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
          <form action="{{ route('items.addComment', $item->id)}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
              @csrf
              <div class="form-group">
                <label for="title">アイテム名</label>
                <p>{{ $item->title }}</p>
                <label for="isbn_13">ISBN-13</label>
                <p>{{ $item->isbn_13 }}</p>
                <label for="comment">アズカリの約束メモ記入欄(300文字まで）</label>
                <textarea class="form-control" name="comment" if="comment" maxlength="300" cols="50" rows="10" value={{ old('comment')}}></textarea>
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