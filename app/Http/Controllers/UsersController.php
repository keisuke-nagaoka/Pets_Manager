<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Pet;
use App\Models\Management;
// use Storage\App\Public; ローカルストレージでファイルを保存時に使用

class UsersController extends Controller
{
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        if (\Auth::id() === $user->id) {
            return view('users.show', [
                'user' => $user,
            ]);
        }
        
        return view('dashboard');
    }
    
    
    public function edit($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 認証済ユーザのidを取得して編集画面へ
        if (\Auth::id() === $user->id) {
            return view('users.edit', [
            'user' => $user,
            ]);
        }
        
        return view('dashboard');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        // idの値でユーザを検索して取得        
        $user = User::findOrFail($id);
        
        // 認証済ユーザのidを取得して各値を取得        
        if (\Auth::id() === $user->id) {
            
            $file = $request->file('image');
            
            // ファイルを変更した場合のみ変更を保存する
            if (!is_null($file)) {
                
                // アップロードしたファイル名を取得
                $file_name = $request->file('image')->getClientOriginalName();
                
                // s3のバケットURLを取得
                $file_path = Storage::disk('s3')->putFile('user_image', $file);
                
                // 取得したファイル名のまま保存
                $request->file('image')->storeAs('user_image', $file_name, 's3');
                
                // s3のバケットURLを取得してデータベースに編集内容を保存
                $user->image = Storage::disk('s3')->url($file_path);
            }
            
            
            /* ローカルストレージでファイルを保存する場合に使用
            $file = $request->file('image');
            
            // ファイルを変更した場合のみ変更を保存する
            if (!is_null($file)) {
                // ディレクトリ名
                $dir = "user_image";
                
                // アップロードしたファイル名を取得
                $file_name = $request->file('image')->getClientOriginalName();
                
                // 取得したファイル名のまま保存
                $request->file('image')->storeAs('public/' . $dir, $file_name);
                
                // データベースに編集内容を保存
                $user->image = $file_name;
                $user->save();
            } */
            

            // データベースに編集内容を保存
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            
            return redirect('/');
        }

        return view('dashboard');
    }
    
    
    public function destroy($id)
    {
        // ユーザ削除
    }
}
