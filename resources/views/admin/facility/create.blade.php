@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('main')
<div class="container">
    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/home') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('facility.index') }}">設施介紹管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增設施</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">
                    設施介紹 - 新增
                </h2>

                <div class="card-body">
                    <form action="{{ route('facility.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="title" class="col-sm-2 col-form-label">標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="img_url" class="col-sm-2 col-form-label">圖片</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="img_url" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="content" class="col-sm-2 col-form-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
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
$('#content').summernote({
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
