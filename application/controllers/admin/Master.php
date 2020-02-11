<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Administrator */
	public function administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_admin(){
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '1'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->fullname;
			$isi['username'] = $value->username;
			$isi['total_login'] = number_format($value->total_login,0).'x';
			$pecah_tanggal = explode(' ',$value->last_activity);
			$isi['last_activity'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_admin/'.md5($value->id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_admin/'.md5($value->id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_admin/'.md5($value->id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$data['prov'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_administrator_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'fullname' => $this->input->post('nama')
			);
			$this->Main_model->insertData('user_profile',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '1'
			);
			$this->Main_model->insertData('user_to_role',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Admin (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
		}
		
	}
	public function detail_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		// $data['data_utama'] =  $this->Main_model->getSelectedData('kube a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
		// $data['riwayat_pembayaran'] = $this->Main_model->getSelectedData('purchasing a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
		// $data['riwayat_kehadiran'] = $this->Main_model->getSelectedData('presence a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->result_array();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/detail_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function edit_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.*', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_administrator_data(){
		if($this->input->post('un')!=NULL){
			$cek_ = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$this->input->post('un')."' AND md5(a.id) NOT IN ('".$this->input->post('user_id')."')")->row();
			if($cek_==NULL){
				$this->db->trans_start();
				if($this->input->post('ps')!=NULL){
					$data_insert1 = array(
						'username' => $this->input->post('un'),
						'pass' => $this->input->post('ps')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}
				else{
					$data_insert1 = array(
						'username' => $this->input->post('un')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}

				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
				}
			}else{
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
		}elseif($this->input->post('ps')!=NULL){
			$this->db->trans_start();

			$data_insert1 = array(
				'pass' => $this->input->post('ps')
			);
			$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
			// print_r($data_insert1);

			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
			}
		}else{
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	public function reset_password_administrator_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Update admin's data","Reset password admin's account (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	public function download_admin_data(){
		$this->load->view('admin/master/cetak_data_admin');
	}
	public function delete_administrator_data(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('user_profile',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting admin's data","Delete admin's data (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	/* Member */
	public function member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_member(){
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname,c.nin,c.email,c.number_phone',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '2'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->fullname;
			$isi['nik'] = $value->nin;
			$isi['email'] = $value->email;
			$isi['hp'] = $value->number_phone;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_anggota/'.md5($value->id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_anggota/'.md5($value->id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_anggota/'.md5($value->id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_member_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'fullname' => $this->input->post('nama'),
				'nin' => $this->input->post('nik'),
				'number_phone' => $this->input->post('no_hp'),
				'email' => $this->input->post('email')
			);
			$this->Main_model->insertData('user_profile',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '2'
			);
			$this->Main_model->insertData('user_to_role',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Pengguna (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_anggota/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_anggota/'</script>";
		}
		
	}
	public function reset_password_member_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Update member's data","Reset password member's account (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	public function delete_member_data(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('user_profile',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting member's data","Delete member's data (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	/* Master Berita */
	public function berita(){
		$data['parent'] = 'master';
        $data['child'] = 'berita';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/berita',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_berita(){
		$get_data = $this->Main_model->getSelectedData('berita a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$isi['isi'] = $value->isi;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_berita/'.md5($value->id_berita)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_berita/'.md5($value->id_berita)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_berita(){
		$data['parent'] = 'master';
        $data['child'] = 'berita';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_berita',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_berita(){
		$this->db->trans_start();
		$get_last_id = $this->Main_model->getLastID('berita','id_berita');
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/berita/'; // path folder
		$config['allowed_types'] = 'jpg|jpeg|png|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);
		if(isset($_FILES['file']['name']))
		{
			if(!$this->upload->do_upload('file'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$data_insert_ = array(
					'id_berita' => $get_last_id['id_berita']+1,
					'judul' => $this->input->post('judul'),
					'foto' => $gbr['file_name'],
					'isi' => $this->input->post('isi'),
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->Main_model->insertData("berita",$data_insert_);
			}
		}else{echo'';}

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data berita",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/berita'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/berita/'</script>";
		}
	}
	public function detail_berita(){
		$data['parent'] = 'master';
        $data['child'] = 'berita';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('berita a', 'a.*',array('md5(a.id_berita)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/ubah_berita',$data);
        $this->load->view('admin/template/footer');
	}
	public function perbarui_berita(){
		$this->db->trans_start();
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/berita/'; // path folder
		$config['allowed_types'] = 'jpg|jpeg|png|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);
		if(isset($_FILES['file']['name']))
		{
			if(!$this->upload->do_upload('file'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$data_insert_1 = array(
					'judul' => $this->input->post('judul'),
					'foto' => $gbr['file_name'],
					'isi' => $this->input->post('isi')
				);
				$this->Main_model->updateData('berita',$data_insert_1,array('md5(id_berita)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert_2 = array(
			'judul' => $this->input->post('judul'),
			'isi' => $this->input->post('isi')
		);
		$this->Main_model->updateData('berita',$data_insert_2,array('md5(id_berita)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data berita (".$this->input->post('judul').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/berita'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/berita/'</script>";
		}
	}
	public function hapus_berita(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('berita a', 'a.*',array('md5(a.id_berita)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_berita;
		$nama = $get_data->judul;

		$this->Main_model->deleteData('berita',array('id_berita'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data berita (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/berita/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/berita/'</script>";
		}
	}
	/* Data Potensi Desa */
	public function potensi_desa(){
		$data['parent'] = 'master';
        $data['child'] = 'potensi_desa';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/potensi_desa',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_potensi_desa(){
		$get_data = $this->Main_model->getSelectedData('potensi_desa a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$isi['isi'] = $value->isi;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_potensi_desa/'.md5($value->id_potensi_desa)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_potensi_desa/'.md5($value->id_potensi_desa)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_potensi_desa(){
		$data['parent'] = 'master';
        $data['child'] = 'potensi_desa';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_potensi_desa',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_potensi_desa(){
		$this->db->trans_start();
		$get_last_id = $this->Main_model->getLastID('potensi_desa','id_potensi_desa');
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/potensi_desa/'; // path folder
		$config['allowed_types'] = 'jpg|jpeg|png|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);
		if(isset($_FILES['file']['name']))
		{
			if(!$this->upload->do_upload('file'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$data_insert_ = array(
					'id_potensi_desa' => $get_last_id['id_potensi_desa']+1,
					'judul' => $this->input->post('judul'),
					'foto' => $gbr['file_name'],
					'isi' => $this->input->post('isi'),
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->Main_model->insertData("potensi_desa",$data_insert_);
			}
		}else{echo'';}

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data potensi_desa",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/potensi_desa'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/potensi_desa/'</script>";
		}
	}
	public function detail_potensi_desa(){
		$data['parent'] = 'master';
        $data['child'] = 'potensi_desa';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('potensi_desa a', 'a.*',array('md5(a.id_potensi_desa)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/ubah_potensi_desa',$data);
        $this->load->view('admin/template/footer');
	}
	public function perbarui_potensi_desa(){
		$this->db->trans_start();
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/potensi_desa/'; // path folder
		$config['allowed_types'] = 'jpg|jpeg|png|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);
		if(isset($_FILES['file']['name']))
		{
			if(!$this->upload->do_upload('file'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$data_insert_1 = array(
					'judul' => $this->input->post('judul'),
					'foto' => $gbr['file_name'],
					'isi' => $this->input->post('isi')
				);
				$this->Main_model->updateData('potensi_desa',$data_insert_1,array('md5(id_potensi_desa)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert_2 = array(
			'judul' => $this->input->post('judul'),
			'isi' => $this->input->post('isi')
		);
		$this->Main_model->updateData('potensi_desa',$data_insert_2,array('md5(id_potensi_desa)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data potensi_desa (".$this->input->post('judul').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/potensi_desa'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/potensi_desa/'</script>";
		}
	}
	public function hapus_potensi_desa(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('potensi_desa a', 'a.*',array('md5(a.id_potensi_desa)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_potensi_desa;
		$nama = $get_data->judul;

		$this->Main_model->deleteData('potensi_desa',array('id_potensi_desa'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data potensi_desa (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/potensi_desa/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/potensi_desa/'</script>";
		}
	}
	/* Other Function */
	public function ajax_function(){
		if($this->input->post('modul')=='get_data_kabupaten_by_keterangan_admin'){
			if($this->input->post('id')=='6'){
				echo'
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Kabupaten/ Kota <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="wilayah" id="id_kabupaten" class="form-control select2-allow-clear" required>
								<option value="">-- Pilih Kabupaten/ Kota --</option>
							</select>
						</div>
					</div>
				</div>
				';
			}else{echo'';}
		}
		elseif($this->input->post('modul')=='get_kabupaten_by_id_provinsi'){
			$data = $this->Main_model->getSelectedData('kabupaten a', 'a.*', array('a.id_provinsi'=>$this->input->post('id')))->result();
			echo'<option value="">-- Pilih Kabupaten/ Kota --</option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_kabupaten.'">'.$value->nm_kabupaten.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_kecamatan_by_id_kabupaten'){
			$data = $this->Main_model->getSelectedData('kecamatan a', 'a.*', array('a.id_kabupaten'=>$this->input->post('id')))->result();
			echo'<option value=""></option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_kecamatan.'">'.$value->nm_kecamatan.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_desa_by_id_kecamatan'){
			$data = $this->Main_model->getSelectedData('desa a', 'a.*', array('a.id_kecamatan'=>$this->input->post('id')))->result();
			echo'<option value=""></option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_desa.'">'.$value->nm_desa.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_data_form_by_jenis_permohonan'){
			if($this->input->post('id')=='Tambah Anak'){
				echo'
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Istri <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Istri">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Suami <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KTP Suami">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Kelahiran <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Surat Kelahiran">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}elseif($this->input->post('id')=='Pindah RT'){
				echo'
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something">
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something">
							<input type="hidden" name="ket2" value="KTP Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something">
							<input type="hidden" name="ket3" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}elseif($this->input->post('id')=='Pindah Kelurahan'){
				echo'
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah Dari Kelurahan Asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Surat Pindah Dari Kelurahan Asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Permohonan Pembuatan KK Kelurahan Tujuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Surat Permohonan Pembuatan KK Kelurahan Tujuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}elseif($this->input->post('id')=='Perubahan Data'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Nama, Tempat Tanggal Lahir, Pekerjaan">Nama, Tempat Tanggal Lahir, Pekerjaan</option>
								<option value="Perubahan Status">Perubahan Status</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Perubahan Pisah KK'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai">Pisah KK Karena Cerai</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Buat KK Baru'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Pindah Antar Kelurahan Membenuk Keluarga Baru'){
				echo'
				<input type="hidden" name="jumlah_file" value="6">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah Dari Kelurahan Asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Surat Pindah Dari Kelurahan Asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Permohonan Pembuatan KK Kelurahan Tujuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Surat Permohonan Pembuatan KK Kelurahan Tujuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli Pihak Laki-Laki <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli Pihak Laki-Laki">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli Pihak Perempuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file6" placeholder="Type something" required>
							<input type="hidden" name="ket6" value="KK Asli Pihak Perempuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}else{echo'';}
		}
		elseif($this->input->post('modul')=='get_data_form_by_sub_jenis_permohonan'){
			if($this->input->post('id')=='Nama, Tempat Tanggal Lahir, Pekerjaan'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="4">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Nama, Tempat Tanggal Lahir, Pekerjaan" selected>Nama, Tempat Tanggal Lahir, Pekerjaan</option>
								<option value="Perubahan Status">Perubahan Status</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Data Dukung (Akta atau Ijazah) <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Data Dukung">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Perubahan Status'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Nama, Tempat Tanggal Lahir, Pekerjaan">Nama, Tempat Tanggal Lahir, Pekerjaan</option>
								<option value="Perubahan Status" selected>Perubahan Status</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku nikah/ Surat Cerai/ Akte Kematian <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Buku nikah/ Surat Cerai/ Akte Kematian">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pisah KK Karena Cerai'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai" selected>Pisah KK Karena Cerai</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Cerai <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Surat Cerai">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pisah KK'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="1">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai" selected>Pisah KK Karena Cerai</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindahan dari luar Kota atau Provinsi'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi" selected>Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat kedatangan dari Disdukcapil Batang <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat kedatangan dari Disdukcapil Batang">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindahan dari luar Kecamatan'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan" selected>Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat SKPWNI dari Kecamatan asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat SKPWNI dari Kecamatan asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindah dari Kecamatan membentuk keluarga baru'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru" selected>Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat SKPWNI dari Kecamatan asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat SKPWNI dari Kecamatan asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindah dari luar Kota membentuk keluarga baru'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru" selected>Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat kedatangan dari Disdukcapil Batang <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat kedatangan dari Disdukcapil Batang">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}
		}
	}
}