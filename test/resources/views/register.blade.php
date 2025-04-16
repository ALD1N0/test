<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <a href="{{ route('login') }}">Login</a>

    <form action="{{ route('register') }}" method="POST">
        @csrf 
    
        <label for="name">Nama</label><br>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required><br><br>
    
        <label for="tanggal_lahir">Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required><br><br>
    
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required><br><br>
    
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" required><br><br>
    
        <label for="password_confirmation">Konfirmasi Password</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" required><br><br>
    
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>
