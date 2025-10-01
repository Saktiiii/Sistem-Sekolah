<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wali Murid - Laporan Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white h-screen shadow-md">
      <div class="p-6 flex items-center space-x-2">
        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">WM</div>
        <span class="font-semibold text-lg">Wali Murid</span>
      </div>
      <nav class="mt-6">
        <ul class="space-y-2">
          <li>
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx  bx-dashboard'></i> <span class="ml-3">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx  bx-user'></i> <span class="ml-3">Data Siswa</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
              <i class='bx  bx-file-report'></i><span class="ml-3">Laporan Siswa</span>
            </a>
          </li>
          <li>
            <a href="absensi.html"
              class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx  bx-check-square'></i><span class="ml-3">Absensi</span>
            </a>
          </li>
          <li>
            <a href="komunikasi.html"
              class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx  bx-message'></i><span class="ml-3">Komunikasi Wali Kelas</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx  bx-megaphone'></i><span class="ml-3">Pengumuman</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <div class="container mt-3">
        <div class="row">
          <div class="col-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/paypal.png" alt="" class="rounded">
                  </div>
                </div>
                <span class="d-block mb-1">Peringkat</span>
                <h2 class="card-title text-nowrap mb-2">6</h2>
              </div>
            </div>
          </div>
          <div class="col-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/paypal.png" alt="" class="rounded">
                  </div>
                </div>
                <span class="d-block mb-1">Pelanggaran</span>
                <h3 class="card-title text-nowrap mb-2">3</h3>
              </div>
            </div>
          </div>
          <div class="col-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/paypal.png" alt="" class="rounded">
                  </div>
                </div>
                <span class="d-block mb-1">Absensi</span>
                <h3 class="card-title text-nowrap mb-2">1</h3>
              </div>
            </div>
          </div>
        </div>
        <!-- Siswa Bermasalah -->
        <div class="container mt-3">
          <h2 class="mb-3">Laporan Siswa Bermasalah</h2>
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($siswa_bermasalah as $s): ?>
                <tr>
                  <td><?= $s->nama ?></td>
                  <td><?= $s->nis ?></td>
                  <td><?= $s->kelas_id ?></td>
                  <td>
                    <?php if($s->status == 'alpha'): ?>
                    <span class="badge bg-danger">Alpha</span>
                    <?php elseif($s->status == 'sakit'): ?>
                    <span class="badge bg-warning">Sakit</span>
                    <?php elseif($s->status == 'izin'): ?>
                    <span class="badge bg-info">Izin</span>
                    <?php endif; ?>
                  </td>
                  <td><?= $s->keterangan ?></td>
                  <td><?= $s->tanggal ?></td>
                  <td><a href="<?= site_url('laporan/detail/'.$s->id) ?>" class="btn btn-primary btn-sm">Detail</a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

    </main>

    <!-- Detail Siswa -->
    <aside class="w-80 bg-white shadow-md p-6">
      <div class="flex flex-col items-center">
        <img src="assets/profile1.jpg" class="w-20 h-20 rounded-full" alt="">
        <h2 class="mt-2 font-semibold text-lg">Silvan Vanness</h2>
        <p class="text-gray-500">29/9022</p>
      </div>
      <div class="mt-6">
        <h3 class="text-gray-600 font-semibold mb-2">Informasi Pribadi</h3>
        <ul class="text-sm text-gray-700 space-y-1">
          <li>Jhon Smith</li>
          <li>3 Agustus 2000</li>
          <li>Laki-laki</li>
          <li>Islam</li>
          <li>Kembang RT 01 RW 06, Karanganyar</li>
        </ul>
      </div>
      <div class="mt-6">
        <h3 class="text-gray-600 font-semibold mb-2">Informasi Akademik</h3>
        <ul class="text-sm text-gray-700 space-y-1">
          <li>SMK Negeri 2 Karanganyar</li>
          <li>9999 / 0084354677</li>
          <li>Kelas XI RB</li>
          <li>Tahun Masuk: 2023</li>
          <li>Tahun Lulus: <i>belum lulus</i></li>
          <li>Wali Kelas: Dwi Nuryani</li>
        </ul>
      </div>
      <div class="mt-6">
        <h3 class="text-gray-600 font-semibold mb-2">Informasi Orang Tua/Wali</h3>
        <ul class="text-sm text-gray-700 space-y-1">
          <li>Ayah: Edi (Pedagang)</li>
          <li>Ibu: Eni (IRT)</li>
        </ul>
      </div>
    </aside>
  </div>
</body>

</html>