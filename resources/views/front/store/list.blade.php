@extends('layouts.template')

@section('title', '最新消息 NEWS')

@section('css')

<link rel="stylesheet" href="{{ asset('css/facility.css') }}">
@endsection

@section('main')
    <div class="container-xl">
        <h1 class="text-center m-5">門市資訊</h1>
        <div class="sort d-flex flex-row">
            <a href="{{ route('store.list', 'store_id=0') }}" class="btn btn-success me-3">所有</a>
            @foreach ($storeAreas as $storeArea)
                <a href="{{ route('store.list', 'store_id='.$storeArea->id) }}" class="btn btn-success me-3">{{ $storeArea->name }}</a>
            @endforeach
        </div>
        <hr>
        @foreach ($stores as $store)
        <div class="news-block d-flex justify-content-center">
            <div class="info col-sm-3 me-3">
                <h3 class="fs-3">{{ $store->name }}</h3>
                <p>{{ $store->storeAreas->name }}</p>
                <p>{{ $store->phone }}</p>
                <p>{{ $store->address }}</p>
            </div>
            <img src="{{ Storage::url($store->image_url) }}" alt="">
        </div>
        <hr>
        @endforeach
    </div>
@endsection

@section('js')

@endsection
