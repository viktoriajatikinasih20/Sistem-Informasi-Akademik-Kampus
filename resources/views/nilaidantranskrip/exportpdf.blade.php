<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <style>
        body {
            font-size: 12px;
            color: #000;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .header-table {
            width: 100%;
            margin-bottom: 15px;
            border: none;
        }
        .header-table td {
            padding: 4px 6px;
            vertical-align: top;
            border: none;
        }
        table.main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.main-table th, table.main-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        table.main-table td.text-left {
            text-align: left;
        }
        .summary-table {
            width: 40%;
            margin-left: auto;
            border-collapse: collapse;
        }
        .summary-table th, .summary-table td {
            padding: 5px 8px;
            text-align: left;
            border: none;
        }
        .summary-table th {
            width: 60%;
        }
    </style>
</head>
<body>

    <h2>Transkrip Akademik</h2>

    <table class="header-table">
        <tr>
            <td><strong>Nama</strong></td>
            <td>: {{ $mahasiswa->nama }}</td>
            <td><strong>Fakultas</strong></td>
            <td>: Matematika dan Ilmu Pengetahuan Alam</td>
        </tr>
        <tr>
            <td><strong>Tempat Lahir</strong></td>
            <td>: {{ $mahasiswa->tempat_lahir }}</td>
            <td><strong>Program Studi</strong></td>
            <td>: Teknik Informatika (S1)</td>
        </tr>
        <tr>
            <td><strong>Tanggal Lahir</strong></td>
            <td>: {{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            <td><strong>NIM</strong></td>
            <td>: {{ $mahasiswa->nim }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Huruf</th>
                <th>SKSN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilaiData as $index => $item)
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
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $item->matakuliah->nama }}</td>
                    <td>{{ $sks }}</td>
                    <td>{{ $item->nilai_huruf }}</td>
                    <td>{{ number_format($sksn, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="summary-table">
        <tr>
            <th colspan="2" style="text-align: left; font-size: 14px; padding-bottom: 10px;">
                Rangkuman
            </th>
        </tr>
        <tr>
            <th>Jumlah Mata Kuliah</th>
            <td>: {{ $nilaiData->count() }}</td>
        </tr>
        <tr>
            <th>Jumlah SKS</th>
            <td>: {{ $totalSks }}</td>
        </tr>
        <tr>
            <th>Jumlah SKSN</th>
            <td>: {{ number_format($totalSksn, 2) }}</td>
        </tr>
        <tr>
            <th>Indeks Prestasi Kumulatif (IPK)</th>
            <td>: {{ number_format($ipk, 2) }}</td>
        </tr>
    </table>

</body>
</html>
