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
		$this->load->view('mobile/app/login');
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
		$data['parent'] = 'home';
		$data['child'] = '';
		$data['grand_child'] = '';
		// $q = "SELECT a.* FROM user a WHERE a.role='radiografer' AND a.deleted='0'";
		// $data['radiografer'] = $this->Main_model->manualQuery($q);
		// $q2 = "SELECT a.* FROM job a WHERE a.deleted='0'";
		// $data['do_kegiatan'] = $this->Main_model->manualQuery($q2);
		// $q3 = "SELECT a.* FROM job_type a WHERE a.deleted='0'";
		// $data['jenis_kegiatan'] = $this->Main_model->manualQuery($q3);
		// $q4 = "SELECT a.* FROM category a WHERE a.deleted='0'";
		// $data['jenis_pemeriksaan'] = $this->Main_model->manualQuery($q4);
		// $q5 = "SELECT a.id,b.job_name,c.fullname,d.name,a.created_at FROM monitoring a LEFT JOIN job b ON a.job_id=b.id LEFT JOIN user_profile c ON a.user_id=c.user_id LEFT JOIN patient d ON a.patient_id=d.id WHERE a.deleted='0' ORDER BY `a`.`created_at` DESC";
		// $data['laporan'] = $this->Main_model->manualQuery($q5);
		// $q6 = "SELECT a.* FROM job_type a WHERE a.deleted='0'";
		// $data['data_jenis'] = $this->Main_model->manualQuery($q6);
		$this->load->view('mobile/template/header',$data);
		$this->load->view('mobile/app/home',$data);
		$this->load->view('mobile/template/footer');
	}
	public function log_activity()
	{
		$data['parent'] = 'log_activity';
		$data['child'] = '';
		$data['grand_child'] = '';
		$data['data_tabel'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('a.user_id'=>$this->session->userdata('id')), "a.activity_time DESC",'','','',array(
			'table' => 'user_profile b',
			'on' => 'a.user_id=b.user_id',
			'pos' => 'LEFT'
		))->result();
		$this->load->view('mobile/template/header',$data);
		$this->load->view('mobile/app/log_activity',$data);
		$this->load->view('mobile/template/footer');
	}
	public function cleaning_log(){
		$this->db->trans_start();
		$this->Main_model->cleanData('activity_logs');
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."member_side/log_activity/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."member_side/log_activity/'</script>";
		}
	}
	public function about()
	{
		$data['parent'] = 'about';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('mobile/template/header',$data);
		$this->load->view('mobile/app/about',$data);
		$this->load->view('mobile/template/footer');
	}
	public function helper()
	{
		$data['parent'] = 'helper';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('mobile/template/header',$data);
		$this->load->view('mobile/app/helper',$data);
		$this->load->view('mobile/template/footer');
	}
	public function logout(){
		$this->session->sess_destroy();
		echo "<script>window.location='".base_url('mobile_side/login')."'</script>";
	}
	/* Menu setting and user's permission */
	public function ajax_function(){
		if($this->input->post('modul')=='modul_detail_log_aktifitas'){
			$data['data_utama'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('md5(a.activity_id)'=>$this->input->post('id')), "",'','','',array(
				'table' => 'user_profile b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			))->result();
			$this->load->view('mobile/app/ajax_detail_log_aktifitas',$data);
		}
	}
}