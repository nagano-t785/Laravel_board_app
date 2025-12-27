<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        //最初のユーザーを取得（ログイン用）
        $user = User::first();

        //ユーザーが異なる場合、ログイン画面へ戻る
        if(!$user){
            return;
        }

        // 投稿データを作成(postsテーブルへINSERT)
        Post::create([
            'user_id' => $user->id,
            'content' => 'これはテスト投稿です。',
        ]);

        Post::create([
            'user_id' => $user->id,
            'content' => '2件目のテスト投稿です。',
        ]);

        Post::create([
            'user_id' => $user->id,
            'content' => '3件目のテスト投稿です。',
        ]);

        Post::create([
            'user_id' => $user->id,
            'content' => '4件目のテスト投稿です。',
        ]);

        Post::create([
            'user_id' => $user->id,
            'content' => '5件目のテスト投稿です。',
        ]);
    }
}
