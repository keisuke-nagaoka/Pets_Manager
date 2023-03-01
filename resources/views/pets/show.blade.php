@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>{{ $pet->name }} の詳細情報</h2>
    </div>
    
    <table class="table w-full my-4">
        
        <div>
            <aside class="avatar">
                <div class="w-40 rounded-full"><img src="/storage/pet_image/{{ $pet->image }}"></td>
            </aside>
        </div>
        
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
    
    <a class="btn btn-ountline" href="{{ route('pets.edit', $pet->id) }}">ペットの情報を編集する</a>
    
    <form method="POST" action="{{ route('pets.destroy', $pet->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline"
            onclick="return confirm('id = {{ $pet->id }} の登録を削除します。よろしいですか？')">ペットの登録を削除する</button>
    </form>
    
@endsection