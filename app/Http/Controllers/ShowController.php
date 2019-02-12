<?php

namespace App\Http\Controllers;

use App\Exceptions\SourceCheckException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class ShowController extends Controller
{
    private $article;

    /**
     * 文章展示处理
     *
     * @param $id
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     * @throws SourceCheckException
     */
    public function index($id, Request $request)
    {
        $this->article = DB::table('articles')
            ->find($id);
        //来源检测
        $this->previous($request);
        //改自增的字段值进行自增
        $this->increment($this->article->id);
        //日志记录
        $logId = $this->visitLog();
        $aUrl = $this->randomAUrl($this->article->user_id);
        if (!empty($this->article->right_now)) { //立即跳转
            return redirect($this->article->right_now);
        }
        if ($this->article->is_encryption == 1) { //加密文章
            $content = $this->encryptionArticle();
        }
        if ($this->article->is_encryption === 0) { //使用vue架构
            $content = $this->vue();
        }
        if ($this->article->iframe == 1) { //使用嵌套网页
            $content = $this->iframe();
        }
        if ($this->article->is_encryption == 2) { //异步加载内容
            $content = $this->ajax();
        }
        return view('article.main', [
            'article' => (array)$this->article,
            'content' => $content ?? $this->article->content,
            'aUrl' => $aUrl,
            'id' => $id,
            'logId' => $logId,
            'status' => 'show'
        ]);
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
     * 加密文章视图
     * @return string
     */
    public function encryptionArticle()
    {
        $rand_str = $this->randStr();
        $encryptionArticle = view('article/jsParts/encryptionArticle', [
            'result' => $rand_str,
            'article' => (array)$this->article,
        ]);
        return base64_encode($encryptionArticle);
    }

    /**
     * 使用vue
     *
     * @return \Illuminate\Contracts\View\Factory|View|string
     */
    public function vue()
    {
        return view('article.jsParts.vue');
    }

    /**
     * 嵌套网页
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function iframe()
    {
        $bUrl = $this->randomBUrl($this->article->user_id);
        $articleId = $this->article->id;
        return view('article.jsParts.frame', [
            'url' => $bUrl,
            'articleId' => $articleId,
        ]);
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

    /**
     * 获得文章内容
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticle($id)
    {
        $this->article = DB::table('articles')
            ->where('id', $id)
            ->first();
        return response()->json($this->article);
    }

    /**
     * 字段值进行自增
     *
     * @param $articleId
     */
    public function increment($articleId)
    {
        DB::table('articles')
            ->where('id', $articleId)
            ->increment('click');
        $url = parse_url(URL::current())['host'];
        $domain = explode('.', $url);
        $com = array_pop($domain);
        $mani = array_pop($domain);
        DB::table('urls')
            ->where('url', $mani . '.' . $com)
            ->increment('click');
    }

    /**
     * 来源检测
     *
     * @throws SourceCheckException
     */
    public function previous($request)
    {
        if ($this->article->source_check == 1) {
            $previous = URL::previous();
            $path = parse_url($previous)['path'];
            $result = strpos($path, 'A-url');
            if ($result === false) {
                throw new SourceCheckException();
            }
        }
        if ($this->article->is_wechat === 1) { //是否为微信浏览器
            $userAgent = $request->header('user-agent');
            if (strpos($userAgent, 'MicroMessenger') === false) {
                throw new SourceCheckException();
            }
        }

//        if ($this->article->is_wechat === 0) {  //跳转出浏览器打开
//            $userAgent = $request->header('user-agent');
//            if (strpos($userAgent, 'MicroMessenger') !== false) { //如果当前在微信环境中给出下载头
//                header("Content-type:application/pdf");
//                header("Content-Disposition:attachment;filename='downloaded.pdf'");
//            }
//// else {
////                if (empty($request->get('one'))) { //防止重复跳转
////                    header('location:'.URL::current().'?one=1');
////                }
////            }
//        }
    }

    /**
     * 异步加载文章
     *
     * @return \Illuminate\Contracts\View\Factory|View|string
     */
    public function ajax()
    {
        return view('article.jsParts.AjaxArticle', [
            'articleId' => $this->article->id
        ]);
    }

    /**
     * 访问记录
     */
    public function visitLog()
    {
        return DB::table('visit_logs')->insertGetId([
            'ip' => \request()->getClientIp(),
            'event' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'system_type' => request()->header()['user-agent'][0],
        ]);
    }

    /**
     * 更新状态
     *
     * @param $id
     */
    public function updateEvent($id)
    {
        $log = DB::table('visit_logs')
            ->where('id', $id)
            ->first();
        $event = \request()->get('event');

        DB::table('visit_logs')
            ->where('id', $id)->update([
                'event'=>"{$log->event},{$event}"
         ]);
    }
}
