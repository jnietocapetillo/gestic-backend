<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('login')}}" method="post">
    @csrf
        <input type="hidden" name="email" value="javi@gestic.com">
        <input type="hidden" name="`password" value="1234">
        <input type="submit">
    </form> 
    
</body>
</html>
