@extends('layout')

@section('content')
    <h2>Daftar Kelas</h2>
    <a href="{{ route('kelas.create') }}">Tambah Kelas</a>
    <ul>
        @foreach($kelas as $k)
            <li>{{ $k->nama }} - 
                <a href="{{ route('kelas.edit', $k->id) }}">Edit</a>
                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
