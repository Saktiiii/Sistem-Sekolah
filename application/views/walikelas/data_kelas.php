<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Wali Kelas' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* === LAYOUT DASAR === */
.sidebar-container { 
    display: flex; 
    min-height: 100vh; 
}
.sidebar { 
    position: sticky; 
    top: 0; 
    height: 100vh; 
    overflow-y: auto; 
}
.main-content { 
    flex: 1; 
}
.detail-sidebar { 
    position: sticky; 
    top: 0; 
    height: 100vh; 
    overflow-y: auto; 
    transition: transform 0.3s ease; 
}
.detail-sidebar.hidden { 
    transform: translateX(100%); 
    width: 0; 
    padding: 0; 
    overflow: hidden; 
}

/* === TABEL DAN TEKS === */
.gender-male { color: #3b82f6; }
.gender-female { color: #ec4899; }
.table-hover tr:hover { background-color: #f9fafb; }

.table-container {
    position: relative;
    overflow: visible !important;
}
table {
    position: relative;
    z-index: 1;
}
td {
    position: relative;
}

/* === DROPDOWN PERBAIKAN === */
.dropdown { 
    position: relative; 
    display: inline-block; 
}

.dropdown-content { 
    display: none; 
    position: absolute; 
    bottom: 100%;              /* muncul ke atas tombol */
    right: 0;
    background-color: white; 
    min-width: 140px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
    z-index: 1000; 
    border-radius: 8px; 
    overflow: hidden;
    border: 1px solid #e5e7eb;
    margin-bottom: 6px;
    animation: fadeIn 0.2s ease;
}

/* Tombol di dalam dropdown */
.dropdown-content a,
.dropdown-content button {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    padding: 8px 12px;
    height: 36px;
    border: none;
    background: none;
    text-align: left;
    font-size: 13px;
    line-height: 1;
    color: #374151;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
    box-sizing: border-box;
}

.dropdown-content a:hover,
.dropdown-content button:hover {
    background-color: #f3f4f6;
}

.dropdown-content i {
    width: 16px;
    text-align: center;
    font-size: 14px;
}

.dropdown.active .dropdown-content { 
    display: block; 
}

/* Tombol titik tiga */
.action-btn { 
    background: none; 
    border: none; 
    cursor: pointer; 
    padding: 6px 10px;
    border-radius: 6px; 
    color: #6b7280;
    transition: all 0.2s;
    font-size: 14px;
}
.action-btn:hover { 
    background-color: #f3f4f6; 
    color: #374151;
}

/* Animasi muncul */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* === ALERT / NOTIFIKASI === */
.alert {
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 16px;
    font-weight: 500;
}
.alert-success {
    background-color: #d1fae5;
    border: 1px solid #a7f3d0;
    color: #065f46;
}
.alert-error {
    background-color: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

</style>

</head>
<body class="bg-gray-100 font-sans">
    <div class="sidebar-container">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md sidebar">
<div class="p-6 flex flex-col items-center space-y-3">
    <div class="flex items-center space-x-2">
        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">WK</div>
        <span class="font-semibold text-lg">Wali Kelas</span>
    </div>

    <!-- Tombol Logout -->
    <a href="<?= base_url('auth/logout') ?>" 
       class="mt-2 w-full text-center bg-red-500 hover:bg-red-600 text-white py-2 rounded-md text-sm font-medium transition">
       <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </a>
</div>

            <nav class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="<?= base_url('walipengumuman/walikelas') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fas fa-bullhorn mr-3"></i>
                            <span>Kirim Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('laporperkembangan') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fas fa-clipboard-list mr-3"></i>
                            <span>Lapor Perkembangan</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <span class="px-6 text-gray-400 uppercase text-xs">Kelas</span>
                    </li>
                    <li>
                        <a href="<?= base_url('walikelas/data_kelas') ?>" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
                            <i class="fas fa-book mr-3"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Administrasi Kelas</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 main-content">
            <!-- Notifikasi -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i><?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle mr-2"></i><?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (empty($kelas)): ?>
                <!-- Tampilan Error jika bukan wali kelas -->
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Akses Ditolak!</strong>
                    <span class="block sm:inline">Anda tidak memiliki akses sebagai wali kelas atau tidak memiliki kelas yang diampu.</span>
                </div>
            <?php else: ?>
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Wali Kelas</h1>
                    <p class="text-gray-600"><?= $kelas['nama_kelas'] ?> - <?= $kelas['nama_jurusan'] ?></p>
                    <p class="text-gray-500 text-sm">Wali Kelas: <?= $kelas['nama_wali_kelas'] ?></p>
                </div>

                <!-- Siswa Berprestasi -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Siswa Berprestasi</h2>
                    </div>
                    
                    <?php if (!empty($siswa_berprestasi)): ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden table-container">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">NIS</th>
                                    <th class="p-3">Rata-rata Nilai</th>
                                    <th class="p-3">Total Alpha</th>
                                    <th class="p-3">Gender</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($siswa_berprestasi as $siswa): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="flex items-center p-3 space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                            <?= substr($siswa['nama'], 0, 2) ?>
                                        </div>
                                        <span><?= $siswa['nama'] ?></span>
                                    </td>
                                    <td class="p-3"><?= $siswa['nis'] ?></td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                            <?= number_format($siswa['rata_rata_nilai'] ?? 0, 1) ?>
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                            <?= $siswa['total_alpha'] ?? 0 ?>
                                        </span>
                                    </td>
                                    <td class="p-3 <?= ($siswa['jenis_kelamin'] ?? 'L') == 'L' ? 'gender-male' : 'gender-female' ?>">
                                        <?= ($siswa['jenis_kelamin'] ?? 'L') == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="dropdown">
                                            <button class="action-btn dropdown-toggle">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-content">
                                                <button onclick="showStudentInfo(<?= $siswa['id'] ?>)">
                                                    <i class="fas fa-info-circle text-blue-500"></i> Info
                                                </button>
                                                <a href="<?= base_url('walikelas/form_edit_siswa/') ?><?= $siswa['id'] ?>">
                                                    <i class="fas fa-edit text-yellow-500"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                        <i class="fas fa-info-circle text-yellow-500 text-xl mb-2"></i>
                        <p class="text-yellow-700">Belum ada siswa berprestasi</p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Siswa Bermasalah -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Siswa Bermasalah</h2>
                    </div>
                    
                    <?php if (!empty($siswa_bermasalah)): ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden table-container">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">NIS</th>
                                    <th class="p-3">Rata-rata Nilai</th>
                                    <th class="p-3">Total Alpha</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Gender</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($siswa_bermasalah as $siswa): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="flex items-center p-3 space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                            <?= substr($siswa['nama'], 0, 2) ?>
                                        </div>
                                        <span><?= $siswa['nama'] ?></span>
                                    </td>
                                    <td class="p-3"><?= $siswa['nis'] ?></td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                            <?= number_format($siswa['rata_rata_nilai'] ?? 0, 1) ?>
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-medium">
                                            <?= $siswa['total_alpha'] ?? 0 ?>
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <?php 
                                        $status = 'Warning';
                                        $color = 'bg-yellow-100 text-yellow-800';
                                        if (($siswa['rata_rata_nilai'] ?? 0) < 70) {
                                            $status = 'Kritis';
                                            $color = 'bg-red-100 text-red-800';
                                        } elseif (($siswa['total_alpha'] ?? 0) > 10) {
                                            $status = 'Bahaya';
                                            $color = 'bg-red-100 text-red-800';
                                        }
                                        ?>
                                        <span class="px-2 py-1 <?= $color ?> rounded-full text-xs font-medium">
                                            <?= $status ?>
                                        </span>
                                    </td>
                                    <td class="p-3 <?= ($siswa['jenis_kelamin'] ?? 'L') == 'L' ? 'gender-male' : 'gender-female' ?>">
                                        <?= ($siswa['jenis_kelamin'] ?? 'L') == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="dropdown">
                                            <button class="action-btn dropdown-toggle">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-content">
                                                <button onclick="showStudentInfo(<?= $siswa['id'] ?>)">
                                                    <i class="fas fa-info-circle text-blue-500"></i> Info
                                                </button>
                                                <a href="<?= base_url('walikelas/form_beri_peringatan/') ?><?= $siswa['id'] ?>">
                                                    <i class="fas fa-exclamation-triangle text-orange-500"></i> Peringatan
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mb-2"></i>
                        <p class="text-green-700">Tidak ada siswa bermasalah</p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Rekap Absensi -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">Rekap Absensi Siswa</h2>
                    <div class="flex space-x-2 mb-2">
                        <a href="<?= base_url('walikelas/export_absensi/pdf') ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">PDF</a>
                        <a href="<?= base_url('walikelas/export_absensi/excel') ?>" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">XLS</a>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden table-container">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">Pertemuan</th>
                                    <th class="p-3">Hadir</th>
                                    <th class="p-3">Izin</th>
                                    <th class="p-3">Sakit</th>
                                    <th class="p-3">Alpa</th>
                                    <th class="p-3">Gender</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($rekap_absensi as $absensi): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3"><?= $absensi['nama'] ?></td>
                                    <td class="p-3"><?= $absensi['total_pertemuan'] ?></td>
                                    <td class="p-3"><?= $absensi['hadir'] ?></td>
                                    <td class="p-3"><?= $absensi['izin'] ?></td>
                                    <td class="p-3"><?= $absensi['sakit'] ?></td>
                                    <td class="p-3"><?= $absensi['alpha'] ?></td>
                                    <td class="p-3 <?= isset($absensi['jenis_kelamin']) && $absensi['jenis_kelamin'] == 'L' ? 'gender-male' : 'gender-female' ?>">
                                        <?= isset($absensi['jenis_kelamin']) ? ($absensi['jenis_kelamin'] == 'L' ? 'Male' : 'Female') : '-' ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="dropdown">
                                            <button class="action-btn dropdown-toggle">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-content">
                                                <button onclick="showStudentInfo(<?= $absensi['id'] ?>)">
                                                    <i class="fas fa-info-circle text-blue-500"></i> Info
                                                </button>
                                                <a href="<?= base_url('walikelas/form_edit_siswa/') ?><?= $absensi['id'] ?>">
                                                    <i class="fas fa-edit text-yellow-500"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Data Siswa -->
                <div>
<!-- Data Siswa -->
<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Data Siswa</h2>
        <button onclick="openTambahModal()" 
            class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium transition">
            <i class="fas fa-plus mr-1"></i> Tambah Siswa
        </button>
    </div>

                    
                    <?php if (!empty($siswa_kelas)): ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden table-container">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">NIS</th>
                                    <th class="p-3">Alamat</th>
                                    <th class="p-3">Telepon</th>
                                    <th class="p-3">Gender</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($siswa_kelas as $siswa): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="flex items-center p-3 space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                                            <?= substr($siswa['nama'], 0, 2) ?>
                                        </div>
                                        <span><?= $siswa['nama'] ?></span>
                                    </td>
                                    <td class="p-3"><?= $siswa['nis'] ?></td>
                                    <td class="p-3"><?= $siswa['alamat'] ?></td>
                                    <td class="p-3"><?= $siswa['telepon'] ?></td>
                                    <td class="p-3 <?= ($siswa['jenis_kelamin'] ?? 'L') == 'L' ? 'gender-male' : 'gender-female' ?>">
                                        <?= ($siswa['jenis_kelamin'] ?? 'L') == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="dropdown">
                                            <button class="action-btn dropdown-toggle">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-content">
                                                <button onclick="showStudentInfo(<?= $siswa['id'] ?>)">
                                                    <i class="fas fa-info-circle text-blue-500"></i> Info
                                                </button>
                                                <a href="<?= base_url('walikelas/form_edit_siswa/') ?><?= $siswa['id'] ?>">
                                                    <i class="fas fa-edit text-yellow-500"></i> Edit
                                                </a>
                                                <button onclick="hapusSiswa(<?= $siswa['id'] ?>)">
                                                    <i class="fas fa-trash text-red-500"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
                        <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Siswa</h3>
                        <p class="text-gray-500 mb-4">Tambahkan siswa pertama untuk kelas ini</p>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </main>

        <!-- Detail Siswa -->
        <aside id="detailSidebar" class="w-80 bg-white shadow-md p-6 detail-sidebar hidden">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Detail Siswa</h2>
                <button onclick="closeStudentInfo()" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <div class="flex flex-col items-center">
                <div id="studentAvatar" class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold"></div>
                <h2 id="studentName" class="mt-2 font-semibold text-lg"></h2>
                <p id="studentId" class="text-gray-500"></p>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Informasi Pribadi</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li id="studentFullName"></li>
                    <li id="studentDob"></li>
                    <li id="studentGender"></li>
                    <li id="studentAddress"></li>
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Informasi Akademik</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li id="studentSchool"></li>
                    <li id="studentNisNisn"></li>
                    <li id="studentClass"></li>
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Informasi Orang Tua/Wali</h3>
                <ul id="studentParents" class="text-sm text-gray-700 space-y-1">
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Prestasi</h3>
                <ul id="studentAchievements" class="text-sm text-gray-700 space-y-1">
                </ul>
            </div>
        </aside>
    </div>

    <!-- Modal Tambah Siswa -->
<div id="tambahModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold mb-4">Tambah Siswa</h2>
        <form id="formTambahSiswa">
            <div class="mb-3">
    <label class="block text-sm font-medium text-gray-700">Pilih User</label>
    <select name="users_id" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
        <option value="">-- Pilih User Siswa --</option>
        <?php foreach ($available_users as $u): ?>
            <option value="<?= $u['id'] ?>"><?= $u['username'] ?></option>
        <?php endforeach; ?>
    </select>
</div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" name="nis" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Telepon</label>
                <input type="text" name="telepon" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeTambahModal()" class="bg-gray-300 px-4 py-2 rounded text-sm">Batal</button>
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>


    <script>
        // Fungsi untuk mengelola dropdown
        document.addEventListener('DOMContentLoaded', function() {
            // Menutup dropdown saat klik di luar
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                        dropdown.classList.remove('active');
                    });
                }
            });
            
            // Toggle dropdown saat tombol diklik
            document.querySelectorAll('.dropdown-toggle').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.closest('.dropdown');
                    document.querySelectorAll('.dropdown').forEach(function(d) {
                        if (d !== dropdown) {
                            d.classList.remove('active');
                        }
                    });
                    dropdown.classList.toggle('active');
                });
            });
        });

        // Fungsi untuk menampilkan info siswa
        async function showStudentInfo(siswaId) {
            try {
                const response = await axios.get('<?= base_url('walikelas/get_detail_siswa/') ?>' + siswaId);
                
                if (response.data.success) {
                    const data = response.data.data;
                    const siswa = data.siswa;
                    
                    // Update data di panel detail
                    document.getElementById('studentAvatar').textContent = siswa.nama.substring(0, 2).toUpperCase();
                    document.getElementById('studentAvatar').className = `w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold`;
                    document.getElementById('studentName').textContent = siswa.nama;
                    document.getElementById('studentId').textContent = siswa.nis;
                    document.getElementById('studentFullName').textContent = siswa.nama;
                    document.getElementById('studentDob').textContent = 'Tanggal Lahir: ' + (siswa.tanggal_lahir || '-');
                    document.getElementById('studentGender').textContent = 'Jenis Kelamin: ' + (siswa.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan');
                    document.getElementById('studentAddress').textContent = 'Alamat: ' + (siswa.alamat || '-');
                    document.getElementById('studentSchool').textContent = 'SMK Negeri 2 Karanganyar';
                    document.getElementById('studentNisNisn').textContent = 'NIS: ' + siswa.nis;
                    document.getElementById('studentClass').textContent = 'Kelas: ' + siswa.nama_kelas;
                    
                    // Update orang tua
                    const parentsList = document.getElementById('studentParents');
                    parentsList.innerHTML = '';
                    if (data.orang_tua) {
                        const li = document.createElement('li');
                        li.textContent = data.orang_tua.nama + ' (' + data.orang_tua.hubungan + ') - ' + (data.orang_tua.telepon || '');
                        parentsList.appendChild(li);
                    } else {
                        const li = document.createElement('li');
                        li.innerHTML = '<i>Data orang tua belum tersedia</i>';
                        li.className = 'text-gray-400';
                        parentsList.appendChild(li);
                    }
                    
                    // Update prestasi
                    const achievementsList = document.getElementById('studentAchievements');
                    achievementsList.innerHTML = '';
                    if (data.prestasi && data.prestasi.length > 0) {
                        data.prestasi.forEach(prestasi => {
                            const li = document.createElement('li');
                            li.textContent = prestasi.nama_mapel + ': ' + prestasi.nilai_total;
                            achievementsList.appendChild(li);
                        });
                    } else {
                        const li = document.createElement('li');
                        li.innerHTML = '<i>Belum ada prestasi</i>';
                        li.className = 'text-gray-400';
                        achievementsList.appendChild(li);
                    }
                    
                    // Tampilkan panel detail
                    document.getElementById('detailSidebar').classList.remove('hidden');
                } else {
                    alert('Data siswa tidak ditemukan');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data siswa');
            }
        }

        // Fungsi untuk menutup panel detail
        function closeStudentInfo() {
            document.getElementById('detailSidebar').classList.add('hidden');
        }

        // Fungsi hapus siswa dengan konfirmasi
function hapusSiswa(id) {
    if (confirm('Yakin ingin menghapus siswa ini? Data tidak bisa dikembalikan.')) {
        window.location.href = '<?= base_url('walikelas/hapus_siswa/') ?>' + id;
    }
}

// === Modal Tambah Siswa ===
function openTambahModal() {
    document.getElementById('tambahModal').classList.remove('hidden');
}
function closeTambahModal() {
    document.getElementById('tambahModal').classList.add('hidden');
}

// Simpan siswa pakai AJAX
document.getElementById('formTambahSiswa').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    try {
        const response = await axios.post('<?= base_url('walikelas/tambah_siswa') ?>', formData);
        if (response.data.success) {
            alert('Siswa berhasil ditambahkan');
            location.reload(); // reload biar data langsung muncul
        } else {
            alert(response.data.message || 'Gagal menambah siswa');
        }
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat menambah siswa');
    }
});

       
        
        function editSiswa(id) {
            window.location.href = '<?= base_url('walikelas/form_edit_siswa/') ?>' + id;
        }
        
        function beriPeringatan(id) {
            window.location.href = '<?= base_url('walikelas/form_beri_peringatan/') ?>' + id;
        }
    </script>
</body>
</html>