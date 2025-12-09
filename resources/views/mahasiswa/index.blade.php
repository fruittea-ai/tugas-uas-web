@extends('templates.layout')

@section('content')
<div class="container mt-5">
    
    <h3 class="mb-4">Daftar Mahasiswa</h3>

    {{-- Pesan Sukses (Success Message) dari Controller --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Pencarian (Search Box) --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="/mahasiswa" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari mahasiswa..." name="keyword" value="{{ old('keyword', $keyword ?? '') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Mahasiswa --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Mahasiswa</h5>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus"></i>Tambah Data
            </a>
        </div>
        
        <div class="card-body">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->prodi }}</td>
                        <td>
                            {{-- Tombol Edit --}}
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-success btn-sm me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            
                            {{-- Tombol Hapus (Menggunakan Form POST untuk keamanan) --}}
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data Mahasiswa tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection