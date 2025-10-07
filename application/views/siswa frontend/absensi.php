<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Absensi Siswa</title>
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
    .table th {
      background-color: #2563eb;
      color: white;
    }
    .table tbody tr:hover {
      background-color: #f0f7ff;
    }
    .status-hadir { color: #16a34a; font-weight: 600; }
    .status-izin { color: #ca8a04; font-weight: 600; }
    .status-sakit { color: #0284c7; font-weight: 600; }
    .status-alpha { color: #dc2626; font-weight: 600; }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <h4>Siswa</h4>
        <ul class="nav flex-column">
          <li><a class="nav-link" href="<?= site_url('Page/dashboard'); ?>">📊 Dashboard</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/data_kelas'); ?>">📚 Data Kelas</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/akademik'); ?>">🎓 Akademik</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
          <li><a class="nav-link active" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
        </ul>
      </div>

      <!-- Konten -->
      <div class="col-md-10 p-4">
        <div class="welcome-box">
          <h2>🕒 Absensi Siswa</h2>
          <p>Rekap kehadiran selama semester berjalan.</p>
        </div>

        <div class="card p-4 shadow-sm">
          <table class="table table-bordered align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Status</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>2025-10-01</td>
                <td>07:00</td>
                <td class="status-hadir">Hadir</td>
                <td>-</td>
              </tr>
              <tr>
                <td>2</td>
                <td>2025-10-02</td>
                <td>-</td>
                <td class="status-izin">Izin</td>
                <td>Sakit perut</td>
              </tr>
              <tr>
                <td>3</td>
                <td>2025-10-03</td>
                <td>-</td>
                <td class="status-alpha">Alpha</td>
                <td>Tidak hadir tanpa keterangan</td>
              </tr>
              <tr>
                <td>4</td>
                <td>2025-10-04</td>
                <td>07:05</td>
                <td class="status-hadir">Hadir</td>
                <td>-</td>
              </tr>
            </tbody>
          </table>
          <button class="btn btn-primary mt-3">📤 Ajukan Izin / Sakit</button>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
