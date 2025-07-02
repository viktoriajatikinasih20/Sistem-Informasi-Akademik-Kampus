@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<h2>Tambah Mata Kuliah</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('matakuliah.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="kode" class="form-label">Kode Mata Kuliah</label>
        <input type="text" name="kode" class="form-control" value="{{ old('kode') }}" required>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
    </div>
    <div class="mb-3">
        <label for="sks" class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control" value="{{ old('sks') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
