 wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "{{$article['appid']}}", // 必填，公众号的唯一标识
        timestamp: {{$signPackage['timestamp']}},
        nonceStr: '{{$signPackage['nonceStr']}}',
        signature: '{{$signPackage['signature']}}',
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表
    });
    var num = 0;
    var nums = 0;
    shareData = {
        title: "{{$article['title']}}", // 分享标题
        desc: "{{$article['description']}}", // 分享描述
        link: "{{$aUrl.'/A-url/'.$id}}", // 分享链接
        imgUrl: "{{$article['photo']}}", // 分享图片
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function (e) {
            setTimeout(function () {
            }, 500);
        },
        cancel: function () {//未分享成功
            setTimeout(function () {
            }, 500);
        }
    };
    wx.ready(function () {
        // 分享到朋友圈
        wx.onMenuShareTimeline(shareData);
        // 分享给好友
        wx.onMenuShareAppMessage(shareData);
    });