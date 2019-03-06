<?php

namespace App\Http\Controllers\Article\Template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 异步加载文章,加密 外联网页
 *
 * Class Tempalte1
 * @package App\Http\Controllers\Article\Template
 */
class Tempalte1
{
    private $article;
    private $logId;

    public function __construct($article, $logId)
    {
        $this->article = $article;
        $this->logId = $logId;
    }
    //
    public function getContent()
    {
        $normal = \request()->get('normal', null);
        if (empty($normal)) {
            //第一次访问
            return $this->set1();
        }else {
            //外联网页再次加载
            return $this->set2();
        }

    }

    public function set1()
    {
        $url =  $this->randomBUrl();
        return view('article.template.fram_encryp_ajax.mainRead', [
            'result' => $this->article, //文章内容
            'article' => (array)$this->article, //文章内容
            'url'=> $url.'/storage/'.date('Y/m/d').'/'.$this->article->id.'set2.html', //B链接
            'id'=>$this->article->id, //文章Id
        ]);
    }

    public function set2()
    {
        $rand_str = $this->rand_str();
        $str = view('article.template.fram_encryp_ajax.test2',[
            'result'=>$rand_str,
            'id'=>$this->article->id,
            'logId'=> $this->logId,
            'article'=> $this->article,
        ]);
        $str1 = view('article.template.fram_encryp_ajax.test', [
            'result' => base64_encode($str),
            'article'=>$this->article
        ]);
        return view('article.template.fram_encryp_ajax.Read', [
            'result' => $str1
        ]);
    }

    /**
     * 随机生成文字
     *
     * @return array
     */
    private function rand_str()
    {
        //随机生成字
        $result = [];
        $rand_str = [];
        for ($i = 0; $i <= 100; $i++) {
            if (count($result) < 50) {
                $result[] = md5(uniqid());
            }else {
                $rand_str[] = md5(uniqid());
            }
        }
        return [$result, $rand_str];
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
            ->where('user_id', $this->article->user_id)
            ->where('type', $aUrl)
            ->inRandomOrder()
            ->first()
            ->url;
    }
}
