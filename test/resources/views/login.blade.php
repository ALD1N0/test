<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <a href="{{ route('register') }}">Register</a>

    <form action="{{ route('login') }}" method="POST">
        @csrf 
    
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" required><br><br>
    
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" required><br><br>
    
        <button type="submit">Login</button>
    </form>
    
    
</body>
</html>
