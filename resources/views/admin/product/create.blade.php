@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('main')
<div class="container">
    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/home') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">商品管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增商品</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">
                    商品 - 新增
                </h2>

                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="category" class="col-sm-2 col-form-label">類別<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="product_category_id" id="category" class="form-control" required>
                                    <option value="" hidden>請選擇類別</option>
                                    @foreach ($productCategories as $productCategory)
                                        <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">名稱<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="price" class="col-sm-2 col-form-label">價格<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-url" class="col-sm-2 col-form-label">主要圖片<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image-url" name="image_url" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-urls" class="col-sm-2 col-form-label">其他圖片</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image-urls" name="image_urls[]" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="descripte" class="col-sm-2 col-form-label">描述<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="descripte" id="descripte" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
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
<script>
$('#descripte').summernote({
    placeholder: '請輸入內容',
    tabsize: 3,
    height: 200,
    callbacks: {
        onImageUpload: function(files) {
            // upload image to server and create imgNode...
            console.log(files);

            // 圖片要發送到後端的路徑
            let url = '{{route('tool.image-upload')}}';
            // 利用JS建立一個form表單
            let formData = new FormData();
            // formDate.append(key, value);
            // csrf token
            formData.append('_token', '{{ csrf_token() }}')
            // 圖片
            formData.append('image', files[0]);

            fetch(url, {
                'method': 'post',
                'body': formData
            }).then((response) => {
                return response.text();
            }).then((data)=> {
                console.log(data);
                $('#content').summernote('insertImage', data);
            })
        }
    }
});
</script>
@endsection
