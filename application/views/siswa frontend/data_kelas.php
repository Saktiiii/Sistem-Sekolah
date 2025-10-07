<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Kelas Siswa</title>
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
          <li><a class="nav-link active text-primary fw-bold" href="<?= site_url('Page/data_kelas'); ?>">📚 Data Kelas</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/akademik'); ?>">🎓 Akademik</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
        </ul>
      </div>

      <!-- Content -->
      <div class="col-md-10 p-4">
        <div class="welcome-box">
          <h2>📚 Data Kelas</h2>
          <p>Lihat daftar pelajaran, guru pengajar, dan jadwal harian kamu di sini.</p>
        </div>

        <div class="card p-3 shadow-sm">
          <h5 class="mb-3 text-primary">📅 Jadwal Pelajaran Minggu Ini</h5>
          <table class="table table-bordered table-hover align-middle">
            <thead class="text-center">
              <tr>
                <th>Hari</th>
                <th>Mata Pelajaran</th>
                <th>Guru Pengajar</th>
                <th>Jam</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Senin</td>
                <td>Bahasa Indonesia</td>
                <td>Ibu Rini</td>
                <td>07.00 - 08.40</td>
              </tr>
              <tr>
                <td>Senin</td>
                <td>Matematika</td>
                <td>Pak Budi</td>
                <td>08.50 - 10.30</td>
              </tr>
              <tr>
                <td>Selasa</td>
                <td>Basis Data</td>
                <td>Bu Sinta</td>
                <td>07.00 - 09.30</td>
              </tr>
              <tr>
                <td>Rabu</td>
                <td>Pemrograman Web</td>
                <td>Pak Deni</td>
                <td>07.00 - 09.30</td>
              </tr>
              <tr>
                <td>Kamis</td>
                <td>Bahasa Inggris</td>
                <td>Bu Lita</td>
                <td>07.00 - 08.40</td>
              </tr>
              <tr>
                <td>Jumat</td>
                <td>Pendidikan Agama</td>
                <td>Pak Hadi</td>
                <td>07.00 - 08.40</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="card p-3 shadow-sm mt-4">
          <h5 class="mb-3 text-primary">👨‍🏫 Wali Kelas</h5>
          <table class="table table-striped table-bordered">
            <tr>
              <th>Nama Wali Kelas</th>
              <td>Pak Ahmad</td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td>XI RPL A</td>
            </tr>
            <tr>
              <th>Nomor Kontak</th>
              <td>0812-3456-7890</td>
            </tr>
          </table>
        </div>

      </div>
    </div>
  </div>
</body>
</html>
