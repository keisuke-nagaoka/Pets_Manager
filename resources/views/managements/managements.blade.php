@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/index.css">
    </head>

    <body>
    <div class="title">
        <h2>{{ $pet->name }} の飼育記録一覧</h2>
    </div>

    @if (isset($managements))
        <table class="w-full">
            <thead>
                <tr>
                    <th>写真</th>
                    <th>活動記録</th>
                    <th>開始日時</th>
                    <th>終了日時</th>
                    <th>内容</th>
                    <th>餌量、体重（g）</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($managements as $management)
                <tr>
                    <td>
                        <aside class="avatar">
                            <div class="w-40"><img src="/storage/record_image/{{ $management->image }}"></div>
                        </aside>
                    </td>
                    <td><a class="content link" href="{{ route('managements.show', $management->id) }}">{{ $management->record }}</a></td>
                    <td>{{ $management->start_date}}</td>
                    <td>{{ $management->end_date }}</td>
                    <td>{{ $management->content }}</td>
                    <td>{{ $management->weight }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーションのリンク --}}
        {{ $managements->links() }}
    @endif
    
    <a class="btn" href="{{ route('managements.create', $pet->id) }}">飼育記録の登録</a>
    </body>

@endsection