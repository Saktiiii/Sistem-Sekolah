<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akademik Siswa</title>
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
    .card-stat {
      border-radius: 15px;
      padding: 20px;
      background: #fff;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .card-stat:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.15);
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
        <li><a class="nav-link" href="<?= site_url('Page/profil'); ?>">👤 Profil</a></li>
        <li><a class="nav-link active text-primary fw-bold" href="<?= site_url('Page/akademik'); ?>">🎓 Akademik</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/ekskul'); ?>">🏅 Ekskul</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/konseling'); ?>">💬 Konseling</a></li>
        <li><a class="nav-link" href="<?= site_url('Page/absensi'); ?>">🕒 Absensi</a></li>
      </ul>
    </div>

    <!-- Content -->
    <div class="col-md-10 p-4">
      <div class="welcome-box">
        <h2>Nilai Akademik</h2>
        <p>Lihat hasil belajar dan perkembangan akademikmu di sini.</p>
      </div>

      <!-- Statistik singkat -->
      <div class="row g-4 mb-4">
        <div class="col-md-3">
          <div class="card-stat">
            <h4 class="text-primary">83</h4>
            <p>Rata-rata Nilai</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-stat">
            <h4 class="text-danger">2</h4>
            <p>Nilai Belum Tuntas</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-stat">
            <h4 class="text-success">10</h4>
            <p>Mata Pelajaran</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-stat">
            <h4 class="text-secondary">XI RPL A</h4>
            <p>Kelas</p>
          </div>
        </div>
      </div>

      <!-- Tabel nilai -->
      <div class="card p-4 shadow-sm">
        <h5 class="mb-3 text-primary fw-bold">Daftar Nilai Semester Genap</h5>
        <table class="table table-bordered align-middle">
          <thead>
            <tr>
              <th>No</th>
              <th>Mata Pelajaran</th>
              <th>Guru</th>
              <th>Nilai Tugas</th>
              <th>Nilai UTS</th>
              <th>Nilai UAS</th>
              <th>Rata-rata</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Basis Data</td>
              <td>Bu Sari</td>
              <td>85</td>
              <td>80</td>
              <td>90</td>
              <td>85</td>
              <td class="text-success fw-semibold">Lulus</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Pemrograman Web</td>
              <td>Pak Dwi</td>
              <td>88</td>
              <td>78</td>
              <td>84</td>
              <td>83</td>
              <td class="text-success fw-semibold">Lulus</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Matematika</td>
              <td>Bu Sinta</td>
              <td>70</td>
              <td>68</td>
              <td>72</td>
              <td>70</td>
              <td class="text-danger fw-semibold">Remedial</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Bahasa Indonesia</td>
              <td>Pak Joko</td>
              <td>90</td>
              <td>86</td>
              <td>88</td>
              <td>88</td>
              <td class="text-success fw-semibold">Lulus</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</body>
</html>
