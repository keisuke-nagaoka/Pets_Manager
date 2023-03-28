@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/register_login.css">
    </head>

    <body>
    <div class="title">
        <h2>- ログイン -</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">メールアドレス</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">パスワード</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-block normal-case">Pet's Managerを再開する（ログイン）</button>
        </font>

        {{-- ユーザ登録ページへのリンク --}}
        <p class="mt-2"><a class="link" href="{{ route('register') }}">ユーザ登録がまだの方はこちら</a></p>
    </div>
    </body>
@endsection