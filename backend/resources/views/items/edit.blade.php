@extends('layout')

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
                    <form action="{{ route('items.edit', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="isbn_13">ISBN-13</label>
                            <input type="text" class="form-control" name="isbn_13" id="isbn_13"
                                value="{{ old('isbn_13') ?? $item->isbn_13 }}" />
                        </div>

                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ old('title') ?? $item->title }}" />
                        </div>

                        <label for="price">希望価格（購入者が払う金額）</label>
                        <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}" />
                        <label for="scratch">傷の有無</label>
                        <br>
                        <select name="scratches" id="scratches">
                            <option value="1">なし</option>
                            <option value="2">少し傷あり</option>
                            <option value="3">傷あり(読めない)</option>
                            <option value="4">かなり傷あり(読めない)</option>
                        </select>
                        <div id="d1_category">
                            <label for="s1_category">カテゴリ1</label>
                            <br>
                            {{-- <input type="text" class="form-control" name="category" id="category"
                                value="{{ old('category') }}" /> --}}
                            <select name="s1_category" id='s1_category'>
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
                            <select name="s2_category" id="s2_category">
                                <option value="">選択してください</option>
                            </select>
                            <br>
                        </div>
                        <div id="d3_category">
                            <label for="category">カテゴリ3</label>
                            <br>
                            <select name="category" id="category">
                                <option value="">選択してください</option>
                            </select>
                        </div>
                        <br>


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">送信</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
    <div id="book_confirm">
        <div class="col col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="badge panel-heading">こちらの本で合っていますか？</div>
                <div class="panel-body">
                    <div class="col col-md-offset-1 col-md-3">
                        <label for="confirm_cover">表紙</label>
                        <p><img src="" alt="" id="confirm_cover"></p>
                    </div>
                    <div class="col col-md-offset-2 col-md-3">
                        <label for="confirm_title">タイトル</label>
                        <p><textarea class="overflow-wrap" id="confirm_title" readonly></textarea></p>
                        <label for="confirm_author">著者</label>
                        <p><input id="confirm_author" readonly /></p>
                        <label for="confirm_publisher">出版社</label>
                        <p><input id="confirm_publisher" readonly /></p>
                        <label for="confirm_date">出版日</label>
                        <p><input id="confirm_date" readonly /></p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('js/sell.js') }}"></script>
@endsection
