<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ================================================
// KONFIGURASI DASAR
// ================================================
$route['default_controller'] = 'walikelas/data_kelas';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ================================================
// LOGIN & AUTH
// ================================================
$route['auth']   = 'auth/index';
$route['login']  = 'auth/login';
$route['logout'] = 'auth/logout';

// ================================================
// ADMIN
// ================================================
$route['admin']               = 'admin/dashboard';
$route['admin/dashboard']     = 'admin/dashboard';
$route['admin/manage_users']  = 'admin/manage_users';
$route['admin/manage_guru']   = 'admin/manage_guru';
$route['admin/manage_siswa']  = 'admin/manage_siswa';
$route['admin/manage_kelas']  = 'admin/manage_kelas';

// ================================================
// WALI KELAS (DIPERBAIKI & DIPERSEDERHANA)
// ================================================
$route['walikelas']                        = 'walikelas/data_kelas';
$route['walikelas/data_kelas']             = 'walikelas/data_kelas';
$route['walikelas/form_tambah_siswa']      = 'walikelas/form_tambah_siswa';
$route['walikelas/form_edit_siswa/(:num)'] = 'walikelas/form_edit_siswa/$1';
$route['walikelas/get_absensi/(:num)'] = 'walikelas/get_absensi/$1';
$route['walikelas/update_absensi'] = 'walikelas/update_absensi';
$route['walikelas/get_rekap_absensi_by_siswa/(:num)'] = 'walikelas/get_rekap_absensi_by_siswa/$1';
$route['walikelas/kirim_pengumuman'] = 'walikelas/kirim_pengumuman';
$route['walikelas/tambah_jadwal'] = 'walikelas/tambah_jadwal';
$route['walikelas/get_jadwal_by_hari'] = 'walikelas/get_jadwal_by_hari';
$route['walikelas/hapus_jadwal/(:num)'] = 'walikelas/hapus_jadwal/$1';
$route['walikelas/update_jadwal'] = 'walikelas/update_jadwal';
$route['walikelas/simpan_pengumuman'] = 'walikelas/simpan_pengumuman';
$route['walikelas/administrasi_kelas'] = 'walikelas/administrasi_kelas';
$route['walikelas/tambah_siswa']           = 'walikelas/tambah_siswa';
$route['walikelas/edit_siswa/(:num)']      = 'walikelas/edit_siswa/$1';
$route['walikelas/hapus_siswa/(:num)']     = 'walikelas/hapus_siswa/$1';
$route['walikelas/get_detail_siswa/(:num)'] = 'walikelas/get_detail_siswa/$1';
$route['walikelas/export_siswa/(:any)']    = 'walikelas/export_siswa/$1';
$route['walikelas/laporan_siswa']          = 'walikelas/laporan_siswa';

// ================================================
// GURU (TIDAK DIUBAH)
// ================================================
$route['guru'] = 'guru';
$route['guru/login'] = 'guru/login';
$route['guru/logout'] = 'guru/logout';
$route['guru/akademik'] = 'guru/akademik';
$route['guru/dashboard'] = 'guru/dashboard';
$route['guru/jadwal_api'] = 'guru/jadwal_api';
$route['guru/siswa_by_kelas/(:num)'] = 'guru/siswa_by_kelas/$1';
$route['guru/tambah_nilai'] = 'guru/tambah_nilai';
$route['guru/upload_materi'] = 'guru/upload_materi';
$route['guru/pengumuman'] = 'guru/pengumuman';
$route['guru/pengumuman_list'] = 'guru/pengumuman_list';
$route['guru/pengumuman_add'] = 'guru/pengumuman_add';
$route['guru/pengumuman_delete/(:num)'] = 'guru/pengumuman_delete/$1';
$route['guru/laporan'] = 'guru/laporan';
$route['guru/(:any)'] = 'guru/$1';

// ================================================
// SISWA (TIDAK DIUBAH)
// ================================================
$route['siswa']           = 'siswa/dashboard';
$route['siswa/dashboard'] = 'siswa/dashboard';
$route['siswa/profil']    = 'siswa/profil';
$route['siswa/nilai']     = 'siswa/nilai';
$route['siswa/presensi']  = 'siswa/presensi';

// ================================================
// ORANG TUA (TIDAK DIUBAH)
// ================================================
$route['ortu']            = 'ortu/dashboard';
$route['ortu/dashboard']  = 'ortu/dashboard';
$route['ortu/monitoring'] = 'ortu/monitoring';
$route['ortu/laporan']    = 'ortu/laporan';

// ================================================
// FLEKSIBILITAS (JANGAN DIHAPUS)
// ================================================
$route['(:any)/(:any)/(:any)'] = '$1/$2/$3';
$route['(:any)/(:any)']        = '$1/$2';
$route['(:any)']               = '$1';
