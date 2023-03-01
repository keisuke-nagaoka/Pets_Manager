<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pets;
use Storage\App\Public;

class PetsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        
        if (\Auth::user()) {
            $pets = $user->pets;

            return view('pets.index', [
                'pets' => $pets,
            ]);
        }
        
        return view('dashboard');
    }

    public function create()
    {
        $pet = new Pets;
        
        return view('pets.create', [
            'pet' => $pet,
        ]);
    }    
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'kinds' => 'required|max:50',
            'memos' => 'max:255',
        ]);
        
        $pet = new Pets;
        
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
        $pet->user_id = $request->user()->id;
        $pet->save();

        return redirect('/');
    }
    
    public function show($id)
    {
        $pet = Pets::findOrFail($id);
        
        if (\Auth::id() === $pet->user_id) {
            return view('pets.show', [
            'pet' => $pet,
            ]);
        }
        
        return view('dashboard');
    }
    
    public function edit($id)
    {
        $pet = Pets::findOrFail($id);

        if (\Auth::id() === $pet->user_id) {
            return view('pets.edit', [
            'pet' => $pet,
            ]);
        }
        
        return view('dashboard');
    }
    
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:50',
            'kinds' => 'required|max:50',
            'memos' => 'max:255',
        ]);
        
        $pet = Pets::findOrFail($id);
        
        if (\Auth::id() === $pet->user_id) {
            $file = $request->file('image');
            
            // ファイルを変更した場合のみ変更を保存する
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
        $pet = Pets::findOrFail($id);
        
        if (\Auth::id() === $pet->user_id) {
            $pet->delete();
            return redirect('/');
        }
        
        return view('dashboard');
    }
}
