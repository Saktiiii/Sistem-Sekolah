<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Siswa</title>
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
      border-radius: 6px;
      padding: 8px 12px;
    }
    .nav-link:hover,
    .nav-link.active {
      color: #2563eb;
      background-color: #e0e7ff;
    }
    .welcome-box {
      border-radius: 15px;
      padding: 25px;
      background: linear-gradient(135deg, #2563eb, #3b82f6);
      color: #fff;
      margin-bottom: 25px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .profile-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 25px;
      transition: 0.3s;
    }
    .profile-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.15);
    }
    .profile-img {
      width: 130px;
      height: 130px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #2563eb;
      margin-bottom: 10px;
    }
    .table thead {
      background-color: #2563eb;
      color: #fff;
    }
    .table tbody tr:hover {
      background-color: #eef4ff;
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
        <li><a class="nav-link active" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/akademik'); ?>">🎓 Akademik</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="col-md-10 p-4">
      <div class="welcome-box">
        <h2 class="mb-1">Profil Siswa</h2>
        <p>Lihat dan perbarui data pribadimu di halaman ini.</p>
      </div>

      <div class="profile-card">
        <div class="text-center mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Foto Profil" class="profile-img">
          <h4 class="mt-2">Salma Raihana</h4>
          <p class="text-muted">XI RPL A | NIS: 9023</p>
        </div>

        <table class="table table-bordered align-middle">
          <tbody>
            <tr>
              <th width="30%">Nama Lengkap</th>
              <td>Salma Raihana</td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td>XI RPL A</td>
            </tr>
            <tr>
              <th>Jurusan</th>
              <td>Rekayasa Perangkat Lunak</td>
            </tr>
            <tr>
              <th>Tanggal Lahir</th>
              <td>17 Juni 2007</td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>Jl. Merdeka No. 12, Karanganyar</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>salmaraihana@example.com</td>
            </tr>
            <tr>
              <th>No. HP</th>
              <td>0812-3456-7890</td>
            </tr>
          </tbody>
        </table>

        <div class="text-end mt-3">
          <a href="#" class="btn btn-primary">✏️ Edit Profil</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
