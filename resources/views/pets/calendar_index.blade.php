@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>どのペットの飼育を記録しますか？</h2>
    </div>

    @if (isset($pets))
        <table class="table table-zebra w-full my-4">
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
                    <aside class="avatar">
                        <td class="w-40 rounded-full"><img src="/storage/pet_image/{{ $pet->image }}"></td>
                    </aside>
                    <td><a class="link link-hover text-info" href="{{ route('managements.create', $pet->id) }}">{{ $pet->name }}</a></td>
                    <td>{{ $pet->kinds }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection