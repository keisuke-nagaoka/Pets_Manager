@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/show.css">
    </head>

    <body id="users">
    <div class="title">
        <h2>{{ $user->name }} さんの詳細情報</h2>
    </div>

    <table class="w-full">
        
        <tr>
            <th>アイコン</th>
            <td>
            <aside class="avatar">
                <div class="w-40 rounded">
                    @if ($user->image === null)
                        <img src="{{ Storage::disk('s3')->url('user_image/petsmanager_null_logo.JPG') }}">
                    @else
                        <img src="{{ $user->image }}">
                    @endif
                </div>
            </aside>
            </td>
        </tr>
        
        <tr>
            <th>飼い主の名前</th>
            <td>{{ $user->name }}</td>
        </tr>
        
        <tr>
            <th>メールアドレス</th>
            <td>{{ $user->email }}</td>
        </tr>

    </table>
    
    <a class="btn normal-case" href="{{ route('users.edit', $user->id) }}">飼い主の情報を編集</a></td>

    </body>
    
@endsection