<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Pengumuman</title>
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
            <div class="container-fluid p-0">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Pengumuman</h1>

                <div class="col-md-12 p-4 mx-auto">
                    <div class="card shadow-lg mt-5 border-0 rounded-4">
                        <div
                            class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                            <h4 class="mb-0 fw-bold">Kelola Pengumuman</h4>
                            <button type="button" class="btn btn-light fw-semibold text-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahPengumumanModal">
                                <i class="bi bi-plus-circle"></i> Buat Pengumuman
                            </button>
                        </div>

                        <div class="card-body p-4">
                            <p class="text-muted mb-4 small">Daftar semua pengumuman yang telah dipublikasikan.</p>

                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover align-middle">
                                    <thead class="table-light border-bottom border-3">
                                        <tr>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Isi Singkat</th>
                                            <th scope="col" class="text-nowrap">Dipublikasi</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col">Kelas Tujuan</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($pengumuman)): ?>
                                            <?php foreach ($pengumuman as $p): ?>
                                                <tr>
                                                    <td class="fw-semibold text-primary"><?= htmlspecialchars($p->judul); ?>
                                                    </td>
                                                    <td class="text-muted small">
                                                        <?= (strlen($p->isi) > 70) ? htmlspecialchars(substr($p->isi, 0, 70)) . '...' : htmlspecialchars($p->isi); ?>
                                                    </td>
                                                    <td class="text-nowrap small text-secondary">
                                                        <?= date('d M Y', strtotime($p->tanggal_pembuatan)); ?><br><small
                                                            class="text-muted"><?= date('H:i', strtotime($p->tanggal_pembuatan)); ?></small>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($p->status == 'umum'): ?>
                                                            <span
                                                                class="badge rounded-pill bg-success-subtle text-success py-2 px-3">Umum</span>
                                                        <?php else: ?>
                                                            <span
                                                                class="badge rounded-pill bg-primary-subtle text-primary py-2 px-3">Kelas</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="small">
                                                        <?= $p->nama_kelas ?: '<span class="text-muted">Semua</span>'; ?></td>
                                                    <td class="text-nowrap text-center">
                                                        <a href="<?= site_url('guru/hapus_pengumuman/' . $p->id); ?>"
                                                            class="btn btn-sm btn-outline-danger border-0"
                                                            onclick="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <div class="alert alert-light text-primary border-0 mb-0" role="alert">
                                                        <i class="bi bi-info-circle-fill me-2"></i> Belum ada pengumuman
                                                        yang tercatat. Silakan buat pengumuman baru.
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="tambahPengumumanModal" tabindex="-1"
                    aria-labelledby="tambahPengumumanModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content shadow-xl border-0 rounded-4">
                            <form action="<?= site_url('guru/simpan_pengumuman'); ?>" method="post">
                                <div class="modal-header bg-primary text-white rounded-top-4">
                                    <h5 class="modal-title fw-bold" id="tambahPengumumanModalLabel">Publikasikan
                                        Pengumuman Baru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="judul" class="form-label fw-semibold">Judul Pengumuman <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="judul" id="judul" class="form-control" required
                                                placeholder="Contoh: Perubahan Jadwal Ujian">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="statusSelect" class="form-label fw-semibold">Jenis Audiens <span
                                                    class="text-danger">*</span></label>
                                            <select name="status" class="form-select" id="statusSelect" required>
                                                <option value="umum" selected>Umum (Semua)</option>
                                                <option value="kelas">Spesifik Kelas</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" id="kelasSelectContainer"
                                            style="opacity: 0.5; transition: opacity 0.3s ease-in-out;">
                                            <label for="id_kelas" class="form-label fw-semibold">Pilih Kelas</label>
                                            <select name="id_kelas" id="id_kelas" class="form-select" disabled>
                                                <option value="">-- Pilih Kelas --</option>
                                                <?php foreach ($kelas as $k): ?>
                                                    <option value="<?= $k->id; ?>"><?= $k->nama_kelas; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <label for="isi" class="form-label fw-semibold">Detail Pengumuman <span
                                                class="text-danger">*</span></label>
                                        <textarea name="isi" id="isi" class="form-control" rows="6" required
                                            placeholder="Tuliskan isi pengumuman secara lengkap dan jelas di sini..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 pt-0"> <button type="button"
                                        class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success fw-bold">
                                        <i class="bi bi-send-fill"></i> Publikasikan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const statusSelect = document.getElementById('statusSelect');
                        const kelasSelectElement = document.getElementById('id_kelas');
                        const kelasSelectContainer = document.getElementById('kelasSelectContainer');

                        function toggleKelasSelect() {
                            if (statusSelect.value === 'kelas') {
                                // Aktifkan dan jadikan required
                                kelasSelectElement.removeAttribute('disabled');
                                kelasSelectElement.setAttribute('required', 'required');
                                kelasSelectContainer.style.opacity = '1';
                                // Note: Transisi opacity menggunakan style inline yang diizinkan untuk efek halus
                            } else {
                                // Non-aktifkan dan hapus required
                                kelasSelectElement.setAttribute('disabled', 'disabled');
                                kelasSelectElement.removeAttribute('required');
                                kelasSelectContainer.style.opacity = '0.5';
                            }
                        }

                        // Jalankan saat inisialisasi
                        toggleKelasSelect();

                        // Jalankan saat nilai dropdown status berubah
                        statusSelect.addEventListener('change', toggleKelasSelect);
                    });
                </script>


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