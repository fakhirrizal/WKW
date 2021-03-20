<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct() {
        parent::__construct();
	}
	public function index(){
		$this->load->view('desktop/app/index');
	}
    public function home(){
		$data['parent'] = 'home';
		$data['child'] = '';
		$data['grand_child'] = '';
		// $this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/app/beranda',$data);
		// $this->load->view('desktop/app/home',$data);
		// $this->load->view('desktop/template/footer');
	}
	public function log_activity(){
		$data['parent'] = 'log_activity';
		$data['child'] = '';
		$data['grand_child'] = '';
		$data['data_tabel'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('a.user_id'=>'2'), "a.activity_time DESC",'','','',array(
			'table' => 'user b',
			'on' => 'a.user_id=b.id',
			'pos' => 'LEFT'
		))->result();
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/app/log_activity',$data);
		$this->load->view('desktop/template/footer');
	}
	public function about(){
		$data['parent'] = 'about';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/app/about',$data);
		$this->load->view('desktop/template/footer');
	}
	public function helper(){
		$data['parent'] = 'helper';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/app/helper',$data);
		$this->load->view('desktop/template/footer');
	}
	public function ajax_function(){
		if($this->input->post('modul')=='modul_detail_log_aktifitas'){
			$data['data_utama'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('md5(a.activity_id)'=>$this->input->post('id')), "",'','','',array(
				'table' => 'user b',
				'on' => 'a.user_id=b.id',
				'pos' => 'LEFT'
			))->result();
			$this->load->view('desktop/app/ajax_detail_log_aktifitas',$data);
		}
	}
}