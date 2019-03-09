<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="telephone=no" name="format-detection">
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}" />
    <meta id="X_CSRF_TOKEN" name="X-CSRF-TOKEN" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    @include('article.jsParts.previous')
    @if(!empty($result['physics']))
        <script>
            window.onhashchange = function () {
                jump("{{$result['physics']}}");
            };
            function hh() {
                history.pushState(history.length + 1, "app", "#dddc_" + new Date().getTime());
            }
            hh();
        </script>
    @endif
    <script type="text/javascript">
        document.writeln("<title>今日快讯</title>");
        document.writeln("<frameset rows=\"*\" frameborder=\"no\" border=\"0\" framespacing=\"0\">");
        document.writeln("<frame src=\"http://{{$url}}\" name=\"mainFrame\" id=\"mainFrame\" />");
        setTimeout(function () {
            document.title = "{{$result['title']}}"
        }, 2000)
    </script>
<body>
</body>
</html>