@extends('layouts.template')

@section('title', 'Laravel 7 前端')

@section('css')
{{-- <link rel="stylesheet" href="./css/index.css"> --}}
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3641.3723931447707!2d120.67275107606598!3d24.12355687434708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693cfcecffe9d9%3A0xe28afadc0dad203a!2z5ZyL56uL5Lit6IiI5aSn5a24!5e0!3m2!1szh-TW!2stw!4v1697803546561!5m2!1szh-TW!2stw" class="map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<form action="{{ asset('/contact') }}" method="post">
    @csrf
    <h2>聯絡我們</h2>
    <h4>請留下您寶貴的意見</h4>
    <label for="name">姓名</label>
    <input type="text" name='name' value="{{ old('name') }}" required>
    <label for="phone">電話</label>
    <input type="text" name='phone' value="{{ old('phone') }}" required>
    <label for="email" >Email</label>
    <input type="text" name='email' value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <label for="message">Message</label>
    <textarea name="message" id="" cols="30" rows="10" required>{{ old('message') }}</textarea>
    @error('g-recaptcha-response')
        <strong>{{ $message }}</strong>
    @enderror
    {!! htmlFormSnippet() !!}
    <button type="submit">送出</button>
</form>
@endsection

@section('js')

@endsection
