@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('main')
<div class="container">
    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/home') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">門市管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯門市</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">
                    門市 - 編輯
                </h2>

                <div class="card-body">
                    <form action="{{ route('stores.update', ['store'=> $store->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class="form-group row py-2">
                                <label for="area" class="col-sm-2 col-form-label">區域<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="store_area_id" id="area" class="form-control" required>
                                        <option value="" hidden>請選擇區域</option>
                                        @foreach ($storeAreas as $storeArea)
                                        <option value="{{ $storeArea->id }}" @if ($storeArea->id == $store->store_area_id) selected @endif>{{ $storeArea->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="name" class="col-sm-2 col-form-label">名稱<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ $store->name }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="phone" class="col-sm-2 col-form-label">電話<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" value="{{ $store->phone }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="address" class="col-sm-2 col-form-label">地址<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" value="{{ $store->address }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="image-url" class="col-sm-2 col-form-label">目前照片</label>
                                <div class="col-sm-10">
                                    <img src="{{ Storage::url($store->image_url) }}" alt="" srcset="" style="width: 220px">
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="image-url" class="col-sm-2 col-form-label">照片(重新上傳)</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image/*" class="form-control" name="image_url" required>
                                </div>
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
