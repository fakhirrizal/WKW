<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kependudukan extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('tahun')!=NULL AND $this->get('kategori')!=NULL){
            $hasil = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', array('a.tahun'=>$this->get('tahun'),'a.kategori'=>$this->get('kategori')))->result();
            if($hasil==NULL){
                $balikan['status'] = 0;
                $balikan['message'] = 'Data kosong.';
                $balikan['list'] = '';
				$balikan['total'] = 0;
                $this->response($balikan, 200);
            }else{
                $balikan['status'] = '1';
                $balikan['message'] = 'Ada data.';
                $balikan['list'] = $hasil;
                $balikan['total'] = count($hasil);
                $this->response($balikan, 200);
            }
		}elseif($this->get('tahun')!=NULL AND $this->get('kategori')==NULL){
            $hasil = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', array('a.tahun'=>$this->get('tahun')))->result();
            if($hasil==NULL){
                $balikan['status'] = 0;
                $balikan['message'] = 'Data kosong.';
                $balikan['list'] = array(
					'keterangan' => '-',
					'jumlah' => 0
				);
				$balikan['total'] = 0;
                $this->response($balikan, 200);
            }else{
                $balikan['status'] = '1';
                $balikan['message'] = 'Ada data.';
                $balikan['list'] = $hasil;
                $balikan['total'] = count($hasil);
                $this->response($balikan, 200);
            }
		}elseif($this->get('tahun')==NULL AND $this->get('kategori')!=NULL){
            $hasil = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', array('a.kategori'=>$this->get('kategori')))->result();
            if($hasil==NULL){
                $balikan['status'] = 0;
                $balikan['message'] = 'Data kosong.';
                $balikan['list'] = '';
				$balikan['total'] = 0;
                $this->response($balikan, 200);
            }else{
                $balikan['status'] = '1';
                $balikan['message'] = 'Ada data.';
                $balikan['list'] = $hasil;
                $balikan['total'] = count($hasil);
                $this->response($balikan, 200);
            }
		}else{
			$hasil = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*')->result();
			if($hasil==NULL){
				$balikan['status'] = 0;
                $balikan['message'] = 'Data kosong.';
                $balikan['list'] = '';
				$balikan['total'] = 0;
				$this->response($balikan, 200);
			}else{
                $balikan['status'] = '1';
                $balikan['message'] = 'Ada data.';
				$balikan['list'] = $hasil;
				$balikan['total'] = count($hasil);
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