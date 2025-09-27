<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Negeri 2 Karanganyar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9ff;
        }

        /* Header */
        .header {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .nav {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: #6366f1;
        }

        .btn-contact {
            background: #6366f1;
            color: white !important;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-contact:hover {
            background: #5856eb;
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            margin-top: 80px;
            padding: 60px 0;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8eaff 100%);
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content h1 .highlight {
            color: #6366f1;
        }

        .hero-content p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-get-started {
            background: #6366f1;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-get-started:hover {
            background: #5856eb;
            transform: translateY(-2px);
        }

        .hero-image {
            position: relative;
        }

        .hero-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* History Section */
        .history {
            padding: 80px 0;
            background: white;
        }

        .history-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .history h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 60px;
        }

        .history h2 .highlight {
            color: #6366f1;
        }

        .history-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .history-image {
            position: relative;
        }

        .history-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .history-text h3 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .history-text p {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .btn-read-more {
            background: #6366f1;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-read-more:hover {
            background: #5856eb;
        }

        /* Programs Section */
        .programs {
            padding: 80px 0;
            background: #f8f9ff;
        }

        .programs-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .programs h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 60px;
        }

        .programs h2 .highlight {
            color: #6366f1;
        }

        .programs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .program-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .program-card.blue {
            background: linear-gradient(135deg, #a8c8f0 0%, #c8d8f0 100%);
        }

        .program-card.green {
            background: linear-gradient(135deg, #a8f0c8 0%, #c8f0d8 100%);
        }

        .program-card.yellow {
            background: linear-gradient(135deg, #f0d8a8 0%, #f0e8c8 100%);
        }

        .program-card.red {
            background: linear-gradient(135deg, #f0a8c8 0%, #f0c8d8 100%);
        }

        .program-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .program-card.blue .program-icon {
            background: rgba(99, 102, 241, 0.2);
            color: #6366f1;
        }

        .program-card.green .program-icon {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .program-card.yellow .program-icon {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
        }

        .program-card.red .program-icon {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .program-card h3 {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .program-card p {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
        }

        /* Stats Section */
        .stats {
            padding: 80px 0;
            background: white;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .stats h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 60px;
        }

        .stats h2 .highlight {
            color: #6366f1;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .stat-card {
            background: #f8f9ff;
            padding: 40px 20px;
            border-radius: 15px;
            text-align: center;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .stat-card:hover {
            border-color: #6366f1;
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #6366f1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 20px;
        }

        .stat-card h3 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-card p {
            color: #666;
            font-size: 14px;
        }

        /* News Section */
        .news {
            padding: 80px 0;
            background: #f8f9ff;
        }

        .news-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .news h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .news h2 .highlight {
            color: #6366f1;
        }

        .news-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 60px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 50px;
        }

        .news-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-card-content {
            padding: 20px;
        }

        .news-card h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .news-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 12px;
            color: #666;
        }

        .news-link {
            color: #6366f1;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
        }

        .btn-all-news {
            display: block;
            width: 200px;
            margin: 0 auto;
            text-align: center;
            background: #6366f1;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-all-news:hover {
            background: #5856eb;
        }

        /* Map Section */
        .map-section {
            background: white;
            padding: 60px 0;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .map-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 40px;
            align-items: center;
        }

        .map-info {
            background: #f8f9ff;
            padding: 30px;
            border-radius: 15px;
        }

        .map-info h3 {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .map-info p {
            color: #666;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .stars {
            color: #fbbf24;
            font-size: 14px;
        }

        .map-frame {
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: #e5e7eb;
            position: relative;
        }

        .map-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #a8f0c8 0%, #6ee7b7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .map-marker {
            position: absolute;
            background: #ef4444;
            color: white;
            padding: 8px 12px;
            border-radius: 20px 20px 20px 5px;
            font-weight: bold;
            font-size: 12px;
            top: 40%;
            left: 60%;
            transform: translate(-50%, -50%);
        }

        .map-roads {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
        }

        .road {
            position: absolute;
            background: #4b5563;
            height: 4px;
        }

        .road.horizontal {
            width: 100%;
            top: 60%;
        }

        .road.vertical {
            width: 4px;
            height: 100%;
            left: 30%;
        }

        /* Footer */
        .footer {
            background: #6366f1;
            color: white;
            padding: 40px 0;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .footer-info h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer-info p {
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .footer-contact {
            text-align: right;
        }

        .footer-contact p {
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .social-links {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-container,
            .history-content,
            .map-content,
            .footer-container {
                grid-template-columns: 1fr;
            }

            .programs-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .nav {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .stats-grid,
            .news-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <div class="logo-img">SMK</div>
                <div class="logo-text">SMKN2KRA</div>
            </div>
            <nav class="nav">
                <a href="#beranda">Beranda</a>
                <a href="#profil">Profil</a>
                <a href="#artikel">Artikel</a>
                <a href="#kontak" class="btn-contact">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-container">
            <div class="hero-content">
                <h1>SMK <span class="highlight">Negeri 2</span> Karanganyar</h1>
                <p>Mewujudkan pelajar yang berprestasi, berpendidikan karakter, memiliki sopan santun, dan lulusan siap kerja.</p>
                <a href="#" class="btn-get-started">
                    Get Started →
                </a>
            </div>
            <div class="hero-image">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400' viewBox='0 0 600 400'%3E%3Crect width='600' height='400' fill='%23f0f9ff'/%3E%3Cg fill='%23ffffff'%3E%3Cpath d='M50 50h500v300H50z' opacity='0.1'/%3E%3C/g%3E%3Cg fill='%236366f1'%3E%3Ccircle cx='100' cy='100' r='30' opacity='0.3'/%3E%3Ccircle cx='500' cy='100' r='20' opacity='0.3'/%3E%3Ccircle cx='150' cy='300' r='25' opacity='0.3'/%3E%3C/g%3E%3Ctext x='300' y='200' text-anchor='middle' fill='%236366f1' font-size='24' font-weight='bold'%3ESMK Negeri 2 Karanganyar%3C/text%3E%3Ctext x='300' y='230' text-anchor='middle' fill='%23666' font-size='14'%3ESekolah Menengah Kejuruan%3C/text%3E%3C/svg%3E" alt="SMK Negeri 2 Karanganyar">
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="history" id="profil">
        <div class="history-container">
            <h2>Sejarah Berdirinya <span class="highlight">SMK Negeri 2</span> Karanganyar</h2>
            <div class="history-content">
                <div class="history-image">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='350' viewBox='0 0 500 350'%3E%3Crect width='500' height='350' fill='%23f8f9ff'/%3E%3Cg fill='%236366f1' opacity='0.1'%3E%3Crect x='50' y='50' width='400' height='250' rx='10'/%3E%3C/g%3E%3Cg fill='%236366f1'%3E%3Crect x='100' y='100' width='300' height='20' rx='10' opacity='0.3'/%3E%3Crect x='75' y='75' width='50' height='50' rx='5' opacity='0.2'/%3E%3Crect x='375' y='75' width='50' height='50' rx='5' opacity='0.2'/%3E%3C/g%3E%3Ctext x='250' y='180' text-anchor='middle' fill='%236366f1' font-size='20' font-weight='bold'%3ESMK NEGERI 2%3C/text%3E%3Ctext x='250' y='200' text-anchor='middle' fill='%236366f1' font-size='16'%3EKARANGANYAR%3C/text%3E%3Ctext x='250' y='230' text-anchor='middle' fill='%23666' font-size='12'%3EDidirikan 1997%3C/text%3E%3C/svg%3E" alt="Sejarah SMK">
                </div>
                <div class="history-text">
                    <h3>Sejarah Berdirinya SMK Negri 2 Karanganyar</h3>
                    <p>Sekolah ini pertama kali dipimpin oleh Kepala Sekolah Drs. Surip Sumarto dari Tahun Pelajaran 1997/1998 hingga tahun Pelajaran 2005/2006. Atas anjuran dari Bupati Karanganyar pada Tahun Pelajaran 2004/2005 untuk membuka satu Program Studi Teknologi Tekstil. Pada Tahun Pelajaran 2005/2007, karena belum ada Kepala Sekolah resmi maka Dinas Pendidikan Kabupaten Karanganyar menugaskan kepada Drs. Sugyarso HS, S.Pd., S.H., M.Ag</p>
                    <a href="#" class="btn-read-more">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="programs">
        <div class="programs-container">
            <h2>Jurusan Di <span class="highlight">SMK Negeri 2</span> Karanganyar</h2>
            <div class="programs-grid">
                <div class="program-card blue">
                    <div class="program-icon">⚙️</div>
                    <h3>Teknik Permesinan</h3>
                    <p>Mempelajari tentang cara memproduksi barang teknik dan menggunakan mesin, teknik serta alat hingga pemasaran.</p>
                </div>
                <div class="program-card green">
                    <div class="program-icon">💻</div>
                    <h3>Rekayasa Perangkat Lunak</h3>
                    <p>mempelajari tentang pengembangan perangkat lunak termasuk pembuatan, pemeliharaan, dan manajemen organisasi.</p>
                </div>
                <div class="program-card yellow">
                    <div class="program-icon">🏭</div>
                    <h3>Teknik Pembuatan Kain</h3>
                    <p>Jurusan Teknik Pembuatan Kain mempelajari proses pembuatan tekstil dan serat hingga pemasaran.</p>
                </div>
                <div class="program-card red">
                    <div class="program-icon">🚗</div>
                    <h3>Teknik Otomotif</h3>
                    <p>mempelajari tentang otomotif dalam penguasaan teknologi elektronik dan kontrol pada kendaraan bermotor.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <h2>Jumlah GTK dan Siswa di <span class="highlight">SMK Negeri 2</span> Karanganyar</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👨‍🏫</div>
                    <h3>Guru</h3>
                    <p>Terdapat sekitar 110 lebih guru aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <h3>Staff & Karyawan</h3>
                    <p>Terdapat sekitar 40 lebih staff dan karyawan aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">👨‍🎓</div>
                    <h3>Siswa</h3>
                    <p>Terdapat sekitar 1024 lebih pelajar aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📚</div>
                    <h3>Mata Pelajaran</h3>
                    <p>Terdapat sekitar 15 lebih mata pelajaran</p>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news" id="artikel">
        <div class="news-container">
            <h2>Berita Terbaru Di <span class="highlight">SMK Negeri 2</span> Karanganyar</h2>
            <p class="news-subtitle">Berita Terbaru Tentang SMK Negeri Makassar.</p>
            
            <div class="news-grid">
                <div class="news-card">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23f0f9ff'/%3E%3Cg fill='%236366f1' opacity='0.2'%3E%3Crect x='20' y='20' width='260' height='160' rx='8'/%3E%3C/g%3E%3Ctext x='150' y='100' text-anchor='middle' fill='%236366f1' font-size='14'%3EKelas%3C/text%3E%3C/svg%3E" alt="Pendaftaran">
                    <div class="news-card-content">
                        <h3>Pendaftaran SMK Negeri 2 Karanganyar Telah Dibuka !</h3>
                        <div class="news-meta">
                            <span>👤 Admin</span>
                            <span>📅 6 Jun</span>
                        </div>
                        <a href="#" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23f0f9ff'/%3E%3Cg fill='%236366f1' opacity='0.2'