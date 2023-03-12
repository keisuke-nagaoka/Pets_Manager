@extends('layouts.app')

@section('content')
    @if (Auth::check())
<!DOCTYPE html>
<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="calendar"></div>
    </body>
</html>

    @else
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2>Pet's Managerはペット飼育総合管理サービスです。</h2>
                <h2>ご利用いただくにはユーザ登録が必要です。</h2>
                <h2>できることはこちらから → <a href="{{ route('login') }}">できること</a></h2>
                <h2>ユーザ登録はこちらから</h2>
                {{-- ユーザ登録ページへのリンク --}}
                <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">新規登録</a>
                <h2>登録済の方はこちらから</h2>
                {{-- ログインページへのリンク --}}
                <a class="btn btn-primary btn-lg normal-case" href="{{ route('login') }}">ログイン</a>
            </div>
        </div>
    </div>
    @endif
@endsection