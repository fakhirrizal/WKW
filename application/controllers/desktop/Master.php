<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* UMKM */
	public function umkm(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'umkm';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/umkm',$data);
		$this->load->view('desktop/template/footer');
	}
	public function json_umkm(){
		$get_data = $this->Main_model->getSelectedData('umkm a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->nama;
			$isi['jenis'] = $value->jenis;
			$isi['hp'] = $value->no_hp;
			$isi['action'] =	'
			<div class="btn-group" style="text-align: center;">
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="'.site_url('detail_umkm/'.md5($value->id_umkm)).'">
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
	public function tambah_umkm(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'umkm';
		$data['grand_child'] = '';
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/tambah_umkm',$data);
		$this->load->view('desktop/template/footer');
	}
	public function simpan_umkm(){
		$this->db->trans_start();
		$get_last_id = $this->Main_model->getLastID('umkm','id_umkm');
		$id = $get_last_id['id_umkm']+1;
		
		$namafile = '';
		$nmfile = "file_".time().random_string('alnum', 6); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'; // path folder
		$config['allowed_types'] = 'bmp|png|jpg|jpeg'; // type yang dapat diakses bisa anda sesuaikan
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
				$url_file = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'.$gbr['file_name'];
				$imageData = base64_encode(file_get_contents($url_file));
				$namafile = 'data:'.mime_content_type($url_file).';base64,'.$imageData;
				$data_insert2 = array(
					'id_umkm' => $id,
					'file' => $namafile
				);
				$this->Main_model->insertData('foto_produk_umkm',$data_insert2);
				unlink($url_file);
			}
		}else{echo'';}
		$namafile_foto = '';
		$nmfile = "file_".time().random_string('alnum', 6); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'; // path folder
		$config['allowed_types'] = 'bmp|png|jpg|jpeg'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya
		$this->upload->initialize($config);
		if(isset($_FILES['foto']['name']))
		{
			if(!$this->upload->do_upload('foto'))
			{
				echo'';
			}
			else
			{
				$gbr_foto = $this->upload->data();
				$url_file_foto = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'.$gbr_foto['file_name'];
				$imageData_foto = base64_encode(file_get_contents($url_file_foto));
				$namafile_foto = 'data:'.mime_content_type($url_file_foto).';base64,'.$imageData_foto;
				unlink($url_file_foto);
			}
		}else{echo'';}
		$data_insert1 = array(
			'id_umkm' => $id,
			'nama' => $this->input->post('nama'),
			'jenis' => $this->input->post('jenis'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'pemilik' => $namafile_foto
		);
		$this->Main_model->insertData('umkm',$data_insert1);
		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data UMKM (".$this->input->post('nama')." - ".$this->input->post('jenis').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."tambah_umkm/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."umkm/'</script>";
		}
	}
	public function detail_umkm(){
		$data['parent'] = 'tentang_desa';
        $data['child'] = 'umkm';
		$data['grand_child'] = '';
		$data['data_utama'] =  $this->Main_model->getSelectedData('umkm a', 'a.*', array('md5(a.id_umkm)'=>$this->uri->segment(2)))->row();
		$data['foto_produk'] = $this->Main_model->getSelectedData('foto_produk_umkm a', 'a.*', array('md5(a.id_umkm)'=>$this->uri->segment(2)))->result();
		$this->load->view('desktop/template/header',$data);
		$this->load->view('desktop/master/detail_umkm',$data);
		$this->load->view('desktop/template/footer');
	}
	public function perbarui_umkm(){
		$this->db->trans_start();
		$data_utama =  $this->Main_model->getSelectedData('umkm a', 'a.*', array('md5(a.id_umkm)'=>$this->input->post('id')))->row();
		$namafile = '';
		$nmfile = "file_".time().random_string('alnum', 6); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'; // path folder
		$config['allowed_types'] = 'bmp|png|jpg|jpeg'; // type yang dapat diakses bisa anda sesuaikan
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
				$url_file = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'.$gbr['file_name'];
				$imageData = base64_encode(file_get_contents($url_file));
				$namafile = 'data:'.mime_content_type($url_file).';base64,'.$imageData;
				$data_insert2 = array(
					'id_umkm' => $data_utama->id_umkm,
					'file' => $namafile
				);
				$this->Main_model->insertData('foto_produk_umkm',$data_insert2);
				unlink($url_file);
			}
		}else{echo'';}
		$namafile_foto = $data_utama->pemilik;
		$nmfile = "file_".time().random_string('alnum', 6); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'; // path folder
		$config['allowed_types'] = 'bmp|png|jpg|jpeg'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya
		$this->upload->initialize($config);
		if(isset($_FILES['foto']['name']))
		{
			if(!$this->upload->do_upload('foto'))
			{
				echo'';
			}
			else
			{
				$gbr_foto = $this->upload->data();
				$url_file_foto = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/umkm/'.$gbr_foto['file_name'];
				$imageData_foto = base64_encode(file_get_contents($url_file_foto));
				$namafile_foto = 'data:'.mime_content_type($url_file_foto).';base64,'.$imageData_foto;
				unlink($url_file_foto);
			}
		}else{echo'';}
		$data_insert1 = array(
			'nama' => $this->input->post('nama'),
			'jenis' => $this->input->post('jenis'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'pemilik' => $namafile_foto
		);
		$this->Main_model->updateData('umkm',$data_insert1,array('md5(id_umkm)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data UMKM (".$this->input->post('nama')." - ".$this->input->post('jenis').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diperbarui.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_umkm/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diperbarui.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_umkm/".$this->input->post('id')."'</script>";
		}
	}
	public function hapus_gambar_produk_umkm(){
		$this->db->trans_start();
		$id = '';
		$id_umkm = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('foto_produk_umkm a', 'a.*,b.nama',array('md5(a.id_foto_produk_umkm)'=>$this->uri->segment(3)), '', '', '', '', array(
			'table' => 'umkm b',
			'on' => 'a.id_umkm=b.id_umkm',
			'pos' => 'LEFT'
		))->row();
		$id = $get_data->id_foto_produk_umkm;
		$nama = $get_data->nama;
		$id_umkm = md5($get_data->id_umkm);

		$this->Main_model->deleteData('foto_produk_umkm',array('id_foto_produk_umkm'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data foto produk UMKM (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_umkm/".$id_umkm."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."detail_umkm/".$id_umkm."'</script>";
		}
	}
	public function hapus_umkm(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('umkm a', 'a.*',array('md5(a.id_umkm)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_umkm;
		$nama = $get_data->nama;

		$this->Main_model->deleteData('umkm',array('id_umkm'=>$id));
		$this->Main_model->deleteData('foto_produk_umkm',array('id_umkm'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data UMKM (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."umkm/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."umkm/'</script>";
		}
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
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
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
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
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
		elseif($this->input->post('modul')=='modul_detail_file_ppid'){
			$data = $this->Main_model->getSelectedData('ppid a', 'a.*', array('md5(a.id_ppid)'=>$this->input->post('id')))->row();
			echo'<iframe src="'.base_url().'data_upload/ppid/'.$data->file.'" width="100%" height="500px"></iframe>';
		}
	}
}