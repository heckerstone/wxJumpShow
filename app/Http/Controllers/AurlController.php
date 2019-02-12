<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AurlController extends Controller
{
    public function index($id)
    {
        $article = DB::table('articles')
            ->where('id', $id)
            ->first();
        if (!empty($article->right_now)) { //立即跳转
            return redirect($article->right_now);
        }
        $bUrl = 1;
        $url = DB::table('urls')
            ->where('user_id', $article->user_id)
            ->where('type', $bUrl)
            ->inRandomOrder()
            ->first()
            ->url;
        return view('article.AJump', [
            'host' => $url,
            'id' => $id,
            'timestampUrl' => time(),
            'article' => $article
        ]);
    }
}
