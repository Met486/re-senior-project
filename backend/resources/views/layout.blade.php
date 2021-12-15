<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trade App</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/styles.css">
    @yield('styles')
  </head>
  <body>
    <div id="wrapper">
      <header>
        <nav class="my-navbar fixed-top">
          <a class="my-navbar-brand" href="/">Trade App</a>
          <div class="form-inline">
          {{-- <form class="form-inline" action="#" method="get"> --}}
            {{-- <form class="form-inline" action="{{ route('search') }} " method="get"> --}}
            {{-- <div class="form-group mx-sm-3 mx-xs-1 mb-2 "> --}}
              <input type="text" class="form-control" name="keyword" id="keyword" value="@if (isset ($keyword)) {{$keyword}} @endif "/>
            {{-- </div> --}}
              {{-- <button type="submit" class="btn btn-primary mb-2" id="key_btn">検索</button> --}}
              <button class="btn btn-primary mb-2" id="key_btn">検索</button>
          {{-- </form> --}}
        </div>
          @if (Route::has('login'))
              @auth
                <div>
                <a href="{{ route('users.mypage.mypage') }}">マイページ</a>
                <a href="{{ route('items.sell') }}">出品</a>
                <a href="{{ route('wishItems.wish') }}">ほしいもの</a>
                <!-- <a href=" {{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" method="POST">Log out</a> -->
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-jet-responsive-nav-link href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Logout') }}
                </x-jet-responsive-nav-link>
                </form>
                </div>
                @else
                <div>
                  <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>
                  @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">登録</a>
                  @endif
                </div>
              @endauth
          @endif
      
        </nav>
      </header>
    </div>
    <main>
      @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
      @endif
      @if (session('error'))
        <div class=" bg-danger border-danger">
            {{ session('error') }}
        </div>
      @endif
      
      <div class="container-fluid inner">
        @yield('content')
        {{-- <div class="container bg-dark"><!--カルーセル-->
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://1.bp.blogspot.com/-8TkG8niAWbg/X3hF6vgntdI/AAAAAAABblI/T5hUVJ_RITssPJhAnJAHN1ETOuKsT3F8wCNcBGAsYHQ/s1600/dance_youchien.png" class="d-block w-25" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://1.bp.blogspot.com/-fv0QftEDTKA/XobTAMZzplI/AAAAAAABYDc/bmcbtpo7R3Ur1zJvr-yt9Ad2Vw77YsHrQCNcBGAsYHQ/s1600/banzai_kids_people.png" class="d-block w-25" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://1.bp.blogspot.com/-EzpyzsBjUfE/XhwqYyUPenI/AAAAAAABW_E/GiRnp48Lh24oftuMnG2uqcdS-effJSHKgCNcBGAsYHQ/s1600/kouen_untei_boy.png" class="d-block w-25" alt="...">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div> --}}
        </div><!--カルーセル終-->
      </div>
      
    </main>
    @yield('scripts')
      <script src="{{ mix('/js/layout.js') }}"></script>

      <footer>

        <!--https://qumeru.com/magazine/193-->
        {{-- <div class="container-fluid bg-primary sticky-top"><!--フッター--> --}}
        <div class="container-fluid bg-primary fixed-bottom"><!--修正後-->
          <div class="row g-3">
            <div class="col-6">
              <div class="p-3 text-center">コンテンツ</div>
            </div>
            <div class="col-6">
              <div class="p-3 text-center">ヘルプとガイド</div>
            </div>
            <div class="col-6">
              <div class="p-3 text-center">プライバシーと利用規約</div>
            </div>
            <div class="col-6">
              <div class="p-3 text-center">Trade Appについて</div>
            </div>
            <div class="col-12">
              <div class="p-3 text-center">サイトロゴ</div>
            </div>
          </div>
        </div><!--フッター-->
      
        </footer>
    </body>


</html>