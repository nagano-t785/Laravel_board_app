<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// 掲示板（Post）に関する"すべての司令塔"
class PostController extends Controller{

    //★投稿一覧＋検索
    public function index(Request $request){

        //検索キーワードを取得（trim=前後の空白は削除）
        $keyword = trim($request->input('keyword'));

        // 投稿一覧を取得
        $posts = Post::query()

        //キーワードが入力された時だけ、検索条件を追加
        // 空欄だった場合は投稿内容を全て表示
            ->when($keyword !=='', function ($query) use ($keyword) {
                $query->where('contents', 'LIKE', "%{$keyword}%");
            })
            //新しい順番に並び替え
            ->orderBy('created_at','desc')
            //データを取得
            ->get();

        //画面にデータを取得
        return view('posts.index', compact('posts', 'keyword'));
        }


    //★新規投稿
    public function store(Request $request){
        $request->validate([
            // 空欄チェック＋文字数制限（最大100文字まで）
            'content' => [

                // 空欄禁止
                'required',

                // 文字列のみ
                'string',

                // 入力可能文字数（100文字以内）
                'max:100',

                // 空白のみ禁止
                'regex:/\S/'
            ],
        ]);

        try{
        Post::create([
                // ログインユーザー名を自動セット
                'user_name' => auth()->user()->name,
                // 投稿内容をDBに保存
                'contents' => $request -> content,

            // try-catchテスト用
            // 'user_name' => null,
            // 'contents' => $request->content,
            ]);

            // 成功した場合
            return redirect()
                ->route('posts.index')
                ->with('success','新規投稿しました');

            } catch(\Exception $e) {

            // 失敗時（DBエラーなど）
            return redirect()
                ->route('posts.index')
                ->with('save_error','新規投稿に失敗しました');

            }
        }

    //★編集画面表示
    // URL:posts/{post}/editから投稿データを取り出し、$postへ格納する
    public function edit(Post $post){
        return view('posts.edit',compact('post'));
    }


    //★更新
    public function update(Request $request,Post $post){
        $request->validate([
            'content' => [

                // 空欄禁止
                'required',

                // 文字列のみ
                'string',

                // 入力可能文字数（100文字以内）
                'max:100',

                // 空白のみ禁止
                'regex:/\S/'
            ],
        ]);

        try{
            $post->update([
                'contents' => $request->content,
                // try-catchのテスト用
                // 'user_name' => null,
            ]);

            // 成功時
            return redirect()
            ->route('posts.index')
            ->with('success','投稿内容を更新しました');
        } catch(\Exception $e) {

            // 失敗時
            return redirect()
            ->route('posts.index')
            ->with('update_error','更新に失敗しました');
        }
    }

    // 削除
    public function destroy(Post $post){

        try{
            // try-catchのテスト用
            // throw new \Exception('削除テスト');

            // 該当投稿を削除
            $post->delete();

            // 成功時
            return redirect()
            ->route('posts.index')
            ->with('success','投稿内容を削除しました');

        } catch(\Exception $e){

            // 失敗時
            return redirect()
                ->route('posts.index')
                ->with('delete_error','削除に失敗しました');
        }
    }
}
