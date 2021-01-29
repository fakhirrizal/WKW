<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    public function qr()
	{
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/photo_profile/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code="qr_code_".time().'.png';
		
		$isi_qr = 2;

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }
    /* Pemberitahuan */
    public function pemberitahuan(){
		$data['parent'] = 'master';
        $data['child'] = 'pemberitahuan';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/pemberitahuan',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_pemberitahuan(){
		$get_data = $this->Main_model->getSelectedData('pemberitahuan a', 'a.*', '', 'a.id_pemberitahuan DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$isi['deskripsi'] = $value->deskripsi;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_pemberitahuan/'.md5($value->id_pemberitahuan)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_pemberitahuan/'.md5($value->id_pemberitahuan)).'">
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
	public function tambah_pemberitahuan(){
		$data['parent'] = 'master';
        $data['child'] = 'pemberitahuan';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/tambah_pemberitahuan',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_pemberitahuan(){
        $this->db->trans_start();
        $get_last_id = $this->Main_model->getLastID('pemberitahuan','id_pemberitahuan');
		$nmfile = "pemberitahuan_file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
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
                    'id_pemberitahuan' => $get_last_id['id_pemberitahuan']+1,
                    'judul' => $this->input->post('judul'),
                    'deskripsi' => $this->input->post('isi'),
                    'gambar' => $gbr['file_name']
                );
                $this->Main_model->insertData("pemberitahuan",$data_insert_);
			}
		}else{echo'';}
        $body = array(
			"title" => "Pemberitahuan Terbaru",
			"body" => $this->input->post('judul')
		);
		$res = array(
			"click_action" => "FLUTTER_NOTIFICATION_CLICK",
			"id" => $get_last_id['id_pemberitahuan']+1,
			"route" => "/pemberitahuan",
			"icon" => "images/icon_wkw.png"
		);
		$get_user = $this->db->query("SELECT a.* FROM user a WHERE a.verification_token != ''")->result();
		foreach ($get_user as $key => $value) {
			$fields = array(
				'to' => $value->verification_token,
				'notification' => $body,
				"priority"=> "high",
				'data' => $res
			);
			$this->Main_model->sendPushNotificationn($fields);
		}

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data pemberitahuan",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemberitahuan'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemberitahuan/'</script>";
		}
	}
	public function detail_pemberitahuan(){
		$data['parent'] = 'master';
        $data['child'] = 'pemberitahuan';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('pemberitahuan a', 'a.*',array('md5(a.id_pemberitahuan)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pemberitahuan',$data);
        $this->load->view('admin/template/footer');
	}
	public function perbarui_pemberitahuan(){
        $this->db->trans_start();
        $nmfile = "pemberitahuan_file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
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
					'gambar' => $gbr['file_name']
				);
				$this->Main_model->updateData('pemberitahuan',$data_insert_1,array('md5(id_pemberitahuan)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert_2 = array(
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('isi')
		);
		$this->Main_model->updateData('pemberitahuan',$data_insert_2,array('md5(id_pemberitahuan)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data pemberitahuan (".$this->input->post('judul').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemberitahuan'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemberitahuan/'</script>";
		}
	}
	public function hapus_pemberitahuan(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('pemberitahuan a', 'a.*',array('md5(a.id_pemberitahuan)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_pemberitahuan;
		$nama = $get_data->judul;

		$this->Main_model->deleteData('pemberitahuan',array('id_pemberitahuan'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data pemberitahuan (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemberitahuan/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pemberitahuan/'</script>";
		}
	}
    /* Surat Keterangan/ Pengantar */
    public function surat_pengantar(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_pengantar';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/surat_pengantar',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_surat_pengantar(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_surat_pengantar/'.md5($value->id_surat_pengantar)).'/">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_surat_pengantar/'.md5($value->id_surat_pengantar)).'">
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
    public function detail_surat_pengantar(){
		$data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_pengantar';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar a', 'a.*', array('md5(a.id_surat_pengantar)'=>$this->uri->segment(3)), 'a.id_surat_pengantar DESC', '', '', '', array(
            'table' => 'user b',
            'on' => 'a.created_by=b.id',
            'pos' => 'LEFT'
        ))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_surat_pengantar',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_surat_pengantar(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_pengantar';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar a', 'a.*', array('md5(a.id_surat_pengantar)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_surat_pengantar',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_surat_pengantar(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_surat_pengantar_".time().'.png';
		
		$isi_qr = 'surat_pengantar~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'surat_pengantar'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'keperluan' => $this->input->post('keperluan'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'agama' => $this->input->post('agama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_pengantar',$data_insert,array('md5(id_surat_pengantar)'=>$this->input->post('id')));
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('L'); // margin footer
        $data = $this->load->view('admin/form_pdf/surat_pengantar', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'surat_pengantar'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan surat pengantar/ keterangan (".$this->input->post('nama').")");
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_surat_pengantar/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_surat_pengantar/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_surat_pengantar(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_pengantar a', 'a.*',array('md5(a.id_surat_pengantar)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_pengantar;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_pengantar',array('id_surat_pengantar'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data surat keterangan pindah (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/surat_pengantar/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/surat_pengantar/'</script>";
		}
    }
    /* Surat Keterangan Pindah */
    public function surat_keterangan_pindah(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_pindah';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/surat_keterangan_pindah',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_surat_keterangan_pindah(){
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_pindah a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $pisah_nama = explode(';',$value->nama);
            $isi['nama'] = $pisah_nama[0];
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $pisah_tanggal_lahir = explode(';',$value->tanggal_lahir);
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($pisah_tanggal_lahir[0]);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_surat_keterangan_pindah/'.md5($value->id_surat_keterangan_pindah)).'/">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_surat_keterangan_pindah/'.md5($value->id_surat_keterangan_pindah)).'">
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
    public function detail_surat_keterangan_pindah(){
		$data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_pindah';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_pindah a', 'a.*', array('md5(a.id_surat_keterangan_pindah)'=>$this->uri->segment(3)), 'a.id_surat_keterangan_pindah DESC', '', '', '', array(
            'table' => 'user b',
            'on' => 'a.created_by=b.id',
            'pos' => 'LEFT'
        ))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_surat_keterangan_pindah',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_surat_keterangan_pindah(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_pindah';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_pindah a', 'a.*', array('md5(a.id_surat_keterangan_pindah)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_surat_keterangan_pindah',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_surat_keterangan_pindah(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_surat_keterangan_pindah_".time().'.png';
		
		$isi_qr = 'surat_keterangan_pindah~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'surat_keterangan_pindah'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'pendidikan' => $this->input->post('pendidikan'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'agama' => $this->input->post('agama'),
            'status_perkawinan' => $this->input->post('status_perkawinan'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'desa_pindah' => $this->input->post('desa_pindah'),
            'kecamatan_pindah' => $this->input->post('kecamatan_pindah'),
            'kabkota_pindah' => $this->input->post('kabkota_pindah'),
            'provinsi_pindah' => $this->input->post('provinsi_pindah'),
            'tanggal_pindah' => $this->input->post('tanggal_pindah'),
            'alasan_pindah' => $this->input->post('alasan_pindah'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_keterangan_pindah',$data_insert,array('md5(id_surat_keterangan_pindah)'=>$this->input->post('id')));
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('L'); // margin footer
        $data = $this->load->view('admin/form_pdf/surat_keterangan_pindah', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'surat_keterangan_pindah'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan surat keterangan pindah (".$this->input->post('nama').")");
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_surat_keterangan_pindah/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_surat_keterangan_pindah/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_surat_keterangan_pindah(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_pindah a', 'a.*',array('md5(a.id_surat_keterangan_pindah)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_keterangan_pindah;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_keterangan_pindah',array('id_surat_keterangan_pindah'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data surat keterangan pindah (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/surat_keterangan_pindah/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/surat_keterangan_pindah/'</script>";
		}
    }
    /* Data KK */
    public function data_kk(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_kk';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/data_kk',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_kk(){
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*', '', 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'masyarakat b',
            'on' => 'a.created_by=b.user_id',
            'pos' => 'LEFT'
        ))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['kk'] = $value->kk;
            $isi['alamat'] = $value->alamat;
            $isi['nomor_surat'] = $value->nomor_surat;
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['action'] =	'
                            <div class="btn-group" style="text-align: center;">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="'.site_url('admin_side/detil_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
                                            <i class="icon-action-redo"></i> Detail Data </a>
                                    </li>
                                    <li>
                                        <a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
                                            <i class="icon-trash"></i> Hapus Data </a>
                                    </li>
                                </ul>
                            </div>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function detil_data_pengajuan_kk(){
		$data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_kk';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->uri->segment(3)), 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'user b',
            'on' => 'a.created_by=b.id',
            'pos' => 'LEFT'
        ))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detil_data_pengajuan_kk',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_pengajuan_kk(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_kk';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_kk',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_kk(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_kk_".time().'.png';
		
		$isi_qr = 'kk~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'KK'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'kk' => $this->input->post('kk'),
            'dusun' => $this->input->post('dusun'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('data_kk',$data_insert,array('md5(id_data_kk)'=>$this->input->post('id')));
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('L'); // margin footer
        $data = $this->load->view('admin/form_pdf/permohonan_kk', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'KK'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan KK (".$this->input->post('nama').")");
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_kk/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detil_data_pengajuan_kk/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_data_pengajuan_kk(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*',array('md5(a.id_data_kk)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_data_kk;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('data_kk',array('id_data_kk'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan KK (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/permohonan_kk/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/permohonan_kk/'</script>";
		}
    }
    /* Permohonan Informasi */
    public function permohonan_informasi(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_informasi';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/permohonan_informasi',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_permohonan_informasi(){
		$get_data1 = $this->Main_model->getSelectedData('permohonan_informasi a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
            $isi['kategori'] = $value->kategori;
            $isi['alamat'] = $value->alamat;
			$isi['nama'] = $value->nama;
            $isi['tujuan'] = $value->tujuan;
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
                            <div class="btn-group" style="text-align: center;">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="'.site_url('admin_side/detail_permohonan_informasi/'.md5($value->id_permohonan_informasi)).'">
                                            <i class="icon-action-redo"></i> Detail Data </a>
                                    </li>
                                    <li>
                                        <a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_permohonan_informasi/'.md5($value->id_permohonan_informasi)).'">
                                            <i class="icon-trash"></i> Hapus Data </a>
                                    </li>
                                </ul>
                            </div>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function detail_permohonan_informasi(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('permohonan_informasi a', 'a.*', array('md5(a.id_permohonan_informasi)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_permohonan_informasi',$data);
        $this->load->view('admin/template/footer');
    }
    public function hapus_permohonan_informasi(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('permohonan_informasi a', 'a.*',array('md5(a.id_permohonan_informasi)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_permohonan_informasi;
		$keterangan = $get_data->nama;

		$this->Main_model->deleteData('permohonan_informasi',array('id_permohonan_informasi'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan informasi yang diajukan oleh ".$keterangan,$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/permohonan_informasi/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/permohonan_informasi/'</script>";
		}
    }
    /* Data KTP */
    public function data_ktp(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_ktp';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/data_ktp',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_ktp(){
		$get_data1 = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
            $isi['nik'] = $value->nik;
            $isi['nomor_surat'] = $value->nomor_surat;
			$isi['nama'] = $value->nama;
            $isi['jenis'] = $value->permohonan_ktp;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['file'] = '<a class="detaildata" id="'.md5($value->id_permohonan_ktp).'">Lihat File</a>';
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
                            <div class="btn-group" style="text-align: center;">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="'.site_url('admin_side/ubah_pengajuan_ktp/'.md5($value->id_permohonan_ktp)).'">
                                            <i class="icon-action-redo"></i> Detail Data </a>
                                    </li>
                                    <li>
                                        <a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_ktp/'.md5($value->id_permohonan_ktp)).'">
                                            <i class="icon-trash"></i> Hapus Data </a>
                                    </li>
                                </ul>
                            </div>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function perbarui_data_antrean_ktp(){
        $this->db->trans_start();
        if($this->input->post('status')=='Masuk Antrean'){
            $data_insert1 = array(
                'status' => $this->input->post('status')
            );
            $this->Main_model->updateData('data_ktp',$data_insert1,array('id_data_ktp'=>$this->input->post('id_data_ktp')));
            // print_r($data_insert1);
            $data_insert2 = array(
				'id_data_ktp' => $this->input->post('id_data_ktp')
			);
            $this->Main_model->insertData('antrean_ktp',$data_insert2);
            // print_r($data_insert2);
        }
        else{
            $data_insert1 = array(
                'status' => $this->input->post('status')
            );
            $this->Main_model->updateData('data_ktp',$data_insert1,array('id_data_ktp'=>$this->input->post('id_data_ktp')));
            // print_r($data_insert1);
        }
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
    }
    public function ubah_status_tercetak(){
        $this->db->trans_start();
        $data_insert1 = array(
            'status' => 'Tercetak'
        );
        $this->Main_model->updateData('data_ktp',$data_insert1,array('md5(id_data_ktp)'=>$this->uri->segment(3)));
        // print_r($data_insert1);
        $this->Main_model->deleteData('antrean_ktp',array('md5(id_data_ktp)'=>$this->uri->segment(3)));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
    }
    public function ubah_pengajuan_ktp(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_ktp';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', array('md5(a.id_permohonan_ktp)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_ktp',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_ktp(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_ktp_".time().'.png';
		
		$isi_qr = base_url().'scan_surat/ktp~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'ktp'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'permohonan_ktp' => $this->input->post('permohonan_ktp'),
            'kk' => $this->input->post('kk'),
            'nik' => $this->input->post('nik'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'kode_pos' => $this->input->post('kode_pos'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('permohonan_ktp',$data_insert,array('md5(id_permohonan_ktp)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $baru = '';
        $perpanjangan = '';
        $penggantian = '';
        if($this->input->post('permohonan_ktp')=='Baru'){
            $baru = 'X';
        }elseif($this->input->post('permohonan_ktp')=='Perpanjangan'){
            $perpanjangan = 'X';
        }elseif($this->input->post('permohonan_ktp')=='Penggantian'){
            $penggantian = 'X';
        }else{
            echo'';
        }
        $data_insert['baru'] = $baru;
        $data_insert['perpanjangan'] = $perpanjangan;
        $data_insert['penggantian'] = $penggantian;
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/permohonan_ktp', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'ktp'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan KTP (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_ktp/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/permohonan_ktp/'</script>";
        }
    }
    public function hapus_data_pengajuan_ktp(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*',array('md5(a.id_permohonan_ktp)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_permohonan_ktp;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('permohonan_ktp',array('id_permohonan_ktp'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan KTP (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/permohonan_ktp/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/permohonan_ktp/'</script>";
		}
    }
    /* Keterangan Domisili */
    public function pengantar_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/pengajuan_surat_keterangan_domisili',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_domisili(){
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['alamat'] = $value->alamat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_surat_keterangan_domisili/'.md5($value->id_surat_keterangan_domisili)).'">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_domisili/'.md5($value->id_surat_keterangan_domisili)).'">
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
    public function detail_surat_keterangan_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('md5(a.id_surat_keterangan_domisili)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_surat_keterangan_domisili',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_pengajuan_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('md5(a.id_surat_keterangan_domisili)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_domisili',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_domisili(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_domisili_".time().'.png';
		
		$isi_qr = base_url().'scan_surat/domisili~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'domisili'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'kebangsaan' => $this->input->post('kebangsaan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'keperluan' => $this->input->post('keperluan'),
            'keterangan' => $this->input->post('keterangan'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_keterangan_domisili',$data_insert,array('md5(id_surat_keterangan_domisili)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        $data = $this->load->view('admin/form_pdf/keterangan_domisili', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'domisili'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan keterangan domisili (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_domisili/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_surat_keterangan_domisili/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_data_pengajuan_domisili(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*',array('md5(a.id_surat_keterangan_domisili)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_keterangan_domisili;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_keterangan_domisili',array('id_surat_keterangan_domisili'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan domisili (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pengantar_domisili/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/pengantar_domisili/'</script>";
		}
    }
    /* Keterangan Usaha */
    public function surat_keterangan_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/keterangan_usaha',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_surat_keterangan_usaha(){
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['usaha'] = $value->nama_usaha;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_surat_keterangan_usaha/'.md5($value->id_surat_keterangan_usaha)).'">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_usaha/'.md5($value->id_surat_keterangan_usaha)).'">
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
    public function detail_surat_keterangan_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('md5(a.id_surat_keterangan_usaha)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_surat_keterangan_usaha',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_pengajuan_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('md5(a.id_surat_keterangan_usaha)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_usaha',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_usaha(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_pengajuan_usaha_".time().'.png';
		
		$isi_qr =  base_url().'scan_surat/usaha~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'usaha'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'jenis_usaha' => $this->input->post('jenis_usaha'),
            'nama_usaha' => $this->input->post('nama_usaha'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_keterangan_usaha',$data_insert,array('md5(id_surat_keterangan_usaha)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_usaha', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'usaha'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan ijin usaha (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_usaha/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_surat_keterangan_usaha/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_data_pengajuan_usaha(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*',array('md5(a.id_surat_keterangan_usaha)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_keterangan_usaha;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_keterangan_usaha',array('id_surat_keterangan_usaha'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan usaha (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/surat_keterangan_usaha/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/surat_keterangan_usaha/'</script>";
		}
    }
    /* SKTM */
    public function sktm(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/sktm',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_sktm_umum(){
		$get_data = $this->Main_model->getSelectedData('sktm a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['nama'] = $value->nama;
            $isi['nik'] = $value->nik;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['action'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_sktm/'.md5($value->id_sktm)).'/1">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_sktm_umum/'.md5($value->id_sktm)).'">
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
    public function json_sktm_pelajar(){
		$get_data = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['nama'] = $value->nama;
            $isi['nik'] = $value->nik;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['action'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_sktm/'.md5($value->id_sktm_pendidikan)).'/2">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_sktm_pendidikan/'.md5($value->id_sktm_pendidikan)).'">
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
    public function detail_sktm(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        if($this->uri->segment(4)=='1'){
            $data['data_utama'] = $this->Main_model->getSelectedData('sktm a', 'a.*', array('md5(a.id_sktm)'=>$this->uri->segment(3)))->row();
            $this->load->view('admin/template/header',$data);
            $this->load->view('admin/report/detail_sktm',$data);
            $this->load->view('admin/template/footer');
        }elseif($this->uri->segment(4)=='2'){
            $data['data_utama'] = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('md5(a.id_sktm_pendidikan)'=>$this->uri->segment(3)))->row();
            $this->load->view('admin/template/header',$data);
            $this->load->view('admin/report/detail_sktm_pendidikan',$data);
            $this->load->view('admin/template/footer');
        }else{
            redirect('admin_side/sktm');
        }
    }
    public function ubah_pengajuan_sktm_umum(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('sktm a', 'a.*', array('md5(a.id_sktm)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_sktm_umum',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_sktm_umum(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_sktm_umum_".time().'.png';
		
		$isi_qr =  base_url().'scan_surat/sktm_umum~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'sktm_umum'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'nik' => $this->input->post('nik'),
            'kebangsaan' => $this->input->post('kebangsaan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('sktm',$data_insert,array('md5(id_sktm)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/sktm', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sktm_umum'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SKTM (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_sktm_umum/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_sktm/".$this->input->post('id')."/1'</script>";
        }
    }
    public function ubah_pengajuan_sktm_pendidikan(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('md5(a.id_sktm_pendidikan)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_sktm_pendidikan',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_sktm_pendidikan(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_sktm_pendidikan_".time().'.png';
		
		$isi_qr = base_url().'scan_surat/sktm_pendidikan~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'sktm_pendidikan'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'nik' => $this->input->post('nik'),
            'kebangsaan' => $this->input->post('kebangsaan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'nama_ayah' => $this->input->post('nama_ayah'),
            'nama_ibu' => $this->input->post('nama_ibu'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('sktm_pendidikan',$data_insert,array('md5(id_sktm_pendidikan)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/sktm_sekolah', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sktm_pendidikan'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SKTM Pendidikan (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_sktm_pendidikan/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_sktm/".$this->input->post('id')."/2'</script>";
        }
    }
    public function hapus_data_pengajuan_sktm_umum(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('sktm a', 'a.*',array('md5(a.id_sktm)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_sktm;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('sktm',array('id_sktm'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan SKTM (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/sktm/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/sktm/'</script>";
		}
    }
    public function hapus_data_pengajuan_sktm_pendidikan(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*',array('md5(a.id_sktm_pendidikan)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_sktm_pendidikan;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('sktm_pendidikan',array('id_sktm_pendidikan'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan SKTM (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/sktm/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/sktm/'</script>";
		}
    }
    /* SIM */
    public function sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/sim',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_sim(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_pengajuan_sim/'.md5($value->id_surat_pengantar_sim)).'/">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_sim/'.md5($value->id_surat_pengantar_sim)).'">
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
    public function detail_pengajuan_sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('md5(a.id_surat_pengantar_sim)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_pengajuan_sim',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_pengajuan_sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('md5(a.id_surat_pengantar_sim)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_sim',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_sim(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_sim_".time().'.png';
		
		$isi_qr = base_url().'scan_surat/sim~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'sim'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'nik' => $this->input->post('nik'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_pengantar_sim',$data_insert,array('md5(id_surat_pengantar_sim)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_sim', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sim'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SIM (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_sim/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_pengajuan_sim/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_data_pengajuan_sim(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*',array('md5(a.id_surat_pengantar_sim)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_pengantar_sim;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_pengantar_sim',array('id_surat_pengantar_sim'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan SIM (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/sim/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/sim/'</script>";
		}
    }
    /* SKCK */
    public function skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/skck',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_skck(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_pengajuan_skck/'.md5($value->id_surat_pengantar_skck)).'/">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_skck/'.md5($value->id_surat_pengantar_skck)).'">
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
    public function detail_pengajuan_skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('md5(a.id_surat_pengantar_skck)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_pengajuan_skck',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_pengajuan_skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('md5(a.id_surat_pengantar_skck)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_skck',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_skck(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_skck_".time().'.png';
		
		$isi_qr = base_url().'scan_surat/skck~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'skck'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'nik' => $this->input->post('nik'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_pengantar_skck',$data_insert,array('md5(id_surat_pengantar_skck)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_skck', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'skck'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SKCK (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_skck/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_pengajuan_skck/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_data_pengajuan_skck(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*',array('md5(a.id_surat_pengantar_skck)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_pengantar_skck;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_pengantar_skck',array('id_surat_pengantar_skck'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan SKCK (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/skck/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/skck/'</script>";
		}
    }
    /* Surat Kematian */
    public function kematian(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'kematian';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/kematian',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_kematian(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*', '', 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $isi['waktu'] = $this->Main_model->convert_tanggal($value->tanggal_meninggal);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['aksi'] =	'
            <div class="btn-group" >
				<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
                    <li>
                        <a  href="'.site_url('admin_side/detail_pengajuan_kematian/'.md5($value->id_surat_pengantar_kematian)).'/">
                            <i class="icon-action-redo"></i> Detail Data </a>
                    </li>
					<li>
						<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_surat_keterangan_kematian/'.md5($value->id_surat_pengantar_kematian)).'">
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
    public function detail_pengajuan_kematian(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'kematian';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*', array('md5(a.id_surat_pengantar_kematian)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detail_pengajuan_kematian',$data);
        $this->load->view('admin/template/footer');
    }
    public function ubah_pengajuan_kematian(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'kematian';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*', array('md5(a.id_surat_pengantar_kematian)'=>$this->uri->segment(3)))->row();
        $data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/ubah_pengajuan_kematian',$data);
        $this->load->view('admin/template/footer');
    }
    public function perbarui_pengajuan_kematian(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $image_name_qr_code = '';
		$config_qr_code['cacheable']	= true; // boolean, the default is true
		$config_qr_code['cachedir']		= './data_upload/dokumen_qr/'; // string, the default is application/cache/
		$config_qr_code['errorlog']		= './data_upload/dokumen_qr/'; // string, the default is application/logs/
		$config_qr_code['imagedir']		= './data_upload/dokumen_qr/'; // direktori penyimpanan qr code
		$config_qr_code['quality']		= true; // boolean, the default is true
		$config_qr_code['size']			= '3024'; // interger, the default is 1024
		$config_qr_code['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config_qr_code['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config_qr_code);

		$image_name_qr_code = "qr_code_kematian_".time().'.png';
		
		$isi_qr = base_url().'scan_surat/kematian~'.$this->input->post('id');

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'kematian'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tempat_meninggal' => $this->input->post('tempat_meninggal'),
            'tanggal_meninggal' => $this->input->post('tanggal_meninggal'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'sebab_kematian' => $this->input->post('sebab_kematian'),
            'pelapor' => $this->input->post('pelapor'),
            'hubungan_pelapor' => $this->input->post('hubungan_pelapor'),
            'rt_pelapor' => $this->input->post('rt_pelapor'),
            'rw_pelapor' => $this->input->post('rw_pelapor'),
            'desa_pelapor' => $this->input->post('desa_pelapor'),
            'kecamatan_pelapor' => $this->input->post('kecamatan_pelapor'),
            'kabupaten_pelapor' => $this->input->post('kabupaten_pelapor'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('surat_pengantar_kematian',$data_insert,array('md5(id_surat_pengantar_kematian)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $data = $this->load->view('admin/form_pdf/kematian', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'kematian'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah surat keterangan kematian (".$this->input->post('pelapor').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/ubah_pengajuan_kematian/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/detail_pengajuan_kematian/".$this->input->post('id')."'</script>";
        }
    }
    public function hapus_data_pengajuan_surat_keterangan_kematian(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*',array('md5(a.id_surat_pengantar_kematian)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_surat_pengantar_kematian;
		$keterangan = $get_data->nomor_surat;

		$this->Main_model->deleteData('surat_pengantar_kematian',array('id_surat_pengantar_kematian'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data surat pengantar kematian (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kematian/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kematian/'</script>";
		}
    }
    /* Other Function */
	public function ajax_function(){
		if($this->input->post('modul')=='modul_ubah_data_status_antrean_ktp'){
            $get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*', array('md5(a.id_data_ktp)'=>$this->input->post('id')))->row();
            $waktu = explode(' ',$get_data1->created_date);
            echo'
            <form role="form" class="form-horizontal" action="'.base_url('admin_side/perbarui_data_antrean_ktp').'" method="post" >
                <input type="hidden" name="id_data_ktp" value="'.$get_data1->id_data_ktp.'">
                <input type="hidden" name="nik" value="'.$get_data1->nik.'">
                <input type="hidden" name="keterangan" value="'.$get_data1->keterangan.'">
                <input type="hidden" name="from" value="report">
                <div class="form-body">
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">NIK</label>
                        <div class="col-md-10">
                            '.$get_data1->nik.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Nama</label>
                        <div class="col-md-10">
                            '.$get_data1->nama.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Keterangan</label>
                        <div class="col-md-10">
                            '.$get_data1->keterangan.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Waktu Pengajuan</label>
                        <div class="col-md-10">
                            '.$this->Main_model->convert_tanggal($waktu[0]).' '.substr($waktu[1],0,5).'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Status <span class="required"> * </span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <select name="status" class="form-control select2-allow-clear" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Masuk Antrean">Masuk Antrean</option>
                                    <option value="Ditolak">Ditolak</option>';
                            echo'</select>
                                <i class="icon-pin"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-actions margin-top-9">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="reset" class="btn default">Batal</button>
                            <button type="submit" class="btn blue">Perbarui</button>
                        </div>
                    </div>
                </div>
            </form>
            ';
		}
		elseif($this->input->post('modul')=='modul_ubah_data_status_antrean_kk'){
            $get_data1 = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->input->post('id')))->row();
            echo'
            <form role="form" class="form-horizontal" action="'.base_url('admin_side/perbarui_data_antrean_kk').'" method="post" >
                <input type="hidden" name="id_data_kk" value="'.md5($get_data1->id_data_kk).'">
                <input type="hidden" name="no_kk" value="'.$get_data1->no_kk.'">
                <input type="hidden" name="nama" value="'.$get_data1->nama.'">
                <input type="hidden" name="from" value="report">
                <div class="form-body">
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">NIK</label>
                        <div class="col-md-10">
                            '.$get_data1->nik.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Nomor KK</label>
                        <div class="col-md-10">
                            '.$get_data1->no_kk.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Nama</label>
                        <div class="col-md-10">
                            '.$get_data1->nama.' ('.$get_data1->jk.')
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">TTL</label>
                        <div class="col-md-10">
                            '.$get_data1->tempat_lahir.', '.$this->Main_model->convert_tanggal($get_data1->tgl_lahir).'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Status <span class="required"> * </span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <select name="status" class="form-control select2-allow-clear" required>
                                    <option value="">-- Pilih --</option>';
                                    if($get_data1->status=='Proses'){
                                        echo'<option value="Proses" selected>Proses</option>
                                            <option value="Selesai">Selesai</option>';
                                    }elseif($get_data1->status=='Selesai'){
                                        echo'<option value="Proses">Proses</option>
                                            <option value="Selesai" selected>Selesai</option>';
                                    }else{
                                        echo'<option value="Proses">Proses</option>
                                            <option value="Selesai">Selesai</option>';
                                    }
                            echo'</select>
                                <i class="icon-pin"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-actions margin-top-9">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="reset" class="btn default">Batal</button>
                            <button type="submit" class="btn blue">Perbarui</button>
                        </div>
                    </div>
                </div>
            </form>
            ';
        }
        elseif($this->input->post('modul')=='modul_file_permohonan_ktp'){
            $get_data = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', array('md5(a.id_permohonan_ktp)'=>$this->input->post('id')))->row();
            echo'<iframe height="600" width="100%" src="'.$get_data->file.'"></iframe>';
		}
	}
}