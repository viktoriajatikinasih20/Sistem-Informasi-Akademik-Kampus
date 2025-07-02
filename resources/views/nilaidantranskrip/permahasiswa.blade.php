@extends('layouts.app')

@section('title', 'Nilai & Transkrip Per Mahasiswa')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Nilai & Transkrip Per Mahasiswa</h2>

    <div class="mb-3">
        <a href="{{ route('nilaidantranskrip.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Semua Data Nilai
        </a>
    </div>

    <form action="{{ route('nilaidantranskrip.permahasiswa') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width: 400px; margin: 0 auto;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama mahasiswa..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
            @if(request('search'))
                <a href="{{ route('nilaidantranskrip.permahasiswa') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </div>
    </form>

    @if(request('search') && $data && $data->count() > 0)
        @php
            $filteredData = $data->filter(function($item) {
                return str_contains(strtolower($item->mahasiswa->nama), strtolower(request('search')));
            });

            $totalSks = 0;
            $totalSksn = 0;
            $jumlahMatkul = $filteredData->count();
        @endphp

        @if($jumlahMatkul > 0)
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('nilaidantranskrip.exportpdf', ['id' => $filteredData->first()->mahasiswa->id]) }}" class="btn btn-danger" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Nilai Mahasiswa: <strong>{{ $filteredData->first()->mahasiswa->nama }}</strong></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-dark text-center align-middle">
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
                        @foreach ($filteredData as $index => $item)
                        @php
                            switch ($item->nilai_huruf) {
                                case 'A': $bobot = 4.00; break;
                                case 'B': $bobot = 3.00; break;
                                case 'C': $bobot = 2.00; break;
                                case 'D': $bobot = 1.00; break;
                                default: $bobot = 0.00;
                            }
                            $sks = $item->matakuliah->sks;
                            $sksn = $sks * $bobot;

                            $totalSks += $sks;
                            $totalSksn += $sksn;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->matakuliah->nama }}</td>
                            <td class="text-center">{{ $sks }}</td>
                            <td class="text-center">{{ number_format($item->nilai_angka, 2) }}</td>
                            <td class="text-center">{{ $item->nilai_huruf }}</td>
                            <td class="text-center">{{ number_format($bobot, 2) }}</td>
                            <td class="text-center">{{ number_format($sksn, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rangkuman Total --}}
        <div class="card shadow-sm" style="max-width: 400px; margin-left: auto;">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Rangkuman</h5>
            </div>
            <table class="table mb-0">
                <tbody>
                    <tr>
                        <th>Jumlah Mata Kuliah</th>
                        <td>{{ $jumlahMatkul }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah SKS</th>
                        <td>{{ $totalSks }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah SKSN</th>
                        <td>{{ number_format($totalSksn, 2) }}</td>
                    </tr>
                    <tr>
                        <th>IPK</th>
                        <td>{{ $totalSks > 0 ? number_format($totalSksn / $totalSks, 2) : '0.00' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @else
            <div class="alert alert-warning text-center">
                Data tidak ditemukan untuk nama mahasiswa: <strong>{{ request('search') }}</strong>
            </div>
        @endif

    @elseif(request('search'))
        <div class="alert alert-warning text-center">
            Data tidak ditemukan untuk nama mahasiswa: <strong>{{ request('search') }}</strong>
        </div>
    @endif
</div>
@endsection
