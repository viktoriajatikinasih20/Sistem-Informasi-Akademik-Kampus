@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Pengaturan Sistem</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pengaturan Umum --}}
    <div class="card mb-3">
        <div class="card-header">Pengaturan Umum</div>
        <div class="card-body">
            <form action="{{ route('pengaturan.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="site_name" class="form-label">Nama Aplikasi</label>
                    <input
                        type="text"
                        name="site_name"
                        id="site_name"
                        class="form-control @error('site_name') is-invalid @enderror"
                        value="{{ old('site_name', $siteName) }}"
                    >
                    @error('site_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Tahun Akademik --}}
    <div class="card mb-3">
        <div class="card-header">Tahun Akademik</div>
        <div class="card-body">
            <form action="{{ route('pengaturan.akademik') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="tahun_akademik" class="form-label">Tahun Akademik Aktif</label>
                    <input
                        type="text"
                        name="tahun_akademik"
                        id="tahun_akademik"
                        class="form-control @error('tahun_akademik') is-invalid @enderror"
                        value="{{ old('tahun_akademik', $tahunAktif) }}"
                    >
                    @error('tahun_akademik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Profil User --}}
    <div class="card mb-3">
        <div class="card-header">Profil Saya</div>
        <div class="card-body">
            <form action="{{ route('pengaturan.profil') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Simpan Profil</button>
            </form>
        </div>
    </div>

    {{-- Ganti Password --}}
    <div class="card mb-3">
        <div class="card-header">Ganti Password</div>
        <div class="card-body">
            <form action="{{ route('pengaturan.password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <input
                        type="password"
                        name="current_password"
                        id="current_password"
                        class="form-control @error('current_password') is-invalid @enderror"
                    >
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                    >
                </div>
                <button class="btn btn-primary">Ganti Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
