<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Surat_pengantar_kematian extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
        /* ID Desa 3325110014 */
		$cek = $this->Main_model->getSelectedData('masyarakat a', '*', array("a.user_id" => $this->post('user_id')))->row();
		if($cek==NULL){
			$hasil['status'] = '0';
            $hasil['message'] = 'Akun Anda tidak terdaftar di sistem Kami.';
            $this->response($hasil, 200);
		}
		else{
            $this->db->trans_start();
			$get_last = $this->Main_model->getLastID('surat_pengantar_kematian','id_surat_pengantar_kematian');
			$image_name_qr_code = '';
			$config_qr_code['cacheable']	= true; // boolean, the default is true
			$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
			$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
			$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
			$config_qr_code['quality']		= true; // boolean, the default is true
			$config_qr_code['size']			= '3024'; // interger, the default is 1024
			$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config_qr_code);
	
			$image_name_qr_code = "qr_code_surat_pengantar_kematian_".time().'.png';
			
			$isi_qr = base_url().'scan_surat/kematian~'.md5($get_last['id_surat_pengantar_kematian']+1);
	
			$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
			$params['level'] = 'H'; // H=High
			$params['size'] = 15;
			$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
			$data_insert = array(
				'id_surat_pengantar_kematian' => $get_last['id_surat_pengantar_kematian']+1,
				'tempat_lahir' => $this->post('tempat_lahir'),
				'tanggal_lahir' => $this->post('tanggal_lahir'),
				'nama' => $this->post('nama'),
				'jenis_kelamin' => $this->post('jenis_kelamin'),
				'tempat_meninggal' => $this->post('tempat_meninggal'),
				'tanggal_meninggal' => $this->post('tanggal_meninggal'),
				'rt' => $this->post('rt'),
				'rw' => $this->post('rw'),
				'sebab_kematian' => $this->post('sebab_kematian'),
				'pelapor' => $this->post('pelapor'),
				'hubungan_pelapor' => $this->post('hubungan_pelapor'),
				'rt_pelapor' => $this->post('rt_pelapor'),
				'rw_pelapor' => $this->post('rw_pelapor'),
				'desa_pelapor' => $this->post('desa_pelapor'),
				'kecamatan_pelapor' => $this->post('kecamatan_pelapor'),
				'kabupaten_pelapor' => $this->post('kabupaten_pelapor'),
				'nomor_surat' => '',
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_surat_pengantar_kematian']+1).'_surat_pengantar_kematian.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('surat_pengantar_kematian',$data_insert);
            // print_r($data_insert);
            // Composer Autoloader
            require FCPATH . 'vendor/autoload.php';
			$data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
            require_once BASEPATH.'core/CodeIgniter.php';
            $mpdf = new \Mpdf\Mpdf();
            $data = $this->load->view('admin/form_pdf/kematian', $data_insert, TRUE);
            $mpdf->WriteHTML($data);
            if (ob_get_contents()) ob_end_clean();
            $pathh = 'data_upload/dokumen/'.($get_last['id_surat_pengantar_kematian']+1).'_surat_pengantar_kematian.pdf';
            $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

            $datainsert = array(
				'form' => 'Surat Pengantar Kematian',
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_surat_pengantar_kematian']+1).'_surat_pengantar_kematian.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('riwayat_administrasi',$datainsert);
            // print_r($datainsert);

			$this->Main_model->log_activity($this->post('user_id'),'Adding data',"Membuat surat pengantar kematian");
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$hasil['status'] = '0';
                $hasil['message'] = 'Gagal, silahkan ulangi lagi.';
                $this->response($hasil, 200);
			}
			else{
				$hasil['status'] = '1';
                $hasil['message'] = 'Sukses menyimpan data.';
                $hasil['link'] = base_url().'data_upload/dokumen/'.($get_last['id_surat_pengantar_kematian']+1).'_surat_pengantar_kematian.pdf';
                $this->response($hasil, 200);
			}
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}