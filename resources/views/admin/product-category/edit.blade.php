@extends('layouts.app-product')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('main')
<div class="container">
    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/home') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">商品管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯類別</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">
                    類別 - 編輯
                </h2>

                <div class="card-body">
                    <form action="{{ route('product-categories.update', ['product_category'=>$productCategory->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">類別<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ $productCategory->name }}" required>
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
