<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Anggota_lembaga_desa extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('id_lembaga_desa')!=NULL){
            $hasil = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*,b.nama AS lembaga_desa', array('a.id_lembaga_desa'=>$this->get('id_lembaga_desa')), '', '', '', '', array(
                'table' => 'lembaga_desa b',
                'on' => 'a.id_lembaga_desa=b.id_lembaga_desa',
                'pos' => 'LEFT'
            ))->result();
            $tampung = array();
            foreach ($hasil as $key => $value) {
                $isi['id_anggota_lembaga_desa'] = $value->id_anggota_lembaga_desa;
                $isi['lembaga_desa'] = $value->lembaga_desa;
                $isi['nama'] = $value->nama;
                $isi['jabatan'] = $value->jabatan;
                if($value->foto=='' OR $value->foto==NULL){
                    $isi['foto'] = '';
                }else{
                    $isi['foto'] = base_url().'data_upload/anggota_lembaga_desa/'.$value->foto;
                }
                $tampung[] = $isi;
            }
            $balikan['status'] = '1';
            $balikan['message'] = 'Ada data.';
            $balikan['list'] = $tampung;
            $balikan['jumlah'] = count($tampung);
            $balikan['total'] = count($tampung);
            $this->response($balikan, 200);
		
        }else{
            $balikan['status'] = '0';
            $balikan['message'] = 'Tidak ada data.';
            $balikan['list'] = array();
            $balikan['jumlah'] = 0;
            $balikan['total'] = 0;
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