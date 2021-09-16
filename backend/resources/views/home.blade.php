@extends('layout')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">
            トップ！！
          </div>
          <div class="panel-body">
            <div class="text-center">
              <a href="{{ route('search') }}" class="btn btn-primary">
                検索・管理ページへ
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection