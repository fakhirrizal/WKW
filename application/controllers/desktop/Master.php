<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Master Berita */
	public function berita(){
		$data['parent'] = 'master';
        $data['child'] = 'berita';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/berita',$data);
        $this->load->view('desktop/template/footer');
	}
	public function json_berita(){
		$get_data = $this->Main_model->getSelectedData('berita a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$isi['isi'] = $value->isi;
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('detail_berita/'.md5($value->id_berita)).'">
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
	public function detail_berita(){
		$data['parent'] = 'master';
        $data['child'] = 'berita';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('berita a', 'a.*',array('md5(a.id_berita)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/ubah_berita',$data);
        $this->load->view('desktop/template/footer');
	}
	/* Data Potensi Desa */
	public function potensi_desa(){
		$data['parent'] = 'master';
        $data['child'] = 'potensi_desa';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/potensi_desa',$data);
        $this->load->view('desktop/template/footer');
	}
	public function json_potensi_desa(){
		$get_data = $this->Main_model->getSelectedData('potensi_desa a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$isi['isi'] = $value->isi;
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('detail_potensi_desa/'.md5($value->id_potensi_desa)).'">
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
	public function detail_potensi_desa(){
		$data['parent'] = 'master';
        $data['child'] = 'potensi_desa';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('potensi_desa a', 'a.*',array('md5(a.id_potensi_desa)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/ubah_potensi_desa',$data);
        $this->load->view('desktop/template/footer');
	}
	/* Kependudukan */
	public function kependudukan(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'data_kependudukan';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/data_kependudukan',$data);
        $this->load->view('desktop/template/footer');
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
												<a href="'.site_url('detail_kependudukan/'.md5($value->tahun)).'/'.md5($value->kategori).'">
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
			echo "<script>window.location='".base_url()."detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
	}
	public function detail_kependudukan(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'data_kependudukan';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*',array('md5(a.kategori)'=>$this->uri->segment(3),'md5(a.tahun)'=>$this->uri->segment(2)), '', '1')->row();
		$data['data_detail'] = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*',array('md5(a.kategori)'=>$this->uri->segment(3),'md5(a.tahun)'=>$this->uri->segment(2)))->result();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/detail_kependudukan',$data);
        $this->load->view('desktop/template/footer');
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
			echo "<script>window.location='".base_url()."detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_kependudukan/".md5($this->input->post('tahun'))."/".md5($this->input->post('kategori'))."'</script>";
		}
	}
	public function hapus_item_data_kependudukan(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$thn = '';
		$kat = '';
		$get_data = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*',array('md5(a.id)'=>$this->uri->segment(2)))->row();
		$id = $get_data->id;
		$nama = $get_data->keterangan;
		$thn = $get_data->tahun;
		$kat = $get_data->kategori;

		$this->Main_model->deleteData('data_kependudukan',array('id'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus rincian data kependudukan (".$kat." - ".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_kependudukan/".md5($thn)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_kependudukan/".md5($thn)."/".md5($kat)."'</script>";
		}
	}
	/* APBDESA */
	public function apbdesa_desa(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'apbdesa';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/apbdesa_desa',$data);
        $this->load->view('desktop/template/footer');
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
											<a href="'.site_url('detail_apbdesa/'.md5($value->tahun)).'">
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
			echo "<script>window.location='".base_url()."detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
	}
	public function detail_apbdesa(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'apbdesa';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(2)), '', '1')->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/master/detail_apbdesa',$data);
        $this->load->view('desktop/template/footer');
	}
	public function detail_anggaran(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'apbdesa';
		$data['grand_child'] = '';
		$data['data_utama'] =  $this->Main_model->getSelectedData('apbdes a', 'a.*', array('md5(a.id_apbdes)'=>$this->uri->segment(2)))->row();
		$data['sub_output'] = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('md5(a.id_apbdes)'=>$this->uri->segment(2)))->result();
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/detail_anggaran',$data);
		$this->load->view('desktop/template/footer');
	}
	public function json_output(){
		$data_tampil = array();
		$no = 1;
		$get_data = $this->Main_model->getSelectedData('output a', 'a.*,b.sub_output', array('md5(a.id_apbdes)'=>$this->input->get('id_apbdes')), 'a.id_sub_output ASC', '', '', '', array(
			'table' => 'sub_output b',
			'on' => 'a.id_sub_output=b.id_sub_output',
			'pos' => 'LEFT'
		))->result();
		foreach ($get_data as $key => $value) {
			$isi['number'] = $no++.'.';
			$isi['sub_output'] = $value->sub_output;
			$isi['output'] = $value->output;
			$isi['nominal'] = 'Rp '.number_format($value->nominal,2);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['aksi'] =	'
			<div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a class="ubahdata2" id="'.md5($value->id_output).'">
							<i class="icon-note"></i> Ubah Data </a>
					</li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('hapus_output/'.md5($value->id_output)).'">
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
	public function perbarui_data_rincian_apbdesa(){
		$this->db->trans_start();
		$data_insert_1 = array(
			'rincian' => $this->input->post('rincian')
		);
		$this->Main_model->updateData('apbdes',$data_insert_1,array('md5(id_apbdes)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data rincian APBDESA (".$this->input->post('kategori').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_apbdesa/".md5($this->input->post('tahun'))."'</script>";
		}
	}
	public function simpan_detail_anggaran(){
		if($this->input->post('radio2')=='sub_output'){
			if($this->input->post('sub_output')==''){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
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
					echo "<script>window.location='".base_url()."detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
					echo "<script>window.location='".base_url()."detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
			}
		}else{
			if($this->input->post('id_sub_output')=='' OR $this->input->post('output')=='' OR $this->input->post('nominal')==''){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
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
					echo "<script>window.location='".base_url()."detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
					echo "<script>window.location='".base_url()."detail_anggaran/".md5($this->input->post('id_apbdesa'))."'</script>";
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
			echo "<script>window.location='".base_url()."detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
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
			echo "<script>window.location='".base_url()."detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_anggaran/".$this->input->post('id_apbdesa')."'</script>";
		}
	}
	public function hapus_item_apbdesa(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$thn = '';
		$get_data = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.id_apbdes)'=>$this->uri->segment(2)))->row();
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
			echo "<script>window.location='".base_url()."detail_apbdesa/".md5($thn)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_apbdesa/".md5($thn)."'</script>";
		}
	}
	public function hapus_sub_output(){
		$this->db->trans_start();
		$id = '';
		$apbdes = '';
		$nama = '';
		$baru = 0;
		$get_data = $this->Main_model->getSelectedData('sub_output a', 'a.*',array('md5(a.id_sub_output)'=>$this->uri->segment(2)))->row();
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
			echo "<script>window.location='".base_url()."detail_anggaran/".md5($apbdes)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_anggaran/".md5($apbdes)."'</script>";
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
		$get_data = $this->Main_model->getSelectedData('output a', 'a.*',array('md5(a.id_output)'=>$this->uri->segment(2)))->row();
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
			echo "<script>window.location='".base_url()."detail_anggaran/".md5($apbdes)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_anggaran/".md5($apbdes)."'</script>";
		}
	}
	/* PPID */
	public function ppid(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'ppid';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/ppid',$data);
		$this->load->view('desktop/template/footer');
	}
	public function json_ppid(){
		$get_data = $this->Main_model->getSelectedData('ppid a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->kategori;
			$isi['isi'] = $value->judul;
			$isi['file'] = '<a class="detaildata" id="'.md5($value->id_ppid).'">Lihat File</a>';
			$return_on_click = "return confirm('Anda yakin?')";
			if($value->judul=='Laporan Tahunan PPID'){
				$isi['action'] =	'
				<div class="btn-group" style="text-align: center;">
					<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="'.site_url('ubah_ppid/'.md5($value->id_ppid)).'">
								<i class="icon-note"></i> Ubah Data </a>
						</li>
					</ul>
				</div>
				';
			}else{
				$isi['action'] =	'
				<div class="btn-group" style="text-align: center;">
					<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="'.site_url('ubah_ppid/'.md5($value->id_ppid)).'">
								<i class="icon-note"></i> Ubah Data </a>
						</li>
						<li>
							<a onclick="'.$return_on_click.'" href="'.site_url('hapus_ppid/'.md5($value->id_ppid)).'">
								<i class="icon-trash"></i> Hapus Data </a>
						</li>
					</ul>
				</div>
				';
			}
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_ppid(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'ppid';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/tambah_ppid',$data);
		$this->load->view('desktop/template/footer');
	}
	public function simpan_ppid(){
		$this->db->trans_start();
		$namafile = '';
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/ppid/'; // path folder
		$config['allowed_types'] = 'pdf'; // type yang dapat diakses bisa anda sesuaikan
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
				$namafile = $gbr['file_name'];
			}
		}else{echo'';}
		$data_insert1 = array(
			'kategori' => $this->input->post('keterangan'),
			'judul' => $this->input->post('judul'),
			'file' => $namafile
		);
		$this->Main_model->insertData('ppid',$data_insert1);
		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data PPID (".$this->input->post('judul')." - ".$this->input->post('keterangan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."tambah_ppid/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."ppid/'</script>";
		}
	}
	public function ubah_ppid(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'ppid';
		$data['grand_child'] = '';
		$data['data_utama'] =  $this->Main_model->getSelectedData('ppid a', 'a.*', array('md5(a.id_ppid)'=>$this->uri->segment(2)))->row();
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/ubah_ppid',$data);
		$this->load->view('desktop/template/footer');
	}
	public function perbarui_ppid(){
		$this->db->trans_start();
		$namafile = '';
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/ppid/'; // path folder
		$config['allowed_types'] = 'pdf'; // type yang dapat diakses bisa anda sesuaikan
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
				$this->Main_model->updateData('ppid',array('file'=>$gbr['file_name']),array('md5(id_ppid)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert1 = array(
			'kategori' => $this->input->post('keterangan'),
			'judul' => $this->input->post('judul')
		);
		$this->Main_model->updateData('ppid',$data_insert1,array('md5(id_ppid)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data PPID (".$this->input->post('judul')." - ".$this->input->post('keterangan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."ubah_ppid/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."ppid/'</script>";
		}
	}
	public function hapus_ppid(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$ket = '';
		$get_data = $this->Main_model->getSelectedData('ppid a', 'a.*',array('md5(a.id_ppid)'=>$this->uri->segment(2)))->row();
		$id = $get_data->id_ppid;
		$nama = $get_data->judul;
		$ket = $get_data->kategori;

		$this->Main_model->deleteData('ppid',array('id_ppid'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data PPID (".$nama." - ".$ket.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."ppid/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."ppid/'</script>";
		}
	}
	/* Lembaga Desa */
	public function lembaga_desa(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'lembaga_desa';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/lembaga_desa',$data);
		$this->load->view('desktop/template/footer');
	}
	public function json_lembaga_desa(){
		$get_data = $this->Main_model->getSelectedData('lembaga_desa a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$angg = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*', array('a.id_lembaga_desa'=>$value->id_lembaga_desa))->result();
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->nama;
			$isi['isi'] = number_format(count($angg),0).' Orang';
			$isi['action'] =	'
			<div class="btn-group" style="text-align: center;">
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="'.site_url('detail_lembaga_desa/'.md5($value->id_lembaga_desa)).'">
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
	public function detail_lembaga_desa(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'lembaga_desa';
		$data['grand_child'] = '';
		$data['data_utama'] =  $this->Main_model->getSelectedData('lembaga_desa a', 'a.*', array('md5(a.id_lembaga_desa)'=>$this->uri->segment(2)))->row();
		$data['anggota_lembaga_desa'] = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*', array('md5(a.id_lembaga_desa)'=>$this->uri->segment(2)))->result();
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/detail_lembaga_desa',$data);
		$this->load->view('desktop/template/footer');
	}
	public function perbarui_data_lembaga_desa(){
		$this->db->trans_start();
		$data_insert1 = array(
			'keterangan' => $this->input->post('ket')
		);
		$this->Main_model->updateData('lembaga_desa',$data_insert1,array('id_lembaga_desa'=>$this->input->post('id_')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data lembaga desa (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".md5($this->input->post('id_'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".md5($this->input->post('id_'))."'</script>";
		}
	}
	public function simpan_data_anggota_lembaga_desa(){
		$this->db->trans_start();
		$namafile = '';
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/anggota_lembaga_desa/'; // path folder
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
				$namafile = $gbr['file_name'];
			}
		}else{echo'';}
		$data_insert1 = array(
			'id_lembaga_desa' => $this->input->post('id_'),
			'nama' => $this->input->post('nama'),
			'jabatan' => $this->input->post('jabatan')
			,'foto' => $namafile
		);
		$this->Main_model->insertData('anggota_lembaga_desa',$data_insert1);
		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data anggota lembaga desa (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".md5($this->input->post('id_'))."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".md5($this->input->post('id_'))."'</script>";
		}
	}
	public function perbarui_data_anggota_lembaga_desa(){
		$this->db->trans_start();
		$namafile = '';
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/anggota_lembaga_desa/'; // path folder
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
				$this->Main_model->updateData('anggota_lembaga_desa',array('foto'=>$gbr['file_name']),array('md5(id_anggota_lembaga_desa)'=>$this->input->post('id_anggota_lembaga_desa')));
			}
		}else{echo'';}
		$data_insert1 = array(
			'nama' => $this->input->post('nama'),
			'jabatan' => $this->input->post('jabatan')
		);
		$this->Main_model->updateData('anggota_lembaga_desa',$data_insert1,array('md5(id_anggota_lembaga_desa)'=>$this->input->post('id_anggota_lembaga_desa')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data anggota lembaga desa (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".$this->input->post('id_lembaga_desa')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".$this->input->post('id_lembaga_desa')."'</script>";
		}
	}
	public function hapus_data_anggota_lembaga_desa(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$ket = '';
		$get_data = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*',array('md5(a.id_anggota_lembaga_desa)'=>$this->uri->segment(2)))->row();
		$id = $get_data->id_anggota_lembaga_desa;
		$nama = $get_data->nama;
		$ket = md5($get_data->id_lembaga_desa);

		$this->Main_model->deleteData('anggota_lembaga_desa',array('id_anggota_lembaga_desa'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data anggota lembaga desa (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".$ket."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_lembaga_desa/".$ket."'</script>";
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
			$this->load->view('desktop/master/ajax_page/form_ubah_data_rincian_apbdesa',$data);
		}
		elseif($this->input->post('modul')=='modul_ubah_rincian_data_kependudukan'){
			$data['data_utama'] = $this->Main_model->getSelectedData('data_kependudukan a', 'a.*', array('md5(a.id)'=>$this->input->post('id')))->row();
			$this->load->view('desktop/master/ajax_page/form_ubah_rincian_data_kependudukan',$data);
		}
		elseif($this->input->post('modul')=='modul_ubah_data_sub_output'){
			$data['data_utama'] = $this->Main_model->getSelectedData('sub_output a', 'a.*', array('md5(a.id_sub_output)'=>$this->input->post('id')))->row();
			$this->load->view('desktop/master/ajax_page/form_ubah_data_sub_output',$data);
		}
		elseif($this->input->post('modul')=='modul_ubah_data_output'){
			$data['data_utama'] = $this->Main_model->getSelectedData('output a', 'a.*,b.sub_output', array('md5(a.id_output)'=>$this->input->post('id')), '', '', '', '', array(
				'table' => 'sub_output b',
				'on' => 'a.id_sub_output=b.id_sub_output',
				'pos' => 'LEFT'
			))->row();
			$this->load->view('desktop/master/ajax_page/form_ubah_data_output',$data);
		}
		elseif($this->input->post('modul')=='modul_detail_file_ppid'){
			$data = $this->Main_model->getSelectedData('ppid a', 'a.*', array('md5(a.id_ppid)'=>$this->input->post('id')))->row();
			echo'<iframe src="'.base_url().'data_upload/ppid/'.$data->file.'" width="100%" height="500px"></iframe>';
		}
		elseif($this->input->post('modul')=='modul_ubah_data_anggota_lembaga_desa'){
			$data['data_utama'] = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*', array('md5(a.id_anggota_lembaga_desa)'=>$this->input->post('id')))->row();
			$this->load->view('desktop/master/ajax_page/form_ubah_data_anggota_lembaga_desa',$data);
		}
	}
}