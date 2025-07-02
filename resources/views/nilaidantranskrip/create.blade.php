@extends('layouts.app')

@section('title', 'Tambah Nilai & Transkrip')

@section('content')
    <h2>Tambah Nilai & Transkrip</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('nilaidantranskrip.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_id" class="form-control" required>
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                        {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="matakuliah_id" class="form-label">Mata Kuliah</label>
            <select name="matakuliah_id" class="form-control" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($matakuliah as $mk)
                    <option value="{{ $mk->id }}" {{ old('matakuliah_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama }} ({{ $mk->sks }} SKS)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nilai_angka" class="form-label">Nilai Angka (0-100)</label>
            <input type="number" name="nilai_angka" class="form-control" step="0.01" value="{{ old('nilai_angka') }}" required min="0" max="100">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('nilaidantranskrip.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
