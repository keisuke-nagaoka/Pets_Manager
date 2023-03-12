<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;

use App\Http\Controllers\ManagementsController;
use App\Models\User;
use App\Models\Pet;
use App\Models\Management;
use Storage\App\Public;

class PetsController extends Controller
{
    public function index()
    {
        // idの値でユーザを検索して取得
        $user = \Auth::user();
        
        // ユーザのペット一覧を取得
        $pets = $user->pets()->paginate(10);
        
        return view('pets.index', [
            'user' => $user,
            'pets' => $pets,
        ]);
    }
    

    public function create()
    {
        // ペットを新規登録
        $pet = new Pet;
        
        // idの値で認証済ユーザを取得
        $user = \Auth::user();
        
        return view('pets.create', [
            'pet' => $pet,
            'user' => $user,
        ]);
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'kinds' => 'required|max:50',
            'memos' => 'max:255',
        ]);
        
        $pet = new Pet;
        
        $user = \Auth::user();
        
        // ファイル無しの場合、ファイル無しのまま登録
        $file = $request->file('image');
        
        if (!is_null($file)) {
            
            // ディレクトリ名
            $dir = "pet_image";

            // アップロードしたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
        
            // 取得したファイル名のまま保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        
            // データベースに編集内容を保存
            $pet->image = $file_name;
        }

        // データベースに編集内容を保存
        $pet->name = $request->name;
        $pet->kinds = $request->kinds;
        $pet->birthday = $request->birthday;
        $pet->sex = $request->sex;
        $pet->memos = $request->memos;
        $pet->user_id = $user->id;
        $pet->save();

        return redirect('/');
    }
    
    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        
        // idを取得して指定のpets.showを表示
        if (\Auth::id() === $pet->user_id) {
            return view('pets.show', [
            'pet' => $pet,
            ]);
        }
        
        return view('dashboard');
    }
    
    public function edit($id)
    {
        // idを取得して指定のpets.editを表示
        $pet = Pet::findOrFail($id);

        if (\Auth::id() === $pet->user_id) {
            return view('pets.edit', [
            'pet' => $pet,
            ]);
        }
        
        return view('dashboard');
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'kinds' => 'required|max:50',
            'memos' => 'max:255',
        ]);
        
        // idを取得して指定のpets.editデータを反映
        $pet = Pet::findOrFail($id);
        
        if (\Auth::id() === $pet->user_id) {
            $file = $request->file('image');
            
            // ファイル変更した場合のみ変更を保存する
            if (!is_null($file)) {
                // ディレクトリ名
                $dir = "pet_image";
                
                // アップロードしたファイル名を取得
                $file_name = $request->file('image')->getClientOriginalName();
                
                // 取得したファイル名のまま保存
                $request->file('image')->storeAs('public/' . $dir, $file_name);
                
                // データベースに編集内容を保存
                $pet->image = $file_name;
                $pet->save();
            }

            // データベースに編集内容を保存
            $pet->name = $request->name;
            $pet->kinds = $request->kinds;
            $pet->birthday = $request->birthday;
            $pet->sex = $request->sex;
            $pet->memos = $request->memos;
            $pet->save();
            
            return redirect('/');
        }

        return view('dashboard');
    }
    

    public function destroy($id)
    {
        // idを取得して指定のpetsを削除
        $pet = Pet::findOrFail($id);
        
        if (\Auth::id() === $pet->user_id) {
            $pet->delete();
            return redirect('/');
        }
        
        return view('dashboard');
    }
}
