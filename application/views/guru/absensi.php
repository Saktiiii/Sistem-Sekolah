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
                <h4>📘 Absensi Guru</h4>

                <ul class="nav nav-tabs mt-3" id="akademikTabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#absensi">Absensi</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#lihat_absensi">Lihat
                            Absensi</a></li>
                </ul>

                <div class="tab-content mt-3">
                    <!-- Absensi -->
                    <div class="tab-pane fade" id="absensi">
                        <div class="container mt-4" style="max-width: 500px;">
                            <h4>Absen</h4>
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                            <?php endif; ?>

                            <form method="post" action="<?= base_url('guru/absen') ?>">
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>NIP</label>
                                    <input type="text" name="nip" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Waktu</label>
                                    <input type="time" name="waktu" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Absen</button>
                            </form>
                        </div>
                    </div>

                    <!-- Lihat Absensi -->
                    <div class="tab-pane fade" id="lihat_absensi">
                        <h2>Absensi</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($absensi as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $a['nama'] ?></td>
                                        <td><?= $a['nip'] ?></td>
                                        <td><?= $a['tanggal'] ?></td>
                                        <td><?= $a['waktu'] ?></td>
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