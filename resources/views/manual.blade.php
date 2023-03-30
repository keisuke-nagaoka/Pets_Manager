@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
    
    <head>
        <link rel="stylesheet" href="{{ asset('/css/manual.css') }}">
    </head>
    
    <body>
        <div class="how-to-use">
            <p>ログインするとカレンダーページが開きます。</p>
            <p>まずはナビゲーションバーにある「登録ペット一覧」から
                <br>飼育記録を登録したいペットを追加しよう。
                <br>※ペットの登録件数に制限はありません。何匹でも登録できます。</p>
            <img class="manual-image" src="/css/image/manual/calendar.jpg" alt="fullcalendar">
            <img class="manual-image margin" src="/css/image/manual/pets-create.jpg" alt="pets-create">
            <p class="margin">ペット登録が完了したらナビゲーションバーの
                <br>「登録ペット一覧」から登録できたことを確認。
                <br>登録したペット情報は編集ページで編集も可能です。</p>
            <img class="manual-image" src="/css/image/manual/calendar_2.jpg" alt="fullcalendar_2">
            <img class="manual-image margin" src="/css/image/manual/pets-index.jpg" alt="pets-index">
            <p class="margin">登録したペットの右端に表示されている「飼育記録を確認する」をクリック。</p>
            <img class="manual-image" src="/css/image/manual/pets-index_2.jpg" alt="pets-index_2">
            <img class="manual-image margin" src="/css/image/manual/managements-index.jpg" alt="managements-index">
            <p class="margin">「飼育記録の登録」をクリックして飼育記録の登録ページへ。
                <br>飼育記録を登録する。
                <br>※飼育記録の登録件数に制限はありません。</p>
            <img class="manual-image" src="/css/image/manual/managements-index_2.jpg" alt="managements-index_2">
            <img class="manual-image margin" src="/css/image/manual/managements-create.jpg" alt="managements-create">
            <p class="margin">登録が完了するとカレンダーの登録日付に飼育記録が表示されます。</p>
            <p>カレンダーに表示されている飼育記録をクリックすると<br>
                登録した飼育記録が表示されます。
                飼育記録は編集ページで編集も可能です。</p>
            <img class="manual-image" src="/css/image/manual/managements-store.jpg" alt="managements-store">
            <img class="manual-image margin" src="/css/image/manual/managements-show.jpg" alt="managements-show">
            <p class="margin">飼育記録の登録はカレンダーの空欄をクリックすると
                <br>登録済のペットを選択するページが表示されます。
                    <br>ペットを選択すると飼育記録の登録ページが表示されます。</p>
            <img class="manual-image" src="/css/image/manual/calendar-managements.jpg" alt="calendar-managements">
            <p class="margin">ナビゲーションバーの「（ユーザ名）さんのプロフィール」を
                <br>クリックするとユーザ情報が表示されます。
                <br>編集ページで画像の登録やユーザ名、メールアドレスの変更が可能です。</p>
            <img class="manual-image" src="/css/image/manual/users-show.jpg" alt="users-show">
            <p class="let margin">さあ！Pet's Managerに登録してペットとの生活を充実させよう！</p>
            {{-- ユーザ登録ページへのリンク --}}
            <a class="btn" href="{{ route('register') }}">Pet's Managerを始める</a>
        </div>
    </body>
    
</html>