@extends('layout')

@section('content')
    <h2>Daftar Mahasiswa</h2>
    <a href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
    <ul>
        @foreach($mahasiswa as $m)
            <li>{{ $m->nama }} ({{ $m->nim }}) - {{ $m->kelas->nama ?? 'Tidak Ada Kelas' }} - 
                <a href="{{ route('mahasiswa.edit', $m->id) }}">Edit</a>
                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
