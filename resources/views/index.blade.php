@extends('layouts.template')

@section('title', 'Laravel 7 前端')

@section('css')
{{-- <link rel="stylesheet" href="./css/index.css"> --}}
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<form action="{{ asset('/contact') }}" method="post">
    @csrf
    <h2>聯絡我們</h2>
    <h4>請留下您寶貴的意見</h4>
    <label for="name">姓名</label>
    <input type="text" name='name'>
    <label for="phone">電話</label>
    <input type="text" name='phone'>
    <label for="email" >Email</label>
    <input type="text" name='email'>
    <label for="message">Message</label>
    <textarea name="message" id="" cols="30" rows="10"></textarea>
    <button type="submit">送出</button>
</form>
@endsection

@section('js')

@endsection
