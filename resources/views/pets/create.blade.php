@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>ペットの新規登録</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('pets.store', $user->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf

            <aside =class="avatar">
                <div class="w-40 rounded-full">
                    <img src="/storage/pet_image/{{ $pet->image }}">
                </div>
                <input type="file" name="image" value="{{ $pet->image }}">
            </aside>
            
            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">ペットの名前</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="text" class="label">
                    <span class="label-text">種類</span>
                </label>
                <input type="text" name="kinds" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="date" class="label">
                    <span class="label-text">お迎え日（誕生日）</span>
                </label>
                <input type="date" name="birthday" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="text" class="label">
                    <span class="label-text">性別</span>
                </label>
                <input type="text" name="sex" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="text" class="label">
                    <span class="label-text">その他、メモ（モルフなど）</span>
                </label>
                <input type="text" name="memos" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-primary btn-outline">登録する</button>
        </form>
    </div>
    
@endsection