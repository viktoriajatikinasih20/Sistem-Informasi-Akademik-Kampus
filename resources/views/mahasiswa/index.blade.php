<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Sistem Informasi Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand img {
            height: 30px;
            margin-right: 8px;
        }
        footer {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt="Logo" />
                <span>Sistem Informasi Mahasiswa</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3">Daftar Mahasiswa</h2>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill"/>
                        </svg>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-sm align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>TTL</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $mhs)
                            <tr>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->fakultas }}</td>
                                <td>{{ $mhs->prodi }}</td>
                                <td>{{ $mhs->tempat_lahir }}, {{ $mhs->tanggal_lahir }}</td>
                                <td class="text-center">
                                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

                                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if ($data->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data mahasiswa.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('mahasiswa.create') }}" class="btn btn-success mt-3">+ Tambah Mahasiswa</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        <small class="text-muted">&copy; 2025 Sistem Informasi Mahasiswa</small>
    </footer>

    <!-- Bootstrap Bundle JS (Popper & Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons SVG Sprite (for alert icon) -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 5.992 7.93a.75.75 0 0 0-1.06 1.061l2.038 2.04z"/>
        </symbol>
    </svg>
</body>
</html>
