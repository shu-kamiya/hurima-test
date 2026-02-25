<header class="header">
    <div class="header__inner">
        <a href="/" class="header__logo">
            <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" class="header__logo-img">
        </a>

        <form action="{{ route('items.index') }}" method="GET" class="header__search-form">
            @if (request()->has('tab'))
            <input type="hidden" name="tab" value="{{ request('tab') }}">
            @endif

            <input type="text"
                name="keyword"
                placeholder="何をお探しですか？"
                class="header__search-input"
                value="{{ request('keyword') }}"> <button type="submit" class="header__search-button">
                <i class="fa fa-search"></i>
            </button>
        </form>

        <nav class="header__nav">
            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="header-button">
                    ログアウト
                </button>
            </form>

            <a href="{{ route('mypage') }}" class="header__nav-link">マイページ</a>
            <a href="{{ route('sell.create') }}" class="header__sell-button">出品</a>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="header-button">
                ログイン
            </a>

            <a href="{{ route('register') }}" class="header__nav-link">会員登録</a>
            @endguest

        </nav>

    </div>
</header>