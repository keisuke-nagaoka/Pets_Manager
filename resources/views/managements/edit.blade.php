@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="/css/edit.css">
    </head>

    <body id="background">
    <div class="title">
        <h2>飼育記録編集</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('managements.update', $management->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="w-40">
                    <img src="/storage/record_image/{{ $management->image }}">
                </div>
                <input class="image" type="file" name="image" value="/storage/record_image/{{ $management->image }}">
                
                <div class="form-control my-4">
                    <span class="label-text">何を記録する？</span>
                    <select name="record">
                        <option value="">▼活動を選択する <a class="must">*必須項目</a></option>
                        <option>今日の様子（日記）</option>
                        <option>ゴハン</option>
                        <option>おやつ</option>
                        <option>トイレ</option>
                        <option>掃除</option>
                        <option>通院</option>
                        <option>餌の量</option>
                        <option>体重測定</option>
                        <option>その他</option>
                    </select>
                </div>

                <div class="form-control my-4">
                    <label for="datetime-local" class="label">
                        <span class="label-text">開始日時 <a class="must">*必須項目</a></span>
                    </label>
                    <input type="datetime-local" name="start_date" value="{{ $management->start_date }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="datetime-local" class="label">
                        <span class="label-text">終了日時 <a class="must">*必須項目</a></span>
                    </label>
                    <input type="datetime-local" name="end_date" value="{{ $management->end_date }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="text" class="label">
                        <span class="label-text">内容</span>
                    </label>
                    <input type="text" name="content" value="{{ $management->content }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="text" class="label">
                        <span class="label-text">内容（g単位：半角数字）</span>
                    </label>
                    <input type="number" name="weight" value="{{ $management->weight }}" class="input input-bordered w-full">
                </div>


            <button type="submit" class="btn">更新する</button>
        </form>
    </div>
    </body>

@endsection