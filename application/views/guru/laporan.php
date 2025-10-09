<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Laporan - Sistem Sekolah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root { --primary:#2c3e50; --accent:#3498db; }
    html,body{height:100%;margin:0;font-family:Segoe UI,system-ui,-apple-system;}
    .app-container{display:flex;align-items:flex-start;min-height:100vh;}
    .main-content{flex:1;padding:28px;min-width:0;}
    .page-title{font-size:28px;font-weight:700;color:var(--primary);margin-bottom:18px;}
    .report-section{background:white;border-radius:8px;padding:0;margin-bottom:20px;border-left:4px solid var(--accent);box-shadow:0 2px 10px rgba(0,0,0,0.06);}
    .card-header{padding:12px 16px;font-weight:700;border-bottom:1px solid #eef2f6;background:#fff;}
    .info-box{background:#f8f9fa;padding:12px;border-radius:6px;margin:12px;}
    .table-responsive{overflow-x:auto;}
    @media (max-width:1024px){ .app-container{flex-direction:column;} .main-content{padding:16px;} }
  </style>
</head>
<body>
  <div class="app-container">
    <?php $this->load->view('guru/sidebar'); ?>

    <main class="main-content" role="main">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="page-title">Laporan</div>
        <div>
          <!-- pilih kelas -->
          <form method="get" class="d-flex" id="kelasForm">
            <label class="me-2 align-self-center">Kelas:</label>
            <select name="kelas_id" class="form-select form-select-sm me-2" onchange="document.getElementById('kelasForm').submit();" style="width:240px;">
              <option value="">-- Pilih Kelas --</option>
              <?php foreach ($kelas_list as $k): ?>
                <option value="<?= html_escape($k->id) ?>" <?= (isset($selected_kelas_id) && $selected_kelas_id == $k->id) ? 'selected' : '' ?>>
                  <?= html_escape($k->nama_kelas) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <noscript><button class="btn btn-primary btn-sm">Load</button></noscript>
          </form>
        </div>
      </div>

      <?php if (empty($selected_kelas_id)): ?>
        <div class="alert alert-info">Silakan pilih kelas untuk melihat laporan.</div>
      <?php else: ?>

        <!-- Rekap Nilai -->
        <section class="report-section card">
          <div class="card-header d-flex align-items-center">
            <i class="fas fa-chart-bar me-2" style="color:var(--accent)"></i> Rekap Nilai Kelas <?= isset($kelas_info->nama_kelas) ? ' - '.html_escape($kelas_info->nama_kelas) : '' ?>
          </div>
          <div class="p-3">
            <div class="info-box mb-3">
              <div class="row">
                <div class="col-md-6"><strong>Jumlah Siswa:</strong> <?= count($siswa_list) ?></div>
                <div class="col-md-6"><strong>Semester:</strong> Ganjil</div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Rata-rata Nilai</th>
                    <th>Detail Nilai (per mapel)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($siswa_list)): foreach ($siswa_list as $s): 
                    $d = isset($detail[$s->id]) ? $detail[$s->id] : null;
                    $avg = $d && isset($d['avg']) ? number_format((float)$d['avg'],2) : '-';
                  ?>
                    <tr>
                      <td><?= html_escape($s->nama) ?></td>
                      <td><?= html_escape($s->nis) ?></td>
                      <td style="width:120px;"><?= $avg ?></td>
                      <td>
                        <?php if ($d && !empty($d['nilai_rows'])): ?>
                          <ul class="mb-0" style="list-style:none;padding-left:0;">
                            <?php foreach ($d['nilai_rows'] as $nr): ?>
                              <li><strong><?= html_escape(isset($nr->nama_mapel)?$nr->nama_mapel:'-') ?></strong>: <?= isset($nr->nilai_total) ? number_format((float)$nr->nilai_total,2) : '-' ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php else: ?>
                          <span class="text-muted">Belum ada data nilai</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; else: ?>
                    <tr><td colspan="4" class="text-center text-muted">Tidak ada siswa di kelas ini</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Absensi -->
        <section class="report-section card">
          <div class="card-header d-flex align-items-center">
            <i class="fas fa-clipboard-check me-2" style="color:var(--accent)"></i> Laporan Absensi
          </div>
          <div class="p-3">
            <?php if (!empty($siswa_list)): foreach ($siswa_list as $s):
              $d = isset($detail[$s->id]) ? $detail[$s->id] : null;
              $abs = $d && isset($d['absensi']) ? $d['absensi'] : [];
            ?>
              <div class="mb-2 p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <div><strong><?= html_escape($s->nama) ?></strong> <small class="text-muted">NIS: <?= html_escape($s->nis) ?></small></div>
                  <div>
                    <span class="badge bg-success"><?= isset($abs['hadir']) ? $abs['hadir'] : 0 ?> hadir</span>
                    <span class="badge bg-warning text-dark ms-1"><?= isset($abs['izin']) ? $abs['izin'] : 0 ?> izin</span>
                    <span class="badge bg-danger ms-1"><?= isset($abs['sakit']) ? $abs['sakit'] : 0 ?> sakit</span>
                  </div>
                </div>
              </div>
            <?php endforeach; else: ?>
              <div class="text-muted">Tidak ada siswa/absensi.</div>
            <?php endif; ?>
          </div>
        </section>

        <!-- Tugas -->
        <section class="report-section card">
          <div class="card-header d-flex align-items-center">
            <i class="fas fa-tasks me-2" style="color:var(--accent)"></i> Laporan Tugas
          </div>
          <div class="p-3">
            <?php if (!empty($siswa_list)): foreach ($siswa_list as $s):
                $d = isset($detail[$s->id]) ? $detail[$s->id] : null;
                $tugas = $d && isset($d['tugas']) ? $d['tugas'] : [];
            ?>
              <div class="mb-3">
                <div class="fw-bold"><?= html_escape($s->nama) ?> <small class="text-muted">NIS: <?= html_escape($s->nis) ?></small></div>
                <?php if (!empty($tugas)): ?>
                  <ul class="mb-0">
                    <?php foreach ($tugas as $t): ?>
                      <li><?= html_escape(isset($t->nama_tugas) ? $t->nama_tugas : (isset($t->tugas_ke) ? 'Tugas '.$t->tugas_ke : 'Tugas')) ?> — <?= isset($t->nilai) ? html_escape($t->nilai) : '-' ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <div class="text-muted">Belum ada data tugas</div>
                <?php endif; ?>
              </div>
            <?php endforeach; else: ?>
              <div class="text-muted">Tidak ada data tugas.</div>
            <?php endif; ?>
          </div>
        </section>

      <?php endif; ?>

      <!-- footer small -->
      <div class="text-muted small mt-4">© <?= date('Y') ?> Sistem Sekolah</div>
    </main>
  </div>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
