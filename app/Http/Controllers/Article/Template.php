<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Article\Template\Tempalte1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Template
{
    private $article;

    private $logId;

    /**
     * 设置文章内容
     *
     * Template constructor.
     * @param $article
     */
    public function __construct($article, $logId)
    {
        $this->article = $article;
        $this->logId = $logId;
    }
    /**
     * 分配模板任务
     *
     * @return int
     */
    public function allot()
    {
        $class = 'App\Http\Controllers\Article\Template\Tempalte'.$this->article->template_id;
        return (new $class($this->article, $this->logId))->getContent();
    }
}
