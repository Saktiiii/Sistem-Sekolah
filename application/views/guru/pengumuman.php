<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - Guru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background: white;
        }

        .form-textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        /* Button Styles */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        /* Pengumuman List */
        .pengumuman-list {
            margin-top: 15px;
        }

        .pengumuman-item {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .pengumuman-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .pengumuman-meta {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: #6c757d;
        }

        .pengumuman-type {
            background: #e3f2fd;
            color: #1976d2;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 500;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-grid {
                grid-template-columns: 1fr;
            }
            
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
            <?php $this->load->view('guru/sidebar'); ?>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <h1 class="page-title">Pengumuman</h1>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Buat Pengumuman -->
                <div class="card">
                    <h3 class="card-title">Buat Pengumuman</h3>
                    <form>
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <select class="form-select">
                                <option value="">All</option>
                                <option value="umum">Umum</option>
                                <option value="ekskul">Ekskul</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <select class="form-select">
                                <option value="">All</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Judul Pengumuman</label>
                            <input type="text" class="form-input" placeholder="Masukkan judul pengumuman">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Isi Pengumuman</label>
                            <textarea class="form-textarea" placeholder="Tulis isi pengumuman di sini..."></textarea>
                        </div>
                        <button type="button" class="btn btn-primary">
                            + Buat Pengumuman
                        </button>
                    </form>
                </div>

                <!-- Lihat Pengumuman -->
                <div class="card">
                    <h3 class="card-title">Lihat Pengumuman</h3>
                    
                    <!-- Filter -->
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select class="form-select">
                                    <option value="">All</option>
                                    <option value="umum">Umum</option>
                                    <option value="ekskul">Ekskul</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kelas</label>
                                <select class="form-select">
                                    <option value="">All</option>
                                    <option value="10">Kelas 10</option>
                                    <option value="11">Kelas 11</option>
                                    <option value="12">Kelas 12</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Pengumuman -->
                    <div class="pengumuman-list">
                        <div class="pengumuman-item">
                            <div class="pengumuman-title">Diadakan Lomba PBB</div>
                            <div class="pengumuman-meta">
                                <span class="pengumuman-type">Ekskul</span>
                                <span>25-05-2025</span>
                            </div>
                        </div>
                        <div class="pengumuman-item">
                            <div class="pengumuman-title">Diadakan Senam Pagi</div>
                            <div class="pengumuman-meta">
                                <span class="pengumuman-type">Umum</span>
                                <span>30-05-2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple JavaScript
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                if (this.textContent.includes('Buat Pengumuman')) {
                    alert('Pengumuman berhasil dibuat!');
                }
            });
        });

        document.querySelectorAll('.form-select').forEach(select => {
            select.addEventListener('change', function() {
                console.log('Filter berubah:', this.value);
            });
        });
    </script>
</body>
</html>