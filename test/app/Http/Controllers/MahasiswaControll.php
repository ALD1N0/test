<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaControll extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswa',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswa,nim,' . $mahasiswa->id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
    
    public function nobin($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }
    
}
