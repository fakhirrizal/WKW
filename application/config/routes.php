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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/* Auth */
$route['login'] = 'Auth/login';
$route['login_process'] = 'Auth/login_process';
$route['registrasi'] = 'Auth/registration';
$route['register_process'] = 'Auth/register_process';

/* Admin */
$route['admin_side/launcher'] = 'admin/App/launcher';
$route['admin_side/beranda'] = 'admin/App/home';
$route['admin_side/menu'] = 'admin/App/menu';
$route['admin_side/log_activity'] = 'admin/App/log_activity';
$route['admin_side/hapus_aktifitas/(:any)'] = 'admin/App/delete_activity/$1';
$route['admin_side/cleaning_log'] = 'admin/App/cleaning_log';
$route['admin_side/tentang_aplikasi'] = 'admin/App/about';
$route['admin_side/bantuan'] = 'admin/App/helper';

$route['admin_side/administrator'] = 'admin/Master/administrator_data';
$route['admin_side/tambah_data_admin'] = 'admin/Master/add_administrator_data';
$route['admin_side/simpan_data_admin'] = 'admin/Master/save_administrator_data';
$route['admin_side/detail_data_admin/(:any)'] = 'admin/Master/detail_administrator_data/$1';
$route['admin_side/ubah_data_admin/(:any)'] = 'admin/Master/edit_administrator_data/$1';
$route['admin_side/perbarui_data_admin'] = 'admin/Master/update_administrator_data';
$route['admin_side/atur_ulang_kata_sandi_admin/(:any)'] = 'admin/Master/reset_password_administrator_account/$1';
$route['admin_side/hapus_data_admin/(:any)'] = 'admin/Master/delete_administrator_data/$1';

$route['admin_side/data_anggota'] = 'admin/Master/member_data';
$route['admin_side/tambah_data_anggota'] = 'admin/Master/add_member_data';
$route['admin_side/simpan_data_anggota'] = 'admin/Master/save_member_data';
$route['admin_side/ubah_data_anggota/(:any)'] = 'admin/Master/edit_member_data/$1';
$route['admin_side/perbarui_data_anggota'] = 'admin/Master/update_member_data';
$route['admin_side/atur_ulang_kata_sandi_anggota/(:any)'] = 'admin/Master/reset_password_member_account/$1';
$route['admin_side/hapus_data_anggota/(:any)'] = 'admin/Master/delete_member_data/$1';

$route['admin_side/berita'] = 'admin/Master/berita';
$route['admin_side/tambah_berita'] = 'admin/Master/tambah_berita';
$route['admin_side/simpan_berita'] = 'admin/Master/simpan_berita';
$route['admin_side/detail_berita/(:any)'] = 'admin/Master/detail_berita/$1';
$route['admin_side/perbarui_berita'] = 'admin/Master/perbarui_berita';
$route['admin_side/hapus_berita/(:any)'] = 'admin/Master/hapus_berita/$1';

$route['admin_side/potensi_desa'] = 'admin/Master/potensi_desa';
$route['admin_side/tambah_potensi_desa'] = 'admin/Master/tambah_potensi_desa';
$route['admin_side/simpan_potensi_desa'] = 'admin/Master/simpan_potensi_desa';
$route['admin_side/detail_potensi_desa/(:any)'] = 'admin/Master/detail_potensi_desa/$1';
$route['admin_side/perbarui_potensi_desa'] = 'admin/Master/perbarui_potensi_desa';
$route['admin_side/hapus_potensi_desa/(:any)'] = 'admin/Master/hapus_potensi_desa/$1';

$route['admin_side/apbdesa'] = 'admin/Master/apbdesa_desa';
$route['admin_side/detail_apbdesa/(:any)'] = 'admin/Master/detail_apbdesa/$1';
$route['admin_side/detail_anggaran/(:any)'] = 'admin/Master/detail_anggaran/$1';
$route['admin_side/simpan_data_rincian_apbdesa'] = 'admin/Master/simpan_data_rincian_apbdesa';
$route['admin_side/perbarui_data_rincian_apbdesa'] = 'admin/Master/perbarui_data_rincian_apbdesa';
$route['admin_side/simpan_detail_anggaran'] = 'admin/Master/simpan_detail_anggaran';
$route['admin_side/perbarui_data_sub_output'] = 'admin/Master/perbarui_data_sub_output';
$route['admin_side/perbarui_data_output'] = 'admin/Master/perbarui_data_output';
$route['admin_side/hapus_item_apbdesa/(:any)'] = 'admin/Master/hapus_item_apbdesa/$1';
$route['admin_side/hapus_sub_output/(:any)'] = 'admin/Master/hapus_sub_output/$1';
$route['admin_side/hapus_output/(:any)'] = 'admin/Master/hapus_output/$1';

$route['admin_side/ppid'] = 'admin/Master/ppid';
$route['admin_side/tambah_ppid'] = 'admin/Master/tambah_ppid';
$route['admin_side/simpan_ppid'] = 'admin/Master/simpan_ppid';
$route['admin_side/ubah_ppid/(:any)'] = 'admin/Master/ubah_ppid/$1';
$route['admin_side/perbarui_ppid'] = 'admin/Master/perbarui_ppid';
$route['admin_side/hapus_ppid/(:any)'] = 'admin/Master/hapus_ppid/$1';

$route['admin_side/lembaga_desa'] = 'admin/Master/lembaga_desa';
$route['admin_side/detail_lembaga_desa/(:any)'] = 'admin/Master/detail_lembaga_desa/$1';
$route['admin_side/perbarui_data_lembaga_desa'] = 'admin/Master/perbarui_data_lembaga_desa';
$route['admin_side/simpan_data_anggota_lembaga_desa'] = 'admin/Master/simpan_data_anggota_lembaga_desa';
$route['admin_side/perbarui_data_anggota_lembaga_desa'] = 'admin/Master/perbarui_data_anggota_lembaga_desa';
$route['admin_side/hapus_data_anggota_lembaga_desa/(:any)'] = 'admin/Master/hapus_data_anggota_lembaga_desa/$1';

$route['admin_side/data_kependudukan'] = 'admin/Master/kependudukan';
$route['admin_side/simpan_data_rincian_kependudukan'] = 'admin/Master/simpan_data_rincian_kependudukan';
$route['admin_side/perbarui_rincian_data_kependudukan'] = 'admin/Master/perbarui_rincian_data_kependudukan';
$route['admin_side/detail_kependudukan/(:any)/(:any)'] = 'admin/Master/detail_kependudukan/$1/$2';
$route['admin_side/hapus_item_data_kependudukan/(:any)'] = 'admin/Master/hapus_item_data_kependudukan/$1';

$route['admin_side/permohonan_ktp'] = 'admin/Report/data_ktp';
$route['admin_side/ubah_pengajuan_ktp/(:any)'] = 'admin/Report/ubah_pengajuan_ktp/$1';
$route['admin_side/perbarui_pengajuan_ktp'] = 'admin/Report/perbarui_pengajuan_ktp';
$route['admin_side/permohonan_kk'] = 'admin/Report/data_kk';
$route['admin_side/pengantar_domisili'] = 'admin/Report/pengantar_domisili';
$route['admin_side/detail_surat_keterangan_domisili/(:any)'] = 'admin/Report/detail_surat_keterangan_domisili/$1';
$route['admin_side/ubah_pengajuan_domisili/(:any)'] = 'admin/Report/ubah_pengajuan_domisili/$1';
$route['admin_side/perbarui_pengajuan_domisili'] = 'admin/Report/perbarui_pengajuan_domisili';
$route['admin_side/surat_keterangan_usaha'] = 'admin/Report/surat_keterangan_usaha';
$route['admin_side/detail_surat_keterangan_usaha/(:any)'] = 'admin/Report/detail_surat_keterangan_usaha/$1';
$route['admin_side/ubah_pengajuan_usaha/(:any)'] = 'admin/Report/ubah_pengajuan_usaha/$1';
$route['admin_side/perbarui_pengajuan_usaha'] = 'admin/Report/perbarui_pengajuan_usaha';
$route['admin_side/sktm'] = 'admin/Report/sktm';
$route['admin_side/detail_sktm/(:any)/(:any)'] = 'admin/Report/detail_sktm/$1/$2';
$route['admin_side/ubah_pengajuan_sktm_umum/(:any)'] = 'admin/Report/ubah_pengajuan_sktm_umum/$1';
$route['admin_side/perbarui_pengajuan_sktm_umum'] = 'admin/Report/perbarui_pengajuan_sktm_umum';
$route['admin_side/ubah_pengajuan_sktm_pendidikan/(:any)'] = 'admin/Report/ubah_pengajuan_sktm_pendidikan/$1';
$route['admin_side/perbarui_pengajuan_sktm_pendidikan'] = 'admin/Report/perbarui_pengajuan_sktm_pendidikan';
$route['admin_side/sim'] = 'admin/Report/sim';
$route['admin_side/detail_pengajuan_sim/(:any)'] = 'admin/Report/detail_pengajuan_sim/$1';
$route['admin_side/ubah_pengajuan_sim/(:any)'] = 'admin/Report/ubah_pengajuan_sim/$1';
$route['admin_side/perbarui_pengajuan_sim'] = 'admin/Report/perbarui_pengajuan_sim';
$route['admin_side/skck'] = 'admin/Report/skck';
$route['admin_side/detail_pengajuan_skck/(:any)'] = 'admin/Report/detail_pengajuan_skck/$1';
$route['admin_side/ubah_pengajuan_skck/(:any)'] = 'admin/Report/ubah_pengajuan_skck/$1';
$route['admin_side/perbarui_pengajuan_skck'] = 'admin/Report/perbarui_pengajuan_skck';

/* Mobile */
$route['mobile_side/login'] = 'mobile/App/login';
$route['mobile_side/login_process'] = 'mobile/App/login_process';
$route['mobile_side/logout'] = 'mobile/App/logout';
$route['mobile_side/beranda'] = 'mobile/App/home';
$route['mobile_side/administrasi'] = 'mobile/App/administration';
$route['mobile_side/kependudukan'] = 'mobile/App/population';
$route['mobile_side/ekonomi'] = 'mobile/App/economy';
$route['mobile_side/log_activity'] = 'mobile/App/log_activity';
$route['mobile_side/cleaning_log'] = 'mobile/App/cleaning_log';
$route['mobile_side/tentang_aplikasi'] = 'mobile/App/about';
$route['mobile_side/bantuan'] = 'mobile/App/helper';

/* REST API */
$route['api'] = 'Rest_server/documentation';

$route['api/login'] = 'api/auth/Login';
$route['api/change_password'] = 'api/auth/Change_password';

$route['api/indikator'] = 'api/master/Indikator';
$route['api/user_data'] = 'api/master/User_data';
$route['api/device'] = 'api/master/Device';
$route['api/provinsi'] = 'api/master/Provinsi';
$route['api/kabupaten'] = 'api/master/Kabupaten';
$route['api/kecamatan'] = 'api/master/Kecamatan';
$route['api/desa'] = 'api/master/Desa';

$route['api/hapus_laporan'] = 'api/Other/delete_report';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8