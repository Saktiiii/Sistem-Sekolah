<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Kelas - Administrasi Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-container {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            background: white;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
        }
        
        .main-content {
            flex: 1;
            background-color: #f8fafc;
            overflow-y: auto;
        }
        
        .card-feature {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .card-feature:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }
        
        .card-feature.active {
            border-color: #fb923c;
            box-shadow: 0 4px 12px rgba(251, 146, 60, 0.2);
        }
        
        .card-feature:not(.active) {
            border-color: #dbeafe;
        }
        
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 16px;
            transition: all 0.3s ease;
        }
        
        .card-feature.active .icon-circle {
            background-color: #fed7aa !important;
        }
        
        .card-feature.active .icon-circle i {
            color: #fb923c !important;
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in;
        }
        
        .tab-content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #4f46e5;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 8px;
        }
        
        .stat-label {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }
        
        .schedule-item {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            position: relative;
        }
        
        .schedule-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #4f46e5;
        }
        
        .schedule-item:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }
        
        .schedule-item.piket::before {
            background: #fb923c;
        }
        
        .schedule-item.kegiatan::before {
            background: #10b981;
        }
        
        .schedule-item.pelajaran::before {
            background: #4f46e5;
        }
        
        .schedule-number {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .schedule-time {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
        }
        
        .schedule-item.piket .schedule-time {
            background: linear-gradient(135deg, #fb923c, #f59e0b);
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        
        .admin-title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .filter-btn {
            background: white;
            border: 1px solid #e5e7eb;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            color: #6b7280;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover {
            border-color: #4f46e5;
            color: #4f46e5;
        }

        .nav-item {
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .nav-item:hover {
            background-color: #f0f4ff;
            color: #4f46e5;
        }
        
        .nav-item.active {
            background-color: #4f46e5;
            color: white;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .table-header {
            background: #f8fafc;
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 600;
            color: #374151;
        }
        
        .table-row {
            display: grid;
            grid-template-columns: 80px 1fr 1fr 1fr;
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            align-items: center;
        }
        
        .table-row:last-child {
            border-bottom: none;
        }
        
        .table-row:hover {
            background: #f9fafb;
        }
        
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
        }
        
        .schedule-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #4f46e5;
            transition: all 0.3s ease;
        }
        
        .schedule-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .schedule-card.piket {
            border-left-color: #fb923c;
        }
        
        .schedule-card.kegiatan {
            border-left-color: #10b981;
        }
    </style>
</head>
<body>
<div id="notifBox" 
     class="fixed top-6 right-6 hidden transition-all duration-500 transform opacity-0 translate-y-[-10px] text-white font-medium rounded-md shadow-lg z-[9999]">
</div>

    <div class="sidebar-container">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md sidebar">
            <div class="p-6 flex flex-col items-center space-y-3">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                        WK
                    </div>
                    <span class="font-semibold text-lg">Wali Kelas</span>
                </div>

                <!-- Tombol Logout -->
                <a href="<?= base_url('auth/logout') ?>" class="mt-2 w-full text-center bg-red-500 hover:bg-red-600 text-white py-2 rounded-md text-sm font-medium transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>

            <nav class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="<?= base_url('walikelas/kirim_pengumuman') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fas fa-bullhorn mr-3"></i>
                            <span>Kirim Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('walikelas/lapor_perkembangan') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fas fa-clipboard-list mr-3"></i>
                            <span>Lapor Perkembangan</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <span class="px-6 text-gray-400 uppercase text-xs">Kelas</span>
                    </li>
                    <li>
                        <a href="<?= base_url('walikelas/data_kelas') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <i class="fas fa-book mr-3"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('walikelas/administrasi_kelas') ?>" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Administrasi Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('walikelas/laporan') ?>" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            <span class="ml-3">Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Content Area -->
            <div class="p-8">

                <!-- Feature Cards sebagai Tab Navigation -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="card-feature text-center active" data-tab="pelajaran">
                        <div class="icon-circle" style="background-color: #dbeafe;">
                            <i class="fas fa-book text-blue-500"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Jadwal Pelajaran</h3>
                        <p class="text-sm text-gray-600">Atur jadwal mata pelajaran</p>
                    </div>

                    <div class="card-feature text-center" data-tab="piket">
                        <div class="icon-circle" style="background-color: #dbeafe;">
                            <i class="fas fa-clock text-blue-500"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Jadwal Piket</h3>
                        <p class="text-sm text-gray-600">Kelola piket harian siswa</p>
                    </div>

                    <div class="card-feature text-center" data-tab="kegiatan">
                        <div class="icon-circle" style="background-color: #dbeafe;">
                            <i class="fas fa-tasks text-blue-500"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Kegiatan Kelas</h3>
                        <p class="text-sm text-gray-600">Organize kegiatan kelas</p>
                    </div>
                </div>

                <!-- Tab Content -->
                
                <!-- Jadwal Pelajaran Tab -->
<div class="tab-content active" id="pelajaran-tab">
    <div class="bg-white rounded-lg p-6 mb-8 shadow-sm">
        <div class="section-header">
            <h2 class="section-title">Jadwal Pelajaran</h2>
            <div class="flex space-x-2">
<form method="get" action="<?= base_url('walikelas/administrasi_kelas') ?>" class="flex space-x-2">
<select class="filter-btn" onchange="window.location.href='?hari=' + this.value">
    <option disabled selected>Pilih Hari</option>
    <option value="Senin" <?= ($hari_terpilih == 'Senin') ? 'selected' : '' ?>>Senin</option>
    <option value="Selasa" <?= ($hari_terpilih == 'Selasa') ? 'selected' : '' ?>>Selasa</option>
    <option value="Rabu" <?= ($hari_terpilih == 'Rabu') ? 'selected' : '' ?>>Rabu</option>
    <option value="Kamis" <?= ($hari_terpilih == 'Kamis') ? 'selected' : '' ?>>Kamis</option>
    <option value="Jumat" <?= ($hari_terpilih == 'Jumat') ? 'selected' : '' ?>>Jumat</option>
</select>


            <button type="button" 
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition flex items-center"
                    onclick="openModal('modalTambah')">
                <i class="fas fa-plus mr-2"></i>Tambah
            </button>
<button type="button" 
    class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition flex items-center"
    onclick="openEditModal('<?= base_url('walikelas/get_jadwal_by_hari') ?>', '<?= $hari_terpilih ?>', <?= $kelas['id'] ?>)">
    <i class="fas fa-edit mr-2"></i>Edit
</button>

</form>

            </div>
        </div>

        <div class="flex gap-6 mt-6">
            <!-- Left Side - Statistics -->
            <?php
// Hitung total durasi semua jadwal hari terpilih
$total_detik = 0;
$total_mapel = count($jadwal);
$guru_unik = [];

foreach ($jadwal as $j) {
    $mulai = strtotime($j['jam_mulai']);
    $selesai = strtotime($j['jam_selesai']);
    $selisih = $selesai - $mulai;
    $total_detik += $selisih;

    if (!empty($j['guru'])) {
        $guru_unik[$j['guru']] = true;
    }
}

// Konversi total durasi ke jam & menit
$total_jam = floor($total_detik / 3600);
$total_menit = floor(($total_detik % 3600) / 60);

// Format ke bentuk jam.menit (misal 2.30 jam)
$total_durasi = $total_jam . '.' . str_pad($total_menit, 2, '0', STR_PAD_LEFT);

// Hitung total guru unik
$total_guru = count($guru_unik);
?>

<div class="flex flex-col gap-4" style="min-width: 200px;">
    <div class="stat-card">
        <div class="stat-number"><?= $total_durasi ?></div>
        <div class="stat-label">Jam Pelajaran</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $total_mapel ?></div>
        <div class="stat-label">Mata Pelajaran</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $total_guru ?></div>
        <div class="stat-label">Guru</div>
    </div>
</div>


            <!-- Right Side - Schedule Grid -->
            <div class="flex-1">
                <!-- Jadwal Pagi -->
                <div class="mb-6">
                    <div class="grid grid-cols-1 gap-4">
                        <?php foreach ($jadwal as $j): ?>
    <div class="schedule-item pelajaran">
        <div class="flex-1 p-4 flex items-center gap-4">
            <div class="text-center" style="min-width: 100px;">
                <div class="text-2xl font-bold text-gray-800"><?= $j['id'] ?></div>
                <div class="text-xs text-gray-500">Jam Pelajaran</div>
            </div>
            <div class="bg-gray-100 rounded px-4 py-2 text-center" style="min-width: 120px;">
                <div class="font-semibold text-sm text-gray-800">
                    <?= $j['jam_mulai'] ?> - <?= $j['jam_selesai'] ?>
                </div>
<?php
$mulai = strtotime($j['jam_mulai']);
$selesai = strtotime($j['jam_selesai']);
$selisih = $selesai - $mulai;

$jam = floor($selisih / 3600);
$menit = floor(($selisih % 3600) / 60);

$durasi_format = $jam . '.' . str_pad($menit, 2, '0', STR_PAD_LEFT);
?>
<?= $durasi_format ?> jam



            </div>
            <div class="flex-1 text-left">
                <div class="font-medium text-gray-800"><?= $j['mata_pelajaran'] ?></div>
                <div class="text-sm text-gray-600"><?= $j['guru'] ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Jadwal Piket Tab -->
<div class="tab-content" id="piket-tab">
    <div class="bg-white rounded-lg p-6 mb-8 shadow-sm">
        <div class="section-header">
            <h2 class="section-title">Jadwal Piket</h2>
            <div class="flex space-x-2">
                <select class="filter-btn">
                    <option>Minggu Ini</option>
                    <option>Minggu Depan</option>
                </select>
                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-orange-600 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Piket
                </button>
            </div>
        </div>

        <div class="flex gap-6 mt-6">
            <!-- Left Side - Statistics -->
            <div class="flex flex-col gap-4" style="min-width: 200px;">
                <div class="stat-card">
                    <div class="stat-number">5</div>
                    <div class="stat-label">Jumlah Siswa</div>
                </div>
                
                <!-- Area Piket Switch -->
                <div class="area-switch mt-4">
                    <div class="bg-gray-100 rounded-lg p-1 flex">
                        <button class="area-btn active flex-1 py-2 px-3 rounded-md text-sm font-medium transition" data-area="kelas">
                            Kelas
                        </button>
                        <button class="area-btn flex-1 py-2 px-3 rounded-md text-sm font-medium transition" data-area="lab">
                            Lab
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side - Piket Grid -->
            <div class="flex-1">
                <!-- Piket Kelas -->
<div id="kelas-piket" class="grid grid-cols-2 gap-4">
    <?php if (!empty($piket_kelas)): ?>
        <?php foreach ($piket_kelas as $p): ?>
        <div class="schedule-item piket">
            <div class="flex-1 p-4">
                <div class="text-center mb-3">
                    <div class="text-lg font-bold text-gray-800"><?= $p['hari'] ?></div>
                    <div class="text-xs text-gray-500"><?= ucfirst($p['area']) ?></div>
                </div>
                <div class="text-center font-medium text-gray-800">
                    <?= $p['nama_siswa'] ?: 'Belum ditentukan' ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-500 text-sm col-span-2 text-center">Belum ada jadwal piket kelas</p>
    <?php endif; ?>
</div>



<div id="lab-piket" class="grid grid-cols-2 gap-4 hidden">
    <?php if (!empty($piket_lab)): ?>
        <?php foreach ($piket_lab as $p): ?>
        <div class="schedule-item piket">
            <div class="flex-1 p-4">
                <div class="text-center mb-3">
                    <div class="text-lg font-bold text-gray-800"><?= $p['hari'] ?></div>
                    <div class="text-xs text-gray-500"><?= ucfirst($p['area']) ?></div>
                </div>
                <div class="text-center font-medium text-gray-800">
                    <?= $p['nama_siswa'] ?: 'Belum ditentukan' ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-500 text-sm col-span-2 text-center">Belum ada jadwal piket lab</p>
    <?php endif; ?>
</div>

            </div>
        </div>
    </div>
</div>

<div id="notifBox" class="fixed top-5 right-5 hidden bg-red-500 text-white px-4 py-3 rounded shadow-md z-50"></div>

<script>
document.getElementById('formTambahJadwal').addEventListener('submit', async function(e) {
  e.preventDefault();

  const formData = new FormData(this);
  const response = await fetch(this.action, {
    method: 'POST',
    body: formData
  });

  const result = await response.json();
  const notifBox = document.getElementById('notifBox');

  if (result.success) {
    notifBox.textContent = result.message || 'Jadwal berhasil ditambahkan.';
    notifBox.className = 'fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded shadow-md z-50';
  } else {
    notifBox.textContent = result.message || 'Jam tersebut sudah terpakai. Silakan pilih jam lain.';
    notifBox.className = 'fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded shadow-md z-50';
  }

  notifBox.classList.remove('hidden');
  setTimeout(() => notifBox.classList.add('hidden'), 3000);

  if (result.success) location.reload();
});
</script>

<!-- Modal Edit Jadwal (pindahkan ke sini, sebelum </body>) -->
<div id="modalEditJadwal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-[9999]">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
    <h3 class="text-lg font-bold mb-4 text-gray-800">Edit Jadwal Pelajaran</h3>

    <div id="editList" class="space-y-3 max-h-[400px] overflow-y-auto">
      <!-- Daftar jadwal dinamis -->
    </div>

    <div class="flex justify-end mt-4">
      <button type="button" onclick="closeModal('modalEditJadwal')" class="bg-gray-300 px-4 py-2 rounded-md text-sm hover:bg-gray-400">
        Tutup
      </button>
    </div>

    <button onclick="closeModal('modalEditJadwal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
      <i class="fas fa-times"></i>
    </button>
  </div>
</div>


<!-- Modal Tambah Jadwal -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
    <h3 class="text-lg font-bold mb-4 text-gray-800">Tambah Jadwal Pelajaran</h3>

<form id="formTambahJadwal" method="post" action="<?= base_url('walikelas/tambah_jadwal') ?>" onsubmit="return submitJadwal(event, this)">
    <input type="hidden" name="kelas_id" value="<?= $kelas['id'] ?>">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
        <select name="hari" class="w-full border border-gray-300 rounded-md p-2">
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>
        </select>
      </div>

<div class="mb-4">
  <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
  <select name="mata_pelajaran_id" class="w-full border border-gray-300 rounded-md p-2" required>
    <option disabled selected>Pilih Mata Pelajaran</option>
    <?php foreach ($mata_pelajaran as $mp): ?>
      <option value="<?= $mp['id'] ?>"><?= $mp['nama_mapel'] ?></option>
    <?php endforeach; ?>
  </select>
</div>

<div class="mb-4">
  <label class="block text-sm font-medium text-gray-700 mb-1">Guru Pengajar</label>
  <select name="guru_id" class="w-full border border-gray-300 rounded-md p-2" required>
    <option disabled selected>Pilih Guru</option>
    <?php foreach ($guru as $g): ?>
      <option value="<?= $g['id'] ?>"><?= $g['nama'] ?></option>
    <?php endforeach; ?>
  </select>
</div>


      <div class="flex gap-4 mb-4">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
          <input type="time" name="jam_mulai" class="w-full border border-gray-300 rounded-md p-2" required>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
          <input type="time" name="jam_selesai" class="w-full border border-gray-300 rounded-md p-2" required>
        </div>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal('modalTambah')" class="bg-gray-300 px-4 py-2 rounded-md text-sm hover:bg-gray-400">
          Batal
        </button>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
          Simpan
        </button>
      </div>
    </form>

    <button onclick="closeModal('modalTambah')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
      <i class="fas fa-times"></i>
    </button>
  </div>
</div>

<script>
function openModal(id) {
  document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
  document.getElementById(id).classList.add('hidden');
}


document.addEventListener('DOMContentLoaded', function() {
    const areaBtns = document.querySelectorAll('.area-btn');
    const kelasPiket = document.getElementById('kelas-piket');
    const labPiket = document.getElementById('lab-piket');
    
    areaBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            areaBtns.forEach(b => b.classList.remove('active', 'bg-white', 'text-orange-600', 'shadow-sm'));
            areaBtns.forEach(b => b.classList.add('text-gray-600'));
            
            // Add active class to clicked button
            this.classList.add('active', 'bg-white', 'text-orange-600', 'shadow-sm');
            this.classList.remove('text-gray-600');
            
            const area = this.getAttribute('data-area');
            
            // Show/hide appropriate piket lists
            if (area === 'kelas') {
                kelasPiket.classList.remove('hidden');
                labPiket.classList.add('hidden');
            } else {
                kelasPiket.classList.add('hidden');
                labPiket.classList.remove('hidden');
            }
        });
    });
});
</script>

<style>
.schedule-item.piket {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: white;
    transition: all 0.3s ease;
    text-align: center;
}

.schedule-item.piket:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.stat-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
    text-align: center;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    color: #1f2937;
}

.stat-label {
    font-size: 12px;
    color: #6b7280;
    margin-top: 4px;
}

.filter-btn {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 14px;
    color: #374151;
    background: white;
    cursor: pointer;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.section-title {
    font-size: 20px;
    font-weight: bold;
    color: #1f2937;
}

.area-btn {
    transition: all 0.3s ease;
}

.area-btn.active {
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.hidden {
    display: none;
}
</style>

<!-- Kegiatan Kelas Tab -->
<div class="tab-content" id="kegiatan-tab">
    <div class="bg-white rounded-lg p-6 mb-8 shadow-sm">
        <div class="section-header">
            <h2 class="section-title">Kegiatan Kelas</h2>
            <div class="flex space-x-2">
                <select class="filter-btn">
                    <option>Bulan Ini</option>
                    <option>Bulan Depan</option>
                </select>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
                </button>
            </div>
        </div>

        <!-- Kegiatan Item -->
        <div class="mt-6 space-y-4">
            <!-- Kegiatan Item 1 -->
            <div class="kegiatan-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                18:00 - Selesai
                            </div>
                            <div class="text-sm text-gray-500">
                                Hari : Selasa
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">
                            Latihan Upacara
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Semua Siswa
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                        <button class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kegiatan Item 2 -->
            <div class="kegiatan-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                14:00 - 16:00
                            </div>
                            <div class="text-sm text-gray-500">
                                Hari : Rabu
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">
                            Study Tour ke Museum
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Kelas X RPL 1
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                        <button class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kegiatan Item 3 -->
            <div class="kegiatan-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                10:00 - 12:00
                            </div>
                            <div class="text-sm text-gray-500">
                                Hari : Kamis
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">
                            Lomba Kebersihan Kelas
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Semua Siswa
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                        <button class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kegiatan Item 4 -->
            <div class="kegiatan-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                08:00 - 15:00
                            </div>
                            <div class="text-sm text-gray-500">
                                Hari : Jumat
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">
                            Pentas Seni
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Siswa Pilihan
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                        <button class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.kegiatan-item {
    background: white;
}

.kegiatan-item:hover {
    border-color: #d1d5db;
}

.filter-btn {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 14px;
    color: #374151;
    background: white;
    cursor: pointer;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.section-title {
    font-size: 20px;
    font-weight: bold;
    color: #1f2937;
}
</style>
<!-- Modal Tambah Piket -->
<div id="modalPiket" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
    <h3 class="text-lg font-bold mb-4 text-gray-800">Tambah Jadwal Piket</h3>
    <form id="formTambahPiket" method="post" action="<?= base_url('walikelas/tambah_piket') ?>">
      <input type="hidden" name="kelas_id" value="<?= $kelas['id'] ?>">

      <div class="mb-3">
        <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
        <select name="hari" class="w-full border border-gray-300 rounded-md p-2">
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>
          <option value="Sabtu">Sabtu</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>
        <select name="penanggung_jawab_id" class="w-full border border-gray-300 rounded-md p-2">
          <?php foreach ($siswa as $s): ?>
            <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="block text-sm font-medium text-gray-700 mb-1">Area</label>
        <select name="area" class="w-full border border-gray-300 rounded-md p-2">
          <option value="kelas">Kelas</option>
          <option value="lab">Lab</option>
        </select>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal('modalPiket')" class="bg-gray-300 px-4 py-2 rounded-md text-sm">Batal</button>
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-md text-sm hover:bg-orange-600">Simpan</button>
      </div>
    </form>

    <button onclick="closeModal('modalPiket')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
      <i class="fas fa-times"></i>
    </button>
  </div>
</div>

            </div>
        </main>
    </div>

    <script>
        document.getElementById('formTambahPiket').addEventListener('submit', async function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  const response = await fetch(this.action, { method: 'POST', body: formData });
  const result = await response.json();

  const notifBox = document.getElementById('notifBox');
  notifBox.textContent = result.message;
  notifBox.style.backgroundColor = result.success ? '#22c55e' : '#ef4444';
  notifBox.classList.remove('hidden');
  setTimeout(() => notifBox.classList.add('hidden'), 3000);

  if (result.success) {
    setTimeout(() => location.reload(), 1000);
  }
});

        document.addEventListener('DOMContentLoaded', function() {
            // Tab Navigation
            const featureCards = document.querySelectorAll('.card-feature');
            const tabContents = document.querySelectorAll('.tab-content');
            
            featureCards.forEach(card => {
                card.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Remove active class from all cards and contents
                    featureCards.forEach(c => c.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    // Add active class to clicked card and corresponding content
                    this.classList.add('active');
                    document.getElementById(`${tabId}-tab`).classList.add('active');
                });
            });

            // Hover effect untuk schedule items
            const scheduleItems = document.querySelectorAll('.schedule-item, .schedule-card');
            scheduleItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f9fafb';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'white';
                });
            });

            // Navigasi sidebar
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });

        async function submitJadwal(e, form) {
  e.preventDefault();

  const formData = new FormData(form);
  const response = await fetch(form.action, { method: 'POST', body: formData });
  const result = await response.json();

  const notifBox = document.getElementById('notifBox');

  // Atur tampilan dasar
  notifBox.textContent = result.message || (result.success 
      ? '✅ Jadwal berhasil ditambahkan.' 
      : '⚠️ Jam tersebut sudah terpakai. Silakan pilih jam lain.');

  notifBox.classList.remove('hidden', 'opacity-0', 'translate-y-[-10px]');
  notifBox.classList.add('opacity-100', 'translate-y-0');
  notifBox.style.backgroundColor = result.success ? '#22c55e' : '#ef4444';
  notifBox.style.color = 'white';
  notifBox.style.padding = '12px 16px';
  notifBox.style.borderRadius = '8px';
  notifBox.style.boxShadow = '0 4px 10px rgba(0,0,0,0.1)';
  notifBox.style.zIndex = '9999';

  // Hilang pelan-pelan
  setTimeout(() => {
    notifBox.classList.add('opacity-0', 'translate-y-[-10px]');
    setTimeout(() => notifBox.classList.add('hidden'), 300);
  }, 3000);

  // Reload kalau sukses
  if (result.success) {
    setTimeout(() => location.reload(), 1200);
  }

  return false;
}
async function openEditModal(url, hari, kelas_id) {
  if (!hari) {
    alert("Pilih hari dulu sebelum mengedit jadwal!");
    return;
  }

  const response = await fetch(`${url}?hari=${hari}&kelas_id=${kelas_id}`);
  const data = await response.json();

  const list = document.getElementById("editList");
  list.innerHTML = "";

  if (!data.length) {
    list.innerHTML = `<p class='text-gray-500 text-center text-sm'>Belum ada jadwal pada hari ${hari}.</p>`;
  } else {
    data.forEach(item => {
      const row = document.createElement("div");
      row.className = "flex justify-between items-center border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition";
      row.innerHTML = `
        <div>
          <p class="font-semibold text-gray-800">${item.mata_pelajaran} <span class="text-sm text-gray-500">(${item.jam_mulai} - ${item.jam_selesai})</span></p>
          <p class="text-xs text-gray-600">${item.guru}</p>
        </div>
        <button onclick="hapusJadwal(${item.id})" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">Hapus</button>
      `;
      list.appendChild(row);
    });
  }

  openModal('modalEditJadwal');
}

async function hapusJadwal(id) {
  if (!confirm("Yakin ingin menghapus jadwal ini?")) return;

const response = await fetch(`<?= base_url('walikelas/hapus_jadwal/') ?>${id}`, { method: 'POST' });
  const result = await response.json();

  const notifBox = document.getElementById('notifBox');
  notifBox.textContent = result.message || (result.success ? 'Berhasil dihapus.' : 'Gagal menghapus.');
  notifBox.style.backgroundColor = result.success ? '#22c55e' : '#ef4444';
  notifBox.classList.remove('hidden');
  setTimeout(() => notifBox.classList.add('hidden'), 3000);

  if (result.success) {
    setTimeout(() => location.reload(), 1000);
  }
}
    </script>
</body>
</html>