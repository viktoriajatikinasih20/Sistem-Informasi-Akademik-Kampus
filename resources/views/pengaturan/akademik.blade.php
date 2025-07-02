@extends('layouts.app')

@section('title', 'Pengaturan Tahun Akademik')

@section('content')
<div class="container">
    <h3 class="mb-4">Pengaturan Tahun Akademik Aktif</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pengaturan.akademik') }}">

        @csrf
        <div class="mb-3">
            <label for="tahun_akademik" class="form-label">Tahun Akademik Aktif</label>
            <input type="text" name="tahun_akademik" class="form-control" placeholder="Contoh: 2024/2025" value="{{ old('tahun_akademik', $tahunAktif) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
