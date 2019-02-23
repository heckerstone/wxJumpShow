<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}" />
    <meta id="X_CSRF_TOKEN" name="X-CSRF-TOKEN" content="{{ csrf_token() }}" />
    <title>{{$article['title']}}</title>
    <link rel="stylesheet" href="/css/page.css">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
</head>
<body>
