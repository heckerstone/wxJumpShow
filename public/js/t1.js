window.onload = function () {
    $(".like-push span").click(function () {
        var _next = $(this).next("i");
        if ($(this).hasClass("like-full")) {
            $(this).removeClass("like-full").addClass("like");
            _next.text(parseInt(_next.text()) - 1);
        }
        else {
            $(this).removeClass("like").addClass("like-full");
            _next.text(parseInt(_next.text()) + 1);
        }
    });
};
window.addEventListener("popstate", function (e) {
    location.href = $(".callback").val();
});

function pushHistory() {
    var state = {
        title: "title",
        url: "#"
    };
    window.history.pushState(state, "title", "#");
}

function play_music() {
    if ($('#mc_play').hasClass('on')) {
        $('#mc_play audio').get(0).pause();
        $('#mc_play').attr('class', 'stop');
    } else {
        $('#mc_play audio').get(0).play();
        $('#mc_play').attr('class', 'on');
    }
    $('#music_play_filter').hide();
    event.stopPropagation();
}

// 音乐播放
function autoPlayMusic() {
    // 自动播放音乐效果，解决浏览器或者APP自动播放问题
    function musicInBrowserHandler() {
        musicPlay(true);
        document.body.removeEventListener('touchstart', musicInBrowserHandler);
    }

    document.body.addEventListener('touchstart', musicInBrowserHandler);

    // 自动播放音乐效果，解决微信自动播放问题
    function musicInWeixinHandler() {
        musicPlay(true);
        document.addEventListener("WeixinJSBridgeReady", function () {
            musicPlay(true);
        }, false);
        document.removeEventListener('DOMContentLoaded', musicInWeixinHandler);
    }

    document.addEventListener('DOMContentLoaded', musicInWeixinHandler);
}

function musicPlay(isPlay) {
    var media = document.querySelector('#musicfx');
    if (isPlay && media.paused) {
        media.play();
    }
    if (!isPlay && !media.paused) {
        media.pause();
    }
}
