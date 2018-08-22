<?php

namespace App\Observers;

use App\Models\Link;
use Cache;

/**
 * 检测到模型修改成功后即刻清除缓存，取数据库的内容更新到资源推荐
 */
class LinkObserver
{
    //在保存时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}