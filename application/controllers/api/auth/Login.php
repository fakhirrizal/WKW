<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {

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
		$cek = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->post('username'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC')->result();
		if($cek!=NULL){
			$cek2 = $this->Main_model->getSelectedData('user a', 'a.fullname,a.photo,b.*,a.total_login,a.login_attempts', array("a.username" => $this->post('username'),'pass' => $this->post('password'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC', '', '', '', array(
				'table' => 'masyarakat b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			))->result();
			if($cek2!=NULL){
				if($this->post('device_id')==''){
					foreach ($cek as $key => $value) {
						$login_attempts = ($value->login_attempts)+1;
						$data_log = array(
							'login_attempts' => $login_attempts,
							'last_login_attempt' => date('Y-m-d H-i-s')
						);
						$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
						$hasil['status'] = '0';
						$hasil['message'] = 'Harap memasukkan Device ID';
						$hasil['user_id'] = '';
						$hasil['nik'] = '';
						$hasil['nama'] = '';
						$hasil['alamat'] = '';
						$hasil['rt'] = '';
						$hasil['rw'] = '';
						$hasil['id_desa'] = '';
						$hasil['id_kecamatan'] = '';
						$hasil['id_kabupaten'] = '';
						$hasil['id_provinsi'] = '';
						$hasil['no_hp'] = '';
						$hasil['email'] = '';
						$hasil['foto'] = '';
						$this->response($hasil, 200);
					}
				}else{
					foreach ($cek2 as $key => $value) {
						$total_login = ($value->total_login)+1;
						$login_attempts = ($value->login_attempts)+1;
						$data_log = array(
							'total_login' => $total_login,
							'last_login' => date('Y-m-d H-i-s'),
							'last_activity' => date('Y-m-d H-i-s'),
							'login_attempts' => $login_attempts,
							'last_login_attempt' => date('Y-m-d H-i-s'),
							'ip_address' => $this->input->ip_address(),
							'verification_token' => $this->post('device_id')
						);
						$this->Main_model->updateData('user',$data_log,array('id'=>$value->user_id));
						$this->Main_model->log_activity($value->user_id,'Login to system','Login via mobile apps');
						$hasil['status'] = '1';
						$hasil['message'] = 'Anda telah berhasil login';
						$hasil['user_id'] = (integer) $value->user_id;
						$hasil['nik'] = $value->nik;
						$hasil['nama'] = $value->fullname;
						$hasil['alamat'] = $value->alamat;
						$hasil['rt'] = $value->rt;
						$hasil['rw'] = $value->rw;
						$hasil['id_desa'] = $value->id_desa;
						$hasil['id_kecamatan'] = $value->id_kecamatan;
						$hasil['id_kabupaten'] = $value->id_kabupaten;
						$hasil['id_provinsi'] = $value->id_provinsi;
						$hasil['email'] = $value->email;
						$hasil['no_hp'] = $value->no_hp;
						$hasil['foto'] = $value->photo;
						$this->response($hasil, 200);
					}
				}
			}else{
				foreach ($cek as $key => $value) {
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s')
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$hasil['status'] = '0';
					$hasil['message'] = 'Password yg Anda masukkan tidak valid';
					$hasil['user_id'] = '';
					$hasil['nik'] = '';
					$hasil['nama'] = '';
					$hasil['alamat'] = '';
					$hasil['rt'] = '';
					$hasil['rw'] = '';
					$hasil['id_desa'] = '';
					$hasil['id_kecamatan'] = '';
					$hasil['id_kabupaten'] = '';
					$hasil['id_provinsi'] = '';
					$hasil['no_hp'] = '';
					$hasil['email'] = '';
					$hasil['foto'] = '';
					$this->response($hasil, 200);
				}
			}
		}
		else{
			$hasil['status'] = '0';
			$hasil['message'] = 'Username yang Anda masukkan tidak terdaftar';
			$hasil['user_id'] = '';
            $hasil['nik'] = '';
            $hasil['nama'] = '';
            $hasil['alamat'] = '';
            $hasil['rt'] = '';
            $hasil['rw'] = '';
            $hasil['id_desa'] = '';
            $hasil['id_kecamatan'] = '';
            $hasil['id_kabupaten'] = '';
            $hasil['id_provinsi'] = '';
            $hasil['no_hp'] = '';
            $hasil['email'] = '';
            $hasil['foto'] = '';
			$this->response($hasil, 200);
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}