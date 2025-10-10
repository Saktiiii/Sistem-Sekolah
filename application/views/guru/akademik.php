<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Akademik</title>
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
                <h4>📘 Akademik Guru</h4>

                <ul class="nav nav-tabs mt-3" id="akademikTabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#jadwal">Jadwal
                            Mengajar</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nilai">Input Nilai</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#materi">Materi</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tugas">Tugas</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#kelas">Data Kelas</a></li>
                </ul>

                <div class="tab-content mt-3">
                    <!-- Jadwal -->
                    <div class="tab-pane fade show active" id="jadwal">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jadwal as $j): ?>
                                    <tr>
                                        <td><?= $j->hari ?></td>
                                        <td><?= $j->jam_mulai ?> - <?= $j->jam_selesai ?></td>
                                        <td><?= $j->nama_kelas ?></td>
                                        <td><?= $j->mapel ?></td>
                                        <td><?= $j->tahun ?> (<?= $j->semester ?>)</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Input Nilai -->
                    <div class="tab-pane fade" id="nilai">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInputNilai">
                            <i class="bx bx-edit"></i> Input Nilai
                        </button>
                        <form method="post" action="<?= base_url('guru/simpan_nilai') ?>">
                            <input type="hidden" name="tahun_ajaran_id" value="<?= $tahun_aktif->id ?>">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Tugas</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kelas as $k): ?>
                                        <?php
                                        $siswa = $this->db->get_where('siswa', ['kelas_id' => $k->id])->result();
                                        foreach ($siswa as $s): ?>
                                            <tr>
                                                <td><?= $s->nama ?></td>
                                                <td><input type="number" name="nilai_tugas" step="0.01" required></td>
                                                <td><input type="number" name="nilai_uts" step="0.01" required></td>
                                                <td><input type="number" name="nilai_uas" step="0.01" required></td>
                                                <td><button type="submit" class="btn btn-primary btn-sm">Simpan</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <!-- Materi -->
                    <div class="tab-pane fade" id="materi">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUploadMateri">
                            <i class="bx bx-upload"></i> Upload Materi
                        </button>
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Judul</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($materi as $m): ?>
                                    <tr>
                                        <td><?= $m->judul ?></td>
                                        <td><?= $m->file ?></td>
                                        <td><?= $m->created_at ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tugas -->
                    <div class="tab-pane fade" id="tugas">
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUploadTugas">
                            <i class="bx bx-task"></i> Upload Tugas
                        </button>
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tugas as $t): ?>
                                    <tr>
                                        <td><?= $t->judul ?></td>
                                        <td><?= $t->kelas_id ?></td>
                                        <td><?= date('d-m-Y', strtotime($t->tanggal_dibuat)) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Data Kelas -->
                    <div class="tab-pane fade" id="kelas">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Kelas</th>
                                    <th>Jumlah Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kelas as $k):
                                    $jumlah = $this->db->where('kelas_id', $k->id)->from('siswa')->count_all_results(); ?>
                                    <tr>
                                        <td><?= $k->nama_kelas ?></td>
                                        <td><?= $jumlah ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalInputNilai" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="<?= base_url('guru/simpan_nilai') ?>" method="post">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title">Input Nilai Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas_id" class="form-select" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            <?php foreach ($kelas as $k): ?>
                                                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select name="mata_pelajaran_id" class="form-select" required>
                                            <option value="">-- Pilih Mapel --</option>
                                            <!-- Isi otomatis dari data jadwal -->
                                            <?php foreach ($jadwal as $j): ?>
                                                <option value="<?= $j->mata_pelajaran_id ?>"><?= $j->mapel ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Semester</label>
                                        <select name="semester" class="form-select">
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap">Genap</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nilai Tugas</label>
                                        <input type="number" step="0.01" name="nilai_tugas" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nilai UTS</label>
                                        <input type="number" step="0.01" name="nilai_uts" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nilai UAS</label>
                                        <input type="number" step="0.01" name="nilai_uas" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan Nilai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalUploadMateri" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="<?= base_url('guru/upload_materi') ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Upload Materi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas_id" class="form-select" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            <?php foreach ($kelas as $k): ?>
                                                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select name="mata_pelajaran_id" class="form-select" required>
                                            <option value="">-- Pilih Mapel --</option>
                                            <?php foreach ($jadwal as $j): ?>
                                                <option value="<?= $j->mata_pelajaran_id ?>"><?= $j->mapel ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Judul Materi</label>
                                        <input type="text" name="judul" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">File Materi (PDF, PPT, DOC)</label>
                                        <input type="file" name="file" class="form-control"
                                            accept=".pdf,.ppt,.pptx,.doc,.docx">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Link Video (Opsional)</label>
                                        <input type="url" name="link_video" class="form-control"
                                            placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalUploadTugas" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="<?= base_url('guru/upload_tugas') ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">Upload Tugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas_id" class="form-select" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            <?php foreach ($kelas as $k): ?>
                                                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select name="mata_pelajaran_id" class="form-select" required>
                                            <option value="">-- Pilih Mapel --</option>
                                            <?php foreach ($jadwal as $j): ?>
                                                <option value="<?= $j->mata_pelajaran_id ?>"><?= $j->mapel ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Judul Tugas</label>
                                        <input type="text" name="judul" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Batas Pengumpulan</label>
                                        <input type="date" name="batas_pengumpulan" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">File Tugas (PDF/DOC)</label>
                                        <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning">Upload</button>
                            </div>
                        </form>
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