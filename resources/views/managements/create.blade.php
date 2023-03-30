@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/create.css">
    </head>

    <body>
    <div class="title">
        <h2>{{ $pet->name }} の飼育記録の登録（活動記録）</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('managements.store', $pet->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf

            <aside class="avatar">
                <div class="w-40">
                    <img src="/storage/record_image/{{ $management->image }}">
                </div>
                <input class="image" type="file" name="image" value="{{ $management->image }}">
            </aside>

            <div class="form-control my-4">
                <label for="text" class="label">
                    <span class="label-text">何を記録する？ <a class="must">*必須項目</a></span>
                </label>
                    <select name="record">
                        <option value="▼活動を選択する">▼活動を選択する</option>
                        <option value="今日の様子（日記）">今日の様子（日記）</option>
                        <option value="ゴハン">ゴハン</option>
                        <option value="おやつ">おやつ</option>
                        <option value="トイレ">トイレ</option>
                        <option value="掃除">掃除</option>
                        <option value="通院">通院</option>
                        <option value="餌の量">餌の量</option>
                        <option value="体重測定">体重測定</option>
                        <option value="その他">その他</option>
                    </select>
            </div>

            <div class="form-control my-4">
                <label for="datetime-local" class="label">
                    <span class="label-text">開始日時 <a class="must">*必須項目</a></span>
                </label>
                <input type="datetime-local" name="start_date" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="datetime-local" class="label">
                    <span class="label-text">終了日時 <a class="must">*必須項目</a></span>
                </label>
                <input type="datetime-local" name="end_date" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="text" class="label">
                    <span class="label-text">内容</span>
                </label>
                <input type="text" name="content" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="text" class="label">
                    <span class="label-text">内容（g単位：半角数字）</span>
                </label>
                <input type="number" name="weight" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn">記録する</button>
        </form>
    </div>
    </body>
    
@endsection