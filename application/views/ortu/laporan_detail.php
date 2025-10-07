<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Murid - Laporan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles to make Bootstrap elements match Tailwind's shadow/rounded corners */
        .card {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Ensure scrollable main content height uses the entire viewport height */
        .main-scroll-area {
            /* flex-grow: 1; is set by flex-1 */
            height: 100vh;
            /* Full viewport height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
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
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-user text-xl'></i><span class="ml-3">Data Siswa</span></a></li>
                    <li><a href="<?= base_url('ortu/laporan') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-file-report text-xl'></i><span class="ml-3">Laporan Siswa</span></a></li>
                    <li><a href="<?= base_url('ortu/absensi') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-check-square text-xl'></i><span class="ml-3">Absensi</span></a></li>
                    <li><a href="<?= base_url('ortu/komunikasi') ?>"
                            class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium border-l-4 border-indigo-600"><i
                                class='bx bx-message text-xl'></i><span class="ml-3">Komunikasi</span></a></li>
                    <li><a href="<?= base_url('ortu/pengumuman') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-megaphone text-xl'></i><span class="ml-3">Pengumuman</span></a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-6 main-scroll-area">
            <div class="container-fluid p-0">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Laporan Siswa</h1>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-start border-4 border-indigo-500">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h5 class="text-muted mb-1">Peringkat</h5>
                                    <i class='bx bx-trophy text-2xl text-indigo-500'></i>
                                </div>
                                <h2 class="text-3xl fw-bold mb-0">6</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-start border-4 border-red-500">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h5 class="text-muted mb-1">Pelanggaran</h5>
                                    <i class='bx bx-error text-2xl text-red-500'></i>
                                </div>
                                <h3 class="text-2xl fw-bold mb-0 text-red-600">3</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-start border-4 border-amber-500">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h5 class="text-muted mb-1">Absensi (A/I/S)</h5>
                                    <i class='bx bx-calendar-x text-2xl text-amber-500'></i>
                                </div>
                                <h3 class="text-2xl fw-bold mb-0 text-amber-600">1</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-xl p-0">
                            <div class="card-header bg-indigo-600 text-white py-3 rounded-t-xl">
                                <h3 class="mb-0 fw-bold text-center"><i class="bi bi-person-badge-fill me-2"></i> Detail
                                    Data Siswa</h3>
                            </div>
                            <div class="card-body p-4 p-md-5">

                                <div class="mb-4 pb-3 border-bottom border-indigo-100">
                                    <h4 class="text-2xl font-bold text-indigo-800 mb-1">
                                        <?= htmlspecialchars($siswa->nama) ?></h4>
                                    <p class="text-gray-500 mb-0">NIS: <span
                                            class="fw-semibold me-3"><?= htmlspecialchars($siswa->nis) ?></span> |
                                        Kelas: <span
                                            class="badge bg-success-subtle text-success-emphasis fw-bolder fs-6"><?= htmlspecialchars($siswa->kelas_id) ?></span>
                                    </p>
                                </div>

                                <h5 class="fw-semibold text-gray-700 mb-3 mt-4"><i
                                        class="bi bi-info-circle me-2 text-indigo-500"></i>
                                    Informasi Pribadi</h5>
                                <div class="row g-3 mb-5">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush border rounded-lg shadow-sm">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light">
                                                <strong class="text-muted">Jenis Kelamin:</strong>
                                                <span class="fw-medium">
                                                    <?= $siswa->jenis_kelamin == 'L' ? '<i class="bi bi-gender-male me-1 text-primary"></i> Laki-laki' : '<i class="bi bi-gender-female me-1 text-danger"></i> Perempuan' ?>
                                                </span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                <strong class="text-muted">Tanggal Lahir:</strong>
                                                <span
                                                    class="fw-medium"><?= htmlspecialchars($siswa->tanggal_lahir) ?></span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light">
                                                <strong class="text-muted">Telepon:</strong>
                                                <span class="fw-medium"><?= htmlspecialchars($siswa->telepon) ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-gray-50 border rounded-lg h-full">
                                            <strong class="text-muted d-block mb-1"><i class="bi bi-geo-alt me-1"></i>
                                                Alamat:</strong>
                                            <p class="mb-0 text-gray-700 fst-italic text-sm">
                                                <?= htmlspecialchars($siswa->alamat) ?></p>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-5 border-2">

                                <h5 class="fw-semibold text-gray-700 mb-3"><i
                                        class="bi bi-calendar-check-fill me-2 text-indigo-500"></i> Riwayat Presensi
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle border">
                                        <thead class="bg-indigo-500 text-white text-center">
                                            <tr>
                                                <th class="py-2" style="width: 20%;">Tanggal</th>
                                                <th class="py-2" style="width: 15%;">Status</th>
                                                <th class="py-2">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($siswa->presensi)): ?>
                                                <?php foreach ($siswa->presensi as $p): ?>
                                                    <tr>
                                                        <td><i class="bi bi-calendar-event me-1 text-muted"></i>
                                                            <?= htmlspecialchars($p->tanggal) ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            $status_text = ucfirst($p->status);
                                                            $classes = [
                                                                'alpha' => 'bg-danger',
                                                                'sakit' => 'bg-warning text-dark',
                                                                'izin' => 'bg-info text-dark',
                                                            ];

                                                            $status_class = $classes[strtolower($p->status)] ?? 'bg-success';
                                                            ?>

                                                            <span
                                                                class="badge <?= $status_class ?> fw-semibold p-2 rounded-pill">
                                                                <?= $status_text ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-muted fst-italic text-sm">
                                                            <?= htmlspecialchars($p->keterangan) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted fst-italic p-3">
                                                        <i class="bi bi-info-circle me-1"></i> Belum ada data presensi yang
                                                        tercatat.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center mt-5">
                                    <a href="<?= site_url('ortu/laporan') ?? '#' ?>"
                                        class="btn btn-outline-secondary btn-lg rounded-pill px-5 shadow-sm">
                                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Laporan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5"></div>
            </div>
        </main>

        <aside class="w-80 bg-white h-screen shadow-md p-6 flex-shrink-0">
            <div class="flex flex-col items-center border-b pb-4 mb-4">
                <img src="assets/profile1.jpg" class="w-20 h-20 rounded-full" alt="">
                <h2 class="mt-2 font-semibold text-lg">Silvan Vanness</h2>
                <p class="text-gray-500">29/9022</p>
            </div>
            <div class="mt-4">
                <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-user-circle mr-2'></i>
                    Informasi Pribadi</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>Jhon Smith</li>
                    <li>3 Agustus 2000</li>
                    <li>Laki-laki</li>
                    <li>Islam</li>
                    <li class="mt-2 text-xs text-gray-500 border-t pt-2">Kembang RT 01 RW 06, Karanganyar</li>
                </ul>
            </div>
            <div class="mt-6 border-t pt-4">
                <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-book-content mr-2'></i>
                    Informasi Akademik</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>SMK Negeri 2 Karanganyar</li>
                    <li>9999 / 0084354677</li>
                    <li>Kelas XI RB</li>
                    <li>Tahun Masuk: 2023</li>
                    <li>Tahun Lulus: <i>belum lulus</i></li>
                    <li>Wali Kelas: Dwi Nuryani</li>
                </ul>
            </div>
            <div class="mt-6 border-t pt-4">
                <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-group mr-2'></i>
                    Informasi
                    Orang Tua/Wali</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>Ayah: Edi (Pedagang)</li>
                    <li>Ibu: Eni (IRT)</li>
                </ul>
            </div>
        </aside>
    </div>
</body>

</html>