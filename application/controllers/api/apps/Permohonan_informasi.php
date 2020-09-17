<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Permohonan_informasi extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
        $this->db->trans_start();
        if($this->post('file_badan_hukum')==''){
            $data_insert1 = array(
                'kategori' => 'Lembaga',
                'user_id' => $this->post('user_id'),
                'nama' => $this->post('nama'),
                'alamat' => $this->post('alamat'),
                'no_hp' => $this->post('no_hp'),
                'email' => $this->post('email'),
                'rincian_informasi_yang_dibutuhkan' => $this->post('rincian_informasi_yang_dibutuhkan'),
                'tujuan' => $this->post('tujuan'),
                'cara_memperoleh' => $this->post('cara_memperoleh'),
                'cara_mendapatkan' => $this->post('cara_mendapatkan'),
                'file_ktp' => $this->post('file_ktp'),
                'created_at' => date('Y-m-d H:i:s')
            );
        }else{
            $data_insert1 = array(
                'kategori' => 'Lembaga',
                'user_id' => $this->post('user_id'),
                'nama' => $this->post('nama'),
                'alamat' => $this->post('alamat'),
                'no_hp' => $this->post('no_hp'),
                'email' => $this->post('email'),
                'rincian_informasi_yang_dibutuhkan' => $this->post('rincian_informasi_yang_dibutuhkan'),
                'tujuan' => $this->post('tujuan'),
                'cara_memperoleh' => $this->post('cara_memperoleh'),
                'cara_mendapatkan' => $this->post('cara_mendapatkan'),
                'file_ktp' => $this->post('file_ktp'),
                'file_badan_hukum' => $this->post('file_badan_hukum'),
                'created_at' => date('Y-m-d H:i:s')
            );
        }
        $this->Main_model->insertData('permohonan_informasi',$data_insert1);
        // print_r($data_insert1);
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $hasil['status'] = '0';
            $hasil['message'] = 'Gagal menyimpan';
            $this->response($hasil, 200);
        }
        else{
            $hasil['status'] = '1';
            $hasil['message'] = 'Berhasil menyimpan';
            $this->response($hasil, 200);
        }
    }

	function index_put() {
	}

	function index_delete() {
    }
}