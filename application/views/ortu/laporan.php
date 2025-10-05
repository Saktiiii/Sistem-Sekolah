<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wali Murid - Laporan Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom styles to make Bootstrap elements match Tailwind's shadow/rounded corners */
    .card {
      border-radius: 0.75rem !important;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Ensure scrollable main content height uses the entire viewport height */
    .main-scroll-area {
      height: 100vh;
      overflow-y: auto;
    }

    /* Ensure sidebar and aside stay fixed in height */
    .h-screen {
      height: 100vh !important;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans">
  <div class="flex h-screen">
    <aside class="w-64 bg-white h-screen shadow-md flex-shrink-0">
      <div class="p-6 flex items-center space-x-2 border-b">
        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">WM</div>
        <span class="font-semibold text-lg">Wali Murid</span>
      </div>
      <nav class="mt-6">
        <ul class="space-y-2">
          <li>
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx bx-dashboard text-xl'></i> <span class="ml-3">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx bx-user text-xl'></i> <span class="ml-3">Data Siswa</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('ortu/laporan'); ?>"
              class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium border-l-4 border-indigo-600">
              <i class='bx bx-file-report text-xl'></i><span class="ml-3">Laporan Siswa</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('ortu/absensi'); ?>"
              class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx bx-check-square text-xl'></i><span class="ml-3">Absensi</span>
            </a>
          </li>
          <li>
            <a href="komunikasi.html"
              class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx bx-message text-xl'></i><span class="ml-3">Komunikasi Wali Kelas</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
              <i class='bx bx-megaphone text-xl'></i><span class="ml-3">Pengumuman</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <main class="flex-1 p-6 main-scroll-area">
      <div class="container-fluid p-0">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Laporan Siswa</h1>

        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="card h-100 border-start border-4 border-indigo-500">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <h5 class="text-muted mb-1">Peringkat</h5>
                  <i class='bx bx-trophy text-2xl text-indigo-500'></i>
                </div>
                <h2 class="text-3xl fw-bold mb-0">6</h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card h-100 border-start border-4 border-red-500">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <h5 class="text-muted mb-1">Pelanggaran</h5>
                  <i class='bx bx-error text-2xl text-red-500'></i>
                </div>
                <h3 class="text-2xl fw-bold mb-0 text-red-600">3</h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card h-100 border-start border-4 border-amber-500">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <h5 class="text-muted mb-1">Absensi (A/I/S)</h5>
                  <i class='bx bx-calendar-x text-2xl text-amber-500'></i>
                </div>
                <h3 class="text-2xl fw-bold mb-0 text-amber-600">1</h3>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid p-0 mt-5">
          <h2 class="text-2xl font-semibold text-gray-800 mb-4"><i
              class="bi bi-exclamation-triangle-fill me-2 text-red-500"></i> Data Siswa Bermasalah</h2>
          <div class="card shadow-lg border-0">
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead class="bg-indigo-600 text-white">
                    <tr>
                      <th class="py-3">Nama</th>
                      <th class="py-3">NIS</th>
                      <th class="py-3">Kelas</th>
                      <th class="py-3 text-center">Status</th>
                      <th class="py-3">Keterangan</th>
                      <th class="py-3">Tanggal</th>
                      <th class="py-3 text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($siswa_bermasalah)): ?>
                      <?php foreach ($siswa_bermasalah as $s): ?>
                        <tr>
                          <td class="fw-semibold text-indigo-700"><?= htmlspecialchars($s->nama) ?></td>
                          <td class="text-muted"><?= htmlspecialchars($s->nis) ?></td>
                          <td><span
                              class="badge bg-secondary-subtle text-secondary fw-bold"><?= htmlspecialchars($s->kelas_id) ?></span>
                          </td>
                          <td class="text-center">
                            <?php
                            $status = strtolower($s->status);

                            // Gunakan array mapping agar ringkas dan aman
                            $badge_classes = [
                              'alpha' => 'bg-danger',
                              'sakit' => 'bg-warning text-dark',
                              'izin' => 'bg-info text-dark',
                            ];

                            // Pilih class sesuai status, default = bg-secondary
                            $badge_class = $badge_classes[$status] ?? 'bg-secondary';
                            ?>
                            <span class="badge <?= $badge_class ?> fw-semibold p-2 rounded-pill shadow-sm">
                              <?= ucfirst($s->status) ?>
                            </span>

                          </td>
                          <td class="text-sm fst-italic"><?= htmlspecialchars($s->keterangan) ?></td>
                          <td class="text-sm text-muted"><?= htmlspecialchars($s->tanggal) ?></td>
                          <td class="text-center">
                            <a href="<?= site_url('ortu/detail/' . $s->id) ?>"
                              class="btn btn-sm btn-outline-primary rounded-pill px-3">
                              <i class="bi bi-eye"></i> Detail
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7" class="text-center text-muted fst-italic p-4">
                          <i class="bi bi-check-circle me-1"></i> Tidak ada data siswa bermasalah/pelanggaran.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="pb-5"></div>
      </div>
    </main>

    <aside class="w-80 bg-white h-screen shadow-md p-6 flex-shrink-0 overflow-y-auto">
      <div class="flex flex-col items-center border-b pb-4 mb-4">
        <img src="assets/profile1.jpg" class="w-20 h-20 rounded-full object-cover border-4 border-indigo-100 shadow-md"
          alt="Profile Picture">
        <h2 class="mt-3 font-bold text-xl text-gray-800">Silvan Vanness</h2>
        <p class="text-gray-500 text-sm">NIS: 29/9022</p>
      </div>

      <div class="mt-4">
        <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-user-circle mr-2'></i>
          Informasi Pribadi</h3>
        <ul class="text-sm text-gray-700 space-y-1">
          <li class="flex justify-between"><span>Jhon Smith</span></li>
          <li class="flex justify-between"><span>3 Agustus 2000</span></li>
          <li class="flex justify-between"><span>Laki-laki</span></li>
          <li class="flex justify-between"><span>Islam</span></li>
          <li class="mt-2 text-xs text-gray-500 border-t pt-2">Kembang RT 01 RW 06, Karanganyar</li>
        </ul>
      </div>

      <div class="mt-6 border-t pt-4">
        <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-book-content mr-2'></i>
          Informasi Akademik</h3>
        <ul class="text-sm text-gray-700 space-y-1">
          <li class="flex justify-between"><span>SMK Negeri 2 Karanganyar</span></li>
          <li class="flex justify-between"><span>9999 / 0084354677</span></li>
          <li class="flex justify-between"><span class="font-bold text-indigo-500">Kelas XI RB</span></li>
          <li class="flex justify-between"><span>Tahun Masuk: 2023</span></li>
          <li class="flex justify-between"><span>Tahun Lulus: <i>belum lulus</i></span></li>
          <li class="flex justify-between"><span>Wali Kelas: Dwi Nuryani</span></li>
        </ul>
      </div>

      <div class="mt-6 border-t pt-4">
        <h3 class="text-indigo-600 font-semibold mb-2 flex items-center"><i class='bx bx-group mr-2'></i> Informasi
          Orang Tua/Wali</h3>
        <ul class="text-sm text-gray-700 space-y-1">
          <li>Ayah: Edi (Pedagang)</li>
          <li>Ibu: Eni (IRT)</li>
        </ul>
      </div>
    </aside>
  </div>
</body>

</html>