<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid black;
        }

        tr, td{
            border: 1px solid black;
            text-align: center;
            vertical-align: center;
            min-width: 100px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>姓名</td>
            <td>{{$contactname}}</td>
        </tr>
        <tr>
            <td>電話</td>
            <td>{{$contactphone}}</td>
        </tr>
        <tr>
            <td>信箱</td>
            <td>{{$contactemail}}</td>
        </tr>
        <tr>
            <td>內容</td>
            <td>{{$contactmessage}}</td>
        </tr>
    </table>
</body>
</html>

{{-- 借用 laravle 樣板 --}}
{{-- @component('mail::message')
# Order Shipped

Your order has been shipped!

@component('mail::button', ['url' => ''])
Botton
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
