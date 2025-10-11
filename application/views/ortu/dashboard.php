<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Murid - Dashboard</title>

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
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-md flex-shrink-0">
            <div class="p-6 flex items-center space-x-2 border-b">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                    WM</div>
                <span class="font-semibold text-lg">Wali Murid</span>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li><a href="<?= base_url('ortu/dashboard') ?>"
                            class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium border-l-4 border-indigo-600"><i
                                class='bx bx-dashboard text-xl'></i><span class="ml-3">Dashboard</span></a></li>
                    <li><a href="<?= base_url('ortu/data_siswa') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
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

        <!-- Main Content -->
        <main class="flex-1 p-6 main-scroll-area">
            <div class="container-fluid p-0">

                <!-- Header Selamat Datang -->
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-2xl p-6 mb-6 shadow-md">
                    <h2 class="text-3xl font-semibold">Selamat Datang, Orang Tua/Wali</h2>
                    <p class="text-indigo-100 mt-2">Anda dapat memantau perkembangan siswa melalui dashboard ini.</p>
                </div>

                <!-- Judul Dashboard Anak -->
                <h2 class="mb-4">Dashboard Anak: <?= htmlspecialchars($siswa->nama); ?></h2>

                <!-- Kartu Dashboard -->
                <div class="row g-4 mb-4">

                    <!-- Peringkat Kelas -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-start border-4 border-indigo-500 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h5 class="text-muted mb-1">Peringkat Kelas</h5>
                                    <i class='bx bx-trophy text-2xl text-indigo-500'></i>
                                </div>
                                <h2 class="text-3xl fw-bold mb-0">
                                    <?= $dashboard['peringkat']; ?>
                                    <small class="text-sm text-muted">dari <?= $dashboard['total_siswa']; ?>
                                        Siswa</small>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <!-- Total Absensi -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-start border-4 border-amber-500 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h5 class="text-muted mb-1">Total Absensi (A/I/S)</h5>
                                    <i class='bx bx-calendar-x text-2xl text-amber-500'></i>
                                </div>
                                <h3 class="text-3xl fw-bold mb-0 text-amber-600"><?= $dashboard['total_absensi']; ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Ringkasan Siswa -->
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header bg-indigo-600 text-white fw-bold">
                        <i class="bi bi-person-lines-fill me-2"></i> Ringkasan Siswa
                    </div>
                    <div class="card-body bg-white">
                        <table class="table table-bordered align-middle mb-0">
                            <tr>
                                <th>Nama</th>
                                <td><?= htmlspecialchars($siswa->nama); ?></td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td><?= htmlspecialchars($siswa->nama_kelas ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>
                                    <?php if (isset($siswa->jenis_kelamin)): ?>
                                        <span class="badge <?= $siswa->jenis_kelamin == 'L' ? 'bg-success' : 'bg-pink'; ?>">
                                            <?= $siswa->jenis_kelamin; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

        </main>

        <!-- Aside (profil siswa) -->
        <aside class="w-80 bg-white h-screen shadow-md p-6 flex-shrink-0 overflow-y-auto">
            <div class="flex flex-col items-center border-b pb-4 mb-4">
                <img src="<?= base_url('assets/profile1.jpg'); ?>"
                    class="w-20 h-20 rounded-full object-cover border-4 border-indigo-100 shadow-md"
                    alt="Profile Picture">
                <h2 class="mt-3 font-bold text-xl text-gray-800">Silvan Vanness</h2>
                <p class="text-gray-500 text-sm">NIS: 29/9022</p>
            </div>

            <div class="mt-4">
                <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-user-circle mr-2'></i>
                    Informasi Pribadi</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li class="flex justify-between"><strong>Nama:</strong> <span>Jhon Smith</span></li>
                    <li class="flex justify-between"><strong>Tgl Lahir:</strong> <span>3 Agustus 2000</span></li>
                    <li class="flex justify-between"><strong>Gender:</strong> <span>Laki-laki</span></li>
                    <li class="flex justify-between"><strong>Agama:</strong> <span>Islam</span></li>
                    <li class="mt-2 text-xs text-gray-500 border-t pt-2">Alamat: Kembang RT 01 RW 06, Karanganyar</li>
                </ul>
            </div>

            <div class="mt-6 border-t pt-4">
                <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-book-content mr-2'></i>
                    Informasi Akademik</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li class="flex justify-between"><strong>Sekolah:</strong> <span>SMK Negeri 2 Karanganyar</span>
                    </li>
                    <li class="flex justify-between"><strong>NIS:</strong> <span>9999 / 0084354677</span></li>
                    <li class="flex justify-between"><strong>Kelas:</strong> <span class="font-bold text-indigo-500">XI
                            RB</span></li>
                    <li class="flex justify-between"><strong>Tahun Masuk:</strong> <span>2023</span></li>
                    <li class="flex justify-between"><strong>Tahun Lulus:</strong> <span><i>Belum lulus</i></span></li>
                    <li class="flex justify-between"><strong>Wali Kelas:</strong> <span>Dwi Nuryani</span></li>
                </ul>
            </div>

            <div class="mt-6 border-t pt-4">
                <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-group mr-2'></i>
                    Informasi Orang Tua/Wali</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li class="flex justify-between"><strong>Ayah:</strong> <span>Edi (Pedagang)</span></li>
                    <li class="flex justify-between"><strong>Ibu:</strong> <span>Eni (IRT)</span></li>
                </ul>
            </div>
        </aside>
    </div>

</body>

</html>