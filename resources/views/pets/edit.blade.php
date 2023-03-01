@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>{{ $pet->name }} の情報編集</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('pets.update', $pet->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="w-40 rounded-full">
                    <img src="/storage/pet_image/{{ $pet->image }}">
                </div>
                <input type="file" name="image" value="/storage/pet_image/{{ $pet->image }}">

                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">ペットの名前:</span>
                    </label>
                    <input type="text" name="name" value="{{ $pet->name }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="text" class="label">
                        <span class="label-text">種類:</span>
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

            <button type="submit" class="btn btn-primary btn-outline">更新する</button>
        </form>
    </div>

@endsection