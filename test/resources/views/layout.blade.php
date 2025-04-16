<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa dan Kelas</title>
</head>
<body>
    <nav>
        <a href="{{ route('kelas.index') }}">Kelas</a>
        <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
    </nav>
    <hr>
    @yield('content')
</body>
</html>
