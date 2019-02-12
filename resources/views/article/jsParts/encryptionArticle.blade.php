<div style="display: none;">
    @foreach($result[0] as $item)
        <p>{{$item}}</p>
    @endforeach
</div>
<div style="max-width: 100%;
    width: 100%;
    display: block;
    word-break: break-all;
    word-wrap: break-word;" class="content">
    {!! $article['content'] !!}
</div>
<div style="display: none;">
    @foreach($result[1] as $item1)
        <p>{{$item1}}</p>
    @endforeach
</div>