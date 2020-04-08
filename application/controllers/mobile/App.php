<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
	}
	public function login()
	{
		
		if(($this->session->userdata('id'))==NULL){
			$this->load->view('mobile/app/login');
		}else{
			redirect('mobile_side/beranda');
		}
	}
	public function login_process(){
		$cek = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->input->post('username'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC')->result();
		if($cek!=NULL){
			$cek2 = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->input->post('username'),'pass' => $this->input->post('password'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC','','','','')->result();
			if($cek2!=NULL){
				foreach ($cek as $key => $value) {
					$total_login = ($value->total_login)+1;
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'total_login' => $total_login,
						'last_login' => date('Y-m-d H-i-s'),
						'last_activity' => date('Y-m-d H-i-s'),
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s'),
						'ip_address' => $this->input->ip_address()
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$this->Main_model->log_activity($value->id,'Login to system','Login via mobile Apps',$this->input->post('location'));
					$role = $this->Main_model->getSelectedData('user_to_role a', 'b.route,a.user_id,a.role_id', array('a.user_id'=>$value->id,'b.deleted'=>'0'), "",'','','',array(
						'table' => 'user_role b',
						'on' => 'a.role_id=b.id',
						'pos' => 'LEFT'
					))->result();
					if($role==NULL){
						$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<strong>Ups! </strong>Akun Anda tidak dikenali sistem.
														</div>' );
						echo "<script>window.location='".base_url('mobile_side/login')."'</script>";
					}else{
						foreach ($role as $key => $value2) {
							$sess_data['id'] = $value2->user_id;
							$sess_data['role_id'] = $value2->role_id;
							$sess_data['fullname'] = $value->fullname;
							$sess_data['photo'] = $value->photo;
							$sess_data['from'] = 'mobile';
							$sess_data['location'] = $this->input->post('location');
							$this->session->set_userdata($sess_data);
							redirect('mobile_side/beranda');
						}
					}
				}
			}else{
				foreach ($cek as $key => $value) {
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s')
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Ups! </strong>Password yg Anda masukkan tidak valid.
												</div>' );
					echo "<script>window.location='".base_url('mobile_side/login')."'</script>";
				}
			}
		}
		else{
			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<strong>Ups! </strong>Username/ Email yang Anda masukkan tidak terdaftar.
										</div>' );
			echo "<script>window.location='".base_url('mobile_side/login')."'</script>";
		}
	}
    public function home()
	{
		$this->load->view('mobile/template/header');
		$this->load->view('mobile/app/home');
		$this->load->view('mobile/template/footer');
	}
	public function administration()
	{
		$this->load->view('mobile/template/header');
		$this->load->view('mobile/app/administration');
		$this->load->view('mobile/template/footer');
	}
	public function economy()
	{
		$this->load->view('mobile/template/header');
		$this->load->view('mobile/app/economy');
		$this->load->view('mobile/template/footer');
	}
	public function population()
	{
		$this->load->view('mobile/template/header');
		$this->load->view('mobile/app/population');
		$this->load->view('mobile/template/footer');
	}
	public function logout(){
		$this->session->sess_destroy();
		echo "<script>window.location='".base_url('mobile_side/login')."'</script>";
	}
	/* Menu setting and user's permission */
	public function ajax_page(){
		if($this->input->post('modul')=='beranda'){
			$data['berita'] = $this->Main_model->getSelectedData('berita a', 'a.*', '', "a.created_at DESC",'2')->result();
			$data['potensi_desa'] = $this->Main_model->getSelectedData('potensi_desa a', 'a.*', '', "a.created_at DESC",'1')->result();
			$this->load->view('mobile/app/ajax_page/beranda',$data);
		}elseif($this->input->post('modul')=='administrasi'){
			$this->load->view('mobile/app/ajax_page/administrasi');
		}elseif($this->input->post('modul')=='ekonomi'){
			$this->load->view('mobile/app/ajax_page/ekonomi');
		}elseif($this->input->post('modul')=='kependudukan'){
			$this->load->view('mobile/app/ajax_page/kependudukan');
		}
	}
}