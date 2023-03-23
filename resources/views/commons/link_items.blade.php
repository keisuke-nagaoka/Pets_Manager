<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('/css/link_items.css') }}">
    </head>
    <body>
        <div class="content">
            @if (Auth::check())
                {{-- ユーザ詳細ページへのリンク --}}
                <li><a class="link link-hover" href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->name }}さんのプロフィール</a></li>
                <li class="divider lg:hidden"></li>
                {{-- 登録ペット一覧ページへのリンク --}}
                <li><a class="link link-hover" href="{{ route('pets.index', Auth::user()->id) }}">登録ペット一覧</a></li>
                {{-- ログアウトへのリンク --}}
                <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
            @else
                {{-- ユーザ登録ページへのリンク --}}
                <li class="link link-hover"><a href="{{ route('register') }}">ユーザ登録</a></li>
                <li class="divider lg:hidden"></li>
                {{-- ログインページへのリンク --}}
                <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
            @endif
        </div>
    </body>
</html>