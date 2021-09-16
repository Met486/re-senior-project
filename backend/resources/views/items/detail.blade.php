@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection

@section('content')
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

            <label for="title">タイトル</label>
            <p>{{ $item->title }}</p>

            <label for="seller">出品者</label>
            <p><a href="{{ route('users.user',['id' => $user_id]) }}">{{ $user_name }}</a></p>

            <label for="status">状態</label>
            <p>{{ $item->status_label }}</p>

            <label for="category">カテゴリ</label>
            <p>{{ $item->category }}</p>

            <label for="sub_category">サブカテゴリ</label>
            <p>{{ $item->sub_category }}</p>

            <label for="isbn_13">ISBN-13</label>
            <p>{{ $item->isbn_13 }}</p>
            <div class="text-right">
                <a href="#" class="btn btn-primary">ほしい！</a>
            </div>
          </div>

        </nav>
      </div>    
        </div>
    </div>
@endsection