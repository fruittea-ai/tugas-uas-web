@extends('templates.layout')

@section('content')
<div class="container mt-5">
    <h2>Ubah Data Mahasiswa: {{ $mahasiswa->nama }}</h2>
    <hr>

    <div class="card shadow-sm">
        <div class="card-body">
            
            {{-- Form akan mengirim data ke Route UPDATE --}}
            <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}">
                {{-- Laravel memerlukan directive ini untuk metode PUT/PATCH --}}
                @method('PUT') 
                @csrf 

                {{-- Field Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" name="nama" 
                           value="{{ old('nama', $mahasiswa->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Field NIM --}}
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                           id="nim" name="nim" 
                           value="{{ old('nim', $mahasiswa->nim) }}" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Field Prodi (Jurusan) --}}
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control @error('prodi') is-invalid @enderror" 
                           id="prodi" name="prodi" 
                           value="{{ old('prodi', $mahasiswa->prodi) }}" required>
                    @error('prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-success">Update Data</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection