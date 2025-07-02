<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:mata_kuliah,kode',
            'nama' => 'required',
            'sks'  => 'required|numeric|min:1|max:6',
        ]);

        MataKuliah::create($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'sks'  => 'required|numeric|min:1|max:6',
        ]);

        $matakuliah = MataKuliah::findOrFail($id);
        $matakuliah->update($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MataKuliah::destroy($id);
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
