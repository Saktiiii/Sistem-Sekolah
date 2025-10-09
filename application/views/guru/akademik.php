<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Akademik - Guru</title>
  <style>
    :root {
      --primary: #6f63ff;
      --primary-light: rgba(111, 99, 255, 0.1);
      --secondary: #6d7682;
      --light-bg: #f3f7fa;
      --white: #ffffff;
      --border: #e6e9ef;
      --success: #4caf50;
      --danger: #f44336;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      background: var(--light-bg);
      color: #222;
      line-height: 1.5;
    }

    .app-container {
      display: flex;
      min-height: 100vh;
      align-items: stretch;
    }

    /* Main content must leave space for sidebar (280px) */
    .main-content {
      flex: 1;
      margin-left: 1  px; /* MATCH sidebar width in partial */
      padding: 20px;
      min-height: 100vh;
    }

    /* Header / page title */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .page-title { font-size: 24px; font-weight: 700; color: #222; }

    .content-tabs {
      display: flex;
      gap: 16px;
      list-style: none;
      padding: 0;
      margin: 8px 0 0 0;
    }
    .content-tabs li { cursor: pointer; color: var(--secondary); padding: 8px 0; }
    .content-tabs li.active { color: var(--primary); font-weight: 600; border-bottom: 2px solid var(--primary); }

    .card {
      background: var(--white);
      border-radius: 12px;
      padding: 16px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-bottom: 16px;
    }

    .jadwal-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 18px;
      margin-top: 12px;
    }

    .jadwal-item {
      background: var(--white);
      border-radius: 10px;
      padding: 12px;
      border-left: 8px solid var(--primary);
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .form-select, input.form-control {
      padding: 8px;
      border-radius: 8px;
      border: 1px solid var(--border);
      width: 100%;
    }

    .list-group-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px;
      border-radius: 10px;
      margin-bottom: 12px;
      background: var(--white);
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .btn { padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; cursor: pointer; }
    .btn-primary { background: var(--primary); color: white; }
    .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--secondary); }
    .btn-danger { background: var(--danger); color: white; }

    .modal-backdrop {
      position: fixed; left: 0; top: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.35); display: flex; align-items: center; justify-content: center; z-index: 1000;
    }
    .modal-box { background: var(--white); border-radius: 10px; padding: 18px; max-width: 480px; width: 100%; }
    .hidden { display: none; }

    /* responsive: remove left margin when sidebar stacks on top */
    @media (max-width: 1024px) {
      .main-content { margin-left: 0; padding: 16px; }
      .jadwal-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <div class="app-container">
    <!-- include shared sidebar partial -->
    <?php $this->load->view('guru/sidebar'); ?>

    <!-- Main -->
    <main class="main-content" role="main">
      <div class="header">
        <div>
          <h2 class="page-title">Akademik</h2>
          <ul class="content-tabs" id="contentTabs">
            <li class="active" data-tab="jadwal">Jadwal Mengajar</li>
            <li data-tab="input_nilai">Input Nilai</li>
            <li data-tab="materi">Materi</li>
            <li data-tab="tugas">Tugas</li>
            <li data-tab="data_kelas">Data Kelas</li>
          </ul>
        </div>
      </div>

      <section class="content">
        <!-- Jadwal Mengajar -->
        <div id="tab-jadwal" class="tab-pane">
          <div class="card">
            <div class="toolbar" style="margin-bottom:10px;">
              <label>Hari:
                <select id="filter-hari" class="form-select" style="width:160px; display:inline-block; margin-left:8px;">
                  <option value="">Semua</option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                </select>
              </label>
            </div>
            <div id="jadwal-container" class="jadwal-grid">
              <!-- jadwal akan diisi JS -->
            </div>
          </div>
        </div>

        <!-- Input Nilai -->
        <div id="tab-input_nilai" class="tab-pane hidden">
          <div class="card">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
              <div>
                <label for="kelas-select">Kelas</label>
                <select id="kelas-select" class="form-select" style="width:240px">
                  <?php if (!empty($kelas_list)): foreach($kelas_list as $k): ?>
                    <option value="<?= $k->id ?>"><?= html_escape($k->nama_kelas) ?></option>
                  <?php endforeach; else: ?>
                    <option value="">- tidak ada kelas -</option>
                  <?php endif; ?>
                </select>
              </div>
            </div>
            <div id="siswa-list"></div>
          </div>
        </div>

        <!-- Materi -->
        <div id="tab-materi" class="tab-pane hidden">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Materi</h3>
            </div>
            <div class="card-content">
              <p style="color:var(--secondary)">Kelola materi pelajaran di sini.</p>
            </div>
          </div>

          <div class="card">
            <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
              <h3 class="card-title">Upload Materi</h3>
              <button id="btn-upload-materi" class="btn btn-outline">+ Upload Materi</button>
            </div>
            <div class="card-content">
              <div id="materi-list"></div>
            </div>
          </div>
        </div>

        <!-- Tugas -->
        <div id="tab-tugas" class="tab-pane hidden">
          <div class="card">
            <p>Coming Soon!</p>
          </div>
        </div>

        <!-- Data Kelas -->
        <div id="tab-data_kelas" class="tab-pane hidden">
          <div class="card">
            <div class="card-header"><h3 class="card-title">Data Kelas</h3></div>
            <div class="card-content">
              <?php if (!empty($kelas_list)): ?>
                <?php foreach($kelas_list as $kelas): ?>
                  <div class="materi-item" style="display:flex;justify-content:space-between;align-items:center;padding:12px;border-radius:10px;background:#fff;margin-bottom:12px;">
                    <div>
                      <h4 style="font-weight:600"><?= html_escape($kelas->nama_kelas) ?></h4>
                      <div style="color:var(--secondary)">Tingkat: <?= $kelas->tingkat ?> | Jurusan: <?= isset($kelas->nama_jurusan) ? $kelas->nama_jurusan : 'N/A' ?> | Wali Kelas: <?= isset($kelas->nama_wali_kelas) ? $kelas->nama_wali_kelas : 'N/A' ?></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div style="color: var(--secondary); text-align: center; padding: 20px;">Tidak ada data kelas</div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </section>
    </main>
  </div>

  <!-- Modal Edit Nilai -->
  <div id="modalNilai" class="modal-backdrop hidden">
    <div class="modal-box">
      <h4>Edit Nilai</h4>
      <form id="form-nilai">
        <input type="hidden" name="siswa_id" id="m-siswa_id">
        <div style="margin:8px 0">
          <label>Nama:</label>
          <div id="m-nama" style="font-weight:bold;padding:5px 0;"></div>
        </div>
        <div style="margin:8px 0">
          <label>Nilai:</label>
          <input class="form-control" name="nilai" id="m-nilai" type="number" min="0" max="100" step="0.01" placeholder="Masukkan nilai">
        </div>
        <div style="margin:8px 0">
          <label>Keterangan:</label>
          <input class="form-control" name="keterangan" id="m-keterangan" placeholder="Keterangan nilai">
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
          <button type="button" id="modalNilaiClose" class="btn btn-outline">Batal</button>
          <button type="submit" class="btn btn-primary">Update Nilai</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Upload Materi -->
  <div id="modalMateri" class="modal-backdrop hidden">
    <div class="modal-box">
      <h4>Upload Materi</h4>
      <form id="form-materi" enctype="multipart/form-data">
        <div style="margin:8px 0"><label>Judul</label><input class="form-control" name="judul" placeholder="Judul materi"></div>
        <div style="margin:8px 0"><label>Kelas</label>
          <select name="kelas_id" class="form-select">
            <?php if (!empty($kelas_list)): foreach($kelas_list as $k): ?>
              <option value="<?= $k->id ?>"><?= html_escape($k->nama_kelas) ?></option>
            <?php endforeach; else: ?>
              <option value="">- tidak ada kelas -</option>
            <?php endif; ?>
          </select>
        </div>
        <div style="margin:8px 0"><label>File</label><input type="file" name="file" class="form-control"></div>
        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
          <button type="button" id="modalMateriClose" class="btn btn-outline">Batal</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Endpoints
    var ENDPOINT_JADWAL = '<?= site_url('guru/jadwal_api') ?>';
    var ENDPOINT_SISWA_BY_KELAS = '<?= site_url('guru/siswa_by_kelas') ?>';
    var ENDPOINT_UPDATE_NILAI = '<?= site_url('guru/update_nilai') ?>';
    var ENDPOINT_GET_NILAI = '<?= site_url('guru/get_nilai') ?>';
    var ENDPOINT_DELETE_NILAI = '<?= site_url('guru/delete_nilai') ?>';
    var ENDPOINT_UPLOAD_MATERI = '<?= site_url('guru/upload_materi') ?>';

    // Tab Navigation (tabs only)
    document.querySelectorAll('.content-tabs li').forEach(function(el){
      el.addEventListener('click', function(){
        var tab = el.getAttribute('data-tab');
        if (!tab) return;
        // update active tab visual
        document.querySelectorAll('.content-tabs li').forEach(x => x.classList.remove('active'));
        document.querySelectorAll('.content-tabs li').forEach(x => { if(x.getAttribute('data-tab') === tab) x.classList.add('active') });
        // Show corresponding pane
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        var pane = document.getElementById('tab-' + tab);
        if (pane) pane.classList.remove('hidden');
        // Load data untuk tab yang aktif
        if (tab === 'jadwal') loadJadwal();
        if (tab === 'input_nilai') loadSiswa();
      });
    });

    // helper fetch
    function safeFetch(url, opts) {
      opts = opts || {};
      opts.credentials = opts.credentials || 'same-origin';
      return fetch(url, opts).then(async r => {
        if (!r.ok) {
          var txt = await r.text().catch(()=>'');
          throw new Error('HTTP ' + r.status + ' ' + txt);
        }
        return r.json().catch(()=> { throw new Error('Invalid JSON response'); });
      });
    }

    function loadJadwal() {
      var hari = (document.getElementById('filter-hari')||{value:''}).value;
      var url = ENDPOINT_JADWAL + (hari ? '?hari=' + encodeURIComponent(hari) : '');
      safeFetch(url)
        .then(data => {
          var container = document.getElementById('jadwal-container');
          container.innerHTML = '';
          if (!data || data.length === 0) {
            container.innerHTML = '<div style="color: var(--secondary); text-align:center; padding:20px;">Tidak ada jadwal mengajar</div>';
            return;
          }
          data.forEach(function(j){
            var el = document.createElement('div');
            el.className = 'jadwal-item';
            var left = '<div><div style="font-weight:700">'+ (j.mata_pelajaran || j.nama_mapel || 'Mata Pelajaran') +'</div><div style="font-size:12px;color:#6d7682">'+ (j.nama_kelas || 'Kelas') +'</div></div>';
            var right = '<div style="text-align:right"><div style="font-size:13px">'+(j.jam_mulai||'')+' - '+(j.jam_selesai||'')+'</div><div style="font-size:12px;color:#6d7682">'+(j.hari||'')+'</div></div>';
            el.innerHTML = left + right;
            container.appendChild(el);
          });
        })
        .catch(err => {
          console.error('Error loading jadwal:', err);
          var container = document.getElementById('jadwal-container');
          if (container) container.innerHTML = '<div style="color: var(--danger); text-align:center; padding:20px;">Error loading jadwal</div>';
        });
    }

    document.getElementById('filter-hari')?.addEventListener('change', loadJadwal);

    document.addEventListener('DOMContentLoaded', function() {
      // initial loads
      loadJadwal();
      loadSiswa();
    });

    function loadSiswa(){
      var kelasSelect = document.getElementById('kelas-select');
      var kelasId = kelasSelect ? kelasSelect.value : '';
      if (!kelasId) {
        document.getElementById('siswa-list').innerHTML = '<div style="color:#6d7682; text-align:center; padding:20px;">Pilih kelas terlebih dulu</div>';
        return;
      }
      var url = ENDPOINT_SISWA_BY_KELAS + '/' + kelasId;
      safeFetch(url)
        .then(data => {
          var list = document.getElementById('siswa-list');
          list.innerHTML = '';
          if (!data || data.length === 0) {
            list.innerHTML = '<div style="color:#6d7682; text-align:center; padding:20px;">Tidak ada siswa di kelas ini</div>';
            return;
          }
          data.forEach(function(s){
            var item = document.createElement('div');
            item.className = 'list-group-item';
            item.innerHTML = '<div><strong>'+ (s.nama || s.username || '') +'</strong><div style="color:#6d7682">NIS: '+(s.nis||'')+' | Jenis Kelamin: '+(s.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan')+'</div></div>' +
              '<div class="materi-actions">' +
              '<button class="btn btn-primary btn-edit" data-id="'+s.id+'" data-nama="'+ (s.nama || s.username || '') +'">Edit</button>' +
              '<button class="btn btn-danger btn-delete" data-id="'+s.id+'" data-nama="'+ (s.nama || s.username || '') +'">Delete</button>' +
              '</div>';
            list.appendChild(item);
          });

          // attach events
          document.querySelectorAll('.btn-edit').forEach(function(b){
            b.addEventListener('click', function(){
              var siswaId = this.getAttribute('data-id');
              var siswaNama = this.getAttribute('data-nama');
              editNilai(siswaId, siswaNama);
            });
          });
          document.querySelectorAll('.btn-delete').forEach(function(b){
            b.addEventListener('click', function(){
              var siswaId = this.getAttribute('data-id');
              var siswaNama = this.getAttribute('data-nama');
              if (confirm('Apakah Anda yakin ingin menghapus nilai untuk siswa: ' + siswaNama + '?')) {
                deleteNilai(siswaId);
              }
            });
          });
        })
        .catch(err => {
          console.error('Error loading siswa:', err);
          var list = document.getElementById('siswa-list');
          if (list) list.innerHTML = '<div style="color: var(--danger); text-align:center; padding:20px;">Error loading data siswa</div>';
        });
    }

    document.getElementById('kelas-select')?.addEventListener('change', loadSiswa);

    function editNilai(siswaId, siswaNama) {
      safeFetch(ENDPOINT_GET_NILAI + '/' + siswaId)
        .then(nilai => {
          document.getElementById('m-siswa_id').value = siswaId;
          document.getElementById('m-nama').innerText = siswaNama;
          document.getElementById('m-nilai').value = (nilai && (nilai.nilai_total !== undefined && nilai.nilai_total !== null)) ? nilai.nilai_total : '';
          document.getElementById('m-keterangan').value = (nilai && nilai.keterangan) ? nilai.keterangan : '';
          toggleModal('modalNilai', true);
        })
        .catch(err => {
          console.error('Error get nilai:', err);
          document.getElementById('m-siswa_id').value = siswaId;
          document.getElementById('m-nama').innerText = siswaNama;
          document.getElementById('m-nilai').value = '';
          document.getElementById('m-keterangan').value = '';
          toggleModal('modalNilai', true);
        });
    }

    function deleteNilai(siswaId) {
      var fd = new FormData();
      safeFetch(ENDPOINT_DELETE_NILAI + '/' + siswaId, { method: 'POST', body: fd })
        .then(res => {
          if (res.status === 'success') {
            alert('Nilai berhasil dihapus');
            loadSiswa();
          } else {
            alert('Gagal menghapus nilai: ' + (res.message || ''));
          }
        })
        .catch(err => {
          console.error('Error deleting nilai:', err);
          alert('Error menghapus nilai');
        });
    }

    document.getElementById('form-nilai')?.addEventListener('submit', function(e){
      e.preventDefault();
      var form = new FormData(this);
      safeFetch(ENDPOINT_UPDATE_NILAI, { method: 'POST', body: form })
        .then(res => {
          if (res.status === 'success') {
            alert('Nilai berhasil diupdate');
            toggleModal('modalNilai', false);
            loadSiswa();
          } else {
            alert('Gagal update nilai: ' + (res.message || ''));
          }
        })
        .catch(err => {
          console.error('Error update nilai:', err);
          alert('Error update nilai');
        });
    });

    document.getElementById('btn-upload-materi')?.addEventListener('click', function(){ toggleModal('modalMateri', true); });
    document.getElementById('form-materi')?.addEventListener('submit', function(e){
      e.preventDefault();
      var form = new FormData(this);
      safeFetch(ENDPOINT_UPLOAD_MATERI, { method: 'POST', body: form })
        .then(res => {
          if (res.status === 'ok') {
            alert('Materi berhasil diupload');
            toggleModal('modalMateri', false);
          } else {
            alert('Upload gagal: ' + (res.message || ''));
          }
        })
        .catch(err => {
          console.error('Error upload materi:', err);
          alert('Error upload materi');
        });
    });

    function toggleModal(id, show) {
      var el = document.getElementById(id);
      if (!el) return;
      if (show) el.classList.remove('hidden'); else el.classList.add('hidden');
    }
    document.getElementById('modalNilaiClose')?.addEventListener('click', function(){ toggleModal('modalNilai', false); });
    document.getElementById('modalMateriClose')?.addEventListener('click', function(){ toggleModal('modalMateri', false); });
  </script>
</body>
</html>
