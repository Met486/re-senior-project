@extends('layout')

@section('styles')
  <link rel="stylesheet" href="/css/home.css">
@endsection

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
  <div class="row row-cols-3 gx-10"><!--横３分割-->
          <div class="col-3 col text-center p-3 border"><!--カテゴリ-->
              <h4>カテゴリ</h4>
              {{-- <ul class="nav flex-column">
                <li class="nav-item border">
                  <a class="nav-link active" aria-current="page" href="#">算数</a>
                </li>
                <li class="nav-item border">
                  <a class="nav-link" href="#">国語</a>
                </li>
                <li class="nav-item border">
                  <a class="nav-link" href="#">理科</a>
                </li>
                <li class="nav-item border">
                  <a class="nav-link" href="#">社会</a>
                </li>
              </ul> --}}

              @foreach ($categories as $category)
                <ul class="nav flex-column">
                  <li class="nav-item border">
                    <a href="{{ route('search',['category' => $category->id]) }}" class="nav-link active" aria-current="page">{{ $category->name }}</a>
                  </li>
                </ul>
              @endforeach
          </div><!--カテゴリ終-->
          
          <div class="col-6 bg-primary">


            <div class="col"><!--真ん中カラムの中にカード-->
              <div>
                <div class="row gy-5">
                  <div class="col-12">
                    <div class="p-3 border bg-primary">
                      新着
                      
                      <div class="row align-items-start border p-3 justify-content-center">
                        @foreach($items as $item)
                        <div class="col-12 card shadow-sm m-2">
                          <a  href="{{ route('items.detail',['id' => $item->item_id]) }}">
                            <img src="{{ asset( $item->path )}}" class="card-img-top image">
                            <div class="card-body">
                              <h5 class="card-title text-truncate">{{ $item->title }}
                              </h5>
                              <h5>{{ $item->price }}円</h5>
                              {{-- <a href="{{ route('items.detail',['id' => $item->id]) }}" class="btn btn-primary">詳細</a> --}}
                            </div>
                          </a>
                        </div>
                        @endforeach
                      </div>
                      {{-- おすすめ
                      <div class="row align-items-start border p-3">
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                      </div>
                      国語
                      <div class="row align-items-start border p-3">
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                      </div>
                      過去閲覧
                      <div class="row align-items-start border p-3">
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                        <div class="col-4 p-3 text-center">
                          ここにカード
                        </div>
                      </div> --}}
                    </div> 
                  </div>
                  <div class="d-flex justify-content-center">  
                    {{ $items->links() }}
                  </div>
                    <div class="p-6 bg-dark">
                      <div class="col-12">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            {{-- <nav class="d-flex justify-content-center" aria-label="Page navigation example"><!--ページネーション-->
              <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav><!--ページネーション--> --}}
          </div>

          <div class="col-3 bg-light">
              
          </div>
@endsection