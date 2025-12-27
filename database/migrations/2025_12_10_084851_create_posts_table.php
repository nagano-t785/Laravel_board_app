<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{

        //postsテーブルの作成
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable(false);
            $table->string('content',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

//$table->foreignID('user_id'):postテーブルに「どのユーザーの投稿か」を表す数字を入れるuser_idカラムを作成する
//->constrained():usersテーブルのidを参照する外部キーを作成して、user_idカラムにインデックスを付ける
//->onDelete('cascade'):ユーザーが削除されたら、その人の投稿(post)も自動で削除される
