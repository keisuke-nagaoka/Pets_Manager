<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;

use App\Http\Controllers\PetsController;
use App\Models\User;
use App\Models\Pet;
use App\Models\Management;
use App\Models\Event;
use Storage\App\Public;

class ManagementsController extends Controller
{
    public function managements($id)
    {
        // idからペットを検索して取得
        $pet = Pet::findOrFail($id);
        
        $managements = $pet->managements()->paginate(10);
        
        return view('managements.managements',[
            'pet' => $pet,
            'managements' => $managements,
        ]);
    }


    public function create($id)
    {
        $management = new Management;
        
        $pet = Pet::findOrFail($id);
        
        return view('managements.create', [
            'management' => $management,
            'pet' => $pet,
        ]);
    }
    
    
    public function store(Request $request, $id)
    {
        $request->validate([
            'record' => 'required',
            'register' => 'required',
            'content' => 'max:255',
        ]);
        
        $management = new Management;
        
        $pet = Pet::findOrFail($id);
        
        // ファイル無しの場合、ファイル無しのまま登録
        $file = $request->file('image');
        
        if (!is_null($file)) {
            
            // ディレクトリ名
            $dir = "record_image";

            // アップロードしたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
        
            // 取得したファイル名のまま保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        
            // データベースに編集内容を保存
            $management->image = $file_name;
        }

        // データベースに編集内容を保存
        $management->record = $request->record;
        $management->register = $request->register;
        $management->content = $request->content;
        $management->weight = $request->weight;
        $management->pet_id = $pet->id;
        $management->save();

        return redirect('/');
    }
    

    public function show($id)
    {
        $management = Management::findOrFail($id);
        
        if (Pet::findOrFail($management->pet_id)) {
            return view('managements.show', [
            'management' => $management,
            ]);
        }
        
        return view('dashboard');
    }
    

    public function edit($id)
    {
        $management = Management::findOrFail($id);

        if (Pet::findOrFail($management->pet_id)) {
            return view('managements.edit', [
            'management' => $management,
            ]);
        }
        
        return view('dashboard');
    }
    
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'record' => 'required|max:50',
            'register' => 'required',
            'content' => 'max:255',
        ]);
        
        $management = Management::findOrFail($id);

        if (Pet::findOrFail($management->pet_id)) {
            $file = $request->file('image');
            
            // ファイルを変更した場合のみ変更を保存する
            if (!is_null($file)) {
                // ディレクトリ名
                $dir = "record_image";
                
                // アップロードしたファイル名を取得
                $file_name = $request->file('image')->getClientOriginalName();
                
                // 取得したファイル名のまま保存
                $request->file('image')->storeAs('public/' . $dir, $file_name);
                
                // データベースに編集内容を保存
                $management->image = $file_name;
                $management->save();
            }

            // データベースに編集内容を保存
            $management->record = $request->record;
            $management->register = $request->register;
            $management->content = $request->content;
            $management->weight = $request->weight;
            $management->save();
            
            return redirect('/');
        }

        return view('dashboard');
    }
    

    public function destroy($id)
    {
        $management = Management::findOrFail($id);
        
        if (Pet::findOrFail($management->pet_id)) {
            $management->delete();
            return redirect('/');
        }
        
        return view('dashboard');
    }
}
