@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/index.css">
    </head>

    <body>
    <div class="title">
        <h2>{{ $user->name }} さんのペット一覧</h2>
    </div>

    @if (isset($pets))
        <table class="w-full">
            <thead>
                <tr>
                    <th>アイコン</th>
                    <th>ペットの名前</th>
                    <th>種類</th>
                    <th>お迎え日（誕生日）</th>
                    <th>性別</th>
                    <th>その他、メモ（モルフなど）</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
                    <td>
                        <aside class="avatar">
                            <div class="w-40"><img src="/storage/pet_image/{{ $pet->image }}"></div>
                        </aside>
                    </td>
                    <td><a class="content link" href="{{ route('pets.show', $pet->id) }}">{{ $pet->name }}</a></td>
                    <td>{{ $pet->kinds }}</td>
                    <td>{{ $pet->birthday }}</td>
                    <td>{{ $pet->sex }}</td>
                    <td>{{ $pet->memos }}</td>
                    <td><a class="content link" href="{{ route('managements.managements', $pet->id) }}">飼育記録を確認する</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーションのリンク --}}
        {{ $pets->links() }}
    @endif
    
    <a class="btn" href="{{ route('pets.create') }}">ペットの新規登録</a>
    </body>

@endsection