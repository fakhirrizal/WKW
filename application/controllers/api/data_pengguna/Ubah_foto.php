<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ubah_foto extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
		if($this->post('user_id')!=NULL){
			$hasil = $this->Main_model->getSelectedData('user a', 'a.*', array('a.id'=>$this->post('user_id')))->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'User_ID tidak ditemukan.';
				$this->response($balikan, 200);
			}else{
				$this->db->trans_start();
				$folderPath = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/photo_profile/';
				$img = $this->post('foto');
				// $image_parts = explode(";base64,", $img);
				// $image_type_aux = explode("image/", $image_parts[0]);
				// $image_type = $image_type_aux[1];
				$image_base64 = base64_decode($img);
				$nama_file = uniqid() . '.png';
				$file = $folderPath . $nama_file;
				file_put_contents($file, $image_base64);
				$file_location = base_url().'data_upload/photo_profile/'.$nama_file;
                $this->Main_model->updateData('user',array('photo'=>$file_location),array('id'=>$hasil->id));
                $this->db->trans_complete();
                if($this->db->trans_status() === false){
                    $balikan['status'] = 0;
                    $balikan['message'] = 'Gagal ubah foto, harap ulangi!';
                    $this->response($balikan, 200);
                }
                else{
					$getfoto = $this->Main_model->getSelectedData('user a', 'a.*', array('a.id'=>$this->post('user_id')))->row();
                    $balikan['status'] = '1';
                    $balikan['message'] = $getfoto->photo;
                    $this->response($balikan, 200);
                }
			}
		}else{
			$balikan['status'] = 0;
			$balikan['message'] = 'Harap masukkan User ID.';
			$this->response($balikan, 200);
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}