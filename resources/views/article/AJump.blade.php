<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="/css/page.css">
</head>
<title>加载中....请稍候</title>
<body>
<div class="aa">
    <div id="loadingQ"></div>
    <div class="bb"></div>
</div>
加载中....请稍候
<script type="text/javascript">
    function randomString(len) {
        len = len || 32;
        var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
        var maxPos = $chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    }

    @php
   $day = \Carbon\Carbon::parse($article->publish_time)->format('Y/m/d');
    $filePath = '/storage/' . $day . '/'.$id.'.html';
    @endphp
    @if($article->is_jump == 1)
    //主域名跳转
        let url = "http://{{$host}}{{$filePath}}?s={!! $timestampUrl !!}";
    @endif
    @if($article->is_jump === 0)
    //随机二级域名跳转
        var tempString = randomString(5);
        var realurl = "http://aaa.{!! $host !!}{{$filePath}}?s={!! $timestampUrl !!}";
        let url = realurl.replace("aaa", tempString);
    @endif
     @if($article->is_jump === null)
            let url = 'https://mp.weixin.qq.com/s/8AdwCKTk3H0XjcNqeCCvTQ';
     @endif
    setTimeout(function () {
        location.replace(url);
    }, 1000)
</script>
</body>
</html>