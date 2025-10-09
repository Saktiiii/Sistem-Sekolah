<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstra Kulikuler - Guru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: #f8fafc;
            color: #334155;
            line-height: 1.5;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: white;
            border-right: 1px solid #e2e8f0;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 32px;
            padding: 0 12px;
        }

        .nav-section {
            margin-bottom: 32px;
        }

        .nav-title {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            padding: 0 12px;
        }

        .nav-links {
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 4px;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .nav-link.active {
            background: #3b82f6;
            color: white;
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 24px;
            background: #f8fafc;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
        }

        /* Stats Section */
        .stats-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .stats-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .data-table th {
            background: #f8fafc;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
            font-size: 14px;
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .data-table tr:hover {
            background: #f8fafc;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        /* Button Styles */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        /* Contact Info */
        .contact-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-top: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .contact-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: #64748b;
            font-size: 14px;
        }

        .contact-item i {
            margin-right: 12px;
            width: 16px;
            text-align: center;
        }

        /* Status Badge */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .app-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }
        }
        /* Profile area */
  .profile-section {
      margin-top: auto;
      padding-top: 12px;
      border-top: 1px solid #e2e8f0;
  }
  .profile-info { display:flex; gap:12px; align-items:center; margin-bottom:12px; }
  .profile-avatar {
      width:40px; height:40px; border-radius:50%; background: rgba(59,130,246,0.08);
      display:flex; align-items:center; justify-content:center; color:#3b82f6; font-weight:700;
  }
  .profile-name { font-size:14px; font-weight:600; color:#111827; }
  .profile-id { font-size:12px; color:#64748b; }

  .logout-button {
      display:block; margin-top:8px; padding:8px 12px; text-align:center; border-radius:8px;
      border:1px solid #e6e9ef; text-decoration:none; color:#111827; font-weight:600;
  }
  .logout-button:hover { background:#f8fafc; }

    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" style="position: sticky; top: 0; height: 100vh;">
            <div class="logo">Guru</div>
            
            <!-- Akademik Menu -->
            <div class="nav-section">
                <div class="nav-title">Akademik</div>
                <ul class="nav-links">
                    <li>
                        <a class="nav-link" href="<?php echo site_url('guru/akademik'); ?>">
                            <i>📚</i> Akademik
                        </a>
                    </li>
                    <li>
                        <a class="nav-link active" href="<?php echo site_url('guru/ekskul'); ?>">
                            <i>⚽</i> Ekskul
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?php echo site_url('guru/pengumuman'); ?>">
                            <i>📢</i> Pengumuman
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?php echo site_url('guru/laporan'); ?>">
                            <i>📊</i> Laporan
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?php echo site_url('guru/absensi'); ?>">
                            <i>📅</i> Absensi
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Profile & Logout -->
  <div class="profile-section" aria-label="Profile Guru">
    <div class="profile-info">
      <div class="profile-avatar">
        <?php
          $nama = isset($guru->nama) && !empty($guru->nama) ? $guru->nama : $this->session->userdata('username');
          echo strtoupper(substr($nama, 0, 2));
        ?>
      </div>
      <div>
        <div class="profile-name"><?= html_escape($nama) ?></div>
        <div class="profile-id"><?= isset($guru->nip) ? html_escape($guru->nip) : '' ?></div>
      </div>
    </div>

    <a id="logoutBtn" class="logout-button" href="<?= site_url('guru/logout') ?>">Logout</a>
  </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <h1 class="page-title">Ekstra Kulikuler</h1>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <h3 class="stats-title">Statistik Ekskul</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-label">Total Siswa</div>
                        <div class="stat-value">125</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Siswa Aktif</div>
                        <div class="stat-value">118</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total Ekskul</div>
                        <div class="stat-value">8</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Ekskul Aktif</div>
                        <div class="stat-value">6</div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Daftar Siswa Card -->
                <div class="card">
                    <h3 class="card-title">Daftar Siswa</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>NIS</th>
                                <th>Ekskul</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Silvan Vanness</strong></td>
                                <td>12 RA</td>
                                <td>2990022</td>
                                <td>Paskibra</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><strong>Swan Magnus Ø. C.</strong></td>
                                <td>12 MA</td>
                                <td>1995</td>
                                <td>Paskibra</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><strong>Nana</strong></td>
                                <td>12 RA</td>
                                <td>9022</td>
                                <td>Jurnalistik</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Daftar Ekskul Card -->
                <div class="card">
                    <h3 class="card-title">Daftar Ekskul</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama Ekskul</th>
                                <th>Jumlah</th>
                                <th>Penghargaan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Paskibra</strong></td>
                                <td>70</td>
                                <td>Juara 1 Pasukan Terbaik</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><strong>Jurnalistik</strong></td>
                                <td>50</td>
                                <td>Juara 1 Fotografi Terbaik</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><strong>PMR</strong></td>
                                <td>45</td>
                                <td>Juara 1 Pertolongan Pertama</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tambah Data Section -->
            <div class="content-grid">
                <!-- Tambah Siswa -->
                <div class="card">
                    <h3 class="card-title">Tambah Siswa Baru</h3>
                    <form action="<?php echo site_url('guru/tambah_siswa'); ?>" method="post">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-input" placeholder="Masukkan nama siswa" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-select" required>
                                <option value="">Pilih Kelas</option>
                                <option value="10_ra">10 RA</option>
                                <option value="11_ra">11 RA</option>
                                <option value="12_ra">12 RA</option>
                                <option value="10_ma">10 MA</option>
                                <option value="11_ma">11 MA</option>
                                <option value="12_ma">12 MA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-input" placeholder="Masukkan NIS" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ekskul</label>
                            <select name="ekskul_id" class="form-select" required>
                                <option value="">Pilih Ekskul</option>
                                <option value="paskibra">Paskibra</option>
                                <option value="jurnalistik">Jurnalistik</option>
                                <option value="pmr">PMR</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i>➕</i> Tambah Siswa
                        </button>
                    </form>
                </div>

                <!-- Tambah Ekskul -->
                <div class="card">
                    <h3 class="card-title">Tambah Ekskul Baru</h3>
                    <form action="<?php echo site_url('guru/tambah_ekskul'); ?>" method="post">
                        <div class="form-group">
                            <label class="form-label">Nama Ekskul</label>
                            <input type="text" name="nama_ekskul" class="form-input" placeholder="Masukkan nama ekskul" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Anggota</label>
                            <input type="number" name="jumlah_anggota" class="form-input" placeholder="0" value="0">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Penghargaan</label>
                            <input type="text" name="penghargaan_terakhir" class="form-input" placeholder="Masukkan penghargaan terakhir">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i>➕</i> Tambah Ekskul
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="contact-section">
                <h3 class="contact-title">Silvan Vanness - 2990022</h3>
                <div class="contact-item">
                    <i>📧</i> kajope5182@ummoh.com
                </div>
                <div class="contact-item">
                    <i>📱</i> 33757005467
                </div>
                <div class="contact-item">
                    <i>🏠</i> 2239 Hog Camp Road Schaumburg
                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple JavaScript for interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Menu item click handler
            const menuItems = document.querySelectorAll('.nav-link');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Form submission handlers
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formType = this.querySelector('button').textContent.includes('Siswa') ? 'siswa' : 'ekskul';
                    alert(`${formType.charAt(0).toUpperCase() + formType.slice(1)} berhasil ditambahkan!`);
                    this.reset();
                });
            });
        });
    </script>
</body>
</html>