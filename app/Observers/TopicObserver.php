<?php

namespace App\Observers;

use App\Models\Topic;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{

    public function saving(Topic $topic)
    {
        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

        // 如果 slug 字段无内容，即使用翻译器对 title 进行翻译
        // if ( ! $topic->slug) {
            //原有方法，有可能会因为网络原因引起用户链接翻译缓慢相应速度慢的问题
            // $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
            //新方法采用队列分发，后台运行，更佳优化
            //推送任务队列
            // dispatch(new TranslateSlug($topic));
        // }
        //因为在saving的时候，此时传参的$topic变量还未在数据库里创建，所以$topic->id取不到id值，故horizon和数据库失败报错id=null
        //故更改分发时机，放到saved方法里去
    }

    public function saved(Topic $topic)
    {
        // 如果 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {
            //原有方法，有可能会因为网络原因引起用户链接翻译缓慢相应速度慢的问题
            // $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
            //新方法采用队列分发，后台运行，更佳优化
            //推送任务队列
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}