@extends('layouts.template')

@section('title', '最新消息 NEWS')

@section('css')

<link rel="stylesheet" href="{{ asset('css/facility.css') }}">
@endsection

@section('main')
    <div class="container-xl">
        <h1 class="text-center m-5">設施介紹</h1>
        <hr>
        @foreach ($facilities as $facility)
        <div class="news-block">
            <img src="{{ Storage::url($facility->img_url) }}" alt="">
            <div class="info">
                <h3>{{ $facility->title }}</h3>
                <p>{!!$facility->content!!}</p>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
@endsection

@section('js')

@endsection
