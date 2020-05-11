<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Sktm_pendidikan extends REST_Controller {

	function __construct()
	{
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
                'nama_ayah' => $this->post('nama_ayah'),
                'nama_ibu' => $this->post('nama_ibu'),
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_sktm_pendidikan']+1).'_sktm_pendidikan.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('sktm_pendidikan',$data_insert);
            // print_r($data_insert1);
            
            $mpdf = new \Mpdf\Mpdf();
            $data = $this->load->view('admin/form_pdf/sktm_sekolah', $data_insert, TRUE);
            $mpdf->WriteHTML($data);
            ob_clean();
            $pathh = 'data_upload/dokumen/'.($get_last['id_sktm_pendidikan']+1).'_sktm_pendidikan.pdf';
            $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

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
                $this->response($hasil, 200);
			}
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}