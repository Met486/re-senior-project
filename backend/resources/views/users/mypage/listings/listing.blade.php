@extends('users/mypage/mypage')

@section('content-mypage')
<p>{{ $mode }}</p>
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
    
{{ $items->onEachSide(2)->links() }}
@endsection
