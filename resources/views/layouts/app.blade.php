<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #fce4ec); /* warna lembut gradien */
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            background-color: #343a40; /* sidebar gelap */
            padding-top: 60px;
            color: white;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ffffff;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar .bg-secondary {
            background-color: #495057;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar bg-dark p-3" style="min-height: 100vh;">
        <div class="text-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt="Logo" width="60" class="mb-2">
            <h5 class="text-white">SIAKAD Admin</h5>
        </div>
        <a href="{{ route('dashboard') }}" class="d-block text-white py-2 px-3 rounded {{ request()->is('dashboard') ? 'bg-secondary' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
        <a href="{{ route('mahasiswa.index') }}" class="d-block text-white py-2 px-3 rounded {{ request()->is('mahasiswa*') ? 'bg-secondary' : '' }}">
            <i class="bi bi-people-fill me-2"></i>Data Mahasiswa
        </a>
        <a href="{{ route('matakuliah.index') }}" class="d-block text-white py-2 px-3 rounded {{ request()->is('matakuliah*') ? 'bg-secondary' : '' }}">
            <i class="bi bi-book-fill me-2"></i>Data Mata Kuliah
        </a>
        <a href="{{ route('nilaidantranskrip.index') }}" class="d-block text-white py-2 px-3 rounded {{ request()->is('nilai*') ? 'bg-secondary' : '' }}">
            <i class="bi bi-journal-check me-2"></i>Nilai & Transkrip
        </a>
        <a href="{{ route('pengaturan') }}" class="d-block text-white py-2 px-3 rounded {{ request()->is('pengaturan') ? 'bg-secondary' : '' }}">
            <i class="bi bi-gear-fill me-2"></i>Pengaturan
        </a>
        <a href="{{ route('logout') }}" class="d-block text-white py-2 px-3 rounded">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
    </nav>


    <div class="content">
        @yield('content')
    </div>

</body>
</html>
