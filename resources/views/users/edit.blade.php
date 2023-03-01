@extends('layouts.app')

@section('content')

    <div class="flex justify-center">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <aside =class="avatar">
                    <div class="w-40 rounded-full">
                        <img src="/storage/user_image/{{ $user->image }}">
                    </div>
                    <input type="file" name="image" value="/storage/user_image/{{ $user->image }}">
                </aside>

                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">飼い主の名前:</span>
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="email" class="label">
                        <span class="label-text">メールアドレス:</span>
                    </label>
                    <input type="email" name="email" value="{{ $user->email }}" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-primary btn-outline">更新する</button>
        </form>
    </div>

@endsection