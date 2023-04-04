@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/show.css">
    </head>

    <body id="background">
    <div class="title">
        <h2>飼育記録</h2>
    </div>
    
    <table class="w-full">

        <tr>
            <th>記録の写真</th>
            <td>
                <aside class="avatar">
                    <div class="w-40 rounded">
                        @if ($management->image === null)
                            <img src="{{ Storage::disk('s3')->url('management_image/petsmanager_null_logo.JPG') }}">
                        @else
                            <img src="{{ $management->image }}">
                        @endif
                    </div>
                </aside>
            </td>
        </tr>
        
        <tr>
            <th>記録</th>
            <td>{{ $management->record }}</td>
        </tr>
        
        <tr>
            <th>開始日時</th>
            <td>{{ $management->start_date }}</td>
        </tr>
        
        <tr>
            <th>終了日時</th>
            <td>{{ $management->end_date }}</td>
        </tr>
        
        <tr>
            <th>内容</th>
            <td>{{ $management->content }}</td>
        </tr>
        
        <tr>
            <th>グラム数</th>
            <td>{{ $management->weight }}</td>
        </tr>
    </table>
    
    <a class="btn" href="{{ route('managements.edit', $management->id) }}">飼育記録を編集する</a>
    
    <form method="POST" action="{{ route('managements.destroy', $management->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-delete"
            onclick="return confirm('{{ $management->record }} の記録を削除します。よろしいですか？')">飼育記録を削除する</button>
    </form>
    
@endsection