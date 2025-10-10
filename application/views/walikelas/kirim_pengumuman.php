<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?? 'Wali Kelas' ?></title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
        .lampiran-box {
    width: 96px;
    height: 96px;
    border-radius: 0.5rem;
    background-color: #f9fafb;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    padding: 4px;
}

.lampiran-nama {
    max-width: 80px;
    font-size: 0.7rem;
    color: #6b7280;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 4px;
    word-break: break-all;
}

        .history-item img {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 0.5rem;
    flex-shrink: 0;
}

		.sidebar-container {
			display: flex;
			min-height: 100vh;
		}

		.sidebar {
			position: sticky;
			top: 0;
			height: 100vh;
			overflow-y: auto;
		}

		.main-content {
			flex: 1;
			background-color: #f3f4f6;
		}

		.divider {
			border-top: 1px solid #e5e7eb;
			margin: 1.5rem 0;
		}

		.form-input {
			width: 100%;
			padding: 0.75rem;
			border: 1px solid #d1d5db;
			border-radius: 0.375rem;
			margin-top: 0.5rem;
		}

		.form-textarea {
			width: 100%;
			padding: 0.75rem;
			border: 1px solid #d1d5db;
			border-radius: 0.375rem;
			margin-top: 0.5rem;
			min-height: 120px;
			resize: vertical;
		}

		.recipient-select {
			width: 100%;
			padding: 0.75rem;
			border: 1px solid #d1d5db;
			border-radius: 0.375rem;
			margin-top: 0.5rem;
			background-color: white;
		}

		.history-item {
			background-color: white;
			padding: 1rem;
			border-radius: 0.375rem;
			margin-bottom: 1rem;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
		}

		.history-panel {
			position: fixed;
			top: 0;
			right: -400px;
			width: 400px;
			height: 100vh;
			background-color: white;
			box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
			transition: right 0.3s ease;
			z-index: 1000;
			overflow-y: auto;
			padding: 1.5rem;
		}

		.history-panel.open {
			right: 0;
		}

		.overlay {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 999;
			display: none;
		}

		.overlay.active {
			display: block;
		}

		/* Styling untuk upload file yang diperbarui */
		.file-upload-area {
			border: 2px dashed #d1d5db;
			border-radius: 0.5rem;
			padding: 1.5rem;
			text-align: center;
			transition: all 0.3s ease;
			background-color: #f9fafb;
			cursor: pointer;
			margin-top: 0.5rem;
		}

		.file-upload-area:hover,
		.file-upload-area.dragover {
			border-color: #4f46e5;
			background-color: #f0f4ff;
		}

		.file-upload-icon {
			color: #6b7280;
			margin-bottom: 0.5rem;
		}

		.file-upload-text {
			color: #6b7280;
			font-size: 0.875rem;
		}

		.file-upload-button {
			background-color: #4f46e5;
			color: white;
			padding: 0.5rem 1rem;
			border-radius: 0.375rem;
			cursor: pointer;
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			margin-top: 0.5rem;
			transition: background-color 0.3s ease;
		}

		.file-upload-button:hover {
			background-color: #4338ca;
		}

		.file-name {
			margin-top: 0.5rem;
			font-size: 0.875rem;
		}

		.file-success {
			color: #10b981;
			font-weight: 500;
		}

	</style>
</head>

<body class="bg-gray-100 font-sans">
	<div class="sidebar-container">
		<!-- Sidebar -->
		<aside class="w-64 bg-white shadow-md sidebar">
			<div class="p-6 flex items-center space-x-2">
				<div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
					WK</div>
				<span class="font-semibold text-lg">Wali Kelas</span>
			</div>
			<nav class="mt-6">
				<ul class="space-y-2">
					<li>
						<a href="<?= base_url('walikelas/kirim_pengumuman') ?>"
							class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-medium">
							<i class="fas fa-bullhorn mr-3"></i>
							<span>Kirim Pengumuman</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url('walikelas/lapor_perkembangan') ?>"
							class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
							<i class="fas fa-clipboard-list mr-3"></i>
							<span>Lapor Perkembangan</span>
						</a>
					</li>
					<li class="mt-4">
						<span class="px-6 text-gray-400 uppercase text-xs">Kelas</span>
					</li>
					<li>
						<a href="<?= base_url('walikelas/data_kelas') ?>"
							class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
							<i class="fas fa-book mr-3"></i>
							<span>Data Kelas</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url('walikelas/administrasi_kelas') ?>"
							class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
							<i class="fas fa-cog mr-3"></i>
							<span>Administrasi Kelas</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url('walikelas/laporan') ?>"
							class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
							<span class="ml-3">Laporan</span>
						</a>
					</li>
				</ul>
			</nav>
		</aside>

		<!-- Main Content -->
		<main class="flex-1 p-6 main-content">
			<!-- Header dengan tombol riwayat -->
			<div class="flex justify-between items-center mb-6">
				<h1 class="text-2xl font-bold text-gray-800">Kirim Pengumuman</h1>
				<button id="showHistoryBtn"
					class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition flex items-center gap-2">
					📋 Lihat Riwayat
				</button>
			</div>

			<!-- Form Pengumuman -->
			<div class="bg-white rounded-lg shadow p-6 mb-6">
<div class="mb-4">
    <label class="block text-gray-700 font-medium">Judul Pengumuman</label>
    <input type="text" name="judul" class="form-input" placeholder="Masukkan judul pengumuman">
</div>

				<div class="divider"></div>
<div class="mb-4">
    <label class="block text-gray-700 font-medium">Isi Pengumuman</label>
    <textarea name="isi" class="form-textarea" placeholder="Tulis isi pengumuman di sini"></textarea>
</div>

				<div class="divider"></div>

				<!-- Komponen Upload File yang Diperbarui -->
				<div class="mb-4">
					<label class="block text-gray-700 font-medium">Lampiran</label>

					<div class="file-upload-area" id="fileUploadArea">
						<input type="file" name="lampiran" id="fileUpload" class="hidden" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">

						<div class="file-upload-icon">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" viewBox="0 0 20 20"
								fill="currentColor">
								<path fill-rule="evenodd"
									d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
									clip-rule="evenodd" />
							</svg>
						</div>

						<p class="file-upload-text">Seret file ke sini atau klik untuk mengunggah</p>

						<button type="button" class="file-upload-button">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
								fill="currentColor">
								<path fill-rule="evenodd"
									d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
									clip-rule="evenodd" />
							</svg>
							Pilih File
						</button>

						<p class="file-name" id="fileName">PDF, DOC, JPG, PNG (maks. 5MB)</p>
					</div>
				</div>

				<div class="divider"></div>

				<div class="mb-4">
                    <label class="block text-gray-700 font-medium">Pilih Penerima</label>
                    <select name="status" class="recipient-select">
                        <option value="umum">Semua</option>
                        <option value="kelas">Khusus Kelas Ini</option>
                    </select>
				</div>
                <input type="hidden" name="id_kelas" value="<?= $kelas['id'] ?? '' ?>">


<div class="flex justify-end mt-6">
    <button type="button" id="sendBtn"
        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
        </svg>
        Kirim Pengumuman
    </button>
</div>
			</div>
		</main>
	</div>

	<!-- Overlay -->
	<div id="overlay" class="overlay"></div>

	<!-- Panel Riwayat -->
	<div id="historyPanel" class="history-panel">
		<div class="flex justify-between items-center mb-4">
			<h2 class="text-lg font-semibold">Riwayat Pengumuman</h2>
			<button id="closeHistoryBtn" class="text-gray-500 hover:text-gray-700 text-xl">✕</button>
		</div>

		<div class="divider"></div>


	</div>

	<script>
		// Elemen DOM
		const showHistoryBtn = document.getElementById('showHistoryBtn');
		const closeHistoryBtn = document.getElementById('closeHistoryBtn');
		const historyPanel = document.getElementById('historyPanel');
		const overlay = document.getElementById('overlay');
		const fileUpload = document.getElementById('fileUpload');
		const fileUploadArea = document.getElementById('fileUploadArea');
		const fileName = document.getElementById('fileName');
		const sendBtn = document.getElementById('sendBtn');

		// Fungsi untuk membuka panel riwayat
		function openHistoryPanel() {
			historyPanel.classList.add('open');
			overlay.classList.add('active');
			document.body.style.overflow = 'hidden'; // Mencegah scroll di background
		}

		// Fungsi untuk menutup panel riwayat
		function closeHistoryPanel() {
			historyPanel.classList.remove('open');
			overlay.classList.remove('active');
			document.body.style.overflow = 'auto'; // Mengembalikan scroll
		}

		// Event listeners
		showHistoryBtn.addEventListener('click', openHistoryPanel);
		closeHistoryBtn.addEventListener('click', closeHistoryPanel);
		overlay.addEventListener('click', closeHistoryPanel);

		// Fungsi untuk menangani upload file
		fileUpload.addEventListener('change', function (e) {
			const file = e.target.files[0];
			if (file) {
				// Validasi ukuran file (maksimal 5MB)
				if (file.size > 5 * 1024 * 1024) {
					alert('Ukuran file terlalu besar. Maksimal 5MB.');
					fileUpload.value = '';
					fileName.textContent = 'PDF, DOC, JPG, PNG (maks. 5MB)';
					return;
				}

				fileName.innerHTML = `<span class="file-success">✓ ${file.name}</span>`;
			} else {
				fileName.textContent = 'PDF, DOC, JPG, PNG (maks. 5MB)';
			}
		});

        sendBtn.addEventListener('click', function () {
            const formData = new FormData();
            formData.append('judul', document.querySelector('input[name="judul"]').value);
            formData.append('isi', document.querySelector('textarea[name="isi"]').value);
            formData.append('status', document.querySelector('select[name="status"]').value);
            formData.append('id_kelas', document.querySelector('input[name="id_kelas"]').value);

            const file = document.querySelector('input[name="lampiran"]').files[0];
            if (file) formData.append('lampiran', file);

            axios.post('<?= base_url("walikelas/simpan_pengumuman") ?>', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })
            .then(res => {
                if (res.data.success) {
                    alert(res.data.message);
                    location.reload();
                } else {
                    alert(res.data.message);
                }
            })
            .catch(err => {
                alert('Terjadi kesalahan saat menyimpan pengumuman.');
                console.error(err);
            });
        });

function loadRiwayat() {
    axios.get('<?= base_url("walikelas/get_riwayat_pengumuman") ?>')
        .then(res => {
            if (res.data.success) {
                const historyPanel = document.getElementById('historyPanel');
                historyPanel.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Riwayat Pengumuman</h2>
                        <button id="closeHistoryBtn" class="text-gray-500 hover:text-gray-700 text-xl">✕</button>
                    </div>
                    <div class="divider"></div>
                `;

                if (res.data.data.length === 0) {
                    historyPanel.innerHTML += '<p class="text-gray-500 text-center">Belum ada pengumuman yang dikirim.</p>';
                    return;
                }

                res.data.data.forEach(item => {
                    const tanggal = new Date(item.tanggal_pembuatan).toLocaleDateString('id-ID', {
                        day: '2-digit', month: 'long', year: 'numeric'
                    });

                    const isImage = item.lampiran && /\.(jpg|jpeg|png|gif)$/i.test(item.lampiran);
                    let lampiranHTML = '';

if (isImage) {
    lampiranHTML = `
        <img src="<?= base_url('uploads/pengumuman/') ?>${item.lampiran}"
             alt="Lampiran"
             class="w-24 h-24 object-cover rounded-md">
    `;
} else if (item.lampiran) {
    lampiranHTML = `
        <div class="lampiran-box">
            <i class="fas fa-file text-gray-500 text-xl"></i>
            <span class="lampiran-nama" title="${item.lampiran}">
                ${item.lampiran}
            </span>
        </div>
    `;
} else {
    lampiranHTML = `
        <div class="lampiran-box border-dashed bg-gray-50">
            <i class="fas fa-file-circle-xmark text-gray-400 text-2xl mb-1"></i>
            <span class="text-gray-400 text-xs text-center">Tidak ada<br>lampiran</span>
        </div>
    `;
}


                    historyPanel.innerHTML += `
                        <div class="history-item flex gap-4 items-start">
                            <div class="flex flex-col items-center">
                                ${lampiranHTML}
                                <span class="text-gray-500 text-xs mt-2">
                                    ${item.status === 'umum' ? 'Dikirim ke: Semua' : 'Dikirim ke: Kelas ini'}
                                </span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-medium text-base leading-tight">${item.judul}</h3>
                                    <span class="text-gray-500 text-sm ml-4 mt-0.5">${tanggal}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">${item.isi}</p>
                            </div>
                        </div>
                    `;
                });

                document.getElementById('closeHistoryBtn').addEventListener('click', closeHistoryPanel);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal memuat riwayat pengumuman');
        });
}

showHistoryBtn.addEventListener('click', () => {
    openHistoryPanel();
    loadRiwayat();
});


		// Tutup panel riwayat dengan tombol Escape
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				closeHistoryPanel();
			}
		});

		// Fungsi untuk drag and drop
		fileUploadArea.addEventListener('click', function () {
			fileUpload.click();
		});

		// Mencegah default behavior saat file di-drag ke area
		['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
			fileUploadArea.addEventListener(eventName, preventDefaults, false);
		});

		function preventDefaults(e) {
			e.preventDefault();
			e.stopPropagation();
		}

		// Highlight area saat file di-drag
		['dragenter', 'dragover'].forEach(eventName => {
			fileUploadArea.addEventListener(eventName, highlight, false);
		});

		['dragleave', 'drop'].forEach(eventName => {
			fileUploadArea.addEventListener(eventName, unhighlight, false);
		});

		function highlight() {
			fileUploadArea.classList.add('dragover');
		}

		function unhighlight() {
			fileUploadArea.classList.remove('dragover');
		}

		// Handle drop
		fileUploadArea.addEventListener('drop', handleDrop, false);

		function handleDrop(e) {
			const dt = e.dataTransfer;
			const files = dt.files;

			if (files.length) {
				fileUpload.files = files;
				const event = new Event('change', {
					bubbles: true
				});
				fileUpload.dispatchEvent(event);
			}
		}

	</script>
</body>

</html>
