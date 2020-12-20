<header>
    <nav class="navbar navbar-expand-lg px-5 row">
        <a class="navbar-brand logo" href="{{ route('books.index') }}">ブクメモ</a>

        @if(Auth::check())
        <ul class="navbar-nav ml-auto">
            {{--  <li class="navbar-item">
                <a class="btn btn-lg btn-primary mx-2 shadow" href="">
                    本をさがす
                </a>
            </li>
            <li class="navbar-item">
                <a class="btn btn-lg btn-success mx-2 mr-5 shadow" href="">
                    本棚
                </a>
            </li>  --}}
            <li class="navbar-item user-icon dropdown">
                <img src="../../storage/app/public/common/default_user.jpeg" id="dropdown1"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                >
                <div class="dropdown-menu dropdown-location" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="{{ route('books.index') }}">ホーム</a>
                    <a class="dropdown-item"  href="{{ route('user.edit', ['user' => Auth::user()]) }}">アカウント管理</a>
                    <button class="dropdown-item" form="logout-form" id="logout">ログアウト</button>
                </div>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>

        @else
        <ul class="navbar-nav ml-auto">
            <li class="navbar-item"><a class="nav-text nav-link btn btn-md font-weight-bold" href="{{ route('login') }}">ログイン</a></li>
            <li class="navbar-item"><a class="nav-text nav-link btn btn-md register-button text-white" href="{{ route('register') }}">新規会員登録</a></li>
        </ul>
        @endif
    </nav>
  </header>
