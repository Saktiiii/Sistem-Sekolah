<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Siswa</title>
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
    .nav-link:hover {
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
    .card-stat {
      border-radius: 15px;
      padding: 20px;
      background: #fff;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
          <li><a class="nav-link active text-primary fw-bold" href="<?= site_url('page/index'); ?>">📊 Dashboard</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/data_kelas'); ?>">📚 Data Kelas</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/ademik'); ?>">🎓 Akademik</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
        </ul>
      </div>

      <!-- Content -->
      <div class="col-md-10 p-4">
        <div class="welcome-box">
          <h2>Selamat Datang, Siswa</h2>
          <p>Kelola data akademik dan kegiatanmu di sini.</p>
        </div>

        <div class="row g-4">
          <div class="col-md-3">
            <div class="card-stat">
              <h3>9</h3>
              <p>Mata Pelajaran</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-stat">
              <h3>2</h3>
              <p>Ekskul Diikuti</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-stat">
              <h3>96%</h3>
              <p>Kehadiran</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-stat">
              <h3>87</h3>
              <p>Nilai Rata-rata</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
