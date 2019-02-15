<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base target="_blank">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}" />
    <meta id="X_CSRF_TOKEN" name="X-CSRF-TOKEN" content="{{ csrf_token() }}" />
    <title id="title"></title>
</head>
<body style="margin:0px auto;width:100%;max-width:685px;">
<style>
    .share_btn {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
        position: fixed;
        border-radius: 30px;
        background-color: rgba(0, 0, 0, 0.5);
        border: 2px solid #fff;
        display: flex;
        align-items:: center;
        justify-content: center;
        text-align: center;
        color: #fff;
    }

    .share_view_bg {
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        position: fixed;
        display: flex;
        align-items:: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .share_span {
        width: 100%;
        height: 100%;
        display: flex;
        padding-top: 13px;
        align-items:: center;
        justify-content: center;
        text-align: center;
    }

    .share_image {
        margin-top: 2.5%;
        width: 100%;
    }



    .div1 {
        width: 30px;
        height: 30px;
        top: 20px;
        right: 20px;
        position: fixed;
        animation: myrotate 1.2s linear infinite;
        -webkit-animation: myrotate 2s linear infinite;
        border-radius: 15px;
    }

    @keyframes myrotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes myrotate {
        from {
            -webkit-transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    .div2 {
        width: 30px;
        height: 30px;
        top: 20px;
        right: 20px;
        position: fixed;
        border-radius: 15px;
    }

    .div3 {
        width: 30px;
        height: 30px;
        top: 20px;
        left: 20px;
        position: fixed;
        border-radius: 15px;
    }

    .item_wrap img {
        float: left;
        margin: 0 0px 0px 0;
        width: 100%;
        float: none;
    }

    .bottom_view {
        padding: 20px;
        display: flex;
        align-items:: center;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .complain_btn {
        height: 30px;
        font-size: 12px;
        color: #888;
    }

    * {
        font-family: open sans, Helvetica Neue, Helvetica, Arial, sans-serif;
        padding: 0;
        margin: 0
    }

    body, html {
        width: 100%;
        height: 100%
    }

    body > a {
        display: none;
    }

    @-webkit-keyframes change {
        0% {
            -webkit-transform: rotate(0deg);
        }
        50% {
            -webkit-transform: rotate(180deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }
</style>


<input type="hidden" id="url" value="{{url('ajax/'.$id)}}">
<input type="hidden" type="text" id="logUrl" name="logUrl" value="{{url('updateEvent', $logId)}}">

<div class="item_wrap rel" style="padding:0px;">
    <ul style="list-style-type:none;">
        @if(!empty($article->music))
            <div id="fhui"></div>
        @endif
        <div class="mains" style="overflow:hidden;height:1px;">
            @foreach($result[0] as $item)
                <p>{{$item}}</p>
            @endforeach
        </div>
        <li class="i_pri" style="text-align:center;" style="margin:-25px 0px 0px 0px;">
            <div id="audio"></div>
            <div id="divId"></div>
            <div id="bottomFixedContent"></div>
        </li>
    </ul>

    <div class="divider"
         style="overflow: hidden;
         height: 1px;
         margin: 9px 0;
         background-color: #e5e5e5;
         margin-top: 18px;">
    </div>
    <div id="js_toobar"
         style="padding-top:10px;
         margin-left: 10px;
         color: #8c8c8c;
         line-height: 32px;
         font-size: 17px;
         height: 32px;
         float: left;
         width:80%;">
    </div>
    <div style="margin-right: 10px;padding-top:10px;float: right;height: 42px;">
        <a style="
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        color: #607fa6;
        text-decoration: none;
        font-size:20px;"
        href="javascript: clickJB();">
        </a>
    </div>
</div>
<div class="mains" style="display:none;">
    @foreach($result[1] as $item1)
        <p>{{$item1}}</p>
    @endforeach
</div>
<div id="dibu"></div>
<div style="display:none;">
    @foreach($result[0] as $item0)
        <p>{{$item0}}</p>
    @endforeach
</div>
<div>
    <a style="-webkit-tap-highlight-color: rgba(0,0,0,0);color:
    #607fa6;text-decoration: none;font-size:20px;" href="javascript: clickJB();">
        举报
    </a>
</div>
<script>
    getArticle();
    document.addEventListener("WeixinJSBridgeReady", function () {
        document.getElementById("music").play();
    }, false);

    function clickJB()
    {
        jump("{{url('/report')}}");
    }

</script>

<div id="total" style="display:none;"></div>
<script src='/js/article.js'></script>
</body>
</html>