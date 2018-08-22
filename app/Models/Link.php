<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Link extends Model
{
    protected $fillable = ['title', 'link'];

    public $cache_key = 'laravel_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
        //尝试从缓存中取出chche_key 对应的数据。如果能取到，边立即返回数据。
        //否则运行匿名函数中的代码来取出 links 表中所有的数据，返回的同时做了缓存。
        return Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function(){
            return $this->all();
        });
    }
}
