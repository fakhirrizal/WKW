<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pemberitahuan extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_pemberitahuan')!=NULL){
			$hasil = $this->Main_model->getSelectedData('pemberitahuan a', 'a.*', array('a.id_pemberitahuan'=>$this->get('id_pemberitahuan')), '', '10', $this->get('jumlah'))->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'Data kosong.';
				$balikan['list'] = '';
				$balikan['total'] = 0;
				$this->response($balikan, 200);
			}else{
				$isi['status'] = '1';
				$isi['id_pemberitahuan'] = $hasil->id_pemberitahuan;
				$isi['judul'] = $hasil->judul;
				$isi['deskripsi'] = $hasil->deskripsi;
				$this->response($isi, 200);
			}
		}else{
			$hasil_total = $this->Main_model->getSelectedData('pemberitahuan a', 'a.*', '', '')->result();
			$hasil = $this->Main_model->getSelectedData('pemberitahuan a', 'a.*', '', '', '10', $this->get('jumlah'))->result();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'Data kosong.';
				$balikan['list'] = '';
				$balikan['total'] = 0;
				$this->response($balikan, 200);
			}else{
				$data_tampil = array();
				foreach ($hasil as $key => $value) {
					$isi['id_pemberitahuan'] = $value->id_pemberitahuan;
					$isi['judul'] = $value->judul;
					$isi['deskripsi'] = $value->deskripsi;
					$data_tampil[] = $isi;
				}
				$jumlah = $this->get('jumlah')+10;
				if($jumlah>count($hasil_total)){
					$tampil_jum = count($hasil_total);
				}else{
					$tampil_jum = $jumlah;
				}
				$balikan['status'] = '1';
				$balikan['message'] = 'Ada data.';
				$balikan['list'] = $data_tampil;
				$balikan['jumlah'] = $tampil_jum;
				$balikan['total'] = count($hasil_total);
				$this->response($balikan, 200);
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