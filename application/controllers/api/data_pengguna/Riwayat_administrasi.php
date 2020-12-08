<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Riwayat_administrasi extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('user_id')!=NULL){
			$hasil = $this->Main_model->getSelectedData('masyarakat a', 'a.*', array('a.user_id'=>$this->get('user_id')), '')->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'User ID tidak dikenali sistem.';
				$balikan['list'] = '';
				$this->response($balikan, 200);
			}else{
                $get_riwayat_total = $this->Main_model->getSelectedData('riwayat_administrasi a', 'a.*', array('a.created_by'=>$this->get('user_id')), 'a.created_at DESC')->result();
                $get_riwayat = $this->Main_model->getSelectedData('riwayat_administrasi a', 'a.*', array('a.created_by'=>$this->get('user_id')), 'a.created_at DESC', '10', $this->get('jumlah'), '')->result();
				if($get_riwayat_total==NULL){
                    $balikan['status'] = 1;
                    $balikan['message'] = 'Data kosong.';
                    $balikan['list'] = '';
                    $this->response($balikan, 200);
                }else{
                    $data_tampung = array();
                    foreach ($get_riwayat as $key => $value) {
                        $isi['form'] = $value->form;
                        $isi['file'] = $value->file;
                        $isi['waktu'] = $this->Main_model->convert_datetime($value->created_at);
                        $data_tampung[] = $isi;
					}
					$jumlah = $this->get('jumlah')+10;
					if($jumlah>count($get_riwayat_total)){
						$tampil_jum = count($get_riwayat_total);
					}else{
						$tampil_jum = $jumlah;
					}
                    $balikan['status'] = 1;
                    $balikan['message'] = 'Data ada.';
					$balikan['list'] = $data_tampung;
					$balikan['jumlah'] = $tampil_jum;
					$balikan['total'] = count($get_riwayat_total);
                    $this->response($balikan, 200);
                }
			}
		}else{
			$balikan['status'] = 0;
            $balikan['message'] = 'User ID tidak boleh kosong.';
            $balikan['list'] = '';
		}
	}

	function index_post() {
	}

	function index_put() {
	}

	function index_delete() {
    }
}