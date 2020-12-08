<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jdih extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('jenis')!='' OR $this->get('jenis')!=NULL){
            $hasil = $this->Main_model->getSelectedData('jdih a', 'a.*', array('a.jenis'=>$this->get('jenis')), 'a.id_jdih DESC')->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_jdih'] = $value->id_jdih;
                $isi['jenis'] = $value->jenis;
                $isi['judul'] = 'Nomor '.$value->nomor.' Tahun '.$value->tahun;
                $isi['tentang'] = $value->tentang;
                $isi['file'] = base_url().'data_upload/jdih/'.$value->file;
                $tampung[] = $isi;
            }
            $balikan['status'] = '1';
            $balikan['message'] = 'Ada data.';
            $balikan['list'] = $tampung;
            $balikan['jumlah'] = count($tampung);
            $balikan['total'] = count($tampung);
            $this->response($balikan, 200);
		
        }elseif($this->get('id_jdih')!='' OR $this->get('id_jdih')!=NULL){
            $value = $this->Main_model->getSelectedData('jdih a', 'a.*', array('a.id_jdih'=>$this->get('id_jdih')), 'a.id_jdih DESC')->row();
            $isi['id_jdih'] = $value->id_jdih;
            $isi['jenis'] = $value->jenis;
            $isi['judul'] = 'Nomor '.$value->nomor.' Tahun '.$value->tahun;
            $isi['tentang'] = $value->tentang;
            $isi['file'] = base_url().'data_upload/jdih/'.$value->file;
            $this->response($isi, 200);
        }else{
            $hasil = $this->Main_model->getSelectedData('jdih a', 'a.*', '', 'a.id_jdih DESC')->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_jdih'] = $value->id_jdih;
                $isi['jenis'] = $value->jenis;
                $isi['judul'] = 'Nomor '.$value->nomor.' Tahun '.$value->tahun;
                $isi['tentang'] = $value->tentang;
                $isi['file'] = base_url().'data_upload/jdih/'.$value->file;
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