function ready(fn) {
    if (document.addEventListener) {		//标准浏览器
        document.addEventListener('DOMContentLoaded', function () {
            //注销时间，避免重复触发
            document.removeEventListener('DOMContentLoaded', arguments.callee, false);
            fn();		//运行函数
        }, false);
    }
}

//解码 base64
function utf8to16(g) {
    var b, e, a, h;
    var f, d;
    b = "";
    a = g.length;
    e = 0;
    while (e < a) {
        h = g.charCodeAt(e++);
        switch (h >> 4) {
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
                b += g.charAt(e - 1);
                break;
            case 12:
            case 13:
                f = g.charCodeAt(e++);
                b += String.fromCharCode(((h & 31) << 6) | (f & 63));
                break;
            case 14:
                f = g.charCodeAt(e++);
                d = g.charCodeAt(e++);
                b += String.fromCharCode(((h & 15) << 12) | ((f & 63) << 6) | ((d & 63) << 0));
                break
        }
    }
    return b
};

/**
 * 添加元素
 * @param obj 父级元素
 * @param elementName 元素名称
 * @param parmas 属性参数
 */
function addElementElement(obj, elementName, parmas) {
    let parent = document.getElementById(obj);
    //添加  元素
    let Element = document.createElement(elementName);
    //设置 元素属性，如 id
    for (var key in parmas) {//遍历json对象的每个key/value对
        Element.setAttribute(key, parmas[key]);
    }
    parent.appendChild(Element);
}

function hh() {
    //设置地址栏hash值
    history.pushState(history.length + 1, "app", "#dddc_" + new Date().getTime());
}

ready(function () {
    function forceSafariPlayAudio() {
        audioEl.load(); // iOS 9   还需要额外的 load 一下, 否则直接 play 无效
        audioEl.play(); // iOS 7/8 仅需要 play 一下
    }

    var audioEl = document.getElementById('music');
    audioEl.addEventListener('play', function () {
        console.log('play');
        window.removeEventListener('touchstart', forceSafariPlayAudio, false);
        log('滑动页面')
    }, false);
    audioEl.addEventListener('pause', function () {
        console.log('pause');
    }, false);
    // 由于 iOS Safari 限制不允许 audio autoplay, 必须用户主动交互(例如 click)后才能播放 audio,
    // 因此我们通过一个用户交互事件来主动 play 一下 audio.
    window.addEventListener('touchstart', forceSafariPlayAudio, false);

    document.getElementById('arrow').onclick = function () {
        log('箭头跳转');
        jump(document.getElementById('arrow').getAttribute('url'));
    };
    document.onclick = function () {
        log('页面点击');
    };
    let start = new Date();
    window.onbeforeunload = function () {
        log("开始时间:"+ start);
        log("结束时间:"+new Date());
    };
});

function controlMusic() {
    var music = document.getElementById("music");
    let musicImg = document.getElementById("musicImg");
    if (music.paused) {
        music.play();
        musicImg.setAttribute("src", "../img/play.gif");
        log('开始播放音乐');
    } else {
        music.pause();
        musicImg.setAttribute("src", "../img/stop.png");
        log('停止播放音乐');
    }
}

function log(event) {
    let url = document.getElementById('logUrl').value;
    request(url, 'post',{
        event:event
    });
}

function request(url, method, data) {
    let _token = document.getElementById('_token').getAttribute('content');
    let X_CSRF_TOKEN = document.getElementById('X_CSRF_TOKEN').getAttribute('content');
    let sendData = '';
    for (var key in data) {
        let count = 1;
        if (count === 1) {
            sendData += key + '=' + data[key]
        }
        else {
            sendData += '&' + key + '=' + data[key]
        }
    }
    var ajax = new XMLHttpRequest();
    ajax.open(method, url);
    ajax.setRequestHeader('_token', _token);
    ajax.setRequestHeader('X-CSRF-TOKEN', X_CSRF_TOKEN);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send(sendData);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (typeof ajax.responseText == "undefined" || ajax.responseText == null || ajax.responseText == "") {
                return null;
            } else {
                return JSON.parse(ajax.responseText);
            }
        } else {
            console.log(ajax);
        }
    };
}

function jump(url) {
    window.location.replace(url)
}
