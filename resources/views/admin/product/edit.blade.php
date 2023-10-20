@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .img{
        width: 200px;
        height: 200px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border: 1px solid #000;
        margin-right: 20px;
        margin-bottom: 20px;
        position: relative;
    }

    .img:hover{
        border: 2px solid #f00;
    }

    .delete-red-btn{
        position: absolute;
        text-align: center;
        font-size: 20px;
        line-height: 24px;
        top: 0px;
        right: 0px;
        transform: translate(50%, -50%);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        color: #fff;
        background-color: #f00;
        cursor: pointer;
    }
</style>
@endsection

@section('main')
<div class="container">
    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/admin') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">商品管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯商品</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">
                    商品 - 編輯
                </h2>

                <div class="card-body">
                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row py-2">
                            <label for="product_category_id" class="col-sm-2 col-form-label">類別<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="product_category_id" id="category">
                                    @foreach ($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}" @if ($productCategory->id == $product->product_category_id) selected @endif>{{ $productCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">名稱<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" required value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="price" class="col-sm-2 col-form-label">價格<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" name="price" required value="{{ $product->price }}">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label for="img_url" class="col-sm-2 col-form-label">目前主要圖片</label>
                            <div class="col-sm-10">
                                <img src="{{ Storage::url($product->image_url)}}" alt="" width="200px">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-url" class="col-sm-2 col-form-label">主要圖片(重新上傳)</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image-url" name="image_url" accept="image/*">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label for="img_url" class="col-sm-2 col-form-label">目前其他圖片</label>
                            <div class="col-sm-10 d-flex flex-row flex-wrap">
                                @foreach ($product->productImages as $productImage)
                                    <div class="img" style="background-image: url({{ Storage::url($productImage->image_url) }})">
                                        <span class="delete-red-btn" data-id={{ $productImage->id }}>X</span>
                                    </div>
                                    {{-- 表單內不能再藏表單，自己試驗過，會導致products.update請求送不出去 --}}
                                    {{-- <form class="d-none" action="{{ route('products.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-urls" class="col-sm-2 col-form-label">其他圖片(上傳)</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image-urls" name="image_urls[]" accept="image/*" multiple>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label for="descripte" class="col-sm-2 col-form-label">描述<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="descripte" id="descripte" rows="5" required>{{ $product->descripte }}</textarea>
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
<script>
    const redBtns = document.querySelectorAll('.delete-red-btn');
    redBtns.forEach(redBtn => {
        redBtn.addEventListener('click', (e)=> {
            // if (confirm('您確定要刪除嗎？')) {
            //     deletebtn.nextElementSibling.submit();
            // }
            // 獲得要刪除的image id，e.target就是redBtn，一般函式下就是this
            let imageId = e.target.getAttribute('data-id');
            // 用js做一個表單
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'delete');
            formData.append('id', imageId);

            let url = '{{  route('product.image-delete') }}';
            fetch(url, {
                method: 'post',
                body: formData
            }).then((response)=> {
                return response.text();
            }).then((data)=> {
                if(data == 'success'){
                    // 刪除前端網頁上的圖片
                    e.target.parentElement.remove();
                }
            });
        })
    });

    // summernote
    $('#descripte').summernote({
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
