<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- views/guru/sidebar.php -->
<style>
  /* Sidebar Styles */
  .sidebar {
      width: 280px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background: white;
      border-right: 1px solid #e2e8f0;
      padding: 24px 20px;
      display: flex;
      flex-direction: column;
      z-index: 10;
  }

  body {
      margin-left: 280px;
      background: #f9fafb;
      font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif !important;
  }

  .logo {
      font-size: 24px;
      font-weight: 700;
      color: #3b82f6;
      margin-bottom: 32px;
      padding: 0 12px;
  }

  .nav-section {
      margin-bottom: 32px;
  }

  .nav-title {
      font-size: 14px;
      font-weight: 600;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 16px;
      padding: 0 12px;
  }

  .nav-links {
      list-style: none;
      padding: 0;
      margin: 0;
  }

  .nav-link {
      display: flex;
      align-items: center;
      padding: 12px;
      margin-bottom: 4px;
      border-radius: 8px;
      color: #475569;
      text-decoration: none;
      transition: all 0.2s;
      cursor: pointer;
      font-weight: 600;
  }

  .nav-link:hover {
      background: #f1f5f9;
      color: #1e293b;
  }

  .nav-link.active {
      background: #3b82f6;
      color: white;
  }

  .nav-link i {
      margin-right: 12px;
      font-size: 18px;
  }

  /* Profile area */
  .profile-section {
      margin-top: auto;
      padding-top: 12px;
      border-top: 1px solid #e2e8f0;
  }

  .profile-info { 
      display: flex; 
      gap: 12px; 
      align-items: center; 
      margin-bottom: 12px; 
  }

  .profile-avatar {
      width: 40px; 
      height: 40px; 
      border-radius: 50%; 
      background: rgba(59,130,246,0.08);
      display: flex; 
      align-items: center; 
      justify-content: center; 
      color: #3b82f6; 
      font-weight: 700;
  }

  .profile-name { 
      font-size: 14px; 
      font-weight: 600; 
      color: #111827; 
  }

  .profile-id { 
      font-size: 12px; 
      color: #64748b; 
  }

  .logout-button {
      display: block; 
      margin-top: 8px; 
      padding: 8px 12px; 
      text-align: center; 
      border-radius: 8px;
      border: 1px solid #e6e9ef; 
      text-decoration: none; 
      color: #111827; 
      font-weight: 600;
  }

  .logout-button:hover { 
      background: #f8fafc; 
  }

  /* Responsive */
  @media (max-width: 1024px) {
      .sidebar {
          width: 100%;
          border-right: none;
          border-bottom: 1px solid #e2e8f0;
          position: relative;
          min-height: auto;
      }
      body {
          margin-left: 0;
      }
  }
</style>

<aside class="sidebar" aria-label="Sidebar">
  <div>
    <div class="logo">Guru</div>

    <!-- Akademik Menu -->
    <div class="nav-section">
      <div class="nav-title">Akademik</div>
      <ul class="nav-links">
        <li>
          <a class="nav-link" href="<?= site_url('guru/akademik') ?>">
            <i>📚</i> Akademik
          </a>
        </li>
        <li>
          <a class="nav-link" href="<?= site_url('guru/ekskul') ?>">
            <i>⚽</i> Ekskul
          </a>
        </li>
        <li>
          <a class="nav-link" href="<?= site_url('guru/pengumuman') ?>">
            <i>📢</i> Pengumuman
          </a>
        </li>
        <li>
          <a class="nav-link" href="<?= site_url('guru/laporan') ?>">
            <i>📊</i> Laporan
          </a>
        </li>
        <li>
          <a class="nav-link" href="<?= site_url('guru/absensi') ?>">
            <i>📅</i> Absensi
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Profile & Logout -->
  <div class="profile-section" aria-label="Profile Guru">
    <div class="profile-info">
      <div class="profile-avatar">
        <?php
          $nama = isset($guru->nama) && !empty($guru->nama) ? $guru->nama : $this->session->userdata('username');
          echo strtoupper(substr($nama, 0, 2));
        ?>
      </div>
      <div>
        <div class="profile-name"><?= html_escape($nama) ?></div>
        <div class="profile-id"><?= isset($guru->nip) ? html_escape($guru->nip) : '' ?></div>
      </div>
    </div>

    <a id="logoutBtn" class="logout-button" href="<?= site_url('auth/logout') ?>">Logout</a>
  </div>
</aside>

<script>
  (function(){
    try {
      // Auto highlight menu
      var links = document.querySelectorAll('.sidebar .nav-link');
      var path = window.location.pathname.replace(/\/$/, '');
      links.forEach(function(a){
        var href = a.getAttribute('href') || '';
        if (href.indexOf(location.origin) === 0) href = href.replace(location.origin,'');
        href = href.replace(/\/$/, '');
        if (href === path || (href !== '' && path.indexOf(href) !== -1)) {
          a.classList.add('active');
        }
      });
    } catch(e){ console.error(e); }

    // Konfirmasi logout
    var logout = document.getElementById('logoutBtn');
    if (logout) {
      logout.addEventListener('click', function(e){
        if (!confirm('Yakin ingin logout?')) {
          e.preventDefault();
        }
      });
    }
  })();
</script>
