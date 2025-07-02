@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
<h2>Edit Nilai Mahasiswa</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('nilaidantranskrip.update', $nilaidantranskrip->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Mahasiswa</label>
        <input type="text" class="form-control" value="{{ $nilaidantranskrip->mahasiswa->nama }}" readonly>
        <input type="hidden" name="mahasiswa_id" value="{{ $nilaidantranskrip->mahasiswa_id }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Mata Kuliah</label>
        <input type="text" class="form-control" value="{{ $nilaidantranskrip->matakuliah->nama }} ({{ $nilaidantranskrip->matakuliah->sks }} SKS)" readonly>
        <input type="hidden" name="matakuliah_id" value="{{ $nilaidantranskrip->matakuliah_id }}">
    </div>

    <div class="mb-3">
        <label for="nilai_angka" class="form-label">Nilai Angka</label>
        <input type="number" step="0.01" name="nilai_angka" class="form-control" value="{{ $nilaidantranskrip->nilai_angka }}" required min="0" max="100">
    </div>

    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="{{ route('nilaidantranskrip.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
