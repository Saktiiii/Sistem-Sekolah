<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ekstrakurikuler Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f4ff;
    }
    .sidebar {
      height: 100vh;
      background: #fff;
      border-right: 1px solid #ddd;
      padding: 20px;
    }
    .sidebar h4 {
      margin-bottom: 30px;
      color: #2563eb;
      font-weight: bold;
    }
    .nav-link {
      color: #333;
      margin-bottom: 10px;
      transition: 0.3s;
    }
    .nav-link:hover,
    .nav-link.active {
      color: #2563eb;
      background-color: #e0e7ff;
      border-radius: 6px;
    }
    .welcome-box {
      border-radius: 15px;
      padding: 25px;
      background: linear-gradient(135deg, #2563eb, #3b82f6);
      color: #fff;
      margin-bottom: 25px;
    }
    .card-activity {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 20px;
      transition: 0.3s;
    }
    .card-activity:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .badge-status {
      font-size: 0.9rem;
      border-radius: 10px;
      padding: 6px 12px;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
      <h4>Siswa</h4>
      <ul class="nav flex-column">
        <li><a class="nav-link" href="<?= site_url('Page/index'); ?>">📊 Dashboard</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/data_kelas'); ?>">📚 Data Kelas</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/akademik'); ?>">🎓 Akademik</a></li>
        <li><a class="nav-link active text-primary fw-bold" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
      </ul>
    </div>

    <!-- Content -->
    <div class="col-md-10 p-4">
      <div class="welcome-box">
        <h2>Kegiatan Ekstrakurikuler</h2>
        <p>Lihat daftar ekskul dan status keikutsertaanmu di bawah ini.</p>
      </div>

      <!-- Daftar Ekskul -->
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-activity">
            <h5>⚽ Sepak Bola</h5>
            <p>Pembina: Pak Andi</p>
            <p>Jadwal: Selasa & Kamis, 15.30 - 17.00</p>
            <span class="badge bg-success badge-status">Aktif</span>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-activity">
            <h5>🎨 Seni Lukis</h5>
            <p>Pembina: Bu Laila</p>
            <p>Jadwal: Rabu, 14.00 - 16.00</p>
            <span class="badge bg-primary badge-status">Terdaftar</span>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-activity">
            <h5>🎵 Musik Band</h5>
            <p>Pembina: Pak Dimas</p>
            <p>Jadwal: Jumat, 15.00 - 17.00</p>
            <span class="badge bg-warning text-dark badge-status">Menunggu</span>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-activity">
            <h5>♟️ Catur</h5>
            <p>Pembina: Pak Budi</p>
            <p>Jadwal: Senin, 15.30 - 17.00</p>
            <span class="badge bg-danger badge-status">Tidak Aktif</span>
          </div>
        </div>
      </div>

      <!-- Tombol aksi -->
      <div class="text-end mt-4">
        <a href="#" class="btn btn-primary">➕ Daftar Ekskul Baru</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
