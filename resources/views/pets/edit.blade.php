@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/edit.css">
    </head>

    <body id="background">
    <div class="title">
        <h2>{{ $pet->name }} の情報を編集する</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('pets.update', $pet->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="w-40">
                    <div class="w-40 rounded">
                        @if ($pet->image === null)
                            <img src="{{ Storage::disk('s3')->url('pet_image/petsmanager_null_logo.JPG') }}">
                        @else
                            <img src="{{ $pet->image }}">
                        @endif
                    </div>
                </div>
                <input class="image" type="file" name="image" value="/storage/pet_image/{{ $pet->image }}">

                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">ペットの名前: <a class="must">*必須項目</a></span>
                    </label>
                    <input type="text" name="name" value="{{ $pet->name }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="text" class="label">
                        <span class="label-text">種類: <a class="must">*必須項目</a></span>
                    </label>
                    <input type="text" name="kinds" value="{{ $pet->kinds }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="date" class="label">
                        <span class="label-text">お迎え日（誕生日）:</span>
                    </label>
                    <input type="date" name="birthday" value="{{ $pet->birthday }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="text" class="label">
                        <span class="label-text">性別:</span>
                    </label>
                    <input type="text" name="sex" value="{{ $pet->sex }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="text" class="label">
                        <span class="label-text">その他、メモ（モルフなど）:</span>
                    </label>
                    <input type="text" name="memos" value="{{ $pet->memos }}" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn">更新する</button>
        </form>
    </div>
    </body>

@endsection