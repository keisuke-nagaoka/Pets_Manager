@extends('layouts.app')

@section('content')
    @if (Auth::check())
    
        <!DOCTYPE html>
        <html>
            <head>
                @vite(['resources/js/app.js'])
            </head>
            <body>
                <div id="calendar"></div>
            </body>
        </html>

    @else
    
        <!DOCTYPE html>
        <html>
            <head>
                <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
            </head>
            <body>
                <div class="layer layer-bg">
                    <div class="layer-txt fadeUp">
                        <p>Pet's Managerはペット飼育総合管理サービスです。<br>ご利用いただくにはユーザ登録が必要です。</p>
                        <p>できることはこちらから → <a href="{{ route('login') }}">できること</a></p>
                        <p>ユーザ登録はこちらから</p>
                        {{-- ユーザ登録ページへのリンク --}}
                        <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">新規登録</a>
                        <p>登録済の方はこちらから</p>
                        {{-- ログインページへのリンク --}}
                        <a class="btn btn-primary btn-lg normal-case" href="{{ route('login') }}">ログイン</a>
                    </div>
                </div>
            </body>
        </html>

    @endif
@endsection