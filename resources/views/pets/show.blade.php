@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/show.css">
    </head>

    <body id="background">
    <div class="title">
        <h2>{{ $pet->name }} の詳細情報</h2>
    </div>
    
    <table class="w-full">
        
        <tr>
            <th>アイコン</th>
            <td>
                <aside class="avatar">
                    <div class="w-40 rounded">
                        @if ($pet->image === null)
                            <img src="{{ Storage::disk('s3')->url('pet_image/petsmanager_null_logo.JPG') }}">
                        @else
                            <img src="{{ $pet->image }}">
                        @endif
                    </div>
                </aside>
            </td>
        </tr>
        
        <tr>
            <th>ペットの名前</th>
            <td>{{ $pet->name }}</td>
        </tr>
        
        <tr>
            <th>種類</th>
            <td>{{ $pet->kinds }}</td>
        </tr>
        
        <tr>
            <th>お迎え日（誕生日）</th>
            <td>{{ $pet->birthday }}</td>
        </tr>
        
        <tr>
            <th>性別</th>
            <td>{{ $pet->sex }}</td>
        </tr>
        
        <tr>
            <th>その他、メモ（モルフなど）</th>
            <td>{{ $pet->memos }}</td>
        </tr>
    </table>
    
    <a class="btn" href="{{ route('pets.edit', $pet->id) }}">ペットの情報を編集する</a>
    
    <form method="POST" action="{{ route('pets.destroy', $pet->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-delete"
            onclick="return confirm('{{ $pet->name }} の登録を削除します。よろしいですか？')">ペットの登録を削除する</button>
    </form>
    </body>
    
@endsection