<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // ユーザー登録に必要な「入力許可カラム」を設定
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    // レスポンスなどで隠すべき属性
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // パスワードやメール認証日時の型変換設定
    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 「1人のユーザーが多数の投稿を持つ」というリレーション関係を設定
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
