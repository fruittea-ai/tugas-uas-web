<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->input('keyword');
        
        if ($keyword) {
            $mahasiswa = Mahasiswa::where('nama', 'like', "%{$keyword}%")
                                 ->orWhere('nim', 'like', "%{$keyword}%")
                                 ->orWhere('prodi', 'like', "%{$keyword}%")
                                 ->get();
        } else {

            $mahasiswa = Mahasiswa::all(); 
        }


        return view('mahasiswa.index', compact('mahasiswa', 'keyword'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required|unique:mahasiswa|max:10',
            'prodi' => 'required'
        ]);

        Mahasiswa::create($validatedData);

        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required|max:10|unique:mahasiswa,nim,' . $mahasiswa->id,
            'prodi' => 'required'
        ]);

        $mahasiswa->update($validatedData);

        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }


    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}