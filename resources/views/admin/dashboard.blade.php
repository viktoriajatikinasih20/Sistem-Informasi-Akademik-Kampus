<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Admin - Sistem Informasi Akademik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
            font-weight: 500;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        main {
            margin-left: 220px;
            padding: 1.5rem;
            flex-grow: 1;
        }
        .topbar {
            height: 56px;
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 0.075);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: fixed;
            left: 220px;
            right: 0;
            top: 0;
            z-index: 1030;
        }
        .content-wrapper {
            margin-top: 56px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="text-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt="Logo" width="60" class="mb-2">
            <h5 class="text-white">SIAKAD Admin</h5>
        </div>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active bg-secondary text-white' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>

        <a href="{{ route('mahasiswa.index') }}" class="{{ request()->is('mahasiswa*') ? 'active bg-secondary text-white' : '' }}">
            <i class="bi bi-people-fill me-2"></i>Data Mahasiswa
        </a>

        <a href="{{ route('matakuliah.index') }}" class="{{ request()->is('matakuliah*') ? 'active bg-secondary text-white' : '' }}">
            <i class="bi bi-book-fill me-2"></i>Data Mata Kuliah
        </a>

        <a href="{{ route('nilaidantranskrip.index') }}" class="{{ request()->is('nilai*') ? 'active bg-secondary text-white' : '' }}">
            <i class="bi bi-journal-check me-2"></i>Nilai & Transkrip
        </a>

        <a href="{{ route('pengaturan') }}" class="{{ request()->is('pengaturan') ? 'active bg-secondary text-white' : '' }}">
            <i class="bi bi-gear-fill me-2"></i>Pengaturan
        </a>

        <a href="{{ route('logout') }}" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>


    </nav>


    <!-- Topbar -->
    <header class="topbar">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Admin" width="32" height="32" class="rounded-circle me-2">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="content-wrapper">
            <h1 class="mb-4">Dashboard</h1>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Mahasiswa</h5>
                            <p class="card-text fs-2">{{ $jumlahMahasiswa }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Mata Kuliah Aktif</h5>
                            <p class="card-text fs-2">{{ $jumlahMataKuliah }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Nilai Rata-rata</h5>
                            <p class="card-text fs-2">{{ number_format($rataRataIPK, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4" />

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
                        @foreach ($mahasiswaTerbaru as $mhs)
                        <tr>
                            <td>{{ $mhs->nama }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->fakultas }}</td>
                            <td>{{ $mhs->prodi }}</td>
                            <td>{{ $mhs->tempat_lahir }}, {{ $mhs->tanggal_lahir }}</td>
                        </tr>
                        @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
