<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Berita extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_berita')!=NULL){
			$hasil = $this->Main_model->getSelectedData('berita a', 'a.*', array('a.id_berita'=>$this->get('id_berita')))->row();
			if($hasil==NULL){
				$balikan['status'] = '0';
				$balikan['message'] = 'Data kosong.';
				$this->response($balikan, 200);
			}else{
				$isi['id_berita'] = $hasil->id_berita;
				$isi['judul'] = $hasil->judul;
				$isi['foto'] = base_url().'data_upload/berita/'.$hasil->foto;
				$isi['isi'] = $hasil->isi;
				$isi['created_at'] = $this->Main_model->convert_datetime($hasil->created_at);
				$this->response($isi, 200);
			}
		}else{
			$hasil = $this->Main_model->getSelectedData('berita a', 'a.*')->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
				$balikan['message'] = 'Data kosong.';
				$this->response($balikan, 200);
			}else{
				$data_tampil = array();
				foreach ($hasil as $key => $value) {
					$isi['id_berita'] = $value->id_berita;
					$isi['judul'] = $value->judul;
					$isi['foto'] = base_url().'data_upload/berita/'.$value->foto;
					$isi['isi'] = $value->isi;
					$isi['created_at'] = $this->Main_model->convert_datetime($value->created_at);
					$data_tampil[] = $isi;
				}
				$this->response($data_tampil, 200);
			}
		}
	}

	function index_post() {
	}

	function index_put() {
	}

	function index_delete() {
    }
}