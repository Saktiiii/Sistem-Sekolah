<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
                    G</div>
                <span class="font-semibold text-lg">Guru</span>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li><a href="<?= base_url('guru/akademik') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-dashboard text-xl'></i><span class="ml-3">Akademik</span></a></li>
                    <li><a href="<?= base_url('guru/ekstrakurikuler') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-user text-xl'></i><span class="ml-3">Ekstrakurikuler</span></a></li>
                    <li><a href="<?= base_url('guru/pengumuman') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-file-report text-xl'></i><span class="ml-3">Pengumuman</span></a></li>
                    <li><a href="<?= base_url('guru/laporan') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-check-square text-xl'></i><span class="ml-3">Laporan</span></a></li>
                    <li><a href="<?= base_url('guru/absensi') ?>"
                            class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium border-l-4 border-indigo-600"><i
                                class='bx bx-message text-xl'></i><span class="ml-3">Absensi</span></a></li>
                    <li><a href="<?= base_url('auth/logout') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-megaphone text-xl'></i><span class="ml-3">Logout</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- MAIN CHAT AREA -->
        <main class="flex-1 p-6 main-scroll-area">
            <div class="container mt-4">
                <h4>📘 Laporan</h4>

                <ul class="nav nav-tabs mt-3" id="akademikTabs" role="tablist">
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nilai">Rekap Nilai</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#absensi">Laporan Absensi</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tugas">Laporan Tugas</a></li>
                </ul>

                <div class="tab-content mt-3">
                    <!-- Laporan Nilai -->
                    <div class="tab-pane fade" id="nilai">
                        <h3>Rekap Nilai Kelas</h3>

                        <form method="get" action="<?= base_url('guru/laporan') ?>">
                            <select name="kelas_id" onchange="this.form.submit()">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($kelas as $k): ?>
                                    <option value="<?= $k->id ?>" <?= ($selected_kelas == $k->id) ? 'selected' : '' ?>>
                                        <?= $k->nama_kelas ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>


                        <?php if (!empty($nilai)): ?>
                            <table border="1">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Mata Pelajaran</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Tugas</th>
                                    <th>Total</th>
                                </tr>
                                <?php $no = 1;
                                foreach ($nilai as $n): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $n->nama_siswa ?></td>
                                        <td><?= $n->nama_mapel ?></td>
                                        <td><?= $n->nilai_uts ?></td>
                                        <td><?= $n->nilai_uas ?></td>
                                        <td><?= $n->nilai_tugas ?></td>
                                        <td><?= $n->nilai_total ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>Pilih kelas untuk menampilkan laporan nilai.</p>
                        <?php endif; ?>

                    </div>

                    <!-- Laporan Absensi -->
                    <div class="tab-pane fade" id="absensi">
                        <h3>Rekap Absensi Kelas</h3>

                        <!-- Dropdown pilih kelas -->
                        <form method="get" action="<?= base_url('guru/laporan_absensi') ?>">
                            <select name="kelas_id" onchange="this.form.submit()">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($kelas as $k): ?>
                                    <option value="<?= $k->id ?>" <?= ($selected_kelas == $k->id) ? 'selected' : '' ?>>
                                        <?= isset($k->nama) ? $k->nama : $k->nama_kelas ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <!-- Tabel absensi -->
                        <?php if (!empty($absensi)): ?>
                            <table border="1" cellpadding="5" cellspacing="0">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                                <?php $no = 1;
                                foreach ($absensi as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $a->nama_siswa ?></td>
                                        <td><?= date('d-m-Y', strtotime($a->tanggal)) ?></td>
                                        <td><?= ucfirst($a->status) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>Pilih kelas untuk menampilkan laporan absensi.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Laporan Tugas -->
                    <div class="tab-pane fade" id="tugas">
                        <h3>Rekap Tugas Kelas</h3>

                        <!-- Dropdown pilih kelas -->
                        <form method="get" action="<?= base_url('guru/laporan_tugas') ?>">
                            <select name="kelas_id" onchange="this.form.submit()">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($kelas as $k): ?>
                                    <option value="<?= $k->id ?>" <?= ($selected_kelas == $k->id) ? 'selected' : '' ?>>
                                        <?= isset($k->nama_kelas) ? $k->nama_kelas : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <!-- Tabel tugas -->
                        <?php if (!empty($tugas)): ?>
                            <table border="1" cellpadding="5" cellspacing="0">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Batas Pengumpulan</th>
                                    <th>Keterangan</th>
                                </tr>
                                <?php $no = 1;
                                foreach ($tugas as $t): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $t->judul ?></td>
                                        <td><?= $t->nama_mapel ?></td>
                                        <td><?= date('d-m-Y', strtotime($t->batas_pengumpulan)) ?></td>
                                        <td><?= $t->deskripsi ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>Pilih kelas untuk menampilkan laporan tugas.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </main>

        <!-- ASIDE INFO SISWA -->
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