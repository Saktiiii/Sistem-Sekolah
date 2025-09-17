<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Ortu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background: #fff;
      border-right: 1px solid #ddd;
      padding: 20px;
    }
    .sidebar h4 {
      margin-bottom: 30px;
    }
    .card-stat {
      border-radius: 15px;
      padding: 20px;
      background: #fff;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .card-stat h3 {
      margin: 10px 0;
      font-weight: bold;
    }
    .card-stat p {
      margin: 0;
      color: #666;
    }
    .welcome-box {
      border-radius: 15px;
      padding: 25px;
      background: linear-gradient(135deg, #4f46e5, #6366f1);
      color: #fff;
      margin-bottom: 25px;
    }
    .nav.flex-column {
    padding: 15px;
}

.nav.flex-column .nav-item {
    margin-bottom: 10px;
}

.nav.flex-column .nav-link {
    padding: 8px 12px;
    border-radius: 6px;
    transition: background-color 0.3s;
}

.nav.flex-column .nav-link:hover {
    background-color: #f0f0f0;
    text-decoration: none;
}

  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
      <h4>Ortu</h4>
      <ul class="nav flex-column p-3">
    <li class="nav-item mb-2">
        <a class="nav-link text-dark" href="<?= site_url('ortu/dashboard'); ?>">📊 Dashboard</a>
    </li>
    <li class="nav-item mb-2">
        <a class="nav-link text-dark" href="<?= site_url('ortu/data_siswa'); ?>">👨‍🎓 Data Siswa</a>
    </li>
    <li class="nav-item mb-2">
        <a class="nav-link text-dark" href="<?= site_url('ortu/pengumuman'); ?>">📢 Pengumuman</a>
    </li>
    <li class="nav-item mt-4">
        <a class="btn btn-danger w-100" href="<?= site_url('ortu/logout'); ?>">🚪 Logout</a>
    </li>
</ul>



    </div>

    <!-- Content -->
    <div class="col-md-10 p-4">
      <div class="welcome-box">
        <h2>Selamat Datang, Orang Tua/Wali</h2>
        <p>Anda dapat memantau perkembangan siswa melalui dashboard ini.</p>
      </div>
      
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card-stat">
            <h3>36</h3>
            <p>Peringkat</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-stat">
            <h3>3</h3>
            <p>Pelanggaran</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-stat">
            <h3>10</h3>
            <p>Absen</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-stat">
            <h3>83</h3>
            <p>Total Nilai</p>
          </div>
        </div>
      </div>

      <!-- Tambahan: Ringkasan cepat -->
      <div class="mt-4">
        <h5>Ringkasan Siswa</h5>
        <table class="table table-bordered bg-white">
          <tr>
            <th>Nama</th>
            <td>Jhon Smith</td>
          </tr>
          <tr>
            <th>Kelas</th>
            <td>XII RPL B</td>
          </tr>
          <tr>
            <th>Jurusan</th>
            <td>Rekayasa Perangkat Lunak</td>
          </tr>
          <tr>
            <th>Status</th>
            <td>Aktif</td>
          </tr>
        </table>
      </div>

    </div>
  </div>
</div>

</body>
</html>
