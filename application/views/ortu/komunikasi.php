<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wali Murid - Komunikasi Wali Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .main-scroll-area {
            height: 100vh;
            overflow-y: auto;
        }

        .h-screen {
            height: 100vh !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-md flex-shrink-0">
            <div class="p-6 flex items-center space-x-2 border-b">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                    WM</div>
                <span class="font-semibold text-lg">Wali Murid</span>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li><a href="<?= base_url('ortu/dashboard') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-dashboard text-xl'></i><span class="ml-3">Dashboard</span></a></li>
                    <li><a href="<?= base_url('ortu/data_siswa') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-user text-xl'></i><span class="ml-3">Data Siswa</span></a></li>
                    <li><a href="<?= base_url('ortu/laporan') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-file-report text-xl'></i><span class="ml-3">Laporan Siswa</span></a></li>
                    <li><a href="<?= base_url('ortu/absensi') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-check-square text-xl'></i><span class="ml-3">Absensi</span></a></li>
                    <li><a href="<?= base_url('ortu/komunikasi') ?>"
                            class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium border-l-4 border-indigo-600"><i
                                class='bx bx-message text-xl'></i><span class="ml-3">Komunikasi</span></a></li>
                    <li><a href="<?= base_url('ortu/pengumuman') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-megaphone text-xl'></i><span class="ml-3">Pengumuman</span></a></li>
                    <li><a href="<?= base_url('auth/logout') ?>"
                            class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600"><i
                                class='bx bx-megaphone text-xl'></i><span class="ml-3">Logout</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- MAIN CHAT AREA -->
        <main class="flex-1 p-6 main-scroll-area">
            <div class="container-fluid p-0">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Komunikasi Wali Kelas</h1>

                <!-- Info atas -->
                <div class="card mb-4 p-4 border-start border-4 border-indigo-500">
                    <div class="flex justify-between">
                        <div>
                            <h5 class="text-gray-700 font-semibold mb-1">Wali Kelas</h5>
                            <p class="mb-0"><?= htmlspecialchars($guru->nama) ?> <span
                                    class="text-gray-500">(<?= $guru->email ?>)</span></p>
                            <p class="text-sm text-gray-500 mb-0"><?= htmlspecialchars($guru->telepon) ?> •
                                <?= htmlspecialchars($guru->alamat) ?>
                            </p>
                        </div>
                        <div class="text-end">
                            <h6 class="text-gray-600 mb-1">Orang Tua</h6>
                            <p class="mb-0"><?= htmlspecialchars($orang_tua->nama) ?>
                                (<?= htmlspecialchars($orang_tua->hubungan) ?>)</p>
                            <p class="text-sm text-gray-500 mb-0"><?= htmlspecialchars($orang_tua->telepon) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Kotak Chat -->
                <div class="bg-white rounded-lg shadow flex flex-col h-[500px]">
                    <div class="flex-1 overflow-y-auto p-4 space-y-3">
                        <?php if (!empty($pesan)): ?>
                            <?php foreach ($pesan as $p): ?>
                                <?php if ($p->pengirim == 'orang_tua'): ?>
                                    <!-- Pesan Orang Tua -->
                                    <div class="flex items-start space-x-2 justify-end">
                                        <div class="bg-indigo-500 text-white p-3 rounded-lg max-w-xs">
                                            <p class="text-sm"><?= htmlspecialchars($p->isi) ?></p>
                                            <span class="text-xs text-gray-200"><?= date('H:i', strtotime($p->created_at)) ?></span>
                                        </div>
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">
                                            OT</div>
                                    </div>
                                <?php else: ?>
                                    <!-- Pesan Guru -->
                                    <div class="flex items-start space-x-2">
                                        <div
                                            class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                                            GK</div>
                                        <div class="bg-gray-100 p-3 rounded-lg max-w-xs">
                                            <p class="text-sm"><?= htmlspecialchars($p->isi) ?></p>
                                            <span class="text-xs text-gray-500"><?= date('H:i', strtotime($p->created_at)) ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-gray-400 mt-5">Belum ada pesan.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Form kirim -->
                    <form action="<?= base_url('ortu/kirim') ?>" method="post"
                        class="border-t p-3 flex items-center space-x-2">
                        <input type="hidden" name="orang_tua_id" value="<?= $orang_tua->id ?>">
                        <input type="hidden" name="guru_id" value="<?= $guru->id ?>">
                        <input type="hidden" name="siswa_id" value="<?= $siswa->id ?>">
                        <input type="text" name="isi" placeholder="Tulis pesan..."
                            class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-indigo-300"
                            required>
                        <button type="submit"
                            class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">Kirim</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>