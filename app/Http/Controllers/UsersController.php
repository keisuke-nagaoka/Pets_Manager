<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pets;
use Storage\App\Public;

class UsersController extends Controller
{
    public function show($id)
    {
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
        $user = User::findOrFail($id);

        if (\Auth::id() === $user->id) {
            return view('users.edit', [
            'user' => $user,
            ]);
        }
        
        return view('dashboard');
    }
    
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $user = User::findOrFail($id);
        
        if (\Auth::id() === $user->id) {
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
            }

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
