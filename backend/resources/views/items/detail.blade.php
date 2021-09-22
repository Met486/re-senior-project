@extends('layout')


{{-- 多分イラン --}}
{{-- @section('styles')
  @include('share.flatpickr.styles')
@endsection --}}
{{-- 同じくイラン --}}
{{-- @section('scripts')
  @include('share.flatpickr.scripts')
@endsection --}}

@section('content')
    @if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
    @endif
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

            <label for="photos">写真</label>
            @foreach ($photos as $i)
              <img src="{{ asset( $i->path )}}">
            @endforeach

            <label for="title">タイトル</label>
            <p>{{ $item->title }}</p>

            <label for="seller">出品者</label>
            <p><a href="{{ route('users.user',['id' => $user_id]) }}">{{ $user_name }}</a></p>

            <label for="status">状態</label>
            <p>{{ $item->status_label }}</p>

            <label for="category">カテゴリ</label>
            {{-- <p>{{ CategoryConsts::Category_List.$item->category }}</p> --}}
            {{-- @foreach (CategoryConsts::Category_List as $category => $number) --}}
              {{-- <p>{{ $category }} => {{ $number }}</p> --}}
              {{-- <option value="{{ $item->category}}">{{ $category }}</option> --}}
            {{-- @endforeach --}}
            <p>{{$category_name}}</p>

            <label for="sub_category">サブカテゴリ</label>
            <p>{{ $item->sub_category }}</p>

            <label for="isbn_13">ISBN-13</label>
            <p>{{ $item->isbn_13 }}</p>
            <div class="text-right">
                <a href="#" class="btn btn-primary">ほしい！</a>
            </div>
            {{-- <div class="text-right">
              <a href="" class="btn btn-primary">削除する</a>
            </div> --}}
            @if(Auth::id() == $item->seller_id) 
              @if($item->status == 3)
                <form action="{{route('items.trade', $item->id)}}" method="post" class="float-right">
                  @csrf
                  @method('put')
                <input type="submit" value="取引！" class="btn btn-danger" onclick='return confirm("販売しますか？");'>
              </form>
              @else
                <form action="{{route('items.destroy', $item->id)}}" method="post" class="float-right">
                  @csrf
                  @method('delete')
                <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
              </form>
                @endif
            @else
              <form action="{{route('items.buy', $item->id)}}" method="post" class="float-right">
                @csrf
                @method('put')
              <input type="submit" value="購入" class="btn btn-danger" onclick='return confirm("購入しますか？");'>
              </form>
            @endif

        </nav>
      </div>    
        </div>
    </div>
@endsection