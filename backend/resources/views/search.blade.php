@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
      </div>
      <div class="column col-md-8">
        <!-- ここにタスクが表示される -->
        <div class="panel panel-default">
            <div class="panel-heading">アイテム</div>
            <div class="panel-body">
                <div class="text-right">
                <a href="{{ route('items.sell') }}" class="btn btn-default btn-block">
                    アイテムを追加する
                </a>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                <th>タイトル</th>
                <th>状態</th>
                <th>ISBN</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                    <td>{{ $item->title }}</td>
                    <td>
                        <span class="label {{$item->status_class}}">{{ $item->status_label }}</span>
                    </td>
                    <td>{{ $item->isbn_13 }}</td>
                    <td><a href="{{ route('items.edit', ['id' => $item->id]) }}">編集</a></td>
                    <td><a href="{{ route('items.detail',['id' => $item->id]) }}">詳細</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection