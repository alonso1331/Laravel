@extends('layouts.app')

{{-- @section('title', '後台首頁') --}}

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        #myTable th, td{
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_length, .dataTables_info{
            margin-left: 10px;
        }

        .dataTables_filter{
            margin-right: 10px;
        }
    </style>
@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">最新消息管理</h2>
                <div class="form-group pt-4 px-3 m-0">
                    {{-- <a href="{{ asset('admin/news/create') }}" class="btn btn-success">新增消息</a> --}}
                    <a href="{{ route('news.create') }}" class="btn btn-success">新增消息</a>
                </div>
                <hr>
                <table id="myTable" class="display table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>標題</th>
                            <th>日期</th>
                            <th>圖片</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->date}}</td>
                                <td><img src="{{$item->img_url}}" alt="" width="200px"></td>
                                <td>
                                    {{-- <a href="/admin/news/{{ $item->id }}/edit" class="btn btn-primary">編輯</a> --}}
                                    <a href="{{ route('news.edit',['id' => $item->id]) }}" class="btn btn-primary">編輯</a>
                                    <button class="btn btn-danger delete-btn">刪除</button>
                                    <form class="d-none" action="{{ route('news.destroy', ['id' => $item->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');

        // 刪除功能
        const deletes = document.querySelectorAll('.delete-btn');
        console.log(deletes);
        deletes.forEach(deletebtn => {
            deletebtn.addEventListener('click', ()=> {
                if (confirm('您確定要刪除嗎？')) {
                    this.nextElementSibling.submit();
                }
            });
        });

        // const btns = document.querySelectorAll('button');

        // btns.forEach(function(btn){
        //     btn.addEventListener('click', () => {
        //         if(confirm('您確定要刪除嗎？')){
        //             this.nextElementSibling.submit();
        //         }
        //     })
        // });

    </script>
@endsection
