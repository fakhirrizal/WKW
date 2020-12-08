<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Umkm extends REST_Controller {

	function __construct(){
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_umkm')!=NULL){
			$hasil = $this->Main_model->getSelectedData('umkm a', 'a.*', array('a.id_umkm'=>$this->get('id_umkm')), '', '10', $this->get('jumlah'))->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'Data kosong.';
				$balikan['list'] = '';
				$balikan['total'] = 0;
				$this->response($balikan, 200);
			}else{
				$get_foto = $this->Main_model->getSelectedData('foto_produk_umkm a', 'a.*', array('a.id_umkm'=>$this->get('id_umkm')), '', '')->result();
				$isi['status'] = '1';
				$isi['id_umkm'] = $hasil->id_umkm;
				$isi['nama_usaha'] = $hasil->nama;
				$isi['jenis_usaha'] = $hasil->jenis;
				$isi['no_hp'] = $hasil->no_hp;
				$isi['alamat'] = $hasil->alamat;
				$isi['pemilik'] = $hasil->nama_pemilik;
				$isi['foto_pemilik'] = base_url().'data_upload/umkm/'.$hasil->pemilik;
				$foto = array();
				foreach ($get_foto as $key => $value) {
					$isi_foto['link'] = base_url().'data_upload/umkm/'.$value->file;
					$foto[] = $isi_foto;
				}
				$isi['foto_produk'] = $foto;
				$this->response($isi, 200);
			}
		}else{
			$hasil_total = $this->Main_model->getSelectedData('umkm a', 'a.*', '', '')->result();
			$hasil = $this->Main_model->getSelectedData('umkm a', 'a.*', '', '', '10', $this->get('jumlah'))->result();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'Data kosong.';
				$balikan['list'] = '';
				$balikan['total'] = 0;
				$this->response($balikan, 200);
			}else{
				$data_tampil = array();
				foreach ($hasil as $key => $value) {
					$get_foto = $this->Main_model->getSelectedData('foto_produk_umkm a', 'a.*', array('a.id_umkm'=>$value->id_umkm), '', '')->result();
					$isi['id_umkm'] = $value->id_umkm;
					$isi['nama_usaha'] = $value->nama;
					$isi['jenis_usaha'] = $value->jenis;
					$isi['no_hp'] = $value->no_hp;
					$isi['alamat'] = $value->alamat;
					$isi['pemilik'] = $value->nama_pemilik;
					$isi['foto_pemilik'] = base_url().'data_upload/umkm/'.$value->pemilik;
					$foto = array();
					foreach ($get_foto as $key => $value) {
						$isi_foto['link'] = base_url().'data_upload/umkm/'.$value->file;
						$foto[] = $isi_foto;
					}
					$isi['foto_produk'] = $foto;
					$data_tampil[] = $isi;
				}
				$jumlah = $this->get('jumlah')+10;
				if($jumlah>count($hasil_total)){
					$tampil_jum = count($hasil_total);
				}else{
					$tampil_jum = $jumlah;
				}
				$balikan['status'] = '1';
				$balikan['message'] = 'Ada data.';
				$balikan['list'] = $data_tampil;
				$balikan['jumlah'] = $tampil_jum;
				$balikan['total'] = count($hasil_total);
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