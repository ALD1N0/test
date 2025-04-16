<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
</head>
<body>

    <h2>Edit Kelas</h2>

    <form action="{{ route('kelas.update', $kela->id) }}" method="POST">

        
        @csrf
        @method('PUT')

        <label for="nama">Nama Kelas:</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $kela->nama) }}" required>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('kelas.index') }}">Batal</a>
    </form>

</body>
</html>
