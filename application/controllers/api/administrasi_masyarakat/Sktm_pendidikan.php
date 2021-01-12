<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Sktm_pendidikan extends REST_Controller {

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
			$get_last = $this->Main_model->getLastID('sktm_pendidikan','id_sktm_pendidikan');
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
	
			$image_name_qr_code = "qr_code_sktm_pendidikan_".time().'.png';
			
			$isi_qr = base_url().'scan_surat/sktm_pendidikan~'.md5($get_last['id_sktm_pendidikan']+1);
	
			$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
			$params['level'] = 'H'; // H=High
			$params['size'] = 15;
			$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
			$data_insert = array(
				'id_sktm_pendidikan' => $get_last['id_sktm_pendidikan']+1,
				'nama' => $cek->nama,
				'nik' => $cek->nik,
				'tempat_lahir' => $this->post('tempat_lahir'),
				'tanggal_lahir' => $this->post('tanggal_lahir'),
				'kebangsaan' => $this->post('kebangsaan'),
				'pekerjaan' => $this->post('pekerjaan'),
				'agama' => $this->post('agama'),
				'rt' => $cek->rt,
				'rw' => $cek->rw,
				'nomor_surat' => '',
                'nama_ayah' => $this->post('nama_ayah'),
                'nama_ibu' => $this->post('nama_ibu'),
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_sktm_pendidikan']+1).'_sktm_pendidikan.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('sktm_pendidikan',$data_insert);
            // print_r($data_insert);
            require FCPATH . 'vendor/autoload.php';
			$data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
            require_once BASEPATH.'core/CodeIgniter.php';
            $mpdf = new \Mpdf\Mpdf();
            $data = $this->load->view('admin/form_pdf/sktm_sekolah', $data_insert, TRUE);
            $mpdf->WriteHTML($data);
            if (ob_get_contents()) ob_end_clean();
            $pathh = 'data_upload/dokumen/'.($get_last['id_sktm_pendidikan']+1).'_sktm_pendidikan.pdf';
            $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

            $datainsert = array(
				'form' => 'SKTM untuk Pendidikan',
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_sktm_pendidikan']+1).'_sktm_pendidikan.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('riwayat_administrasi',$datainsert);
            // print_r($datainsert);

			$this->Main_model->log_activity($this->post('user_id'),'Adding data',"Membuat surat keterangan tidak mampu untuk pendidikan");
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$hasil['status'] = '0';
                $hasil['message'] = 'Gagal, silahkan ulangi lagi.';
                $this->response($hasil, 200);
			}
			else{
				$hasil['status'] = '1';
                $hasil['message'] = 'Sukses menyimpan data.';
                $hasil['link'] = base_url().'data_upload/dokumen/'.($get_last['id_sktm_pendidikan']+1).'_sktm_pendidikan.pdf';
                $this->response($hasil, 200);
			}
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}