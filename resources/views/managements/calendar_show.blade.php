@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>飼育記録</h2>
    </div>
    
    <table class="table w-full my-4">

        <tr>
            <th>記録の写真</th>
            <td><div class="w-40 rounded-full"><img src="/storage/record_image/{{ $management->image }}"></div></td>
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
    
    <a class="btn btn-ountline" href="{{ route('managements.edit', $management->id) }}">飼育記録を編集する</a>
    
    <form method="POST" action="{{ route('managements.destroy', $management->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline"
            onclick="return confirm('{{ $management->record }} の記録を削除します。よろしいですか？')">飼育記録を削除する</button>
    </form>
    
@endsection