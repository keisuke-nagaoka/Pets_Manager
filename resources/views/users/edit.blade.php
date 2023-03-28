@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/edit.css">
    </head>

    <body id="users">
    <div class="title">
        <h2>{{ $user->name }} さんの情報編集</h2>
    </div>
    <div class="flex justify-center">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="w-40">
                    <img src="/storage/user_image/{{ $user->image }}">
                </div>
                    <input class="image" type="file" name="image" value="/storage/user_image/{{ $user->image }}">

                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">飼い主の名前: <a class="must">*必須項目</a></span>
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="email" class="label">
                        <span class="label-text">メールアドレス: <a class="must">*必須項目</a></span>
                    </label>
                    <input type="email" name="email" value="{{ $user->email }}" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn">更新する</button>
        </form>
    </div>
    </body>

@endsection