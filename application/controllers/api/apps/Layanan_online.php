<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Layanan_online extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('id_layanan')!=NULL){
            $hasil = $this->Main_model->getSelectedData('layanan_online a', 'a.*', array('a.id_layanan'=>$this->get('id_layanan')))->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_layanan'] = $value->id_layanan;
                $isi['keterangan'] = $value->keterangan;
                $isi['link'] = $value->link;
                $tampung[] = $isi;
            }
            $balikan['status'] = '1';
            $balikan['message'] = 'Ada data.';
            $balikan['list'] = $tampung;
            $balikan['jumlah'] = count($tampung);
            $balikan['total'] = count($tampung);
            $this->response($balikan, 200);
		
        }else{
            $hasil = $this->Main_model->getSelectedData('layanan_online a', 'a.*')->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_layanan'] = $value->id_layanan;
                $isi['keterangan'] = $value->keterangan;
                $isi['link'] = $value->link;
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