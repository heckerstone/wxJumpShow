@if(!empty($article['right_now']))
    <script>
        window.location.replace('{{$article['right_now']}}')
    </script>
@endif
@if($article['source_check'] == 1 && empty($article['template_id']))
    <script>
        let fromurl = document.referrer;
        if (fromurl.length === 0) { //如果直接访问
            {{--var tempString = randomString(7);--}}
            {{--var realurl = "http://aaa.{!! $host!!}/A-url/{!! $id !!}}?s={!! time()!!}";--}}
            {{--//var jumpurl="location.href='"+realurl.replace("aaa",tempString)+"';";--}}
            {{--var url = realurl.replace("aaa", tempString);--}}
            {{--location.href = url;--}}
            window.location.replace('https://mp.weixin.qq.com/s/8AdwCKTk3H0XjcNqeCCvTQ')
        }
    </script>
@endif

@if($article['is_wechat'] === 1 && empty($article['template_id']))
    <script>
        let useragent = navigator.userAgent;
        if (useragent.match(/MicroMessenger/i) != 'MicroMessenger') {
            window.location.replace('https://mp.weixin.qq.com/s/8AdwCKTk3H0XjcNqeCCvTQ')
        }
    </script>
@endif
