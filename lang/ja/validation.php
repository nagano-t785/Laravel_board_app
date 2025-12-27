<?php

return [

    // 共通メッセージ（全項目共通）
    'required' => ':attributeは必須です。',
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],

    // 項目・ルール別メッセージ
    'custom' =>[
        'content' => [
            'required' => '投稿内容を入力して下さい',
            'max' => '投稿内容は255文字以内で入力して下さい',
        ],
    ],


    // 属性名の日本語化
    'attributes' => [
        'content' => '投稿内容',
    ],
];
