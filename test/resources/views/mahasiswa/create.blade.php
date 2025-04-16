@extends('layout')

@section('content')
    <h2>Tambah Mahasiswa</h2>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Mahasiswa" required>
        <input type="text" name="nim" placeholder="NIM" required>
        <select name="kelas_id" required>
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
        </select>
        <button type="submit">Simpan</button>
    </form>
@endsection
