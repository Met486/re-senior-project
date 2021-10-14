@extends('layout')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">
            出品者との物品のやり取りは他サービスを利用することになります。
            推奨は匿名配送が可能かつ、金銭面でのトラブルが少ない「アズカリ」を推奨しています。
          </div>
          <div class="panel-body">
            <div class="text-center">
              <a href="{{ route('search') }}" class="btn btn-primary">
                検索ページへ
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection