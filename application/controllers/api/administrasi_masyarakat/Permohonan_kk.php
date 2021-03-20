<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Permohonan_kk extends REST_Controller {

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
			$get_last = $this->Main_model->getLastID('data_kk','id_data_kk');

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

			$image_name_qr_code = "qr_code_kk_".time().'.png';
			
			$isi_qr = base_url().'scan_surat/kk~'.md5($get_last['id_data_kk']+1);

			$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
			$params['level'] = 'H'; // H=High
			$params['size'] = 15;
			$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$data_insert_pdf = array(
				'id_data_kk' => $get_last['id_data_kk']+1,
				'nama' => $this->post('nama'),
				'dusun' => $this->post('dusun'),
				'nomor_surat' => '',
				'jenis_kelamin' => $this->post('jenis_kelamin'),
				'tempat_lahir' => $this->post('tempat_lahir'),
				'kk' => $this->post('kk'),
				'nik' => $this->post('nik'),
				'rt' => $cek->rt,
                'rw' => $cek->rw,
				'alamat' => $cek->alamat,
				'provinsi' => $this->post('provinsi'),
				'tanggal_lahir' => $this->post('tanggal_lahir'),
				'akta_kelahiran' => $this->post('akta_kelahiran'),
				'golongan_darah' => $this->post('golongan_darah'),
				'agama' => $this->post('agama'),
				'status_perkawinan' => $this->post('status_perkawinan'),
				'tanggal_perkawinan' => $this->post('tanggal_perkawinan'),
				'status_hubungan_dalam_keluarga' => $this->post('status_hubungan_dalam_keluarga'),
				'nomor_paspor' => $this->post('nomor_paspor'),
				'no_kitap' => $this->post('no_kitap'),
				'ayah' => $this->post('ayah'),
				'ibu' => $this->post('ibu'),
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_data_kk']+1).'_data_kk.pdf',
				'gambar_qr' => '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
            $this->Main_model->insertData('data_kk',$data_insert_pdf);
            // print_r($data_insert_pdf);
            // Composer Autoloader
            require FCPATH . 'vendor/autoload.php';

            require_once BASEPATH.'core/CodeIgniter.php';
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->AddPage('L'); // margin footer
            $data = $this->load->view('admin/form_pdf/permohonan_kk', $data_insert_pdf, TRUE);
            $mpdf->WriteHTML($data);
            if (ob_get_contents()) ob_end_clean();
            $pathh = 'data_upload/dokumen/'.($get_last['id_data_kk']+1).'_data_kk.pdf';
            $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

            $datainsert = array(
				'form' => 'Permohonan KK',
				'file' => base_url().'data_upload/dokumen/'.($get_last['id_data_kk']+1).'_data_kk.pdf',
				'created_by' => $this->post('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('riwayat_administrasi',$datainsert);
            // print_r($datainsert);

			$this->Main_model->log_activity($this->post('user_id'),'Adding data',"Membuat permohonan KK");
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$hasil['status'] = '0';
                $hasil['message'] = 'Gagal, silahkan ulangi lagi.';
                $this->response($hasil, 200);
			}
			else{
				$hasil['status'] = '1';
                $hasil['message'] = 'Sukses menyimpan data.';
                $hasil['link'] = base_url().'data_upload/dokumen/'.($get_last['id_data_kk']+1).'_data_kk.pdf';
                $this->response($hasil, 200);
			}
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}