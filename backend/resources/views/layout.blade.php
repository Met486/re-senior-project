<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Trade App</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">Trade App</a>
  
    <form class="form-inline" action="{{ route('search') }} " method="get">
      <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control" name="keyword" id="keyword" value="{{ old('keyword') }} "/>
      </div>
        <button type="submit" class="btn btn-primary mb-2">検索</button>
    </form>
    @if (Route::has('login'))
        @auth
      
          <!-- <a href=" {{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" method="POST">Log out</a> -->
          <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-jet-responsive-nav-link href="{{ route('logout') }}"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              {{ __('Logout') }}
          </x-jet-responsive-nav-link>
          </form>
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
  @yield('content')
</main>
@yield('scripts')
</body>
</html>