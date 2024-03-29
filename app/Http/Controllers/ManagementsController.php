<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\PetsController;
use App\Models\User;
use App\Models\Pet;
use App\Models\Management;
// use Storage\App\Public; ローカルストレージでファイルを保存時に使用

class ManagementsController extends Controller
{
    public function scheduleGet(Request $request)
    {
        // カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
        
        // ログイン中ユーザのイベントのみ取得
        return Pet::query()
            ->join('managements', 'pets.id', '=', 'managements.pet_id')
            ->select(
                'managements.start_date as start',
                'managements.end_date as end',
                'managements.record as title',
                'managements.id as id'
            )
            ->where('pets.user_id', '=', auth()->user()->id)
            ->where('managements.end_date', '>', $start_date)
            ->where('managements.start_date', '<', $end_date)
            ->get();
    }
    
    
    public function managements($id)
    {
        // idからペットを検索して取得
        $pet = Pet::findOrFail($id);
        
        // ペットの飼い主のidを取得
        $owner = $pet->user_id;
        
        // ログイン中ユーザのidを取得
        $user = Auth::user()->id;
        
        // 飼い主とログイン中ユーザのidが一致しない場合、トップページにリダイレクト
        if ($owner != $user) {
            return redirect('/');
        }
    
        // ペットの飼育記録一覧を表示
        $managements = $pet->managements()->paginate(10);
        
        return view('managements.managements',[
            'pet' => $pet,
            'managements' => $managements,
        ]);
    }


    public function create($id)
    {
        // idからペットを検索して取得
        $pet = Pet::findOrFail($id);
        
        // ペットの飼い主のidを取得
        $owner = $pet->user_id;
        
        // ログイン済ユーザのidを取得
        $user = Auth::user()->id;
        
        // 飼い主とログイン済ユーザのidが一致しない場合、トップページにリダイレクト
        if ($owner != $user) {
            return redirect('/');
        }        
        
        // 飼育記録の新規登録ページへ
        $management = new Management;
        
        $pet = Pet::findOrFail($id);
        
        return view('managements.create', [
            'management' => $management,
            'pet' => $pet,
        ]);
    }
    
    
    public function store(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'record' => 'required',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i',
            'content' => 'max:255',
            'weight' => 'nullable|integer',
        ]);
        
        // 入力内容の登録処理
        $management = new Management;
        
        // idの値でペットを検索して取得
        $pet = Pet::findOrFail($id);
        
        $file = $request->file('image');
            
        // ファイルを変更した場合のみ変更を保存する
        if (!is_null($file)) {
                
            // アップロードしたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
                
            // s3のバケットURLを取得
            $file_path = Storage::disk('s3')->putFile('management_image', $file);
                
            // 取得したファイル名のまま保存
            $request->file('image')->storeAs('management_image', $file_name, 's3');
                
            // s3のバケットURLを取得してデータベースに登録内容を保存
            $management->image = Storage::disk('s3')->url($file_path);
        }
        
        
        /* ローカルストレージでファイルを保存する場合に使用
        $file = $request->file('image');
        
        if (!is_null($file)) {
            
            // ディレクトリ名
            $dir = "record_image";

            // アップロードしたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
        
            // 取得したファイル名のまま保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        
            // データベースに登録内容を保存
            $management->image = $file_name;
        } */
        

        // データベースに入力内容を保存
        $management->record = $request->record;
        $management->start_date = $request->start_date;
        $management->end_date = $request->end_date;
        $management->content = $request->content;
        $management->weight = $request->weight;
        $management->pet_id = $pet->id;
        $management->save();

        return redirect('/');
    }
    

    public function show($id)
    {
        // ペットに紐付く飼育記録を取得し表示
        $management = Management::findOrFail($id);
        
        // ペットを取得
        $pet = $management->pet;
        
        // ペットの飼い主のidえお取得
        $owner = $pet->user_id;
        
        // ログイン中のユーザを取得
        $user = Auth::id();
        
        // 飼育記録に紐付くペットの所有者と、ログイン中のユーザーが一致しない場合、トップページにリダイレクトする
        if ($owner !== $user) {
            return redirect('/');
        }
        
        return view('managements.show', [
            'management' => $management,
        ]);
    }
    

    public function edit($id)
    {
        // ペットに紐付く飼育記録を取得し表示
        $management = Management::findOrFail($id);
        
        // ペットを取得
        $pet = $management->pet;
        
        // ペットの飼い主のidえお取得
        $owner = $pet->user_id;
        
        // ログイン中のユーザを取得
        $user = Auth::id();
        
        // 飼育記録に紐付くペットの所有者と、ログイン中のユーザーが一致しない場合、トップページにリダイレクトする
        if ($owner !== $user) {
            return redirect('/');
        }
        
        return view('managements.edit', [
            'management' => $management,
        ]);
    }
    
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'record' => 'required|max:50',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i',
            'content' => 'max:255',
            'weight' => 'nullable|integer',
        ]);
        
        $management = Management::findOrFail($id);

        if (Pet::findOrFail($management->pet_id)) {
            
            $file = $request->file('image');
            
            // ファイルを変更した場合のみ変更を保存する
            if (!is_null($file)) {
                
                // アップロードしたファイル名を取得
                $file_name = $request->file('image')->getClientOriginalName();
                
                // s3のバケットURLを取得
                $file_path = Storage::disk('s3')->putFile('management_image', $file);
                
                // 取得したファイル名のまま保存
                $request->file('image')->storeAs('management_image', $file_name, 's3');
                
                // s3のバケットURLを取得してデータベースに編集内容を保存
                $management->image = Storage::disk('s3')->url($file_path);
            }
            
            /* ローカルストレージでファイルを保存する場合に使用
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
            } */
            

            // データベースに編集内容を保存
            $management->record = $request->record;
            $management->start_date = $request->start_date;
            $management->end_date = $request->end_date;
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
