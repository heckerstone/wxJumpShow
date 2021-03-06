<?php
/**
 * Created by PhpStorm.
 * User: ALG
 * Date: 2019/3/6 0006
 * Time: 20:21
 */

namespace App\Http\Controllers\CacheFile;

use App\Http\Controllers\Article\Template;
use App\Http\Controllers\Controller;
use App\Http\Controllers\IframeController;
use App\Models\LongRangeArticle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CacheFileController extends Controller
{
    private $article;

    public function index($id, Request $request)
    {
        $type = $request->get('type');
        if (is_null($type)) {
            return response('123');
        }
        $this->article = LongRangeArticle::query()->find($id)->toArray();
        $day = Carbon::parse($this->article['publish_time'])->format('Y/m/d');
        $filePath = '/public/' . $day . '/';
        $field = [];

        foreach ($this->article as $k => $value) {
            $field[$k] = $value;
        }
        if ($type == 'add') {
            DB::connection('mysql')->table('articles')->insert($field);
        }
        if ($type == 'update') {
            DB::connection('mysql')->table('articles')
                ->where('id', $field['id'])->update($field);
        }
        if ($type == 'delete') {
            DB::connection('mysql')
                ->table('articles')
                ->delete($field['id']);
            Storage::delete('/public/' . date('/Y/m/d') . '/' . $id . '.html');
            Storage::delete('/public/' . date('/Y/m/d') . '/' . $id . 'set2.html');
            Storage::delete('/public/' . date('/Y/m/d') . '/' . $id . 'ifra.html');
            return response()->json(['code' => 0]);
        }
        //日志记录
        $logId = $this->visitLog();

        if (!empty($this->article['template_id'])) {
            $class = 'App\Http\Controllers\Article\Template\Tempalte' . $this->article['template_id'];
            $obj = new $class($this->article, $logId);
            $set1 = $obj->set1();
            $set2 = $obj->set2();
            $set1View = Storage::put($filePath . $id . '.html', $set1);
            $set2View = Storage::put($filePath . $id . 'set2.html', $set2);
            if ($set1View && $set2View) {
                return response()->json(['code' => 0], 200);
            }
        }

        $aUrl = $this->randomAUrl($this->article['user_id']);
        if ($this->article['is_encryption'] === 1) { //加密文章
            $content = $this->encryptionArticle();
        }
        if ($this->article['is_encryption'] === 0) { //使用vue架构
            $content = $this->vue();
        }
        if ($this->article['is_encryption'] === 2) { //异步加载内容
            $content = $this->ajax();
        }
        if ($this->article['is_encryption'] === null) {

            $content = $this->article['content'];
        }
        if ($this->article['iframe'] == 1) { //使用嵌套网页
            $content = $this->iframe();
        }

        $view = view('article.main', [
            'article' => (array)$this->article,
            'content' => $content,
            'aUrl' => $aUrl,
            'id' => $id,
            'logId' => $logId,
            'status' => 'show'
        ]);
        $ifra = new IframeController();
        $ifraView = $ifra->index($id);

        $res = Storage::put($filePath . $id . '.html', response($view)->getContent());
        $ifraT = Storage::put($filePath . $id . 'ifra.html', response($ifraView)->getContent());
        if ($res && $ifraT) {
            return response()->json(['code' => 0], 200);
        }

    }

    public function visitLog()
    {
        return DB::connection('mysql')->table('visit_logs')->insertGetId([
            'ip' => \request()->getClientIp(),
            'event' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'system_type' => request()->header()['user-agent'][0],
        ]);
    }

    /**
     * 随机取一个A链接
     *
     * @param $userId
     *
     * @return mixed
     */
    public function randomAUrl($userId)
    {
        $aUrl = 0;
        return DB::connection('mysql_data')->table('urls')
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
     *
     * @return mixed
     */
    public function randomBUrl($userId)
    {
        $bUrl = 1;
        return DB::connection('mysql_data')->table('urls')
            ->where('user_id', $userId)
            ->where('type', $bUrl)
            ->inRandomOrder()
            ->first()
            ->url;
    }

    /**
     * 加密文章视图
     *
     * @return string
     */
    public function encryptionArticle()
    {
        $rand_str = $this->randStr();
        $encryptionArticle = view('article/jsParts/encryptionArticle', [
            'result' => $rand_str,
            'article' => (array)$this->article,
        ]);
        return base64_encode(response($encryptionArticle)->getContent());
    }

    /**
     * 使用vue
     *
     * @return \Illuminate\Contracts\View\Factory|View|string
     */
    public function vue()
    {
        return response(view('article.jsParts.vue'))->getContent();
    }

    /**
     * 嵌套网页
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function iframe()
    {
        $bUrl = $this->randomBUrl($this->article['user_id']);

        $articleId = $this->article['id'];
        $day = Carbon::parse($this->article['publish_time'])->format('Y/m/d');
        $filePath = '/storage/' . $day . '/';
        $view = view('article.jsParts.frame', [
            'url' => $bUrl . $filePath . $articleId . 'ifra.html',
            //"http://阿萨德/frame/52",
            'articleId' => $articleId,
        ]);
        return response($view)->getContent();
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
     * 异步加载文章
     *
     * @return \Illuminate\Contracts\View\Factory|View|string
     */
    public function ajax()
    {
        $view = view('article.jsParts.AjaxArticle', [
            'articleId' => $this->article['id'],
            'url' => url('getArticle') . '/' . $this->article['id']
        ]);
        return response($view)->getContent();
    }
}