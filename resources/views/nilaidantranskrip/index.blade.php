@extends('layouts.app')

@section('title', 'Nilai & Transkrip')

@section('content')
<h2>Nilai & Transkrip Mahasiswa (Seluruh Data)</h2>

<a href="{{ route('nilaidantranskrip.permahasiswa') }}" class="btn btn-info mb-3">
    Lihat Nilai & Transkrip Per Mahasiswa
</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Huruf</th>
            <th>Bobot</th>
            <th>SKSN</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $index => $item)
        @php
            switch ($item->nilai_huruf) {
                case 'A':
                    $bobot = 4.00;
                    break;
                case 'B':
                    $bobot = 3.00;
                    break;
                case 'C':
                    $bobot = 2.00;
                    break;
                case 'D':
                    $bobot = 1.00;
                    break;
                default:
                    $bobot = 0.00;
            }

            $sksn = $item->matakuliah->sks * $bobot;
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->mahasiswa->nama }}</td>
            <td>{{ $item->matakuliah->nama }}</td>
            <td>{{ $item->matakuliah->sks }}</td>
            <td>{{ number_format($item->nilai_angka, 2) }}</td>
            <td>{{ $item->nilai_huruf }}</td>
            <td>{{ number_format($bobot, 2) }}</td>
            <td>{{ number_format($sksn, 2) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Belum ada data nilai.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
