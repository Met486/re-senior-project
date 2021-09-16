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
          <div class="panel-heading">アイテムを編集する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form
                action="{{ route('items.edit', ['id' => $item->id]) }}"
                method="POST"
            >
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title"
                       value="{{ old('title') ?? $item->title }}" />
              </div>
              <div class="form-group">
                <label for="status">状態</label>
                <select name="status" id="status" class="form-control">
                  @foreach(\App\Models\Item::STATUS as $key => $val)
                    <option
                        value="{{ $key }}"
                        {{ $key == old('status', $item->status) ? 'selected' : '' }}
                    >
                      {{ $val['label'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="category">カテゴリ</label>
                <input type="text" class="form-control" name="category" id="category"
                       value="{{ old('category') ?? $item->category }}" />
              </div>
              <div class="form-group">
                <label for="sub_category">サブカテゴリ</label>
                <input type="text" class="form-control" name="sub_category" id="sub_category"
                       value="{{ old('sub_category') ?? $item->sub_category }}" />
              </div>
              <div class="form-group">
                <label for="isbn_13">ISBN-13</label>
                <input type="text" class="form-control" name="isbn_13" id="isbn_13"
                       value="{{ old('isbn_13') ?? $item->isbn_13 }}" />
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
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('category'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script>
@endsection