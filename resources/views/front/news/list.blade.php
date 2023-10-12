@extends('layouts.template')

@section('title', '最新消息 NEWS')

@section('css')

<link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endsection

@section('main')
    <div class="container-xl">
        <h1 class="text-center m-5 ">最新消息</h1>
        <ul class="d-flex flex-row justify-content-end mb-4">
            <li>資料總筆數:<span>70</span></li>
            <li>每頁筆數：<span>10</span></li>
            <li>總頁數：<span>7</span></li>
            <li>目前頁次：<span>1</span></li>
        </ul>
        <hr>
        @foreach ($news as $item)
        <div class="news-block">
            <img src="{{ $item->img_url }}" alt="">
            <div class="info">
                <h2>最新消息</h2>
                {{-- <a href="news/{{ $item->id }}">{{ $item->title }}</a> --}}
                <a href="{{ asset('news/'.$item->id) }}">{{ $item->title }}</a>
                <h3>{{ $item->date }}</h3>
                <p>{{ $item->content }}</p>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
@endsection

@section('js')

@endsection
