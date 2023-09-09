<!DOCTYPE html>
<html lang="{{str_replace('_','_',app()->getLocale())}}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager | @yield('title')</title>
    @include('layout.css')
    @yield('style')
</head>

<body>
    @yield('content')
    @include('layout.js')
    @yield('customjs')
</body>

</html>