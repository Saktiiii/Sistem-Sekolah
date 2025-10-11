<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Murid - Data Siswa</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .card {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .main-scroll-area {
            height: 100vh;
            overflow-y: auto;
        }

        .h-screen {
            height: 100vh !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white h-screen shadow-md flex-shrink-0">
            <div class="p-6 flex items-center space-x-2 border-b">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                    WM</div>
                <span class="font-semibold text-lg">Wali Murid</span>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li><a href="<?= base_url('ortu/dashboard') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-dashboard text-xl'></i><span class="ml-3">Dashboard</span></a></li>
                    <li><a href="<?= base_url('ortu/data_siswa') ?>"
                            class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium border-l-4 border-indigo-600"><i
                                class='bx bx-user text-xl'></i><span class="ml-3">Data Siswa</span></a></li>
                    <li><a href="<?= base_url('ortu/laporan') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-file-report text-xl'></i><span class="ml-3">Laporan Siswa</span></a></li>
                    <li><a href="<?= base_url('ortu/absensi') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-check-square text-xl'></i><span class="ml-3">Absensi</span></a></li>
                    <li><a href="<?= base_url('ortu/komunikasi') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-message text-xl'></i><span class="ml-3">Komunikasi</span></a></li>
                    <li><a href="<?= base_url('ortu/pengumuman') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-megaphone text-xl'></i><span class="ml-3">Pengumuman</span></a></li>
                    <li><a href="<?= base_url('auth/logout') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-megaphone text-xl'></i><span class="ml-3">Logout</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 main-scroll-area">
            <div class="container-fluid p-0">

                <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="bi bi-person-lines-fill text-indigo-600 me-3"></i> Data Siswa
                </h1>

                <?php if (!empty($siswa)): ?>
                    <div class="card border-0 shadow-lg mb-6">
                        <div class="card-body p-6">
                            <h2 class="text-2xl fw-bold text-indigo-700 mb-4"><?= htmlspecialchars($siswa->nama); ?></h2>

                            <div class="mb-3"><span class="fw-semibold text-gray-600">NIS:</span>
                                <?= htmlspecialchars($siswa->nis); ?></div>
                            <div class="mb-3"><span class="fw-semibold text-gray-600">Kelas:</span> <span
                                    class="badge bg-secondary-subtle text-secondary fw-bold"><?= htmlspecialchars($siswa->kelas); ?></span>
                            </div>
                            <div class="mb-3"><span class="fw-semibold text-gray-600">Jurusan:</span>
                                <?= htmlspecialchars($siswa->jurusan); ?></div>
                            <div class="mb-3"><span class="fw-semibold text-gray-600">Jenis Kelamin:</span>
                                <?php if ($siswa->jenis_kelamin == 'L'): ?>
                                    <span class="badge bg-primary"><i class="bi bi-gender-male"></i> Laki-laki</span>
                                <?php else: ?>
                                    <span class="badge bg-pink-500 text-white"><i class="bi bi-gender-female"></i>
                                        Perempuan</span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3"><span class="fw-semibold text-gray-600">Alamat:</span>
                                <?= htmlspecialchars($siswa->alamat); ?></div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center text-muted fst-italic py-6">
                        <i class="bi bi-info-circle me-2"></i> Data siswa tidak ditemukan.
                    </div>
                <?php endif; ?>

            </div>
        </main>


    </div>
</body>

</html>