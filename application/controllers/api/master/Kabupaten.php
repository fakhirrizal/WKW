<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kabupaten extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_provinsi')!=NULL){
			$hasil = $this->Main_model->getSelectedData('kabupaten a', 'a.*', array('a.id_provinsi'=>$this->get('id_provinsi')),'','','','',array(
				'table' => 'provinsi f',
				'on' => 'a.id_provinsi=f.id_provinsi',
				'pos' => 'left'
			))->result();
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
		}elseif($this->get('id_kabupaten')!=NULL){
			$hasil = $this->Main_model->getSelectedData('kabupaten a', 'a.*', array('a.id_kabupaten'=>$this->get('id_kabupaten')),'','','','',array(
				'table' => 'provinsi f',
				'on' => 'a.id_provinsi=f.id_provinsi',
				'pos' => 'left'
			))->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'Data kosong.';
				$balikan['list'] = '';
				$balikan['total'] = 0;
				$this->response($balikan, 200);
			}else{
				$this->response($hasil, 200);
			}
		}else{
			$hasil = $this->Main_model->getSelectedData('kabupaten a', 'a.*','','','','','',array(
				'table' => 'provinsi f',
				'on' => 'a.id_provinsi=f.id_provinsi',
				'pos' => 'left'
			))->result();
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