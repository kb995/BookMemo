<header>
    <nav class="navbar navbar-dark nav-color navbar-expand-lg px-5">

        <a class="navbar-brand logo" href="{{ route('books.index') }}">ブクメモ</a>

        @if(Auth::check())
        <ul class="navbar-nav ml-auto">
            {{-- <li class="navbar-item navbar-text px-4">{{ Auth::user()->name }}さんでログイン中</li> --}}
            {{-- <li class="navbar-item"><button class="btn btn-link text-white" form="logout-form" id="logout">ログアウト</button></li> --}}
            <li class="navbar-item">
                <img class="bg-white" src="{{ asset('/storage/common/default_user.jpeg') }}" style="height:50px; width: 50px;">
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
        @else
        <ul class="navbar-nav ml-auto">
            <li class="navbar-item"><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
            <li class="navbar-item"><a class="nav-link" href="{{ route('register') }}">会員登録</a></li>
        </ul>
        @endif
    </nav>
  </header>
