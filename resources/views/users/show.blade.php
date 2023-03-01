@extends('layouts.app')

@section('content')

    <table class="table w-full my-4">
        
        <aside class="avatar">
            <div class="w-40 rounded-full">
                <img src="/storage/user_image/{{ $user->image }}">
            </div>
        </aside>
        
        <tr>
            <th>飼い主の名前</th>
            <td>{{ $user->name }}</td>
        </tr>

        <tr>
            <th>メールアドレス</th>
            <td>{{ $user->email }}</td>
        </tr>
        
    </table>
    <a class="btn btn-outline" href="{{ route('users.edit', $user->id) }}">飼い主の情報を編集</a>
    
@endsection