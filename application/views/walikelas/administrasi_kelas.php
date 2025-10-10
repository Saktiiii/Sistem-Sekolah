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
                <select class="filter-btn">
                    <option>Hari</option>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                </select>
                <select class="filter-btn">
                    <option>Selasa</option>
                </select>
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
            </div>
        </div>

        <div class="flex gap-6 mt-6">
            <!-- Left Side - Statistics -->
            <div class="flex flex-col gap-4" style="min-width: 200px;">
                <div class="stat-card">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Jam Pelajaran</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Mata Pelajaran</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Guru</div>
                </div>
            </div>

            <!-- Right Side - Schedule Grid -->
            <div class="flex-1">
                <!-- Jadwal Pagi -->
                <div class="mb-6">
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Schedule Item 1 -->
                        <div class="schedule-item pelajaran">
                            <div class="flex-1 p-4 flex items-center gap-4">
                                <div class="text-center" style="min-width: 100px;">
                                    <div class="text-2xl font-bold text-gray-800">1</div>
                                    <div class="text-xs text-gray-500">Jam Pelajaran</div>
                                </div>
                                <div class="bg-gray-100 rounded px-4 py-2 text-center" style="min-width: 120px;">
                                    <div class="font-semibold text-sm text-gray-800">07:00-07:45</div>
                                    <div class="text-xs text-gray-600">45 Menit</div>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="font-medium text-gray-800">Literasi</div>
                                    <div class="text-sm text-gray-600">Pak Lombok</div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Item 2 -->
                        <div class="schedule-item pelajaran">
                            <div class="flex-1 p-4 flex items-center gap-4">
                                <div class="text-center" style="min-width: 100px;">
                                    <div class="text-2xl font-bold text-gray-800">2</div>
                                    <div class="text-xs text-gray-500">Jam Pelajaran</div>
                                </div>
                                <div class="bg-gray-100 rounded px-4 py-2 text-center" style="min-width: 120px;">
                                    <div class="font-semibold text-sm text-gray-800">07:45-08:30</div>
                                    <div class="text-xs text-gray-600">45 Menit</div>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="font-medium text-gray-800">Matematika</div>
                                    <div class="text-sm text-gray-600">Bu Sari</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Jam Kosong -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        <div>
                            <p class="text-sm text-blue-800">
                                <span class="font-semibold">9 jam pelajaran lainnya</span> akan ditampilkan setelah jam ini
                            </p>
                            <p class="text-xs text-blue-600 mt-1">
                                Total 11 jam pelajaran dalam sehari
                            </p>
                        </div>
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

                        <!-- Table for Piket -->
                        <div class="table-container mt-6">
                            <div class="table-header">
                                Jadwal Piket Kelas
                            </div>
                            <div class="table-row">
                                <div class="font-semibold">No</div>
                                <div class="font-semibold">Hari</div>
                                <div class="font-semibold">Siswa</div>
                                <div class="font-semibold">Tugas</div>
                            </div>
                            <div class="table-row">
                                <div>1</div>
                                <div>Senin</div>
                                <div>Andi, Budi, Cici</div>
                                <div>Membersihkan papan tulis</div>
                            </div>
                            <div class="table-row">
                                <div>2</div>
                                <div>Selasa</div>
                                <div>Dedi, Eka, Fani</div>
                                <div>Menyapu kelas</div>
                            </div>
                            <div class="table-row">
                                <div>3</div>
                                <div>Rabu</div>
                                <div>Gina, Hadi, Indra</div>
                                <div>Merapikan buku</div>
                            </div>
                        </div>
                    </div>
                </div>

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

                        <!-- Table for Kegiatan -->
                        <div class="table-container mt-6">
                            <div class="table-header">
                                Daftar Kegiatan Kelas
                            </div>
                            <div class="table-row">
                                <div class="font-semibold">No</div>
                                <div class="font-semibold">Kegiatan</div>
                                <div class="font-semibold">Tanggal</div>
                                <div class="font-semibold">Status</div>
                            </div>
                            <div class="table-row">
                                <div>1</div>
                                <div>Study Tour ke Museum</div>
                                <div>25 Jan 2024</div>
                                <div><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Akan Datang</span></div>
                            </div>
                            <div class="table-row">
                                <div>2</div>
                                <div>Lomba Kebersihan Kelas</div>
                                <div>15 Jan 2024</div>
                                <div><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Selesai</span></div>
                            </div>
                            <div class="table-row">
                                <div>3</div>
                                <div>Pentas Seni</div>
                                <div>30 Jan 2024</div>
                                <div><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Persiapan</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
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
    </script>
</body>
</html>