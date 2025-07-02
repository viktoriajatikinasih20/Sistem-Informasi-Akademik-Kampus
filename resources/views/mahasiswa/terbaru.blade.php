@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Mahasiswa Terbaru</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm align-middle mt-3">
            <thead class="table-primary">
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Fakultas</th>
                    <th>Prodi</th>
                    <th>TTL</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswaTerbaru as $mhs)
                    <tr>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->fakultas }}</td>
                        <td>{{ $mhs->prodi }}</td>
                        <td>{{ $mhs->tempat_lahir }}, {{ $mhs->tanggal_lahir }}</td>                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
