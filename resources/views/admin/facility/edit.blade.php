@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/admin') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('facility.index') }}">設施介紹管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">設施介紹-編輯</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">
                    設施介紹 - 編輯
                </h2>

                <div class="card-body">
                    <form action="{{ route('facility.update', ['id' => $facility->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row py-2">
                            <label for="title" class="col-sm-2 col-form-label">標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{ $facility->title }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="img_url" class="col-sm-2 col-form-label">圖片</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="img_url" accept="image/*" value="{{ Storage::url($facility->img_url) }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="img_url" class="col-sm-2 col-form-label">目前圖片</label>
                            <div class="col-sm-10">
                                <img src="{{ Storage::url($facility->img_url) }}" alt="" width="250px">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="content" class="col-sm-2 col-form-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5" required>{{ $facility->content }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
