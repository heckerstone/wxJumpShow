<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Article\Template\Tempalte1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Template
{
    private $article;

    private $logId;

    private $obj;

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
        $class = 'App\Http\Controllers\Article\Template\Tempalte' . $this->article['template_id'];
        $this->obj = new $class($this->article, $this->logId);
    }

    /**
     * 分配模板任务
     *
     * @return int
     */
    public function allot()
    {

        return $this->obj->getContent();
    }

    /**
     * 第一步
     *
     * @return mixed
     */
    public function set1()
    {
        return $this->obj->set1();
    }

    /**
     * 第二部
     *
     * @return mixed
     */
    public function set2()
    {
        return $this->obj->set2();
    }
}
