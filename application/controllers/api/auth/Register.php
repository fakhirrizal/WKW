<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Register extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
        if($this->post('nik')==NULL){
            $hasil['status'] = '0';
            $hasil['message'] = 'NIK tidak boleh kosong!';
            $hasil['user_id'] = 0;
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
        }elseif($this->post('email')==NULL){
            $hasil['status'] = '0';
            $hasil['message'] = 'Email tidak boleh kosong!';
            $hasil['user_id'] = 0;
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
        }else{
            $cek = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->post('nik'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC')->result();
            if($cek!=NULL){
                $hasil['status'] = '0';
                $hasil['message'] = 'NIK telah terdaftar!';
                $hasil['user_id'] = 0;
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
            else{
                $cek2 = $this->Main_model->getSelectedData('masyarakat a', '*', array("a.email" => $this->post('email')))->result();
                if($cek2==NULL){
                    $this->db->trans_start();
                    $get_user_id = $this->Main_model->getLastID('user','id');
                    $get_last_id = $this->Main_model->getLastID('masyarakat','id');
                    $user_id = $get_user_id['id']+1;

                    $data_insert1 = array(
                        'id' => $get_user_id['id']+1,
                        'username' => $this->post('nik'),
                        'pass' => $this->post('password'),
                        'fullname' => $this->post('nama'),
                        'is_active' => '1',
                        'created_by' => $get_user_id['id']+1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->Main_model->insertData('user',$data_insert1);

                    $data_insert2 = array(
                        'id' => $get_last_id['id']+1,
                        'user_id' => $get_user_id['id']+1,
                        'nama' => $this->post('nama'),
                        'alamat' => $this->post('alamat'),
                        'rt' => $this->post('rt'),
                        'rw' => $this->post('rw'),
                        'id_desa' => $this->post('id_desa'),
                        'id_kecamatan' => $this->post('id_kecamatan'),
                        'id_kabupaten' => $this->post('id_kabupaten'),
                        'id_provinsi' => $this->post('id_provinsi'),
                        'nik' => $this->post('nik'),
                        'no_hp' => $this->post('no_hp'),
                        'email' => $this->post('email')
                    );
                    $this->Main_model->insertData('masyarakat',$data_insert2);

                    $data_insert3 = array(
                        'user_id' => $get_user_id['id']+1,
                        'role_id' => '2',
                    );
                    $this->Main_model->insertData('user_to_role',$data_insert3);
                    $this->db->trans_complete();
                    if($this->db->trans_status() === false){
                        $hasil['status'] = '0';
                        $hasil['message'] = 'Registrasi gagal, harap diulangi lagi!';
                        $hasil['user_id'] = 0;
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
                    else{
                        $hasil = array(
                            'status' => '1',
                            'message' => 'Data Anda berhasil tersimpan',
                            'user_id' => $get_user_id['id']+1,
                            'nik' => $this->post('nik'),
                            'nama' => $this->post('nama'),
                            'alamat' => $this->post('alamat'),
                            'rt' => $this->post('rt'),
                            'rw' => $this->post('rw'),
                            'id_desa' => $this->post('id_desa'),
                            'id_kecamatan' => $this->post('id_kecamatan'),
                            'id_kabupaten' => $this->post('id_kabupaten'),
                            'id_provinsi' => $this->post('id_provinsi'),
                            'no_hp' => $this->post('no_hp'),
                            'email' => $this->post('email'),
                            'foto' => ''
                        );
                        $this->response($hasil, 200);
                    }
                }else{
                    $hasil['status'] = '0';
                    $hasil['message'] = 'Email telah terdaftar!';
                    $hasil['user_id'] = 0;
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
	}

	function index_put() {
	}

	function index_delete() {
    }
}