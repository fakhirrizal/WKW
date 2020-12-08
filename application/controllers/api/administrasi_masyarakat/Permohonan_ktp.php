<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Permohonan_ktp extends REST_Controller {

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
		elseif($cek->id_desa!='3325110014'){
            $hasil['status'] = '0';
            $hasil['message'] = 'Anda bukan warga Kalipucang Wetan.';
            $this->response($hasil, 200);
        }else{
			$this->db->trans_start();		
			$get_last = $this->Main_model->getLastID('permohonan_ktp','id_permohonan_ktp');

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

			$image_name_qr_code = "qr_code_ktp_".time().'.png';
			
			$isi_qr = base_url().'scan_surat/ktp~'.md5($get_last['id_permohonan_ktp']+1);

			$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
			$params['level'] = 'H'; // H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$baru = '';
			$perpanjangan = '';
			$penggantian = '';
			if($this->post('permohonan_ktp')=='Baru'){
				$baru = 'X';
			}elseif($this->post('permohonan_ktp')=='Perpanjangan'){
				$perpanjangan = 'X';
			}elseif($this->post('permohonan_ktp')=='Penggantian'){
				$penggantian = 'X';
			}else{
				echo'';
			}
			$data_insert = array(
				'id_permohonan_ktp' => $get_last['id_permohonan_ktp']+1,
				'nama' => $cek->nama,
				'permohonan_ktp' => $this->post('permohonan_ktp'),
				'kk' => $this->post('kk'),
				'kode_pos' => $this->post('kode_pos'),
				'nik' => $cek->nik,
				'rt' => $cek->rt,
                'rw' => $cek->rw,
                'alamat' => $cek->alamat,
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_permohonan_ktp']+1).'_permohonan_ktp.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('permohonan_ktp',$data_insert);
			// print_r($data_insert);
			$data_insert_pdf = array(
				'id_permohonan_ktp' => $get_last['id_permohonan_ktp']+1,
				'nama' => $cek->nama,
				'baru' => $baru,
				'nomor_surat' => '',
				'perpanjangan' => $perpanjangan,
				'penggantian' => $penggantian,
				'kk' => $this->post('kk'),
				'nik' => $cek->nik,
				'rt' => $cek->rt,
                'rw' => $cek->rw,
				'alamat' => $cek->alamat,
				'kode_pos' => $this->post('kode_pos'),
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_permohonan_ktp']+1).'_permohonan_ktp.pdf',
				'gambar_qr' => '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
            // print_r($data_insert_pdf);
            // Composer Autoloader
            require FCPATH . 'vendor/autoload.php';

            require_once BASEPATH.'core/CodeIgniter.php';
            $mpdf = new \Mpdf\Mpdf();
            $data = $this->load->view('admin/form_pdf/permohonan_ktp', $data_insert_pdf, TRUE);
            $mpdf->WriteHTML($data);
            if (ob_get_contents()) ob_end_clean();
            $pathh = 'data_upload/dokumen/'.($get_last['id_permohonan_ktp']+1).'_permohonan_ktp.pdf';
            $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

            $datainsert = array(
				'form' => 'Permohonan KTP',
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_permohonan_ktp']+1).'_permohonan_ktp.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('riwayat_administrasi',$datainsert);
            // print_r($datainsert);

			$this->Main_model->log_activity($this->post('user_id'),'Adding data',"Membuat permohonan KTP");
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$hasil['status'] = '0';
                $hasil['message'] = 'Gagal, silahkan ulangi lagi.';
                $this->response($hasil, 200);
			}
			else{
				$hasil['status'] = '1';
                $hasil['message'] = 'Sukses menyimpan data.';
                $hasil['link'] = base_url().'data_upload/dokumen/'.($get_last['id_permohonan_ktp']+1).'_permohonan_ktp.pdf';
                $this->response($hasil, 200);
			}
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}