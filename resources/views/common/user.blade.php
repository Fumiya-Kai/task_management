<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>タスク管理</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <header>
      <div class="site-title">
        <i class="fas fa-project-diagram"></i>
        <div class="title">タスク管理</div>
      </div>
    </header>
    <main>
      <nav class="menu">
        <div class="nav-wrapper">
          <div class="nav-title">MENU</div>
            <ul class="nav-items">
              <li class="nav-item">
                <a href="{{ route('target.index') }}">目標</a>
              </li>
              <li class="nav-item">
                <a href="">カレンダー</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('report.index') }}">日報</a>
              </li>
            </ul>
          </div>
      </nav>
      <section class="content fullheight">
        @yield('content')
      </section>
    </main>
  </body>
</html>