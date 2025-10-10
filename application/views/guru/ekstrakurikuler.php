<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Ekstrakurikuler</title>
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
            <div class="container py-4">

                <?php if (!isset($_GET['id'])): ?>
                    <!-- ==================== LIST EKSKUL ==================== -->
                    <h2 class="mb-4 text-primary">Ekstrakurikuler yang Dibina</h2>

                    <div class="row">
                        <?php if (!empty($ekskul)): ?>
                            <?php foreach ($ekskul as $e): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($e->nama_ekskul) ?></h5>
                                            <p class="card-text text-muted"><?= htmlspecialchars($e->deskripsi) ?></p>
                                            <a href="<?= base_url('guru/ekstrakurikuler?id=' . $e->id) ?>"
                                                class="btn btn-primary btn-sm">
                                                Kelola
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada ekstrakurikuler yang Anda bina.</div>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php else: ?>
                    <!-- ==================== DETAIL EKSKUL ==================== -->
                    <h3 class="text-success mb-4">
                        Detail Ekstrakurikuler:
                        <span
                            class="fw-bold"><?= htmlspecialchars($ekskul_terpilih->nama_ekskul ?? 'Tidak Diketahui') ?></span>
                    </h3>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#anggota">Anggota</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#penghargaan">Penghargaan</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#jadwal">Jadwal</button></li>
                    </ul>

                    <div class="tab-content mt-3">

                        <!-- TAB ANGGOTA -->
                        <div class="tab-pane fade show active" id="anggota">
                            <button class="btn btn-success btn-sm mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalAnggota">
                                + Tambah Anggota
                            </button>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($anggota)): ?>
                                        <?php foreach ($anggota as $a): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($a->nama) ?></td>
                                                <td><?= htmlspecialchars($a->nis) ?></td>
                                                <td><?= ucfirst($a->jabatan) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada anggota.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- TAB PENGHARGAAN -->
                        <div class="tab-pane fade" id="penghargaan">
                            <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalPenghargaan">
                                + Tambah Penghargaan
                            </button>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tingkat</th>
                                        <th>Tahun</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($penghargaan)): ?>
                                        <?php foreach ($penghargaan as $p): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($p->nama_penghargaan) ?></td>
                                                <td><?= htmlspecialchars($p->tingkat) ?></td>
                                                <td><?= htmlspecialchars($p->tahun) ?></td>
                                                <td><?= htmlspecialchars($p->keterangan) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada penghargaan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- TAB JADWAL -->
                        <div class="tab-pane fade" id="jadwal">
                            <button class="btn btn-info btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalJadwal">
                                + Tambah Jadwal
                            </button>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Tempat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($jadwal)): ?>
                                        <?php foreach ($jadwal as $j): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($j->hari) ?></td>
                                                <td><?= htmlspecialchars($j->jam_mulai) ?> -
                                                    <?= htmlspecialchars($j->jam_selesai) ?></td>
                                                <td><?= htmlspecialchars($j->tempat) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada jadwal latihan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <a href="<?= base_url('guru/ekstrakurikuler') ?>" class="btn btn-secondary mt-3">← Kembali</a>

                <?php endif; ?>
            </div>

            <!-- ==================== MODAL TAMBAH ANGGOTA ==================== -->
            <div class="modal fade" id="modalAnggota">
                <div class="modal-dialog">
                    <form method="post" action="<?= base_url('guru/tambah_anggota') ?>" class="modal-content">
                        <div class="modal-header">
                            <h5>Tambah Anggota</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="ekskul_id" value="<?= $_GET['id'] ?? '' ?>">
                            <div class="mb-2">
                                <label>Siswa ID</label>
                                <input type="number" name="siswa_id" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control">
                                    <option value="anggota">Anggota</option>
                                    <option value="ketua">Ketua</option>
                                    <option value="wakil">Wakil</option>
                                    <option value="sekretaris">Sekretaris</option>
                                    <option value="bendahara">Bendahara</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="submit" class="btn btn-success">Simpan</button></div>
                    </form>
                </div>
            </div>

            <!-- ==================== MODAL TAMBAH PENGHARGAAN ==================== -->
            <div class="modal fade" id="modalPenghargaan">
                <div class="modal-dialog">
                    <form method="post" action="<?= base_url('guru/tambah_penghargaan') ?>" class="modal-content">
                        <div class="modal-header">
                            <h5>Tambah Penghargaan</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="ekskul_id" value="<?= $_GET['id'] ?? '' ?>">
                            <div class="mb-2"><label>Nama Penghargaan</label><input type="text" name="nama_penghargaan"
                                    class="form-control" required></div>
                            <div class="mb-2">
                                <label>Tingkat</label>
                                <select name="tingkat" class="form-control">
                                    <option value="Sekolah">Sekolah</option>
                                    <option value="Kecamatan">Kecamatan</option>
                                    <option value="Kabupaten">Kabupaten</option>
                                    <option value="Provinsi">Provinsi</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>
                            <div class="mb-2"><label>Tahun</label><input type="number" name="tahun" class="form-control"
                                    required></div>
                            <div class="mb-2"><label>Keterangan</label><textarea name="keterangan"
                                    class="form-control"></textarea></div>
                        </div>
                        <div class="modal-footer"><button type="submit" class="btn btn-warning">Simpan</button></div>
                    </form>
                </div>
            </div>

            <!-- ==================== MODAL TAMBAH JADWAL ==================== -->
            <div class="modal fade" id="modalJadwal">
                <div class="modal-dialog">
                    <form method="post" action="<?= base_url('guru/tambah_jadwal') ?>" class="modal-content">
                        <div class="modal-header">
                            <h5>Tambah Jadwal Ekskul</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="ekskul_id" value="<?= $_GET['id'] ?? '' ?>">
                            <div class="mb-2">
                                <label>Hari</label>
                                <select name="hari" class="form-control">
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                </select>
                            </div>
                            <div class="mb-2"><label>Jam Mulai</label><input type="time" name="jam_mulai"
                                    class="form-control" required></div>
                            <div class="mb-2"><label>Jam Selesai</label><input type="time" name="jam_selesai"
                                    class="form-control" required></div>
                            <div class="mb-2"><label>Tempat</label><input type="text" name="tempat"
                                    class="form-control"></div>
                        </div>
                        <div class="modal-footer"><button type="submit" class="btn btn-info">Simpan</button></div>
                    </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>