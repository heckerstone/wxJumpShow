<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}" />
    <meta id="X_CSRF_TOKEN" name="X-CSRF-TOKEN" content="{{ csrf_token() }}" />
    <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no"/>
    <script src="/js/article.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">

        @if(!empty($result['physics']))
            window.onhashchange = function () {
                jump("{{$article['physics']}}");
            };
            function hh() {
                history.pushState(history.length + 1, "app", "#dddc_" + new Date().getTime());
            }
            hh();
        @endif

        @if($article['appid'] != '' && $article['key'] != '')
            @php
                $jssdk = new \App\Http\Controllers\WeixinJssdkController();
                $jssdk->seter($article['appid'], $article['key']);
                $signPackage = $jssdk->GetSignPackage();
            @endphp
            @include('article.jsParts.wxShare')
        @endif
        window.addEventListener('load', function () {
            setTimeout(function () {
                var html = document.getElementById('encrypt_content').innerHTML;
                html = utf8to16(atob(html));
                var newDoc = document.open("text/html", "replace");
                newDoc.write(html);
            }, 100);
        });</script>
</head>
<body>
<p style="text-align:center">loading...</p>
<script type="text/template" id="encrypt_content">
        {!! $result !!}
</script>
</body>
</html>
