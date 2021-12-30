<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}"/>
    <title>@yield( 'title' , 'test')</title>
</head>
<body>
@include('shared.navigation')
<main class="container">
    @yield( 'main' , 'Student Administration Application')
</main>
@include('shared.footer')
@extends('scripts.scripts')
</body>
</html>
