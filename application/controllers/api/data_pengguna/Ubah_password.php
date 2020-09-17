<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ubah_password extends REST_Controller {

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
                $cek_pass = $this->Main_model->getSelectedData('user a', 'a.*', array('a.id'=>$this->post('user_id'),'a.pass'=>$this->post('password_lama')))->row();
				if($cek_pass==NULL){
					$balikan['status'] = 0;
					$balikan['message'] = 'Password yang Anda masukkan salah.';
					$this->response($balikan, 200);
				}else{
					$this->db->trans_start();
					$this->Main_model->updateData('user',array('pass'=>$this->post('password_baru')),array('id'=>$hasil->id));
					$this->db->trans_complete();
					if($this->db->trans_status() === false){
						$balikan['status'] = 0;
						$balikan['message'] = 'Gagal ubah kata sandi, harap ulangi!';
						$this->response($balikan, 200);
					}
					else{
						$balikan['status'] = '1';
						$balikan['message'] = 'Sukses ubah kata sandi.';
						$this->response($balikan, 200);
					}
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