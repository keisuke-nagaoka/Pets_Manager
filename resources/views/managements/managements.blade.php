@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>{{ $pet->name }} の飼育記録一覧</h2>
    </div>

    @if (isset($managements))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>写真</th>
                    <th>活動記録</th>
                    <th>記録日時</th>
                    <th>内容</th>
                    <th>餌量、体重</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($managements as $management)
                <tr>
                    <aside class="avatar">
                        <td class="w-40 rounded-full"><img src="/storage/record_image/{{ $management->image }}"></td>
                    </aside>
                    <td><a class="link link-hover text-info" href="{{ route('managements.show', $management->id) }}">{{ $management->record }}</a></td>
                    <td>{{ $management->register }}</td>
                    <td>{{ $management->content }}</td>
                    <td>{{ $management->weight }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <a class="btn btn-primary" href="{{ route('managements.create', $pet->id) }}">飼育記録の登録</a>

@endsection