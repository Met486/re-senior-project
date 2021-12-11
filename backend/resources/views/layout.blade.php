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
      
      <div class="container-fluid">
        @yield('content')
      </div>
    </main>
    @yield('scripts')
      <script src="{{ mix('/js/layout.js') }}"></script>
  </body>
</html>