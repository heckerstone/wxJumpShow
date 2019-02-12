@if($status == 'show')
<div class="decorate">
    @if(!empty($article['music']))
        <div class="play">
        <audio id="music"
               src="{{$article['music']}}"
               autoplay="autoplay"
               loop="loop">
        </audio>
        <img id="musicImg" onclick="controlMusic();"
             style="width:35px!important;height:35px!important;"
             src="/img/play.gif"
             alt="">
    </div>
    @endif
    @if(!empty($article['arrow']))
        <div class="back">
        <img id="arrow"
             src="/img/arrow.png" alt=""
             style="width:35px!important;height:35px!important;"
             url="{{$article['arrow']}}"
        >
    </div>
    @endif
</div>
@endif
<div id="container">
    {!! $content !!}
</div>