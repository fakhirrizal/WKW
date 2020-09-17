<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ppid extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('kategori')!='' OR $this->get('kategori')!=NULL){
            $hasil = $this->Main_model->getSelectedData('ppid a', 'a.*', array('a.kategori'=>$this->get('kategori')))->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_ppid'] = $value->id_ppid;
                $isi['kategori'] = $value->kategori;
                $isi['judul'] = $value->judul;
                $isi['file'] = base_url().'data_upload/ppid/'.$value->file;
                $tampung[] = $isi;
            }
            $balikan['status'] = '1';
            $balikan['message'] = 'Ada data.';
            $balikan['list'] = $tampung;
            $balikan['jumlah'] = count($tampung);
            $balikan['total'] = count($tampung);
            $this->response($balikan, 200);
		
        }elseif($this->get('id_ppid')!='' OR $this->get('id_ppid')!=NULL){
            $value = $this->Main_model->getSelectedData('ppid a', 'a.*', array('a.id_ppid'=>$this->get('id_ppid')))->row();
            $isi['id_ppid'] = $value->id_ppid;
            $isi['kategori'] = $value->kategori;
            $isi['judul'] = $value->judul;
            $isi['file'] = base_url().'data_upload/ppid/'.$value->file;
            $this->response($isi, 200);
        }else{
            $hasil = $this->Main_model->getSelectedData('ppid a', 'a.*')->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_ppid'] = $value->id_ppid;
                $isi['kategori'] = $value->kategori;
                $isi['judul'] = $value->judul;
                $isi['file'] = base_url().'data_upload/ppid/'.$value->file;
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