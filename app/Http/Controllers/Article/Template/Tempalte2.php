<?php
/**
 * Created by PhpStorm.
 * User: ALG
 * Date: 2019/3/21 0021
 * Time: 22:35
 */

namespace App\Http\Controllers\Article\Template;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Tempalte2
{
    private $article;

    public function __construct($article)
    {
        $this->article = $article;
    }

    //
    public function getContent()
    {
        $is_get = request()->isMethod('get');
        if ($is_get == true) {
            //第一次访问
            return $this->form();
        } else {
            //post提交再次返回
            return $this->content();
        }
    }

    /**
     * form 表单
     *
     * @return string
     */
    public function form()
    {
        $url = $this->randomBUrl();
        return view('article.template.form_jump.form', [
            'url' => $url . '/form/' . $this->article['id'], //B链接
        ]);
    }

    /**
     * 获得内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function content()
    {
        return view('article.template.form_jump.content', [
            'id' => $this->article['id'],
            'article' => $this->article,
        ]);
    }

    /**
     * 随机取一个B链接
     *
     * @return mixed
     */
    private function randomBUrl()
    {
        $aUrl = 1;
        return DB::connection('mysql_data')->table('urls')
            ->where('user_id', $this->article['user_id'])
            ->where('type', $aUrl)
            ->inRandomOrder()
            ->first()
            ->url;
    }
}