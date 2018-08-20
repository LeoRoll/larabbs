<?php

use App\Models\Topic;

return [
    'title' =>  '话题管理',
    'heading' =>  '话题管理',
    'single' => '话题',
    'model' => Topic::class,
    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'title' => [
            'title' => '标题',
        ],
        'body' => [
            'title' => '话题内容',
        ],
        'reply_count' => [
            'title' => '话题评论数',
        ],
        'created_at' =>[
            'title' => '创建时间',
        ],
        'operation' => [
            'title'  => '管理',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title' => '标题',
            'type' => 'text'
        ],
        'body' => [
            'title' => '话题内容',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title' => '话题',
        ],
        'body' => [
            'title' => '话题内容',
        ],
    ],
];