<header class="bg-dark p-0 px-sm-4 px-md-5">
    <nav class="navbar navbar-expand-sm navbar-light bg-dark">
        <a class="navbar-brand text-white" href="{{ route('books.index') }}">Book Quote</a>

        @if(Auth::check())
            <div class="navbar-nav mr-auto"></div>

            <form method="POST" action="{{ route('books.index') }}" class="text-center">
                @csrf
                <div class="form-group m-0 header-search-container">
                    <input class="header-search" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="本棚からさがす">
                    <button type="submit" class="header-search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle h4 mb-0 text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('books.index') }}">ホーム</a>
                    <a class="dropdown-item"  href="{{ route('user.edit', ['user' => Auth::user()]) }}">アカウント管理</a>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" form="logout-form" id="logout">ログアウト</button>
                </div>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
        <ul class="navbar-nav ml-auto header-login">
            <li class="navbar-item"><a class="nav-text nav-link btn btn-md font-weight-bold text-white" href="{{ route('login') }}">ログイン</a></li>
            <li class="navbar-item"><a class="nav-text nav-link btn register-button text-white" href="{{ route('register') }}">新規会員登録(無料)</a></li>
        </ul>
        @endif
    </nav>
</header>
