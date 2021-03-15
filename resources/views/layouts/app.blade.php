<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/sentsin/layui@v2.5.7/dist/css/layui.css">
    <link rel="stylesheet" href="{{ asset('static/admin/css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/sentsin/layui@v2.5.7/dist/layui.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@v2.6.12"></script>
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script src="{{ asset('static/admin/js/app.js') }}"></script>
</body>
</html>
