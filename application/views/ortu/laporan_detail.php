<div class="container mt-3">
  <h2>Detail Siswa</h2>
  <div class="card p-3">
    <h4><?= $siswa->nama ?> (<?= $siswa->nis ?>)</h4>
    <p>Jenis Kelamin: <?= $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
    <p>Tanggal Lahir: <?= $siswa->tanggal_lahir ?></p>
    <p>Alamat: <?= $siswa->alamat ?></p>
    <p>Telepon: <?= $siswa->telepon ?></p>
    <p>Kelas: <?= $siswa->kelas_id ?></p>

    <hr>
    <h5>Riwayat Presensi</h5>
    <table class="table">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($siswa->presensi as $p): ?>
        <tr>
          <td><?= $p->tanggal ?></td>
          <td><?= ucfirst($p->status) ?></td>
          <td><?= $p->keterangan ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
