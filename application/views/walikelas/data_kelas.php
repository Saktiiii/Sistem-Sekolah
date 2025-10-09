<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Wali Kelas' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .sidebar-container { display: flex; min-height: 100vh; }
        .sidebar { position: sticky; top: 0; height: 100vh; overflow-y: auto; }
        .main-content { flex: 1; }
        .detail-sidebar { position: sticky; top: 0; height: 100vh; overflow-y: auto; transition: transform 0.3s ease; }
        .detail-sidebar.hidden { transform: translateX(100%); width: 0; padding: 0; overflow: hidden; }
        .gender-male { color: #3b82f6; }
        .gender-female { color: #ec4899; }
        .table-hover tr:hover { background-color: #f9fafb; }
        .dropdown { position: relative; display: inline-block; }
        .dropdown-content { display: none; position: absolute; right: 0; background-color: white; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1); z-index: 1; border-radius: 4px; overflow: hidden; }
        .dropdown-content button { width: 100%; text-align: left; padding: 8px 12px; border: none; background: none; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .dropdown-content button:hover { background-color: #f3f4f6; }
        .dropdown:hover .dropdown-content { display: block; }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="sidebar-container">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md sidebar">
            <div class="p-6 flex items-center space-x-2">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">WK</div>
                <span class="font-semibold text-lg">Wali Kelas</span>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="<?= base_url('walipengumuman/walikelas') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📢 <span class="ml-3">Kirim Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('laporperkembangan') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📋 <span class="ml-3">Lapor Perkembangan</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <span class="px-6 text-gray-400 uppercase text-xs">Kelas</span>
                    </li>
                    <li>
                        <a href="<?= base_url('walikelas/data_kelas') ?>" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
                            📚 <span class="ml-3">Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            ⚙️ <span class="ml-3">Administrasi Kelas</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 main-content">
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


                <!-- Siswa Bermasalah -->
                <?php if (!empty($siswa_bermasalah)): ?>
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Siswa Bermasalah</h2>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">NIS</th>
                                    <th class="p-3">Total Alpha</th>
                                    <th class="p-3">Rata-rata Nilai</th>
                                    <th class="p-3">Gender</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($siswa_bermasalah as $siswa): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3"><?= $siswa['nama'] ?></td>
                                    <td class="p-3"><?= $siswa['nis'] ?></td>
                                    <td class="p-3"><?= $siswa['total_alpha'] ?? 0 ?></td>
                                    <td class="p-3"><?= number_format($siswa['rata_rata_nilai'] ?? 0, 2) ?></td>
                                    <td class="p-3 <?= $siswa['jenis_kelamin'] == 'L' ? 'gender-male' : 'gender-female' ?>">
                                        <?= $siswa['jenis_kelamin'] == 'L' ? 'Male' : 'Female' ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="dropdown">
                                            <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                            <div class="dropdown-content">
                                                <button onclick="showStudentInfo(<?= $siswa['id'] ?>)">
                                                    <span>ℹ️</span> Info
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Siswa Berprestasi -->
<div class="mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Siswa Berprestasi</h2>
        <button onclick="tambahPrestasi()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Prestasi
        </button>
    </div>
    
    <?php if (!empty($siswa_berprestasi)): ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
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
                        <div class="flex space-x-2">
                            <button onclick="showStudentInfo(<?= $siswa['id'] ?>)" 
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition text-xs">
                                <i class="fas fa-info-circle mr-1"></i> Detail
                            </button>
                            <button onclick="editSiswa(<?= $siswa['id'] ?>)" 
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-xs">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
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
        <button onclick="tambahCatatanMasalah()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i> Tambah Catatan
        </button>
    </div>
    
    <?php if (!empty($siswa_bermasalah)): ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
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
                        <div class="flex space-x-2">
                            <button onclick="showStudentInfo(<?= $siswa['id'] ?>)" 
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition text-xs">
                                <i class="fas fa-info-circle mr-1"></i> Detail
                            </button>
                            <button onclick="beriPeringatan(<?= $siswa['id'] ?>)" 
                                    class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 transition text-xs">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Peringatan
                            </button>
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
                    <div class="bg-white rounded-lg shadow overflow-hidden">
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
                                            <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                            <div class="dropdown-content">
                                                <button onclick="showStudentInfo(<?= $absensi['id'] ?>)">
                                                    <span>ℹ️</span> Info
                                                </button>
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
                <!-- Data Siswa -->
<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Data Siswa</h2>
        <button onclick="tambahSiswa()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Tambah Siswa
        </button>
    </div>
    
    <?php if (!empty($siswa_kelas)): ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
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
                        <div class="flex space-x-2">
                            <button onclick="showStudentInfo(<?= $siswa['id'] ?>)" 
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition text-xs">
                                <i class="fas fa-eye mr-1"></i> Lihat
                            </button>
                            <button onclick="editSiswa(<?= $siswa['id'] ?>)" 
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-xs">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button onclick="hapusSiswa(<?= $siswa['id'] ?>)" 
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition text-xs">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
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
        <button onclick="tambahSiswa()" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
            <i class="fas fa-user-plus mr-2"></i> Tambah Siswa Pertama
        </button>
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

    <script>
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
    </script>
</body>
</html>