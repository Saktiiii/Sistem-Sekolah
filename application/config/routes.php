<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'walikelas';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// =====================================================
// ROUTES UNTUK WALI KELAS - LENGKAP
// =====================================================

// -----------------------------------------------------
// ROUTES UTAMA & TESTING
// -----------------------------------------------------
$route['walikelas'] = 'walikelas/data_kelas';
$route['walikelas/test'] = 'walikelas/test';
$route['walikelas/index'] = 'walikelas/data_kelas';

// -----------------------------------------------------
// ROUTES VIEW/HALAMAN
// -----------------------------------------------------
$route['walikelas/data_kelas'] = 'walikelas/data_kelas';
$route['walikelas/dashboard'] = 'walikelas/dashboard';

// -----------------------------------------------------
// ROUTES FORM (GET)
// -----------------------------------------------------
$route['walikelas/form_tambah_siswa'] = 'walikelas/form_tambah_siswa';
$route['walikelas/form_edit_siswa/(:num)'] = 'walikelas/form_edit_siswa/$1';
$route['walikelas/form_tambah_prestasi'] = 'walikelas/form_tambah_prestasi';
$route['walikelas/form_tambah_prestasi/(:num)'] = 'walikelas/form_tambah_prestasi/$1';
$route['walikelas/form_tambah_catatan_masalah'] = 'walikelas/form_tambah_catatan_masalah';
$route['walikelas/form_tambah_catatan_masalah/(:num)'] = 'walikelas/form_tambah_catatan_masalah/$1';
$route['walikelas/form_beri_peringatan'] = 'walikelas/form_beri_peringatan';
$route['walikelas/form_beri_peringatan/(:num)'] = 'walikelas/form_beri_peringatan/$1';

// -----------------------------------------------------
// ROUTES ACTION/PROSES (POST)
// -----------------------------------------------------
$route['walikelas/tambah_siswa'] = 'walikelas/tambah_siswa';
$route['walikelas/edit_siswa/(:num)'] = 'walikelas/edit_siswa/$1';
$route['walikelas/hapus_siswa/(:num)'] = 'walikelas/hapus_siswa/$1';
$route['walikelas/tambah_prestasi'] = 'walikelas/tambah_prestasi';
$route['walikelas/tambah_catatan_masalah'] = 'walikelas/tambah_catatan_masalah';
$route['walikelas/beri_peringatan/(:num)'] = 'walikelas/beri_peringatan/$1';

// -----------------------------------------------------
// ROUTES AJAX/API
// -----------------------------------------------------
$route['walikelas/get_detail_siswa/(:num)'] = 'walikelas/get_detail_siswa/$1';
$route['walikelas/get_siswa_by_kelas/(:num)'] = 'walikelas/get_siswa_by_kelas/$1';

// -----------------------------------------------------
// ROUTES EXPORT/LAPORAN
// -----------------------------------------------------
$route['walikelas/export_absensi/(:any)'] = 'walikelas/export_absensi/$1';
$route['walikelas/export_nilai/(:any)'] = 'walikelas/export_nilai/$1';
$route['walikelas/export_siswa/(:any)'] = 'walikelas/export_siswa/$1';
$route['walikelas/laporan_absensi'] = 'walikelas/laporan_absensi';
$route['walikelas/laporan_nilai'] = 'walikelas/laporan_nilai';
$route['walikelas/laporan_siswa'] = 'walikelas/laporan_siswa';

// -----------------------------------------------------
// ROUTES PENGATURAN
// -----------------------------------------------------
$route['walikelas/pengaturan'] = 'walikelas/pengaturan';
$route['walikelas/update_pengaturan'] = 'walikelas/update_pengaturan';
$route['walikelas/ganti_password'] = 'walikelas/ganti_password';
$route['walikelas/update_password'] = 'walikelas/update_password';

// -----------------------------------------------------
// ROUTES BACKUP & RESTORE
// -----------------------------------------------------
$route['walikelas/backup_data'] = 'walikelas/backup_data';
$route['walikelas/restore_data'] = 'walikelas/restore_data';
$route['walikelas/import_siswa'] = 'walikelas/import_siswa';
$route['walikelas/import_nilai'] = 'walikelas/import_nilai';

// -----------------------------------------------------
// ROUTES UTILITY
// -----------------------------------------------------
$route['walikelas/clear_cache'] = 'walikelas/clear_cache';
$route['walikelas/refresh_data'] = 'walikelas/refresh_data';
$route['walikelas/statistik'] = 'walikelas/statistik';

// =====================================================
// ROUTES UNTUK FITUR LAINNYA (OPTIONAL)
// =====================================================

// -----------------------------------------------------
// ROUTES UNTUK AUTH/LOGIN
// -----------------------------------------------------
$route['auth'] = 'auth/index';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';


// -----------------------------------------------------
// ROUTES UNTUK ADMIN (JIKA ADA)
// -----------------------------------------------------
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/manage_users'] = 'admin/manage_users';
$route['admin/manage_guru'] = 'admin/manage_guru';
$route['admin/manage_siswa'] = 'admin/manage_siswa';
$route['admin/manage_kelas'] = 'admin/manage_kelas';

// -----------------------------------------------------
// ROUTES UNTUK GURU (JIKA ADA)
// -----------------------------------------------------
$route['guru'] = 'guru/dashboard';
$route['guru/dashboard'] = 'guru/dashboard';
$route['guru/nilai'] = 'guru/nilai';
$route['guru/presensi'] = 'guru/presensi';
$route['guru/jadwal'] = 'guru/jadwal';

// -----------------------------------------------------
// ROUTES UNTUK SISWA (JIKA ADA)
// -----------------------------------------------------
$route['siswa'] = 'siswa/dashboard';
$route['siswa/dashboard'] = 'siswa/dashboard';
$route['siswa/profil'] = 'siswa/profil';
$route['siswa/nilai'] = 'siswa/nilai';
$route['siswa/presensi'] = 'siswa/presensi';

// -----------------------------------------------------
// ROUTES UNTUK ORANG TUA (JIKA ADA)
// -----------------------------------------------------
$route['ortu'] = 'ortu/dashboard';
$route['ortu/dashboard'] = 'ortu/dashboard';
$route['ortu/monitoring'] = 'ortu/monitoring';
$route['ortu/laporan'] = 'ortu/laporan';

// =====================================================
// ROUTES WILDCARD UNTUK FLEXIBILITAS
// =====================================================

// Untuk handle URL dengan multiple parameters
$route['walikelas/(:any)/(:any)/(:any)'] = 'walikelas/$1/$2/$3';
$route['walikelas/(:any)/(:any)'] = 'walikelas/$1/$2';
$route['walikelas/(:any)'] = 'walikelas/$1';

// Generic routes untuk modul lainnya
$route['(:any)/(:any)/(:any)'] = '$1/$2/$3';
$route['(:any)/(:any)'] = '$1/$2';
$route['(:any)'] = '$1';

// =====================================================
// CATATAN PENGGUNAAN
// =====================================================

/*
CARA AKSES ROUTES:

1. HALAMAN UTAMA:
   - http://localhost/your-app/ → walikelas/data_kelas
   - http://localhost/your-app/walikelas → walikelas/data_kelas
   - http://localhost/your-app/walikelas/data_kelas → walikelas/data_kelas

2. TESTING:
   - http://localhost/your-app/walikelas/test → walikelas/test

3. FORM TAMBAH SISWA:
   - http://localhost/your-app/walikelas/form_tambah_siswa

4. ACTION TAMBAH SISWA:
   - POST ke: http://localhost/your-app/walikelas/tambah_siswa

5. AJAX DETAIL SISWA:
   - GET: http://localhost/your-app/walikelas/get_detail_siswa/1

6. EXPORT ABSENSI:
   - http://localhost/your-app/walikelas/export_absensi/pdf
   - http://localhost/your-app/walikelas/export_absensi/excel

7. LAINNYA:
   - Sesuaikan dengan pattern di atas
*/