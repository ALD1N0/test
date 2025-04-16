<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
</head>
<body>

    <h2>Edit Mahasiswa</h2>

    <form action="{{ route('mahasiswa.update', ['mahasiswa' => $mahasiswa->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required>

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>

        <label for="kelas_id">Kelas:</label>
        <select id="kelas_id" name="kelas_id" required>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ $mahasiswa->kelas_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('mahasiswa.index') }}">Batal</a>
    </form>

</body>
</html>
