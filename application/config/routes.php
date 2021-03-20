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

/* Desktop */
$route['desktop'] = 'desktop/App';
$route['beranda'] = 'desktop/App/home';
$route['log_aktifitas'] = 'desktop/App/log_activity';
$route['tentang_aplikasi'] = 'desktop/App/about';
$route['bantuan'] = 'desktop/App/helper';

$route['berita'] = 'desktop/Master/berita';
$route['detail_berita/(:any)'] = 'desktop/Master/detail_berita/$1';
$route['perbarui_berita'] = 'desktop/Master/perbarui_berita';
$route['hapus_berita/(:any)'] = 'desktop/Master/hapus_berita/$1';

$route['potensi_desa'] = 'desktop/Master/potensi_desa';
$route['tambah_potensi_desa'] = 'desktop/Master/tambah_potensi_desa';
$route['simpan_potensi_desa'] = 'desktop/Master/simpan_potensi_desa';
$route['detail_potensi_desa/(:any)'] = 'desktop/Master/detail_potensi_desa/$1';
$route['perbarui_potensi_desa'] = 'desktop/Master/perbarui_potensi_desa';
$route['hapus_potensi_desa/(:any)'] = 'desktop/Master/hapus_potensi_desa/$1';

$route['apbdesa'] = 'desktop/Master/apbdesa_desa';
$route['detail_apbdesa/(:any)'] = 'desktop/Master/detail_apbdesa/$1';
$route['detail_anggaran/(:any)'] = 'desktop/Master/detail_anggaran/$1';
$route['simpan_data_rincian_apbdesa'] = 'desktop/Master/simpan_data_rincian_apbdesa';
$route['perbarui_data_rincian_apbdesa'] = 'desktop/Master/perbarui_data_rincian_apbdesa';
$route['simpan_detail_anggaran'] = 'desktop/Master/simpan_detail_anggaran';
$route['perbarui_data_sub_output'] = 'desktop/Master/perbarui_data_sub_output';
$route['perbarui_data_output'] = 'desktop/Master/perbarui_data_output';
$route['hapus_item_apbdesa/(:any)'] = 'desktop/Master/hapus_item_apbdesa/$1';
$route['hapus_sub_output/(:any)'] = 'desktop/Master/hapus_sub_output/$1';
$route['hapus_output/(:any)'] = 'desktop/Master/hapus_output/$1';

$route['pengantar_kematian'] = 'desktop/Report/pengantar_kematian';
$route['tambah_pengantar_kematian'] = 'desktop/Report/tambah_pengantar_kematian';
$route['simpan_kematian'] = 'desktop/Report/simpan_kematian';
$route['detail_pengajuan_kematian/(:any)'] = 'desktop/Report/detail_pengajuan_kematian/$1';

$route['ppid'] = 'desktop/Master/ppid';
$route['tambah_ppid'] = 'desktop/Master/tambah_ppid';
$route['simpan_ppid'] = 'desktop/Master/simpan_ppid';
$route['ubah_ppid/(:any)'] = 'desktop/Master/ubah_ppid/$1';
$route['perbarui_ppid'] = 'desktop/Master/perbarui_ppid';
$route['hapus_ppid/(:any)'] = 'desktop/Master/hapus_ppid/$1';

$route['umkm'] = 'desktop/Master/umkm';
$route['tambah_umkm'] = 'desktop/Master/tambah_umkm';
$route['simpan_umkm'] = 'desktop/Master/simpan_umkm';
$route['detail_umkm/(:any)'] = 'desktop/Master/detail_umkm/$1';
$route['perbarui_umkm'] = 'desktop/Master/perbarui_umkm';
$route['hapus_gambar_produk_umkm/(:any)'] = 'desktop/Master/hapus_gambar_produk_umkm/$1';
$route['hapus_umkm/(:any)'] = 'desktop/Master/hapus_umkm/$1';

$route['lembaga_desa'] = 'desktop/Master/lembaga_desa';
$route['detail_lembaga_desa/(:any)'] = 'desktop/Master/detail_lembaga_desa/$1';
$route['perbarui_data_lembaga_desa'] = 'desktop/Master/perbarui_data_lembaga_desa';
$route['simpan_data_anggota_lembaga_desa'] = 'desktop/Master/simpan_data_anggota_lembaga_desa';
$route['perbarui_data_anggota_lembaga_desa'] = 'desktop/Master/perbarui_data_anggota_lembaga_desa';
$route['hapus_data_anggota_lembaga_desa/(:any)'] = 'desktop/Master/hapus_data_anggota_lembaga_desa/$1';

$route['data_kependudukan'] = 'desktop/Master/kependudukan';
$route['simpan_data_rincian_kependudukan'] = 'desktop/Master/simpan_data_rincian_kependudukan';
$route['perbarui_rincian_data_kependudukan'] = 'desktop/Master/perbarui_rincian_data_kependudukan';
$route['detail_kependudukan/(:any)/(:any)'] = 'desktop/Master/detail_kependudukan/$1/$2';
$route['hapus_item_data_kependudukan/(:any)'] = 'desktop/Master/hapus_item_data_kependudukan/$1';

$route['scan_surat/(:any)'] = 'desktop/Report/scan_surat/$1';

$route['permohonan_ktp'] = 'desktop/Report/data_ktp';
$route['tambah_permohonan_ktp'] = 'desktop/Report/tambah_permohonan_ktp';
$route['simpan_permohonan_ktp'] = 'desktop/Report/simpan_permohonan_ktp';
$route['ubah_pengajuan_ktp/(:any)'] = 'desktop/Report/ubah_pengajuan_ktp/$1';
$route['perbarui_pengajuan_ktp'] = 'desktop/Report/perbarui_pengajuan_ktp';

$route['permohonan_kk'] = 'desktop/Report/data_kk';
$route['tambah_data_kk'] = 'desktop/Report/tambah_data_kk';
$route['simpan_permohonan_kk'] = 'desktop/Report/simpan_permohonan_kk';
$route['detil_data_pengajuan_kk/(:any)'] = 'desktop/Report/detil_data_pengajuan_kk/$1';
$route['ubah_pengajuan_kk/(:any)'] = 'desktop/Report/ubah_pengajuan_kk/$1';
$route['perbarui_pengajuan_kk'] = 'desktop/Report/perbarui_pengajuan_kk';

$route['pengantar_domisili'] = 'desktop/Report/pengantar_domisili';
$route['tambah_data_keterangan_domisili'] = 'desktop/Report/tambah_data_keterangan_domisili';
$route['simpan_permohonan_domisili'] = 'desktop/Report/simpan_permohonan_domisili';
$route['detail_surat_keterangan_domisili/(:any)'] = 'desktop/Report/detail_surat_keterangan_domisili/$1';
$route['ubah_pengajuan_domisili/(:any)'] = 'desktop/Report/ubah_pengajuan_domisili/$1';
$route['perbarui_pengajuan_domisili'] = 'desktop/Report/perbarui_pengajuan_domisili';

$route['surat_keterangan_usaha'] = 'desktop/Report/surat_keterangan_usaha';
$route['tambah_data_usaha'] = 'desktop/Report/tambah_data_usaha';
$route['simpan_permohonan_usaha'] = 'desktop/Report/simpan_permohonan_usaha';
$route['detail_surat_keterangan_usaha/(:any)'] = 'desktop/Report/detail_surat_keterangan_usaha/$1';
$route['ubah_pengajuan_usaha/(:any)'] = 'desktop/Report/ubah_pengajuan_usaha/$1';
$route['perbarui_pengajuan_usaha'] = 'desktop/Report/perbarui_pengajuan_usaha';

$route['sktm'] = 'desktop/Report/sktm';
$route['detail_sktm/(:any)/(:any)'] = 'desktop/Report/detail_sktm/$1/$2';
$route['ubah_pengajuan_sktm_umum/(:any)'] = 'desktop/Report/ubah_pengajuan_sktm_umum/$1';
$route['perbarui_pengajuan_sktm_umum'] = 'desktop/Report/perbarui_pengajuan_sktm_umum';
$route['ubah_pengajuan_sktm_pendidikan/(:any)'] = 'desktop/Report/ubah_pengajuan_sktm_pendidikan/$1';
$route['perbarui_pengajuan_sktm_pendidikan'] = 'desktop/Report/perbarui_pengajuan_sktm_pendidikan';

$route['sim'] = 'desktop/Report/sim';
$route['tambah_data_sim'] = 'desktop/Report/tambah_data_sim';
$route['simpan_permohonan_sim'] = 'desktop/Report/simpan_permohonan_sim';
$route['detail_pengajuan_sim/(:any)'] = 'desktop/Report/detail_pengajuan_sim/$1';
$route['ubah_pengajuan_sim/(:any)'] = 'desktop/Report/ubah_pengajuan_sim/$1';
$route['perbarui_pengajuan_sim'] = 'desktop/Report/perbarui_pengajuan_sim';

$route['skck'] = 'desktop/Report/skck';
$route['tambah_data_skck'] = 'desktop/Report/tambah_data_skck';
$route['simpan_permohonan_skck'] = 'desktop/Report/simpan_permohonan_skck';
$route['detail_pengajuan_skck/(:any)'] = 'desktop/Report/detail_pengajuan_skck/$1';
$route['ubah_pengajuan_skck/(:any)'] = 'desktop/Report/ubah_pengajuan_skck/$1';
$route['perbarui_pengajuan_skck'] = 'desktop/Report/perbarui_pengajuan_skck';

/* Auth */
$route['login'] = 'Auth/login';
$route['login_process'] = 'Auth/login_process';
$route['registrasi'] = 'Auth/registration';
$route['register_process'] = 'Auth/register_process';

/* Admin */
$route['admin_side/beranda'] = 'admin/App/home';
$route['admin_side/log_aktifitas'] = 'admin/App/log_activity';
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

$route['admin_side/jdih'] = 'admin/Master/jdih';
$route['admin_side/tambah_jdih'] = 'admin/Master/tambah_jdih';
$route['admin_side/simpan_jdih'] = 'admin/Master/simpan_jdih';
$route['admin_side/ubah_jdih/(:any)'] = 'admin/Master/ubah_jdih/$1';
$route['admin_side/perbarui_jdih'] = 'admin/Master/perbarui_jdih';
$route['admin_side/hapus_jdih/(:any)'] = 'admin/Master/hapus_jdih/$1';

$route['admin_side/umkm'] = 'admin/Master/umkm';
$route['admin_side/tambah_umkm'] = 'admin/Master/tambah_umkm';
$route['admin_side/simpan_umkm'] = 'admin/Master/simpan_umkm';
$route['admin_side/detail_umkm/(:any)'] = 'admin/Master/detail_umkm/$1';
$route['admin_side/perbarui_umkm'] = 'admin/Master/perbarui_umkm';
$route['admin_side/hapus_gambar_produk_umkm/(:any)'] = 'admin/Master/hapus_gambar_produk_umkm/$1';
$route['admin_side/hapus_umkm/(:any)'] = 'admin/Master/hapus_umkm/$1';

$route['admin_side/slider'] = 'admin/Master/slider';
$route['admin_side/tambah_slider'] = 'admin/Master/tambah_slider';
$route['admin_side/simpan_slider'] = 'admin/Master/simpan_slider';
$route['admin_side/detail_slider/(:any)'] = 'admin/Master/detail_slider/$1';
$route['admin_side/perbarui_slider'] = 'admin/Master/perbarui_slider';
$route['admin_side/hapus_slider/(:any)'] = 'admin/Master/hapus_slider/$1';

$route['admin_side/pemberitahuan'] = 'admin/Report/pemberitahuan';
$route['admin_side/tambah_pemberitahuan'] = 'admin/Report/tambah_pemberitahuan';
$route['admin_side/simpan_pemberitahuan'] = 'admin/Report/simpan_pemberitahuan';
$route['admin_side/detail_pemberitahuan/(:any)'] = 'admin/Report/detail_pemberitahuan/$1';
$route['admin_side/perbarui_pemberitahuan'] = 'admin/Report/perbarui_pemberitahuan';
$route['admin_side/hapus_pemberitahuan/(:any)'] = 'admin/Report/hapus_pemberitahuan/$1';

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

$route['admin_side/ttd'] = 'admin/Master/ttd';
$route['admin_side/perbarui_ttd'] = 'admin/Master/perbarui_ttd';

$route['admin_side/permohonan_ktp'] = 'admin/Report/data_ktp';
$route['admin_side/ubah_pengajuan_ktp/(:any)'] = 'admin/Report/ubah_pengajuan_ktp/$1';
$route['admin_side/perbarui_pengajuan_ktp'] = 'admin/Report/perbarui_pengajuan_ktp';
$route['admin_side/hapus_data_pengajuan_ktp/(:any)'] = 'admin/Report/hapus_data_pengajuan_ktp/$1';
$route['admin_side/permohonan_kk'] = 'admin/Report/data_kk';
$route['admin_side/detil_data_pengajuan_kk/(:any)'] = 'admin/Report/detil_data_pengajuan_kk/$1';
$route['admin_side/ubah_pengajuan_kk/(:any)'] = 'admin/Report/ubah_pengajuan_kk/$1';
$route['admin_side/perbarui_pengajuan_kk'] = 'admin/Report/perbarui_pengajuan_kk';
$route['admin_side/hapus_data_pengajuan_kk/(:any)'] = 'admin/Report/hapus_data_pengajuan_kk/$1';
$route['admin_side/pengantar_domisili'] = 'admin/Report/pengantar_domisili';
$route['admin_side/detail_surat_keterangan_domisili/(:any)'] = 'admin/Report/detail_surat_keterangan_domisili/$1';
$route['admin_side/ubah_pengajuan_domisili/(:any)'] = 'admin/Report/ubah_pengajuan_domisili/$1';
$route['admin_side/perbarui_pengajuan_domisili'] = 'admin/Report/perbarui_pengajuan_domisili';
$route['admin_side/hapus_data_pengajuan_domisili/(:any)'] = 'admin/Report/hapus_data_pengajuan_domisili/$1';
$route['admin_side/surat_keterangan_usaha'] = 'admin/Report/surat_keterangan_usaha';
$route['admin_side/detail_surat_keterangan_usaha/(:any)'] = 'admin/Report/detail_surat_keterangan_usaha/$1';
$route['admin_side/ubah_pengajuan_usaha/(:any)'] = 'admin/Report/ubah_pengajuan_usaha/$1';
$route['admin_side/perbarui_pengajuan_usaha'] = 'admin/Report/perbarui_pengajuan_usaha';
$route['admin_side/hapus_data_pengajuan_usaha/(:any)'] = 'admin/Report/hapus_data_pengajuan_usaha/$1';
$route['admin_side/kematian'] = 'admin/Report/kematian';
$route['admin_side/detail_pengajuan_kematian/(:any)'] = 'admin/Report/detail_pengajuan_kematian/$1';
$route['admin_side/ubah_pengajuan_kematian/(:any)'] = 'admin/Report/ubah_pengajuan_kematian/$1';
$route['admin_side/perbarui_pengajuan_kematian'] = 'admin/Report/perbarui_pengajuan_kematian';
$route['admin_side/hapus_data_pengajuan_surat_keterangan_kematian/(:any)'] = 'admin/Report/hapus_data_pengajuan_surat_keterangan_kematian/$1';
$route['admin_side/sktm'] = 'admin/Report/sktm';
$route['admin_side/detail_sktm/(:any)/(:any)'] = 'admin/Report/detail_sktm/$1/$2';
$route['admin_side/ubah_pengajuan_sktm_umum/(:any)'] = 'admin/Report/ubah_pengajuan_sktm_umum/$1';
$route['admin_side/perbarui_pengajuan_sktm_umum'] = 'admin/Report/perbarui_pengajuan_sktm_umum';
$route['admin_side/ubah_pengajuan_sktm_pendidikan/(:any)'] = 'admin/Report/ubah_pengajuan_sktm_pendidikan/$1';
$route['admin_side/perbarui_pengajuan_sktm_pendidikan'] = 'admin/Report/perbarui_pengajuan_sktm_pendidikan';
$route['admin_side/hapus_data_pengajuan_sktm_umum/(:any)'] = 'admin/Report/hapus_data_pengajuan_sktm_umum/$1';
$route['admin_side/hapus_data_pengajuan_sktm_pendidikan/(:any)'] = 'admin/Report/hapus_data_pengajuan_sktm_pendidikan/$1';
$route['admin_side/sim'] = 'admin/Report/sim';
$route['admin_side/detail_pengajuan_sim/(:any)'] = 'admin/Report/detail_pengajuan_sim/$1';
$route['admin_side/ubah_pengajuan_sim/(:any)'] = 'admin/Report/ubah_pengajuan_sim/$1';
$route['admin_side/perbarui_pengajuan_sim'] = 'admin/Report/perbarui_pengajuan_sim';
$route['admin_side/hapus_data_pengajuan_sim/(:any)'] = 'admin/Report/hapus_data_pengajuan_sim/$1';
$route['admin_side/skck'] = 'admin/Report/skck';
$route['admin_side/detail_pengajuan_skck/(:any)'] = 'admin/Report/detail_pengajuan_skck/$1';
$route['admin_side/ubah_pengajuan_skck/(:any)'] = 'admin/Report/ubah_pengajuan_skck/$1';
$route['admin_side/perbarui_pengajuan_skck'] = 'admin/Report/perbarui_pengajuan_skck';
$route['admin_side/hapus_data_pengajuan_skck/(:any)'] = 'admin/Report/hapus_data_pengajuan_skck/$1';
$route['admin_side/permohonan_informasi'] = 'admin/Report/permohonan_informasi';
$route['admin_side/detail_permohonan_informasi/(:any)'] = 'admin/Report/detail_permohonan_informasi/$1';
$route['admin_side/hapus_permohonan_informasi/(:any)'] = 'admin/Report/hapus_permohonan_informasi/$1';
$route['admin_side/surat_keterangan_pindah'] = 'admin/Report/surat_keterangan_pindah';
$route['admin_side/detail_surat_keterangan_pindah/(:any)'] = 'admin/Report/detail_surat_keterangan_pindah/$1';
$route['admin_side/ubah_surat_keterangan_pindah/(:any)'] = 'admin/Report/ubah_surat_keterangan_pindah/$1';
$route['admin_side/perbarui_surat_keterangan_pindah'] = 'admin/Report/perbarui_surat_keterangan_pindah';
$route['admin_side/hapus_surat_keterangan_pindah/(:any)'] = 'admin/Report/hapus_surat_keterangan_pindah/$1';
$route['admin_side/surat_pengantar'] = 'admin/Report/surat_pengantar';
$route['admin_side/detail_surat_pengantar/(:any)'] = 'admin/Report/detail_surat_pengantar/$1';
$route['admin_side/ubah_surat_pengantar/(:any)'] = 'admin/Report/ubah_surat_pengantar/$1';
$route['admin_side/perbarui_surat_pengantar'] = 'admin/Report/perbarui_surat_pengantar';
$route['admin_side/hapus_surat_pengantar/(:any)'] = 'admin/Report/hapus_surat_pengantar/$1';
$route['admin_side/surat_nikah'] = 'admin/Report/surat_nikah';
$route['admin_side/detail_surat_nikah/(:any)'] = 'admin/Report/detail_surat_nikah/$1';
$route['admin_side/ubah_surat_nikah/(:any)'] = 'admin/Report/ubah_surat_nikah/$1';
$route['admin_side/perbarui_surat_nikah'] = 'admin/Report/perbarui_surat_nikah';

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