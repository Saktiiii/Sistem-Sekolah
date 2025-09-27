<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Kelas - Laporan Perkembangan ke Orang Tua</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        }
        
        .main-content {
            flex: 1;
            background-color: #f3f4f6;
        }
        
        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 1.5rem 0;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            margin-top: 0.5rem;
        }
        
        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            margin-top: 0.5rem;
            min-height: 120px;
            resize: vertical;
        }
        
        .recipient-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            margin-top: 0.5rem;
            background-color: white;
        }
        
        .history-item {
            background-color: white;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        /* Styling untuk upload file yang diperbarui */
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            background-color: #f9fafb;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        
        .file-upload-area:hover, .file-upload-area.dragover {
            border-color: #4f46e5;
            background-color: #f0f4ff;
        }
        
        .file-upload-icon {
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .file-upload-text {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .file-upload-button {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
            transition: background-color 0.3s ease;
        }
        
        .file-upload-button:hover {
            background-color: #4338ca;
        }
        
        .file-name {
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }
        
        .file-success {
            color: #10b981;
            font-weight: 500;
        }
        
        /* Styling khusus untuk halaman laporan perkembangan */
        .parent-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 4px solid transparent;
        }
        
        .parent-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .parent-card.selected {
            border-left-color: #4f46e5;
            background-color: #f0f4ff;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #4f46e5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .progress-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .progress-excellent {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .progress-good {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .progress-average {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .progress-needs-attention {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .report-section {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .filter-tabs {
            display: flex;
            background-color: #f3f4f6;
            border-radius: 0.5rem;
            padding: 0.25rem;
            margin-top: 1rem;
        }
        
        .filter-tab {
            flex: 1;
            padding: 0.5rem;
            text-align: center;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .filter-tab.active {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .progress-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 0.5rem;
        }
        
        .progress-option {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .progress-option:hover {
            border-color: #4f46e5;
        }
        
        .progress-option.selected {
            border-color: #4f46e5;
            background-color: #f0f4ff;
        }
        
        .progress-option input {
            margin-right: 0.5rem;
        }
        
        /* Styling untuk panel riwayat yang muncul dari kanan */
        .history-panel {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background-color: white;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            padding: 1.5rem;
        }
        
        .history-panel.open {
            right: 0;
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Styling untuk tombol riwayat di kanan atas */
        .history-btn {
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .history-btn:hover {
            background-color: #4338ca;
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
                        <a href="kirim-pengumuman.html" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            📢 <span class="ml-3">Kirim Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="laporan-perkembangan.html" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
                            📋 <span class="ml-3">Lapor Perkembangan</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <span class="px-6 text-gray-400 uppercase text-xs">Kelas</span>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
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
            <!-- Header dengan tombol riwayat di kanan atas -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Laporan Perkembangan ke Orang Tua</h1>
                    <p class="text-gray-600">Laporkan perkembangan akademik dan perilaku siswa kepada orang tua/wali</p>
                </div>
                <button id="showHistoryBtn" class="history-btn">
                    📋 Lihat Riwayat
                </button>
            </div>

            <!-- Konten Utama -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Panel Daftar Orang Tua -->
                <div class="lg:col-span-1">
                    <div class="report-section">
                        <h2 class="text-lg font-semibold mb-4">Daftar Orang Tua</h2>
                        
                        <!-- Pencarian -->
                        <div class="mb-4">
                            <input type="text" placeholder="Cari nama orang tua atau siswa..." class="form-input">
                        </div>
                        
                        <!-- Filter Tabs -->
                        <div class="filter-tabs">
                            <div class="filter-tab active" data-filter="all">Semua</div>
                            <div class="filter-tab" data-filter="attention">Perlu Perhatian</div>
                            <div class="filter-tab" data-filter="excellent">Berprestasi</div>
                        </div>
                        
                        <!-- Daftar Orang Tua -->
                        <div class="space-y-3 mt-4 max-h-96 overflow-y-auto">
                            <!-- Orang Tua 1 -->
                            <div class="parent-card selected" data-parent="1">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="student-avatar">CA</div>
                                        <div>
                                            <h3 class="font-medium">Bpk. Andaru (Canaka Sakti)</h3>
                                            <p class="text-sm text-gray-500">Kelas 9A - Nilai Rata-rata: 85</p>
                                        </div>
                                    </div>
                                    <span class="progress-indicator progress-excellent">85%</span>
                                </div>
                            </div>
                            
                            <!-- Orang Tua 2 -->
                            <div class="parent-card" data-parent="2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="student-avatar" style="background-color: #10b981;">DP</div>
                                        <div>
                                            <h3 class="font-medium">Ibu Pratama (Dani Pratama)</h3>
                                            <p class="text-sm text-gray-500">Kelas 9A - Nilai Rata-rata: 65</p>
                                        </div>
                                    </div>
                                    <span class="progress-indicator progress-average">65%</span>
                                </div>
                            </div>
                            
                            <!-- Orang Tua 3 -->
                            <div class="parent-card" data-parent="3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="student-avatar" style="background-color: #f59e0b;">FA</div>
                                        <div>
                                            <h3 class="font-medium">Bpk. Adinata (Fajar Adinata)</h3>
                                            <p class="text-sm text-gray-500">Kelas 9A - Nilai Rata-rata: 92</p>
                                        </div>
                                    </div>
                                    <span class="progress-indicator progress-excellent">92%</span>
                                </div>
                            </div>
                            
                            <!-- Orang Tua 4 -->
                            <div class="parent-card" data-parent="4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="student-avatar" style="background-color: #ef4444;">RS</div>
                                        <div>
                                            <h3 class="font-medium">Ibu Sari (Rina Sari)</h3>
                                            <p class="text-sm text-gray-500">Kelas 9A - Nilai Rata-rata: 45</p>
                                        </div>
                                    </div>
                                    <span class="progress-indicator progress-needs-attention">45%</span>
                                </div>
                            </div>
                            
                            <!-- Orang Tua 5 -->
                            <div class="parent-card" data-parent="5">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="student-avatar" style="background-color: #8b5cf6;">MW</div>
                                        <div>
                                            <h3 class="font-medium">Bpk. Wijaya (Maya Wijaya)</h3>
                                            <p class="text-sm text-gray-500">Kelas 9A - Nilai Rata-rata: 88</p>
                                        </div>
                                    </div>
                                    <span class="progress-indicator progress-excellent">88%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Panel Form Laporan -->
                <div class="lg:col-span-2">
                    <div class="report-section">
                        <h2 class="text-lg font-semibold mb-4">Laporan Perkembangan</h2>
                        
                        <!-- Informasi Orang Tua yang Dipilih -->
                        <div class="mb-6 p-4 bg-indigo-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="student-avatar">CA</div>
                                <div>
                                    <h3 class="font-medium">Bpk. Andaru (Canaka Sakti Andaru)</h3>
                                    <p class="text-sm text-gray-600">Kelas 9A - Nilai Rata-rata: 85</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Laporan -->
                        <form id="reportForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Judul Laporan</label>
                                <input type="text" class="form-input" placeholder="Masukkan judul laporan" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Isi Perkembangan</label>
                                <textarea class="form-textarea" placeholder="Deskripsikan perkembangan siswa..." required></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                                <select class="recipient-select" required>
                                    <option value="">Pilih kategori</option>
                                    <option>Akademik</option>
                                    <option>Perilaku</option>
                                    <option>Sosial</option>
                                    <option>Kedisiplinan</option>
                                    <option>Prestasi</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Tingkat Perkembangan</label>
                                <div class="progress-options">
                                    <label class="progress-option">
                                        <input type="radio" name="progressLevel" value="sangat-baik" class="form-radio text-green-500">
                                        <span>Sangat Baik</span>
                                    </label>
                                    <label class="progress-option">
                                        <input type="radio" name="progressLevel" value="baik" class="form-radio text-blue-500">
                                        <span>Baik</span>
                                    </label>
                                    <label class="progress-option">
                                        <input type="radio" name="progressLevel" value="cukup" class="form-radio text-yellow-500">
                                        <span>Cukup</span>
                                    </label>
                                    <label class="progress-option selected">
                                        <input type="radio" name="progressLevel" value="perhatian" class="form-radio text-red-500" checked>
                                        <span>Perlu Perhatian</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Lampiran</label>
                                <div class="file-upload-area" id="fileUploadArea">
                                    <input type="file" id="fileUpload" class="hidden" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                    
                                    <div class="file-upload-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    
                                    <p class="file-upload-text">Seret file ke sini atau klik untuk mengunggah</p>
                                    
                                    <button type="button" class="file-upload-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Pilih File
                                    </button>
                                    
                                    <p class="file-name" id="fileName">PDF, DOC, JPG, PNG (maks. 5MB)</p>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                    Kirim Laporan ke Orang Tua
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>

    <!-- Panel Riwayat -->
    <div id="historyPanel" class="history-panel">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Riwayat Laporan</h2>
            <button id="closeHistoryBtn" class="text-gray-500 hover:text-gray-700 text-xl">✕</button>
        </div>
        
        <div class="divider"></div>
        
        <!-- Riwayat 1 -->
        <div class="history-item">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Kenaikan nilai yang sangat signifikan</h3>
                <span class="text-gray-500 text-sm">15 Mar 2023</span>
            </div>
            <p class="text-gray-600 text-sm mb-2">Canaka menunjukkan peningkatan yang sangat baik dalam mata pelajaran Matematika dan IPA. Nilainya naik dari 75 menjadi 85 dalam satu semester.</p>
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Kategori: Akademik • Tingkat: Sangat Baik</span>
                <span class="text-blue-500 text-sm">Bpk. Andaru</span>
            </div>
        </div>
        
        <!-- Riwayat 2 -->
        <div class="history-item">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Penurunan nilai yang signifikan</h3>
                <span class="text-gray-500 text-sm">10 Feb 2023</span>
            </div>
            <p class="text-gray-600 text-sm mb-2">Dani mengalami penurunan nilai pada ujian tengah semester. Perlu perhatian khusus pada mata pelajaran Bahasa Inggris.</p>
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Kategori: Akademik • Tingkat: Perlu Perhatian</span>
                <span class="text-blue-500 text-sm">Ibu Pratama</span>
            </div>
        </div>
        
        <!-- Riwayat 3 -->
        <div class="history-item">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Perilaku yang membaik</h3>
                <span class="text-gray-500 text-sm">5 Jan 2023</span>
            </div>
            <p class="text-gray-600 text-sm mb-2">Rina menunjukkan peningkatan dalam sikap dan perilaku di kelas. Lebih aktif berpartisipasi dalam diskusi kelompok.</p>
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Kategori: Perilaku • Tingkat: Baik</span>
                <span class="text-blue-500 text-sm">Ibu Sari</span>
            </div>
        </div>
        
        <!-- Riwayat 4 -->
        <div class="history-item">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Prestasi dalam lomba matematika</h3>
                <span class="text-gray-500 text-sm">28 Des 2022</span>
            </div>
            <p class="text-gray-600 text-sm mb-2">Fajar berhasil meraih juara 2 dalam lomba matematika tingkat kota. Prestasi yang sangat membanggakan.</p>
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Kategori: Prestasi • Tingkat: Sangat Baik</span>
                <span class="text-blue-500 text-sm">Bpk. Adinata</span>
            </div>
        </div>
        
        <!-- Riwayat 5 -->
        <div class="history-item">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Peningkatan kedisiplinan</h3>
                <span class="text-gray-500 text-sm">15 Des 2022</span>
            </div>
            <p class="text-gray-600 text-sm mb-2">Maya menunjukkan peningkatan dalam kedisiplinan, terutama dalam hal tepat waktu masuk kelas.</p>
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Kategori: Kedisiplinan • Tingkat: Baik</span>
                <span class="text-blue-500 text-sm">Bpk. Wijaya</span>
            </div>
        </div>
    </div>

    <script>
        // Elemen DOM
        const showHistoryBtn = document.getElementById('showHistoryBtn');
        const closeHistoryBtn = document.getElementById('closeHistoryBtn');
        const historyPanel = document.getElementById('historyPanel');
        const overlay = document.getElementById('overlay');
        const fileUpload = document.getElementById('fileUpload');
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileName = document.getElementById('fileName');
        
        // Fungsi untuk membuka panel riwayat
        function openHistoryPanel() {
            historyPanel.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Mencegah scroll di background
        }
        
        // Fungsi untuk menutup panel riwayat
        function closeHistoryPanel() {
            historyPanel.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Mengembalikan scroll
        }
        
        // Event listeners
        showHistoryBtn.addEventListener('click', openHistoryPanel);
        closeHistoryBtn.addEventListener('click', closeHistoryPanel);
        overlay.addEventListener('click', closeHistoryPanel);
        
        // Fungsi untuk menangani upload file
        fileUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (maksimal 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    fileUpload.value = '';
                    fileName.textContent = 'PDF, DOC, JPG, PNG (maks. 5MB)';
                    return;
                }
                
                fileName.innerHTML = `<span class="file-success">✓ ${file.name}</span>`;
            } else {
                fileName.textContent = 'PDF, DOC, JPG, PNG (maks. 5MB)';
            }
        });
        
        // Fungsi untuk memilih orang tua
        const parentCards = document.querySelectorAll('.parent-card');
        parentCards.forEach(card => {
            card.addEventListener('click', function() {
                // Hapus kelas selected dari semua kartu
                parentCards.forEach(c => c.classList.remove('selected'));
                
                // Tambahkan kelas selected ke kartu yang diklik
                this.classList.add('selected');
                
                // Update informasi orang tua yang dipilih
                const parentName = this.querySelector('h3').textContent;
                const studentInfo = this.querySelector('p').textContent;
                
                document.querySelector('.report-section h3').textContent = parentName;
                document.querySelector('.report-section p').textContent = studentInfo;
            });
        });
        
        // Fungsi untuk filter tab
        const filterTabs = document.querySelectorAll('.filter-tab');
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Hapus kelas active dari semua tab
                filterTabs.forEach(t => t.classList.remove('active'));
                
                // Tambahkan kelas active ke tab yang diklik
                this.classList.add('active');
                
                // Filter daftar orang tua
                const filter = this.getAttribute('data-filter');
                filterParents(filter);
            });
        });
        
        function filterParents(filter) {
            const parents = document.querySelectorAll('.parent-card');
            
            parents.forEach(parent => {
                const progressText = parent.querySelector('.progress-indicator').textContent;
                const progress = parseInt(progressText);
                
                if (filter === 'all') {
                    parent.style.display = 'flex';
                } else if (filter === 'attention' && progress < 70) {
                    parent.style.display = 'flex';
                } else if (filter === 'excellent' && progress >= 85) {
                    parent.style.display = 'flex';
                } else if (filter !== 'all') {
                    parent.style.display = 'none';
                }
            });
        }
        
        // Fungsi untuk progress options
        const progressOptions = document.querySelectorAll('.progress-option');
        progressOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Hapus kelas selected dari semua opsi
                progressOptions.forEach(o => o.classList.remove('selected'));
                
                // Tambahkan kelas selected ke opsi yang diklik
                this.classList.add('selected');
                
                // Pilih radio button yang sesuai
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });
        
        // Fungsi untuk mengirim laporan
        document.getElementById('reportForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const judul = this.querySelector('input[type="text"]').value;
            const isi = this.querySelector('textarea').value;
            const kategori = this.querySelector('select').value;
            const tingkat = this.querySelector('input[name="progressLevel"]:checked').value;
            
            if (!judul || !isi || !kategori) {
                alert('Semua field harus diisi!');
                return;
            }
            
            alert('Laporan perkembangan berhasil dikirim ke orang tua!');
            
            // Reset form setelah pengiriman
            this.reset();
            document.getElementById('fileName').textContent = 'PDF, DOC, JPG, PNG (maks. 5MB)';
            
            // Reset progress options
            progressOptions.forEach(option => option.classList.remove('selected'));
            document.querySelector('.progress-option:last-child').classList.add('selected');
        });
        
        // Fungsi pencarian
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const parents = document.querySelectorAll('.parent-card');
            
            parents.forEach(parent => {
                const name = parent.querySelector('h3').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    parent.style.display = 'flex';
                } else {
                    parent.style.display = 'none';
                }
            });
        });
        
        // Fungsi untuk drag and drop
        fileUploadArea.addEventListener('click', function() {
            fileUpload.click();
        });
        
        // Mencegah default behavior saat file di-drag ke area
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Highlight area saat file di-drag
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            fileUploadArea.classList.add('dragover');
        }
        
        function unhighlight() {
            fileUploadArea.classList.remove('dragover');
        }
        
        // Handle drop
        fileUploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                fileUpload.files = files;
                const event = new Event('change', { bubbles: true });
                fileUpload.dispatchEvent(event);
            }
        }
        
        // Tutup panel riwayat dengan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeHistoryPanel();
            }
        });
    </script>
</body>
</html>