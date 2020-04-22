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
		$data['child'] = 'pengguna';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_member(){
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*,c.nama AS fullname,c.nik AS nin,c.email,c.no_hp AS number_phone',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '2'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'masyarakat c',
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
		$data['child'] = 'pengguna';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_member_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('nik')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email')
			);
			$this->Main_model->insertData('masyarakat',$data_insert2);
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
	public function edit_member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'pengguna';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.photo,c.*,cc.nm_kabupaten,ccc.nm_kecamatan,cccc.nm_desa', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'), '', '', '', '', array(
			array(
				'table' => 'masyarakat c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'kabupaten cc',
				'on' => 'c.id_kabupaten=cc.id_kabupaten',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'kecamatan ccc',
				'on' => 'c.id_kecamatan=ccc.id_kecamatan',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'desa cccc',
				'on' => 'c.id_desa=cccc.id_desa',
				'pos' => 'LEFT'
			)
		))->row();
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_member_data(){
		$this->db->trans_start();
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/photo_profile/'; // path folder
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
					'photo' => $gbr['file_name']
				);
				$this->Main_model->updateData('user',$data_insert_1,array('md5(id)'=>$this->input->post('user_id')));
			}
		}else{echo'';}
		if($this->input->post('pass')!=NULL){
			$data_insert1 = array(
				'pass' => $this->input->post('pass'),
				'fullname' => $this->input->post('nama')
			);
			$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
			// print_r($data_insert1);
		}
		else{
			$data_insert1 = array(
				'fullname' => $this->input->post('nama')
			);
			$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
			// print_r($data_insert1);
		}
		$data_insert2 = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'rt' => $this->input->post('rt'),
			'rw' => $this->input->post('rw'),
			'id_desa' => $this->input->post('id_desa'),
			'id_kecamatan' => $this->input->post('id_kecamatan'),
			'id_kabupaten' => $this->input->post('id_kabupaten'),
			'id_provinsi' => $this->input->post('id_provinsi'),
			'nik' => $this->input->post('un'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email')
		);
		$this->Main_model->updateData('masyarakat',$data_insert2,array('md5(user_id)'=>$this->input->post('user_id')));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_anggota/".$this->input->post('user_id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	public function reset_password_member_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('masyarakat a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->nama;

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
		$get_data = $this->Main_model->getSelectedData('masyarakat a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->nama;

		$this->Main_model->deleteData('masyarakat',array('user_id'=>$user_id));
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
		$namefile = '';
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
				$namefile = $gbr['file_name'];
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

		// $res = array();
		// $res['data']['title'] = 'Berita Terbaru';
		// $res['data']['body'] = $this->input->post('judul');
		// $res['data']['message'] = 'Silahkan lihat detailnya';
		// $res['data']['image'] = base_url().'data_upload/berita/'.$namefile;
		$res = array(
			"title" => "Berita Terbaru",
			"body" => $this->input->post('judul'),
			"id" => $get_last_id['id_berita']+1,
			"route" => "/berita",
			'vibrate'   => 1,
			'sound'     => 1
		);
		$get_user = $this->db->query("SELECT a.* FROM user a WHERE a.verification_token != ''")->result();
		foreach ($get_user as $key => $value) {
			$registrationIds = array( $value->verification_token );
			$fields = array(
				'registration_ids' => $registrationIds,
				'data' => $res
			);
			$this->Main_model->sendPushNotificationn($fields);
		}
		
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
	/* Kependudukan */
	public function kependudukan(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'data_kependudukan';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/data_kependudukan',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_kependudukan(){
		$get_data1 = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', '', '', '', '', 'a.tahun')->result();
        $data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $row) {
			$get_data2 = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', array('a.tahun'=>$row->tahun), '', '', '', 'a.kategori')->result();
			foreach ($get_data2 as $key => $value) {
				$isi['no'] = $no++.'.';
				$isi['tahun'] = $value->tahun;
				$isi['kategori'] = $value->kategori;
				$return_on_click = "return confirm('Anda yakin?')";
				$isi['action'] =	'
									<div class="btn-group" style="text-align: center;">
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
											<i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="'.site_url('admin_side/detail_kependudukan/'.md5($value->tahun)).'/'.md5($value->kategori).'">
													<i class="icon-action-redo"></i> Detail Data </a>
											</li>
										</ul>
									</div>
									';
				$data_tampil[] = $isi;
			}
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function simpan_data_rincian_kependudukan(){
		$this->db->trans_start();
		$data_insert_1 = array(
			'tahun' => $this->input->post('tahun'),
			'keterangan' => $this->input->post('keterangan'),
			'kategori' => $this->input->post('kategori'),
			'jumlah' => $this->input->post('jumlah')
		);
		$this->Main_model->insertData('data_kependudukan',$data_insert_1);
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Menambahkan rincian data kependudukan (".$this->input->post('kategori')." - ".$this->input->post('keterangan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
	}
	public function detail_kependudukan(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'data_kependudukan';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*',array('md5(a.kategori)'=>$this->uri->segment(4),'md5(a.tahun)'=>$this->uri->segment(3)), '', '1')->row();
		$data['data_detail'] = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*',array('md5(a.kategori)'=>$this->uri->segment(4),'md5(a.tahun)'=>$this->uri->segment(3)))->result();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/detail_kependudukan',$data);
        $this->load->view('admin/template/footer');
	}
	public function perbarui_rincian_data_kependudukan(){
		$this->db->trans_start();
		$data_insert_1 = array(
			'keterangan' => $this->input->post('keterangan'),
			'jumlah' => $this->input->post('jumlah')
		);
		$this->Main_model->updateData('data_kependudukan',$data_insert_1,array('md5(id)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui rincian data kependudukan (".$this->input->post('kategori')." - ".$this->input->post('keterangan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
	}
	public function hapus_item_data_kependudukan(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$thn = '';
		$kat = '';
		$get_data = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*',array('md5(a.id)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id;
		$nama = $get_data->keterangan;
		$thn = $get_data->tahun;
		$kat = $get_data->kategori;

		$this->Main_model->deleteData('data_kependudukan',array('id'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus rincian data kependudukan (".$kat." - ".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_kependudukan/".md5($thn)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_kependudukan/".md5($thn)."/".md5($kat)."'</script>";
		}
	}
	/* APBDESA */
	public function apbdesa_desa(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'apbdesa';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/apbdesa_desa',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_apbdesa(){
		$get_data = $this->Main_model->getSelectedData('apbdes a', 'a.*,(SELECT SUM(b.nominal) FROM apbdes b WHERE b.tahun=a.tahun AND b.keterangan="pendapatan") AS pagu,(SELECT SUM(c.nominal) FROM apbdes c WHERE c.tahun=a.tahun AND c.keterangan="pengeluaran") AS pengeluaran', '', '', '', '', 'a.tahun')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['tahun'] = $value->tahun;
			$isi['pagu'] = 'Rp '.number_format($value->pagu,2);
			$isi['out'] = 'Rp '.number_format($value->pengeluaran,2);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_apbdesa/'.md5($value->tahun)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
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
	public function simpan_data_rincian_apbdesa(){
		$this->db->trans_start();
		$data_insert_1 = array(
			'tahun' => $this->input->post('tahun'),
			'keterangan' => $this->input->post('keterangan'),
			'kategori' => $this->input->post('kategori'),
			'rincian' => $this->input->post('rincian')
		);
		$this->Main_model->insertData('apbdes',$data_insert_1);
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Menambahkan data rincian APBDESA (".$this->input->post('kategori').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
	}
	public function detail_apbdesa(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'apbdesa';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(3)), '', '1')->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/detail_apbdesa',$data);
        $this->load->view('admin/template/footer');
	}
	public function detail_anggaran()
	{
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'apbdesa';
		$data['grand_child'] = '';
		$data['data_utama'] =  $this->Main_model->getSelectedData('apbdes a', 'a.*', array('md5(a.id_apbdes)'=>$this->uri->segment(3)))->row();
		$data['sub_output'] = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('md5(a.id_apbdes)'=>$this->uri->segment(3)))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/detail_anggaran',$data);
		$this->load->view('admin/template/footer');
	}
	public function perbarui_data_rincian_apbdesa(){
		$this->db->trans_start();
		$data_insert_1 = array(
			'kategori' => $this->input->post('kategori'),
			'rincian' => $this->input->post('rincian'),
			'nominal' => $this->input->post('nominal')
		);
		$this->Main_model->updateData('apbdes',$data_insert_1,array('md5(id_apbdes)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data rincian APBDESA (".$this->input->post('kategori').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
	}
	public function simpan_detail_anggaran(){
		if($this->input->post('radio2')=='sub_output'){
			if($this->input->post('sub_output')==''){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
			}else{
				$this->db->trans_start();
				$data_insert_1 = array(
					'id_apbdes' => $this->input->post('id_apbdesa'),
					'sub_output' => $this->input->post('sub_output')
				);
				$this->Main_model->insertData('sub_output',$data_insert_1);
				$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Menambahkan data rincian APBDESA (".$this->input->post('sub_output').")",$this->session->userdata('location'));
				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
			}
		}else{
			if($this->input->post('id_sub_output')=='' OR $this->input->post('output')=='' OR $this->input->post('nominal')==''){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
			}else{
				$this->db->trans_start();
				$data_insert_1 = array(
					'id_apbdes' => $this->input->post('id_apbdesa'),
					'id_sub_output' => $this->input->post('id_sub_output'),
					'output' => $this->input->post('output'),
					'nominal' => $this->input->post('nominal')
				);
				$this->Main_model->insertData('output',$data_insert_1);
				$get_sub_output = $this->Main_model->getSelectedData('sub_output a', 'a.*',array('a.id_sub_output'=>$this->input->post('id_sub_output')))->row();
				$nominal_sub_output = ($get_sub_output->nominal)+$this->input->post('nominal');
				$this->Main_model->updateData('sub_output',array('nominal'=>$nominal_sub_output),array('id_sub_output'=>$this->input->post('id_sub_output')));
				$get_anggaran = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('a.id_apbdes'=>$this->input->post('id_apbdesa')))->row();
				$nominal_anggaran = ($get_anggaran->nominal)+$this->input->post('nominal');
				$this->Main_model->updateData('apbdes',array('nominal'=>$nominal_anggaran),array('id_apbdes'=>$this->input->post('id_apbdesa')));
				$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Menambahkan data rincian APBDESA (".$this->input->post('output').")",$this->session->userdata('location'));
				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
			}
		}
	}
	public function perbarui_data_sub_output(){
		$this->db->trans_start();
		$data_insert_1 = array(
			'sub_output' => $this->input->post('sub_output'),
			'nominal' => $this->input->post('nominal')
		);
		$this->Main_model->updateData('sub_output',$data_insert_1,array('md5(id_sub_output)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data rincian APBDESA (".$this->input->post('sub_output').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
	}
	public function perbarui_data_output(){
		$this->db->trans_start();
		$nominal = 0;
		$data_insert_1 = array(
			'output' => $this->input->post('output'),
			'nominal' => $this->input->post('nominal')
		);
		$nominal = $this->input->post('lama')-$this->input->post('nominal');
		$this->Main_model->updateData('output',$data_insert_1,array('md5(id_output)'=>$this->input->post('id')));
		$get_data_sub_output = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('md5(a.id_sub_output)'=>$this->input->post('id_sub_output')))->row();
		$baru = ($get_data_sub_output->nominal)-($nominal);
		$this->Main_model->updateData('sub_output',array('nominal'=>$baru),array('id_sub_output'=>$get_data_sub_output->id_sub_output));
		$get_data_apbdes = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('md5(a.id_apbdes)'=>$this->input->post('id_apbdesa')))->row();
		$apbdes_baru = ($get_data_apbdes->nominal)-($nominal);
		$this->Main_model->updateData('apbdes',array('nominal'=>$apbdes_baru),array('id_apbdes'=>$get_data_apbdes->id_apbdes));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data rincian APBDESA (".$this->input->post('output').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
	}
	public function hapus_item_apbdesa(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$thn = '';
		$get_data = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.id_apbdes)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_apbdes;
		$nama = $get_data->rincian;
		$thn = $get_data->tahun;

		$this->Main_model->deleteData('apbdes',array('id_apbdes'=>$id));
		$this->Main_model->deleteData('sub_output',array('id_apbdes'=>$id));
		$this->Main_model->deleteData('output',array('id_apbdes'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data rincian APBDESA (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_apbdesa/".md5($thn)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_apbdesa/".md5($thn)."'</script>";
		}
	}
	public function hapus_sub_output(){
		$this->db->trans_start();
		$id = '';
		$apbdes = '';
		$nama = '';
		$baru = 0;
		$get_data = $this->Main_model->getSelectedData('sub_output a', 'a.*',array('md5(a.id_sub_output)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_sub_output;
		$apbdes = $get_data->id_apbdes;
		$nama = $get_data->sub_output;

		$get_data_apbdes = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('a.id_apbdes'=>$apbdes))->row();
		$baru = ($get_data_apbdes->nominal)-($get_data->nominal);

		$this->Main_model->deleteData('sub_output',array('id_sub_output'=>$id));
		$this->Main_model->deleteData('output',array('id_sub_output'=>$id));

		$this->Main_model->updateData('apbdes',array('nominal'=>$baru),array('id_apbdes'=>$apbdes));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data rincian APBDESA (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($apbdes)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($apbdes)."'</script>";
		}
	}
	public function hapus_output(){
		$this->db->trans_start();
		$id = '';
		$apbdes = '';
		$nama = '';
		$apbdes_baru = 0;
		$baru = 0;
		$id_sub_output = '';
		$get_data = $this->Main_model->getSelectedData('output a', 'a.*',array('md5(a.id_output)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_output;
		$apbdes = $get_data->id_apbdes;
		$nama = $get_data->output;
		$id_sub_output = $get_data->id_sub_output;

		$get_data_sub_output = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('a.id_sub_output'=>$id_sub_output))->row();
		$baru = ($get_data_sub_output->nominal)-($get_data->nominal);

		$get_data_apbdes = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('a.id_apbdes'=>$apbdes))->row();
		$apbdes_baru = ($get_data_apbdes->nominal)-($get_data->nominal);

		$this->Main_model->deleteData('output',array('id_output'=>$id));

		$this->Main_model->updateData('sub_output',array('nominal'=>$baru),array('id_sub_output'=>$id_sub_output));

		$this->Main_model->updateData('apbdes',array('nominal'=>$apbdes_baru),array('id_apbdes'=>$apbdes));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data rincian APBDESA (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($apbdes)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_anggaran/".md5($apbdes)."'</script>";
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
		elseif($this->input->post('modul')=='modul_ubah_data_rincian_apbdesa'){
			$data['data_utama'] = $this->Main_model->getSelectedData('apbdes a', 'a.*', array('md5(a.id_apbdes)'=>$this->input->post('id')))->row();
			$this->load->view('admin/master/ajax_page/form_ubah_data_rincian_apbdesa',$data);
		}
		elseif($this->input->post('modul')=='modul_ubah_rincian_data_kependudukan'){
			$data['data_utama'] = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', array('md5(a.id)'=>$this->input->post('id')))->row();
			$this->load->view('admin/master/ajax_page/form_ubah_rincian_data_kependudukan',$data);
		}
		elseif($this->input->post('modul')=='modul_ubah_data_sub_output'){
			$data['data_utama'] = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('md5(a.id_sub_output)'=>$this->input->post('id')))->row();
			$this->load->view('admin/master/ajax_page/form_ubah_data_sub_output',$data);
		}
		elseif($this->input->post('modul')=='modul_ubah_data_output'){
			$data['data_utama'] = $this->Main_model->getSelectedData('output a', 'a.*,b.sub_output', array('md5(a.id_output)'=>$this->input->post('id')), '', '', '', '', array(
				'table' => 'sub_output b',
				'on' => 'a.id_sub_output=b.id_sub_output',
				'pos' => 'LEFT'
			))->row();
			$this->load->view('admin/master/ajax_page/form_ubah_data_output',$data);
		}
	}
}