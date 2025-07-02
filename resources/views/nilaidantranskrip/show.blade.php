@extends('layouts.app')

@section('title', 'Detail Transkrip Mahasiswa')

@section('content')
<h2>Detail Transkrip Nilai Mahasiswa</h2>

<div class="card mb-3">
    <div class="card-body">
        <h5>Nama: {{ $nilai->mahasiswa->nama }}</h5>
        <p>NIM: {{ $nilai->mahasiswa->nim }}</p>
        <p>Jurusan: {{ $nilai->mahasiswa->jurusan }}</p>
    </div>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Huruf</th>
            <th>Bobot</th>
            <th>SKSN</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>{{ $nilai->matakuliah->nama }}</td>
            <td>{{ $nilai->matakuliah->sks }}</td>
            <td>{{ number_format($nilai->nilai_angka, 2) }}</td>
            <td>{{ $nilai->nilai_huruf }}</td>
            <td>{{ number_format($nilai->bobot, 2) }}</td>
            <td>{{ number_format($nilai->sksn, 2) }}</td>
        </tr>
    </tbody>
</table>

<a href="{{ route('nilaidantranskrip.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
