@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Mahasiswa</h3>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
                </div>

                <div class="mb-3">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <select name="fakultas" id="fakultas" class="form-control" required>
                        <option value="">- Pilih Fakultas -</option>
                        <option value="fmipa" {{ old('fakultas') == 'fmipa' ? 'selected' : '' }}>FMIPA</option>
                        <option value="fbs" {{ old('fakultas') == 'fbs' ? 'selected' : '' }}>FBS</option>
                        <option value="fe" {{ old('fakultas') == 'fe' ? 'selected' : '' }}>FE</option>
                        <option value="fis" {{ old('fakultas') == 'fis' ? 'selected' : '' }}>FIS</option>
                        <option value="fh" {{ old('fakultas') == 'fh' ? 'selected' : '' }}>FH</option>
                        <option value="ft" {{ old('fakultas') == 'ft' ? 'selected' : '' }}>FT</option>
                        <option value="fik" {{ old('fakultas') == 'fik' ? 'selected' : '' }}>FIK</option>
                        <option value="fip" {{ old('fakultas') == 'fip' ? 'selected' : '' }}>FIP</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prodi</label>
                    <input type="text" name="prodi" class="form-control" value="{{ old('prodi') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection