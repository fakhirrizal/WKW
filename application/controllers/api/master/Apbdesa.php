<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Apbdesa extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('tahun')!=NULL AND $this->get('keterangan')!=NULL AND $this->get('kategori')!=NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.tahun'=>$this->get('tahun'),'a.keterangan'=>$this->get('keterangan'),'a.kategori'=>$this->get('kategori')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('tahun')!=NULL AND $this->get('keterangan')==NULL AND $this->get('kategori')!=NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.tahun'=>$this->get('tahun'),'a.kategori'=>$this->get('kategori')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('tahun')!=NULL AND $this->get('keterangan')!=NULL AND $this->get('kategori')==NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.tahun'=>$this->get('tahun'),'a.keterangan'=>$this->get('keterangan')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('tahun')!=NULL AND $this->get('keterangan')==NULL AND $this->get('kategori')==NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.tahun'=>$this->get('tahun')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
				$balikan['message'] = 'Data kosong.';
				$balikan['list'] = array(
					'id_apbdes' => '-',
					'tahun' => $this->get('tahun'),
					'keterangan' => '-',
					'kategori' => '-',
					'rincian' => '-',
					'nominal' => 0,
					'warna' => '-',
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
		}elseif($this->get('tahun')==NULL AND $this->get('keterangan')!=NULL AND $this->get('kategori')!=NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.keterangan'=>$this->get('keterangan'),'a.kategori'=>$this->get('kategori')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('tahun')==NULL AND $this->get('keterangan')!=NULL AND $this->get('kategori')==NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.keterangan'=>$this->get('keterangan')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('tahun')==NULL AND $this->get('keterangan')==NULL AND $this->get('kategori')!=NULL){
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.kategori'=>$this->get('kategori')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('id_apbdes')!=NULL){
			$hasil = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('a.id_apbdes'=>$this->get('id_apbdes')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
		}elseif($this->get('id_sub_output')!=NULL){
			$hasil = $this->Main_model->getSelectedData('output a', 'a.*', array('a.id_sub_output'=>$this->get('id_sub_output')))->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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
			$hasil = $this->Main_model->getSelectedData('apbdes a', 'a.*')->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
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