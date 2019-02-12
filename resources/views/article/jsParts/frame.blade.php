<script type="text/javascript">
    addElementElement('container', 'frameset',
        {
            id:"frameset",
            rows:"*",
            frameborder:"no",
            border:"0",
            framespacing:"0",
            scrolling:"no",
            allowtransparency:"ture"
        }
    );
    addElementElement('frameset', 'frame',
        {
            src:"http://{{$url}}/frame/{{$articleId}}",
            name:"mainFrame",
            id:"mainFrame"
        }
    );
</script>