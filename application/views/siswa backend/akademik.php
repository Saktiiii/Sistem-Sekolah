<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akademik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e0f2ff, #f0f4ff);
      font-family: "Poppins", sans-serif;
    }
    .sidebar {
      height: 100vh;
      background: #fff;
      border-right: 1px solid #ddd;
      padding: 20px;
      position: sticky;
      top: 0;
    }
    .sidebar h4 {
      color: #2563eb;
      font-weight: bold;
      margin-bottom: 25px;
    }
    .nav-link {
      color: #333;
      margin-bottom: 10px;
      border-radius: 8px;
      padding: 10px 12px;
      transition: 0.3s;
    }
    .nav-link.active, .nav-link:hover {
      color: #2563eb;
      background: #e0e7ff;
    }
    .content {
      padding: 40px;
      animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .welcome-box {
      border-radius: 15px;
      background: linear-gradient(135deg, #2563eb, #3b82f6);
      color: #fff;
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .card-stat {
      border-radius: 15px;
      background: #fff;
      padding: 25px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .card-stat:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }
    .card-stat i {
      font-size: 32px;
      color: #2563eb;
      margin-bottom: 10px;
    }
    footer {
      text-align: center;
      padding: 15px;
      color: #777;
      margin-top: 40px;
      border-top: 1px solid #ddd;
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
     <!-- Sidebar -->
   <div class="col-md-2 sidebar">
        <h4>Admin - Siswa</h4>
        <ul class="nav flex-column">
          <li><a class="nav-link" href="<?= site_url('Page/dashboard'); ?>">📊 Dashboard</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/data_kelas'); ?>">📚 Data Kelas</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
          <li><a class="nav-link active" href="<?= site_url('Page/akademik'); ?>">🎓 Akademik</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
          <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
        </ul>
      </div>

    <div class="col-md-10 p-4">
      <div class="welcome-box">
        <h2>Kelola Nilai Akademik</h2>
        <p>Tambahkan dan perbarui nilai siswa di sini.</p>
      </div>

      <table class="table table-bordered shadow-sm">
        <thead>
          <tr><th>No</th><th>Nama Siswa</th><th>Kelas</th><th>Mata Pelajaran</th><th>Nilai</th><th>Aksi</th></tr>
        </thead>
        <tbody>
          <tr><td>1</td><td>Salma Raihana</td><td>XI RPL A</td><td>Basis Data</td><td>85</td><td><button class="btn btn-sm btn-primary">Edit</button></td></tr>
          <tr><td>2</td><td>Andi Prasetyo</td><td>XI RPL B</td><td>Pemrograman Web</td><td>90</td><td><button class="btn btn-sm btn-primary">Edit</button></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
