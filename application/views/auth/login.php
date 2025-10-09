<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 w-96">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Login Akun</h2>

        <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border border-red-300 text-red-700 px-3 py-2 rounded mb-4 text-sm">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/login') ?>" method="post">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2">Username</label>
                <input type="text" name="username" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm mb-2">Password</label>
                <input type="password" name="password" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>
