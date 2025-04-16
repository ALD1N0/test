<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasControll extends Controller 
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:kelas,nama', 
        ]);

        Kelas::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));

    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama' => 'required|string|unique:kelas,nama,' . $kela->id,
        ]);
    
        $kela->update(['nama' => $request->nama]);
    
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
