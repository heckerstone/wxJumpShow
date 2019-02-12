<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IframeController extends Controller
{
    private $article;
    public function index($id)
    {
        $article = DB::table('articles')
            ->where('id', $id)
            ->first();
        $this->article = $article;
        $aUrl = $this->randomAUrl($article->user_id);
        if ($article->is_encryption == 1) { //加密文章
            $content = $this->encryptionArticle($article);
        }
        if ($article->is_encryption == 0) { //使用vue架构
            $content = $this->vue($article);
        }
        $logId = $this->visitLog();
        return view('article.main', [
            'article' => (array)$article,
            'content' => $content ?? $article['content'],
            'aUrl' => $aUrl,
            'id' => $id,
            'logId' => $logId,
            'status' => 'iframe'
        ]);
    }
    /**
     * 访问记录
     */
    public function visitLog()
    {
        return DB::table('visit_logs')->where(
            'ip',\request()->getClientIp()
        )->orderByDesc('id')->first()->id;
    }

    /**
     * 随机取一个B链接
     *
     * @param $userId
     * @return mixed
     */
    public function randomBUrl($userId)
    {
        $bUrl = 1;
        return DB::table('urls')
            ->where('user_id', $userId)
            ->where('type', $bUrl)
            ->inRandomOrder()
            ->first()
            ->url;
    }

    /**
     * 随机取一个A链接
     *
     * @param $userId
     * @return mixed
     */
    public function randomAUrl($userId)
    {
            $aUrl = 0;
            return DB::table('urls')
                ->where('user_id', $userId)
                ->where('type', $aUrl)
                ->inRandomOrder()
                ->first()
                ->url;
    }

    /**
     * 加密文章视图
     *
     * @param $article
     * @return string
     */
    public function encryptionArticle($article)
    {
        $rand_str = $this->randStr();
        $encryptionArticle = view('article/jsParts/encryptionArticle', [
            'result' => $rand_str,
            'article' => (array)$article,
        ]);
        return base64_encode($encryptionArticle);
    }

    /**
     * 使用vue
     *
     * @param $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function vue($article)
    {
        return view('article.jsParts.vue');
    }

    /**
     * 生成随机字符串
     *
     * @return array
     */
    public function randStr()
    {
        //随机生成字
        $result = [];
        $rand_str = [];
        for ($i = 0; $i <= 100; $i++) {
            if (count($result) < 50) {
                $result[] = md5(uniqid());
            } else {
                $rand_str[] = md5(uniqid());
            }
        }
        return [$result, $rand_str];
    }
}
