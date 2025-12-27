<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            // user_id を削除（外部キーがある場合）
            if (Schema::hasColumn('posts', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            // content → contents
            if (Schema::hasColumn('posts', 'content')) {
                $table->renameColumn('content', 'contents');
            }

            // user_name 追加
            if (!Schema::hasColumn('posts', 'user_name')) {
                $table->string('user_name');
            }
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('content');
            $table->dropColumn('contents');
            $table->dropColumn('user_name');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
