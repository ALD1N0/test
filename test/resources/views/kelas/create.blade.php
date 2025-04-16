@extends('layout')

@section('content')
    <h2>Tambah Kelas</h2>
    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Kelas" required>
        <button type="submit">Simpan</button>
    </form>
@endsection
