@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>ペット一覧</h2>
    </div>

    @if (isset($pets))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>アイコン</th>
                    <th>ペットの名前</th>
                    <th>種類</th>
                    <th>お迎え日（誕生日）</th>
                    <th>性別</th>
                    <th>その他、メモ（モルフなど）</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
                    <aside class="avatar">
                        <td class="w-40 rounded-full"><img src="/storage/pet_image/{{ $pet->image }}"></td>
                    </aside>
                    <td><a class="link link-hover text-info" href="{{ route('pets.show', $pet->id) }}">{{ $pet->name }}</a></td>
                    <td>{{ $pet->kinds }}</td>
                    <td>{{ $pet->birthday }}</td>
                    <td>{{ $pet->sex }}</td>
                    <td>{{ $pet->memos }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <a class="btn btn-primary" href="{{ route('pets.create') }}">ペットの新規登録</a>

@endsection