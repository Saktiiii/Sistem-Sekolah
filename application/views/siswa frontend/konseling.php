<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Konseling Siswa</title>
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
    .card-consult {
      border: 1px solid #cfe2ff;
      border-radius: 12px;
      padding: 20px;
      background: #ffffff;
      box-shadow: 0 3px 6px rgba(0,0,0,0.08);
      transition: transform 0.2s;
    }
    .card-consult:hover {
      transform: translateY(-3px);
    }
    .card-consult h5 {
      color: #2563eb;
      font-weight: 600;
    }
    .btn-outline-primary {
      border-color: #2563eb;
      color: #2563eb;
    }
    .btn-outline-primary:hover {
      background-color: #2563eb;
      color: #fff;
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
          <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
          <li><a class="nav-link active" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
        </ul>
      </div>

      <!-- Konten -->
      <div class="col-md-10 p-4">
        <div class="welcome-box">
          <h2>💬 Layanan Konseling</h2>
          <p>Konseling membantu siswa menghadapi masalah pribadi, sosial, maupun akademik. Pilih topik di bawah ini untuk berkonsultasi.</p>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="card-consult">
              <h5>📘 Masalah Akademik</h5>
              <p>Konsultasikan kesulitan belajar, nilai, atau pengaturan waktu belajar.</p>
              <button class="btn btn-outline-primary btn-sm">Ajukan Konseling</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-consult">
              <h5>💭 Masalah Pribadi</h5>
              <p>Diskusikan perasaan, stres, atau tantangan pribadi dengan guru BK.</p>
              <button class="btn btn-outline-primary btn-sm">Ajukan Konseling</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-consult">
              <h5>🤝 Hubungan Sosial</h5>
              <p>Bimbingan untuk mengatasi masalah dengan teman atau lingkungan sekolah.</p>
              <button class="btn btn-outline-primary btn-sm">Ajukan Konseling</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-consult">
              <h5>🎯 Konseling Karier</h5>
              <p>Dapatkan arahan dalam menentukan jurusan, karier, atau minat masa depan.</p>
              <button class="btn btn-outline-primary btn-sm">Ajukan Konseling</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
