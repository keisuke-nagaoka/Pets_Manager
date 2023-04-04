@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/index.css">
    </head>

    <body>
    <div class="title">
        <h2>どのペットの飼育を記録しますか？</h2>
    </div>

    @if (isset($pets))
        <table class="w-full">
            <thead>
                <tr>
                    <th>アイコン</th>
                    <th>ペットの名前</th>
                    <th>種類</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
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
                    <td><a class="content link" href="{{ route('managements.create', $pet->id) }}">{{ $pet->name }}</a></td>
                    <td>{{ $pet->kinds }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーションのリンク --}}
        {{ $pets->links() }}
    @endif
    </body>

@endsection