<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Kelas - Data Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS untuk memastikan sidebar menyesuaikan tinggi konten */
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
        
        /* Styling tambahan untuk tampilan yang lebih baik */
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
        
        /* Warna untuk gender */
        .gender-male {
            color: #3b82f6;
        }
        
        .gender-female {
            color: #ec4899;
        }
        
        /* Hover effect untuk tabel */
        .table-hover tr:hover {
            background-color: #f9fafb;
        }
        
        /* Menu dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
            z-index: 1;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .dropdown-content button {
            width: 100%;
            text-align: left;
            padding: 8px 12px;
            border: none;
            background: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .dropdown-content button:hover {
            background-color: #f3f4f6;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
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
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📢 <span class="ml-3">Kirim Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📋 <span class="ml-3">Lapor Perkembangan</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <span class="px-6 text-gray-400 uppercase text-xs">Kelas</span>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
                            📚 <span class="ml-3">Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            ⚙️ <span class="ml-3">Administrasi Kelas</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <span class="px-6 text-gray-400 uppercase text-xs">Laporan</span>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📊 <span class="ml-3">Statistik Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📝 <span class="ml-3">Laporan Bulanan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 main-content">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Wali Kelas</h1>
                <p class="text-gray-600">Kelas XI RB - SMK Negeri 2 Karanganyar</p>
            </div>

            <!-- Statistik Cepat -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Jumlah Siswa</p>
                            <p class="text-2xl font-bold">32</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <span class="text-blue-600 text-xl">👥</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Siswa Berprestasi</p>
                            <p class="text-2xl font-bold">5</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <span class="text-green-600 text-xl">🏆</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Siswa Bermasalah</p>
                            <p class="text-2xl font-bold">2</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <span class="text-red-600 text-xl">⚠️</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Rata-rata Kehadiran</p>
                            <p class="text-2xl font-bold">94%</p>
                        </div>
                        <div class="bg-indigo-100 p-3 rounded-full">
                            <span class="text-indigo-600 text-xl">📊</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Siswa Berprestasi -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Siswa Berprestasi</h2>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">+ Tambah Siswa</button>
                </div>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Absen</th>
                                <th class="p-3">NIS</th>
                                <th class="p-3">NISN</th>
                                <th class="p-3">Prestasi</th>
                                <th class="p-3">Gender</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="flex items-center p-3 space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">SV</div>
                                    <span>Silvan Vanness</span>
                                </td>
                                <td class="p-3">29</td>
                                <td class="p-3">9022</td>
                                <td class="p-3">009876421</td>
                                <td class="p-3">Juara 1 Pilpres</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Silvan Vanness', 'SV', 'blue')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Silvan Vanness')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Silvan Vanness')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="flex items-center p-3 space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">SM</div>
                                    <span>Sven Magnus Ø. C.</span>
                                </td>
                                <td class="p-3">00</td>
                                <td class="p-3">1995</td>
                                <td class="p-3">849705267</td>
                                <td class="p-3">Juara 1 FIDE Chess Cup 2023</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Sven Magnus Ø. C.', 'SM', 'green')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Sven Magnus Ø. C.')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Sven Magnus Ø. C.')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="flex items-center p-3 space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">AR</div>
                                    <span>Amelia Rizky</span>
                                </td>
                                <td class="p-3">15</td>
                                <td class="p-3">7845</td>
                                <td class="p-3">009832145</td>
                                <td class="p-3">Juara 1 Olimpiade Matematika</td>
                                <td class="p-3 gender-female">Female</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Amelia Rizky', 'AR', 'purple')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Amelia Rizky')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Amelia Rizky')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Siswa Bermasalah -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Siswa Bermasalah</h2>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">+ Tambah Siswa</button>
                </div>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Absen</th>
                                <th class="p-3">NIS</th>
                                <th class="p-3">NISN</th>
                                <th class="p-3">Tindakan</th>
                                <th class="p-3">Gender</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">Ciduk</td>
                                <td class="p-3">00</td>
                                <td class="p-3">1995</td>
                                <td class="p-3">849705267</td>
                                <td class="p-3">Alpha 1 bulan</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Ciduk', 'CD', 'red')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Ciduk')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Ciduk')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">Rina Sari</td>
                                <td class="p-3">22</td>
                                <td class="p-3">5678</td>
                                <td class="p-3">009845632</td>
                                <td class="p-3">Teguran tertulis</td>
                                <td class="p-3 gender-female">Female</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Rina Sari', 'RS', 'pink')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Rina Sari')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Rina Sari')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rekap Absensi -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-4">Rekap Absensi Siswa</h2>
                <div class="flex space-x-2 mb-2">
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">PDF</button>
                    <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">XLS</button>
                </div>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="p-3">No</th>
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
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">09</td>
                                <td class="p-3">Fandi Dwikunto</td>
                                <td class="p-3">47</td>
                                <td class="p-3">44</td>
                                <td class="p-3">1</td>
                                <td class="p-3">1</td>
                                <td class="p-3">1</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Fandi Dwikunto', 'FD', 'yellow')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Fandi Dwikunto')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Fandi Dwikunto')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">29</td>
                                <td class="p-3">Silvan Vanness</td>
                                <td class="p-3">47</td>
                                <td class="p-3">39</td>
                                <td class="p-3">8</td>
                                <td class="p-3">0</td>
                                <td class="p-3">0</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Silvan Vanness', 'SV', 'blue')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Silvan Vanness')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Silvan Vanness')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">15</td>
                                <td class="p-3">Amelia Rizky</td>
                                <td class="p-3">47</td>
                                <td class="p-3">47</td>
                                <td class="p-3">0</td>
                                <td class="p-3">0</td>
                                <td class="p-3">0</td>
                                <td class="p-3 gender-female">Female</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Amelia Rizky', 'AR', 'purple')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Amelia Rizky')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Amelia Rizky')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Data Siswa -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data Siswa</h2>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">+ Tambah Siswa</button>
                </div>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Absen</th>
                                <th class="p-3">NIS</th>
                                <th class="p-3">NISN</th>
                                <th class="p-3">Alamat</th>
                                <th class="p-3">Gender</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">Ciduk</td>
                                <td class="p-3">00</td>
                                <td class="p-3">1995</td>
                                <td class="p-3">849705267</td>
                                <td class="p-3">Kembang RT 01 RW 06, Sekar Karanganyar</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Ciduk', 'CD', 'red')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Ciduk')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Ciduk')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">Silvan Vanness</td>
                                <td class="p-3">29</td>
                                <td class="p-3">9022</td>
                                <td class="p-3">009876421</td>
                                <td class="p-3">Jl. Merdeka No. 45, Karanganyar</td>
                                <td class="p-3 gender-male">Male</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Silvan Vanness', 'SV', 'blue')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Silvan Vanness')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Silvan Vanness')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">Amelia Rizky</td>
                                <td class="p-3">15</td>
                                <td class="p-3">7845</td>
                                <td class="p-3">009832145</td>
                                <td class="p-3">Perumahan Griya Asri Blok B-12, Karanganyar</td>
                                <td class="p-3 gender-female">Female</td>
                                <td class="p-3">
                                    <div class="dropdown">
                                        <button class="text-gray-500 hover:text-gray-700">⋯</button>
                                        <div class="dropdown-content">
                                            <button onclick="showStudentInfo('Amelia Rizky', 'AR', 'purple')">
                                                <span>ℹ️</span> Info
                                            </button>
                                            <button onclick="editStudent('Amelia Rizky')">
                                                <span>✏️</span> Edit
                                            </button>
                                            <button onclick="deleteStudent('Amelia Rizky')" class="text-red-500">
                                                <span>🗑️</span> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Detail Siswa -->
        <aside id="detailSidebar" class="w-80 bg-white shadow-md p-6 detail-sidebar hidden">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Detail Siswa</h2>
                <button onclick="closeStudentInfo()" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <div class="flex flex-col items-center">
                <div id="studentAvatar" class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">SV</div>
                <h2 id="studentName" class="mt-2 font-semibold text-lg">Silvan Vanness</h2>
                <p id="studentId" class="text-gray-500">29/9022</p>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Informasi Pribadi</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li id="studentFullName">Jhon Smith</li>
                    <li id="studentDob">3 Agustus 2000</li>
                    <li id="studentGender">Laki-laki</li>
                    <li id="studentReligion">Islam</li>
                    <li id="studentAddress">Kembang RT 01 RW 06, Karanganyar</li>
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Informasi Akademik</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li id="studentSchool">SMK Negeri 2 Karanganyar</li>
                    <li id="studentNisNisn">9999 / 0084354677</li>
                    <li id="studentClass">Kelas XI RB</li>
                    <li id="studentEntryYear">Tahun Masuk: 2023</li>
                    <li id="studentGraduationYear">Tahun Lulus: <i>belum lulus</i></li>
                    <li id="studentHomeroomTeacher">Wali Kelas: Dwi Nuryani</li>
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Informasi Orang Tua/Wali</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li id="studentFather">Ayah: Edi (Pedagang)</li>
                    <li id="studentMother">Ibu: Eni (IRT)</li>
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-gray-600 font-semibold mb-2">Prestasi</h3>
                <ul id="studentAchievements" class="text-sm text-gray-700 space-y-1">
                    <li>Juara 1 Pilpres 2024</li>
                    <li>Juara 2 Olimpiade Sains Nasional 2023</li>
                </ul>
            </div>
        </aside>
    </div>

    <script>
        // Data siswa untuk panel detail
        const studentsData = {
            'Silvan Vanness': {
                avatar: 'SV',
                avatarColor: 'blue',
                id: '29/9022',
                fullName: 'Silvan Vanness',
                dob: '3 Agustus 2000',
                gender: 'Laki-laki',
                religion: 'Islam',
                address: 'Jl. Merdeka No. 45, Karanganyar',
                school: 'SMK Negeri 2 Karanganyar',
                nisNisn: '9022 / 009876421',
                class: 'Kelas XI RB',
                entryYear: '2023',
                graduationYear: 'belum lulus',
                homeroomTeacher: 'Dwi Nuryani',
                father: 'Edi (Pedagang)',
                mother: 'Eni (IRT)',
                achievements: ['Juara 1 Pilpres 2024', 'Juara 2 Olimpiade Sains Nasional 2023']
            },
            'Sven Magnus Ø. C.': {
                avatar: 'SM',
                avatarColor: 'green',
                id: '00/1995',
                fullName: 'Sven Magnus Ø. C.',
                dob: '15 Mei 2001',
                gender: 'Laki-laki',
                religion: 'Kristen',
                address: 'Jl. Catur No. 10, Karanganyar',
                school: 'SMK Negeri 2 Karanganyar',
                nisNisn: '1995 / 849705267',
                class: 'Kelas XI RB',
                entryYear: '2023',
                graduationYear: 'belum lulus',
                homeroomTeacher: 'Dwi Nuryani',
                father: 'Ole (Pelatih Catur)',
                mother: 'Sigrun (Guru)',
                achievements: ['Juara 1 FIDE Chess Cup 2023', 'Juara 1 Kejuaraan Catur Nasional 2023']
            },
            'Amelia Rizky': {
                avatar: 'AR',
                avatarColor: 'purple',
                id: '15/7845',
                fullName: 'Amelia Rizky',
                dob: '22 September 2000',
                gender: 'Perempuan',
                religion: 'Islam',
                address: 'Perumahan Griya Asri Blok B-12, Karanganyar',
                school: 'SMK Negeri 2 Karanganyar',
                nisNisn: '7845 / 009832145',
                class: 'Kelas XI RB',
                entryYear: '2023',
                graduationYear: 'belum lulus',
                homeroomTeacher: 'Dwi Nuryani',
                father: 'Budi (PNS)',
                mother: 'Sari (Dokter)',
                achievements: ['Juara 1 Olimpiade Matematika 2023', 'Juara 3 Lomba Debat Bahasa Inggris 2023']
            },
            'Ciduk': {
                avatar: 'CD',
                avatarColor: 'red',
                id: '00/1995',
                fullName: 'Ciduk',
                dob: '10 Januari 2001',
                gender: 'Laki-laki',
                religion: 'Islam',
                address: 'Kembang RT 01 RW 06, Sekar Karanganyar',
                school: 'SMK Negeri 2 Karanganyar',
                nisNisn: '1995 / 849705267',
                class: 'Kelas XI RB',
                entryYear: '2023',
                graduationYear: 'belum lulus',
                homeroomTeacher: 'Dwi Nuryani',
                father: 'Tono (Wiraswasta)',
                mother: 'Siti (IRT)',
                achievements: []
            },
            'Rina Sari': {
                avatar: 'RS',
                avatarColor: 'pink',
                id: '22/5678',
                fullName: 'Rina Sari',
                dob: '5 Maret 2000',
                gender: 'Perempuan',
                religion: 'Islam',
                address: 'Jl. Mawar No. 8, Karanganyar',
                school: 'SMK Negeri 2 Karanganyar',
                nisNisn: '5678 / 009845632',
                class: 'Kelas XI RB',
                entryYear: '2023',
                graduationYear: 'belum lulus',
                homeroomTeacher: 'Dwi Nuryani',
                father: 'Joko (Supir)',
                mother: 'Dewi (Penjahit)',
                achievements: []
            },
            'Fandi Dwikunto': {
                avatar: 'FD',
                avatarColor: 'yellow',
                id: '09/3456',
                fullName: 'Fandi Dwikunto',
                dob: '18 Juli 2000',
                gender: 'Laki-laki',
                religion: 'Islam',
                address: 'Jl. Kenanga No. 15, Karanganyar',
                school: 'SMK Negeri 2 Karanganyar',
                nisNisn: '3456 / 008765432',
                class: 'Kelas XI RB',
                entryYear: '2023',
                graduationYear: 'belum lulus',
                homeroomTeacher: 'Dwi Nuryani',
                father: 'Rudi (Petani)',
                mother: 'Maya (Pedagang)',
                achievements: []
            }
        };

        // Fungsi untuk menampilkan info siswa
        function showStudentInfo(name, avatar, color) {
            const student = studentsData[name];
            if (!student) return;
            
            // Update data di panel detail
            document.getElementById('studentAvatar').textContent = student.avatar;
            document.getElementById('studentAvatar').className = `w-20 h-20 rounded-full bg-${student.avatarColor}-500 flex items-center justify-center text-white text-2xl font-bold`;
            document.getElementById('studentName').textContent = student.fullName;
            document.getElementById('studentId').textContent = student.id;
            document.getElementById('studentFullName').textContent = student.fullName;
            document.getElementById('studentDob').textContent = student.dob;
            document.getElementById('studentGender').textContent = student.gender;
            document.getElementById('studentReligion').textContent = student.religion;
            document.getElementById('studentAddress').textContent = student.address;
            document.getElementById('studentSchool').textContent = student.school;
            document.getElementById('studentNisNisn').textContent = student.nisNisn;
            document.getElementById('studentClass').textContent = student.class;
            document.getElementById('studentEntryYear').textContent = `Tahun Masuk: ${student.entryYear}`;
            document.getElementById('studentGraduationYear').innerHTML = `Tahun Lulus: <i>${student.graduationYear}</i>`;
            document.getElementById('studentHomeroomTeacher').textContent = `Wali Kelas: ${student.homeroomTeacher}`;
            document.getElementById('studentFather').textContent = `Ayah: ${student.father}`;
            document.getElementById('studentMother').textContent = `Ibu: ${student.mother}`;
            
            // Update prestasi
            const achievementsList = document.getElementById('studentAchievements');
            achievementsList.innerHTML = '';
            if (student.achievements.length > 0) {
                student.achievements.forEach(achievement => {
                    const li = document.createElement('li');
                    li.textContent = achievement;
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
        }

        // Fungsi untuk menutup panel detail
        function closeStudentInfo() {
            document.getElementById('detailSidebar').classList.add('hidden');
        }

        // Fungsi untuk mengedit siswa
        function editStudent(name) {
            alert(`Edit data siswa: ${name}`);
            // Di sini bisa diimplementasikan logika untuk membuka form edit
        }

        // Fungsi untuk menghapus siswa
        function deleteStudent(name) {
            if (confirm(`Apakah Anda yakin ingin menghapus data siswa: ${name}?`)) {
                alert(`Data siswa ${name} telah dihapus`);
                // Di sini bisa diimplementasikan logika untuk menghapus data
            }
        }
    </script>
</body>
</html>