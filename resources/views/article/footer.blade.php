<div style="display: none">
    <input type="text" id="logUrl" name="logUrl" value="{{url('updateEvent', $logId)}}">
    {{--统计代码--}}
    {!! $article['cnzz'] !!}
</div>
<script>
    ready(function () {
        hh();
                @if($article['appid'] != '' && $article['key'] != '')
                    @php
                        $jssdk = new \App\Http\Controllers\WeixinJssdkController();
                        $jssdk->seter($article['appid'],$article['key']);
                        $signPackage = $jssdk->GetSignPackage();
                    @endphp
                    @include('article.jsParts.wxShare')
                @endif
                @if($article['is_encryption'] == 1)
                    @if($status == 'show' && $article['iframe'] != 1)
                        var html = document.getElementById('container').innerHTML;
                        document.getElementById('container').innerHTML =  utf8to16(atob(html));
                    @endif
                    @if($status == 'iframe')
                    var html = document.getElementById('container').innerHTML;
                    document.getElementById('container').innerHTML =  utf8to16(atob(html));
                    @endif
                @endif
    });
</script>
<script>
    window.onhashchange = function () {
        //物理按键点击了返回
        location.replace("{{$article['physics']}}");
    };
</script>
</body>
</html>