<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Provinsi extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_provinsi')!=NULL){
			$hasil = $this->Main_model->getSelectedData('provinsi a', 'a.*', array('a.id_provinsi'=>$this->get('id_provinsi')))->row();
			if($hasil==NULL){
				$balikan['status'] = '0';
				$balikan['message'] = 'Data kosong.';
				$this->response($balikan, 200);
			}else{
				$this->response($hasil, 200);
			}
		}else{
			$hasil = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
			if($hasil==NULL){
				$balikan['status'] = '0';
				$balikan['message'] = 'Data kosong.';
				$this->response($balikan, 200);
			}else{
				$balikan['status'] = '1';
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