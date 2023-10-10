@extends('layouts.template')

@section('title', '最新消息細項 Detail')

@section('css')
<link rel="stylesheet" href="{{ asset('css/news-detail.css') }}">
@endsection

@section('main')
<div class="container-xl">
    <h1 class="mt-5 mb-4 ">{{ $news->title }}</h1>
    <div class="info">
        <p class="date">發布日期：<span>{{ $news->date }}</span></p>
        <p class="views">瀏覽次數：<span >205</span></p>
    </div>
    <hr>
    <p class="text">{{ $news->content }}</p>
</div>
@endsection

@section('js')

@endsection

