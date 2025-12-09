<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @if(session()->has('error')){{ session()->get('error') }} @endif
    <form action="{{ route('pay.me')}}" method="post">
        
        @csrf
        <input type="email" placeholder="email" name="email">
        <br>
        <input type="number" placeholder="amount" name="amount">

        <button type="submit">pay</button>
    </form>
</body>
</html>