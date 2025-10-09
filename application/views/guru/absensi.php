<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('guru/sidebar'); ?>
<style>
    body {
  font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
}

</style>

  <div style="max-width:1100px; margin:0 auto;">
    <!-- Header -->
    <div style="margin-bottom:18px;">
      <h1 style="font-size:28px; margin:0 0 6px 0; color:#0f2540; font-weight:700;">Absensi</h1>
      <div style="display:flex; gap:18px; align-items:center;">
        <a style="font-size:14px; color:#5b5bd9; text-decoration:none;" href="<?= base_url('guru/absensi') ?>">Absensi</a>
        <span style="font-size:14px; color:#b7bcc6;">Lihat Absensi</span>
      </div>
    </div>

    <!-- filter area (tetap ringan, tanpa mengubah background halaman) -->
    <div style="margin-bottom:18px;">
      <form method="get" action="<?= base_url('guru/absensi') ?>" style="display:flex; gap:12px; align-items:center;">
        <div>
          <select name="kelas_id" style="padding:8px 10px; border-radius:8px; border:1px solid #e4e9ef;">
            <option value="">-- Semua Kelas --</option>
            <?php if (!empty($kelas_list) && is_array($kelas_list)): ?>
              <?php foreach($kelas_list as $k): 
                $sel = (isset($selected_kelas_id) && $selected_kelas_id == $k->id) ? 'selected' : '';
              ?>
                <option value="<?= htmlspecialchars($k->id) ?>" <?= $sel ?>><?= htmlspecialchars($k->nama) ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>

        <div>
          <input name="tanggal" type="date" value="<?= isset($selected_tanggal) ? htmlspecialchars($selected_tanggal) : date('Y-m-d') ?>" style="padding:8px 10px; border-radius:8px; border:1px solid #e4e9ef;">
        </div>

        <div>
          <button type="submit" style="background:#6b5ce8; color:#fff; padding:8px 14px; border-radius:8px; border:none;">Tampilkan</button>
        </div>
      </form>
    </div>

    <div style="background:transparent;">
      <div style="background:#ffffff; border-radius:12px; padding:18px; box-shadow: 0 6px 14px rgba(16,32,58,0.04);">
        <!-- header tabel -->
        <div style="display:grid; grid-template-columns: 60px 1fr 140px 140px 160px; gap:12px; align-items:center; padding:8px 12px; color:#8090a6; font-weight:600;">
          <div>No</div>
          <div>Nama</div>
          <div style="text-align:center;">Datang</div>
          <div style="text-align:center;">Pulang</div>
          <div style="text-align:right;">Status</div>
        </div>

        <!-- rows -->
        <?php
        $cutoff = '07:00';
        $i = 1;
        if (!empty($students) && is_array($students)):
          foreach($students as $s):
            $record = null;
            if (!empty($absensis) && is_array($absensis)) {
              foreach($absensis as $a) {
                $match = false;
                if (isset($a->siswa_id) && isset($s->id) && $a->siswa_id == $s->id) $match = true;
                if (!$match && isset($a->nis) && isset($s->nis) && $a->nis == $s->nis) $match = true;
                if ($match) { $record = $a; break; }
              }
            }

            $datang = '-'; $pulang = '-'; $status = 'Tidak Hadir';
            if ($record) {
              $datang = isset($record->datang) ? $record->datang : (isset($record['datang']) ? $record['datang'] : (isset($record->time_in) ? $record->time_in : '-'));
              $pulang = isset($record->pulang) ? $record->pulang : (isset($record['pulang']) ? $record['pulang'] : (isset($record->time_out) ? $record->time_out : '-'));
              if ($datang && $datang !== '-' && trim($datang) !== '') {
                $datang_clean = substr($datang,0,5);
                $ts_datang = strtotime($datang_clean);
                $ts_cutoff = strtotime($cutoff);
                if ($ts_datang > $ts_cutoff) $status = 'Terlambat';
                else $status = 'Hadir';
                $datang = $ts_datang ? date('H:i', $ts_datang) : $datang_clean;
                if ($pulang && $pulang !== '-') {
                  $pulang_clean = substr($pulang,0,5);
                  $ts_pulang = strtotime($pulang_clean);
                  if ($ts_pulang) $pulang = date('H:i', $ts_pulang);
                }
              } else {
                $status = 'Tidak Hadir';
              }
            }
        ?>
          <div style="display:grid; grid-template-columns: 60px 1fr 140px 140px 160px; gap:12px; align-items:center; padding:14px; margin-top:12px; border-radius:8px; background: #fff; box-shadow: 0 6px 12px rgba(16,32,58,0.02);">
            <div style="color:#6b7280; font-weight:600;"><?= $i++ ?></div>
            <div style="color:#1f2b45; font-weight:600;"><?= htmlspecialchars($s->nama) ?><div style="font-size:12px; color:#8b97a6; margin-top:4px;"><?= isset($s->nis) ? 'NIS: '.htmlspecialchars($s->nis) : '' ?></div></div>
            <div style="text-align:center; font-weight:700; color:#16324a;"><?= $datang ? htmlspecialchars($datang) : '-' ?></div>
            <div style="text-align:center; font-weight:700; color:#16324a;"><?= $pulang ? htmlspecialchars($pulang) : '-' ?></div>
            <div style="text-align:right;">
              <?php if (strtolower($status) === 'hadir'): ?>
                <span style="display:inline-block; padding:6px 12px; border-radius:20px; background:#eaffef; color:#17a34a; font-weight:600; font-size:13px;">Hadir</span>
              <?php elseif (strtolower($status) === 'terlambat'): ?>
                <span style="display:inline-block; padding:6px 12px; border-radius:20px; background:#fff6e6; color:#d97706; font-weight:600; font-size:13px;">Terlambat</span>
              <?php else: ?>
                <span style="display:inline-block; padding:6px 12px; border-radius:20px; background:#fff0f2; color:#f04f5f; font-weight:600; font-size:13px;">Tidak Hadir</span>
              <?php endif; ?>
            </div>
          </div>
        <?php
          endforeach;
        else:
        ?>
          <div style="padding:18px; margin-top:12px; border-radius:8px; background:#fff; color:#7e8b9b;">
            Tidak ada daftar siswa untuk kelas ini.
          </div>
        <?php endif; ?>

      </div> <!-- end card -->
    </div> <!-- end content -->

    <div style="margin-top:18px;">
      <div style="background:#fff; border-radius:12px; padding:20px; box-shadow: 0 6px 14px rgba(16,32,58,0.04); display:flex; justify-content:space-between; align-items:center;">
        <div>
          <h3 style="margin:0 0 6px 0; color:#1f2b45;">Ringkasan</h3>
          <div style="color:#6b7280;">Tanggal: <strong><?= isset($selected_tanggal) ? htmlspecialchars($selected_tanggal) : date('Y-m-d') ?></strong></div>
          <div style="color:#6b7280; margin-top:6px;">Kelas: <strong><?= isset($selected_kelas_id) && isset($kelas_name) ? htmlspecialchars($kelas_name) : (isset($selected_kelas_id) ? htmlspecialchars($selected_kelas_id) : 'Semua') ?></strong></div>
        </div>

        <div style="width:140px; text-align:center;">
          <?php if (!empty($profile_logo) && file_exists(FCPATH . $profile_logo)): ?>
            <img src="<?= base_url($profile_logo) ?>" alt="logo" style="max-width:120px;">
          <?php else: ?>
            <div style="width:120px; height:120px; display:flex; align-items:center; justify-content:center; border-radius:6px; background:#f3f6fb; color:#8b97a6;">
              Logo
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</div>
