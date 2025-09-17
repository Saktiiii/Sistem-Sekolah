<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengumuman - Dashboard Ortu</title>
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
    /* Biru keunguan */
    .bg-primary-custom {
      background: linear-gradient(90deg, #4e73df, #6f42c1);
      color: #fff !important;
    }
    .announcement-card {
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .announcement-card .card-header {
      border-radius: 12px 12px 0 0;
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
      <div class="card shadow mt-3">
        <div class="card-header bg-primary-custom">
          <h4 class="mb-0">📢 Pengumuman</h4>
        </div>
        <div class="card-body">
          <?php if(!empty($pengumuman)): ?>
            <?php foreach($pengumuman as $row): ?>
              <div class="card announcement-card">
                <div class="card-header bg-primary-custom">
                  <h5 class="mb-0"><?= $row->judul; ?></h5>
                </div>
                <div class="card-body">
                  <small class="text-muted">📅 <?= date('d M Y', strtotime($row->tanggal_posting)); ?></small>
                  <p class="mt-2"><?= $row->isi; ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="alert alert-info">Belum ada pengumuman.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
