<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Lembaga_desa extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('id_lembaga_desa')!=NULL){
            $hasil = $this->Main_model->getSelectedData('lembaga_desa a', 'a.*', array('a.id_lembaga_desa'=>$this->get('id_lembaga_desa')))->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_lembaga_desa'] = $value->id_lembaga_desa;
                $isi['nama'] = $value->nama;
                $isi['keterangan'] = $value->keterangan;
                $tampung[] = $isi;
            }
            $balikan['status'] = '1';
            $balikan['message'] = 'Ada data.';
            $balikan['list'] = $tampung;
            $balikan['jumlah'] = count($tampung);
            $balikan['total'] = count($tampung);
            $this->response($balikan, 200);
		
        }else{
            $hasil = $this->Main_model->getSelectedData('lembaga_desa a', 'a.*')->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_lembaga_desa'] = $value->id_lembaga_desa;
                $isi['nama'] = $value->nama;
                $isi['keterangan'] = $value->keterangan;
                $tampung[] = $isi;
            }
            $balikan['status'] = '1';
            $balikan['message'] = 'Ada data.';
            $balikan['list'] = $tampung;
            $balikan['jumlah'] = count($tampung);
            $balikan['total'] = count($tampung);
            $this->response($balikan, 200);
        }
	}

	function index_post() {
    }

	function index_put() {
	}

	function index_delete() {
    }
}