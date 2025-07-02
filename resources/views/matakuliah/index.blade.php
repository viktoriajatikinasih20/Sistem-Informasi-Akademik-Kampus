@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
<h2>Data Mata Kuliah</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('matakuliah.create') }}" class="btn btn-primary mb-3">+ Tambah Mata Kuliah</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($matakuliah as $index => $mk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mk->kode }}</td>
                <td>{{ $mk->nama }}</td>
                <td>{{ $mk->sks }}</td>
                <td>
                    <a href="{{ route('matakuliah.edit', $mk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('matakuliah.destroy', $mk->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data mata kuliah</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
