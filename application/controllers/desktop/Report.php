<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    /* Pengantar Kematian */
    public function pengantar_kematian(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_kematian';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/pengantar_kematian',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_kematian(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nomor_surat'] = $value->nomor_surat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $isi['waktu'] = $this->Main_model->convert_tanggal($value->tanggal_meninggal);
            $isi['aksi'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_pengajuan_kematian/'.md5($value->id_surat_pengantar_kematian).'"> Detail Data
            </a>';
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
        $data['child'] = 'pengantar_kematian';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*', array('md5(a.id_surat_pengantar_kematian)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detail_pengajuan_kematian',$data);
        $this->load->view('desktop/template/footer');
    }
    public function tambah_pengantar_kematian(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_kematian';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_pengantar_kematian',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_kematian(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('data_kk','id_data_kk');
        $newid = $get_last['id_data_kk']+1;
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
		
		$isi_qr = base_url().'scan_surat/kematian~'.md5($newid);

		$params['data'] = $isi_qr; // data yang akan di jadikan QR CODE
		$params['level'] = 'H'; // H=High
		$params['size'] = 15;
		$params['savename'] = FCPATH.$config_qr_code['imagedir'].$image_name_qr_code; // simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $nama_file = base_url().'data_upload/dokumen/'.$newid.'kematian'.$cur_date.'.pdf';

        $data_insert = array(
            'id_surat_pengantar_kematian' => $newid,
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
            'file' => $nama_file,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('surat_pengantar_kematian',$data_insert);
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';
        $data_insert['gambar_qr'] = '<img src="'.base_url().'data_upload/dokumen_qr/'.$image_name_qr_code.'" width="10%"/>';
        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/kematian', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$newid.'kematian'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Surat Pengantar Kematian',
            'file' => base_url().'data_upload/dokumen/'.$newid.'kematian'.$cur_date.'.pdf',
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat surat keterangan kematian (".$this->input->post('pelapor').")");
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_pengantar_kematian'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
            // echo "<script>window.location='".base_url()."detail_pengajuan_kematian/".md5($newid)."'</script>";
            $this->load->view('desktop/form_pdf/kematian', $data_insert);
        }
    }
    /* Data KK */
    public function data_kk(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/data_kk',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_kk(){
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('a.created_by'=>'2'), 'a.id_data_kk DESC', '', '', '', array(
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
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['action'] =	'
                            <div class="btn-group" style="text-align: center;">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="'.site_url('detil_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
                                            <i class="icon-action-redo"></i> Detail Data </a>
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
    public function tambah_data_kk(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_data_kk',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_permohonan_kk(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('data_kk','id_data_kk');
        $namafile = ($get_last['id_data_kk']+1).date('YmdHis').'data_kk.pdf';
        $data_insert = array(
            'id_data_kk' => $get_last['id_data_kk']+1,
            'nama' => $this->input->post('nama'),
            'kk' => $this->input->post('kk'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'alamat' => $this->input->post('alamat'),
            'dusun' => $this->input->post('dusun'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('data_kk',$data_insert);
        // print_r($data_insert);
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('L'); // margin footer
        $data = $this->load->view('admin/form_pdf/permohonan_kk', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$namafile;
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Permohonan KK',
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat Pengajuan Cetak KK ");
        
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_data_kk/'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            // echo "<script>window.location='".base_url()."permohonan_kk/'</script>";
            $this->load->view('desktop/form_pdf/permohonan_kk', $data_insert);
        }
    }
    public function detil_data_pengajuan_kk(){
		$data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->uri->segment(2)), 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'user b',
            'on' => 'a.created_by=b.id',
            'pos' => 'LEFT'
        ))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detil_data_pengajuan_kk',$data);
        $this->load->view('desktop/template/footer');
    }
    public function ubah_pengajuan_kk(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_kk',$data);
        $this->load->view('desktop/template/footer');
    }
    public function hapus_data_pengajuan_kk(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*',array('md5(a.id_data_kk)'=>$this->uri->segment(2)))->row();
		$id = $get_data->id_data_kk;
		if($get_data->sub_jenis_permohonan==NULL){
            $keterangan = $get_data->jenis_permohonan;
        }else{
            $keterangan = $get_data->jenis_permohonan.' - '.$get_data->sub_jenis_permohonan;
        }

		$this->Main_model->deleteData('data_kk',array('id_data_kk'=>$id));
		$this->Main_model->deleteData('detail_data_kk',array('id_data_kk'=>$id));

		$this->Main_model->log_activity('2',"Deleting data","Menghapus data permohonan KK (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."data_kk/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."data_kk/'</script>";
		}
    }
    public function perbarui_pengajuan_kk(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'KK'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'kk' => $this->input->post('kk'),
            'dusun' => $this->input->post('dusun'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('data_kk',$data_insert,array('md5(id_data_kk)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
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
            echo "<script>window.location='".base_url()."ubah_pengajuan_kk/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detil_data_pengajuan_kk/".$this->input->post('id')."'</script>";
        }
    }
    /* Data KTP */
    public function data_ktp(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_ktp';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/data_ktp',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_ktp(){
		$get_data1 = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['nik'] = $value->nik;
			$isi['nama'] = $value->nama;
            $isi['jenis'] = $value->permohonan_ktp;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['file'] = '<a class="detaildata" id="'.md5($value->id_permohonan_ktp).'">Lihat File</a>';
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function tambah_permohonan_ktp(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_ktp';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_permohonan_ktp',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_permohonan_ktp(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('permohonan_ktp','id_permohonan_ktp');
        $namafile = ($get_last['id_permohonan_ktp']+1).'_permohonan_ktp.pdf';
        $data_insert = array(
            'id_permohonan_ktp' => $get_last['id_permohonan_ktp']+1,
            'nama' => $this->input->post('nama'),
            'permohonan_ktp' => $this->input->post('tipe'),
            'nik' => $this->input->post('nik'),
            'kk' => $this->input->post('kk'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'alamat' => $this->input->post('alamat'),
            'kode_pos' => $this->input->post('pos'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('permohonan_ktp',$data_insert);
        // print_r($data_insert);
        $baru = '';
        $perpanjangan = '';
        $penggantian = '';
        if($this->input->post('tipe')=='Baru'){
            $baru = 'X';
        }elseif($this->input->post('tipe')=='Perpanjangan'){
            $perpanjangan = 'X';
        }elseif($this->input->post('tipe')=='Penggantian'){
            $penggantian = 'X';
        }else{
            echo'';
        }
        $data_insert_pdf = array(
            'id_permohonan_ktp' => $get_last['id_permohonan_ktp']+1,
            'nama' => $this->input->post('nama'),
            'baru' => $baru,
            'perpanjangan' => $perpanjangan,
            'penggantian' => $penggantian,
            'nik' => $this->input->post('nik'),
            'kk' => $this->input->post('kk'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'alamat' => $this->input->post('alamat'),
            'kode_pos' => $this->input->post('pos'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        // print_r($data_insert_pdf);
        
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/permohonan_ktp', $data_insert_pdf, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$namafile;
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Permohonan KTP',
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat Pengajuan Cetak KTP ");
        
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_permohonan_ktp/'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            // echo "<script>window.location='".base_url()."permohonan_ktp/'</script>";
            $this->load->view('desktop/form_pdf/permohonan_ktp', $data_insert_pdf);
        }
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
            echo "<script>window.location='".base_url()."data_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."data_ktp/'</script>";
        }
    }
    public function ubah_status_tercetak(){
        $this->db->trans_start();
        $data_insert1 = array(
            'status' => 'Tercetak'
        );
        $this->Main_model->updateData('data_ktp',$data_insert1,array('md5(id_data_ktp)'=>$this->uri->segment(2)));
        // print_r($data_insert1);
        $this->Main_model->deleteData('antrean_ktp',array('md5(id_data_ktp)'=>$this->uri->segment(2)));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."data_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."data_ktp/'</script>";
        }
    }
    public function ubah_pengajuan_ktp(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'permohonan_ktp';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', array('md5(a.id_permohonan_ktp)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_ktp',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_ktp(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'ktp'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'permohonan_ktp' => $this->input->post('permohonan_ktp'),
            'kk' => $this->input->post('kk'),
            'nik' => $this->input->post('nik'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => $nama_file
        );
        $this->Main_model->updateData('permohonan_ktp',$data_insert,array('md5(id_permohonan_ktp)'=>$this->input->post('id')));
        // print_r($data_insert);
        // Composer Autoloader
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'ktp'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan KTP (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_ktp/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_pengajuan_ktp/".$this->input->post('id')."'</script>";
        }
    }
    /* Keterangan Domisili */
    public function pengantar_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/pengajuan_surat_keterangan_domisili',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_domisili(){
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['alamat'] = $value->alamat;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['aksi'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_surat_keterangan_domisili/'.md5($value->id_surat_keterangan_domisili).'"> Detail Data
            </a>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function tambah_data_keterangan_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_data_keterangan_domisili',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_permohonan_domisili(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('surat_keterangan_domisili','id_surat_keterangan_domisili');
        $namafile = ($get_last['id_surat_keterangan_domisili']+1).'surat_keterangan_domisili'.date('YmdHis').'.pdf';
        $data_insert = array(
            'id_surat_keterangan_domisili' => $get_last['id_surat_keterangan_domisili']+1,
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'kebangsaan' => $this->input->post('kebangsaan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'keperluan' => $this->input->post('keperluan'),
            'keterangan' => $this->input->post('keterangan'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('surat_keterangan_domisili',$data_insert);
        // print_r($data_insert);
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_domisili', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$namafile;
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Surat Keterangan Domisili',
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat Pengajuan Surat Keterangan Domisili");
        
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_data_keterangan_domisili/'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            // echo "<script>window.location='".base_url()."pengantar_domisili/'</script>";
            $this->load->view('desktop/form_pdf/keterangan_domisili', $data_insert);
        }
    }
    public function detail_surat_keterangan_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('md5(a.id_surat_keterangan_domisili)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detail_surat_keterangan_domisili',$data);
        $this->load->view('desktop/template/footer');
    }
    public function ubah_pengajuan_domisili(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'pengantar_domisili';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('md5(a.id_surat_keterangan_domisili)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_domisili',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_domisili(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'domisili'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
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
        $data = $this->load->view('admin/form_pdf/keterangan_domisili', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'domisili'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan keterangan domisili (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_domisili/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_surat_keterangan_domisili/".$this->input->post('id')."'</script>";
        }
    }
    /* Keterangan Usaha */
    public function surat_keterangan_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/keterangan_usaha',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_surat_keterangan_usaha(){
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['usaha'] = $value->nama_usaha;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['aksi'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_surat_keterangan_usaha/'.md5($value->id_surat_keterangan_usaha).'"> Detail Data
            </a>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function tambah_data_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_data_usaha',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_permohonan_usaha(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('surat_keterangan_usaha','id_surat_keterangan_usaha');
        $namafile = ($get_last['id_surat_keterangan_usaha']+1).'surat_keterangan_usaha'.date('YmdHis').'.pdf';
        $data_insert = array(
            'id_surat_keterangan_usaha' => $get_last['id_surat_keterangan_usaha']+1,
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'nama_usaha' => $this->input->post('nama_usaha'),
            'jenis_usaha' => $this->input->post('jenis_usaha'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('surat_keterangan_usaha',$data_insert);
        // print_r($data_insert);
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_usaha', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$namafile;
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Surat Keterangan Usaha',
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat Pengajuan Surat Keterangan Usaha");
        
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_data_usaha/'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            // echo "<script>window.location='".base_url()."surat_keterangan_usaha/'</script>";
            $this->load->view('desktop/form_pdf/keterangan_usaha', $data_insert);
        }
    }
    public function detail_surat_keterangan_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('md5(a.id_surat_keterangan_usaha)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detail_surat_keterangan_usaha',$data);
        $this->load->view('desktop/template/footer');
    }
    public function ubah_pengajuan_usaha(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'surat_keterangan_usaha';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('md5(a.id_surat_keterangan_usaha)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_usaha',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_usaha(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'usaha'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
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

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_usaha', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'usaha'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan ijin usaha (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_usaha/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_surat_keterangan_usaha/".$this->input->post('id')."'</script>";
        }
    }
    /* SKTM */
    public function sktm(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/sktm',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_sktm_umum(){
		$get_data = $this->Main_model->getSelectedData('sktm a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nik'] = $value->nik;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['action'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_sktm/'.md5($value->id_sktm).'/1"> Detail Data
            </a>';
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
		$get_data = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['nik'] = $value->nik;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['action'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_sktm/'.md5($value->id_sktm_pendidikan).'/2"> Detail Data
            </a>';
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
        if($this->uri->segment(3)=='1'){
            $data['data_utama'] = $this->Main_model->getSelectedData('sktm a', 'a.*', array('md5(a.id_sktm)'=>$this->uri->segment(2)))->row();
            $this->load->view('desktop/template/header',$data);
            $this->load->view('desktop/report/detail_sktm',$data);
            $this->load->view('desktop/template/footer');
        }elseif($this->uri->segment(3)=='2'){
            $data['data_utama'] = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('md5(a.id_sktm_pendidikan)'=>$this->uri->segment(2)))->row();
            $this->load->view('desktop/template/header',$data);
            $this->load->view('desktop/report/detail_sktm_pendidikan',$data);
            $this->load->view('desktop/template/footer');
        }else{
            redirect('sktm');
        }
    }
    public function ubah_pengajuan_sktm_umum(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('sktm a', 'a.*', array('md5(a.id_sktm)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_sktm_umum',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_sktm_umum(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'sktm_umum'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
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

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/sktm', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sktm_umum'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan SKTM (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_sktm_umum/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_sktm/".$this->input->post('id')."/1'</script>";
        }
    }
    public function ubah_pengajuan_sktm_pendidikan(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sktm';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('md5(a.id_sktm_pendidikan)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_sktm_pendidikan',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_sktm_pendidikan(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'sktm_pendidikan'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
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

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/sktm_sekolah', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sktm_pendidikan'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan SKTM Pendidikan (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_sktm_pendidikan/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_sktm/".$this->input->post('id')."/2'</script>";
        }
    }
    /* SIM */
    public function sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/sim',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_sim(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['aksi'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_pengajuan_sim/'.md5($value->id_surat_pengantar_sim).'"> Detail Data
            </a>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function tambah_data_sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_data_sim',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_permohonan_sim(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('surat_pengantar_sim','id_surat_pengantar_sim');
        $namafile = ($get_last['id_surat_pengantar_sim']+1).'keterangan_sim'.date('YmdHis').'.pdf';
        $data_insert = array(
            'id_surat_pengantar_sim' => $get_last['id_surat_pengantar_sim']+1,
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('surat_pengantar_sim',$data_insert);
        // print_r($data_insert);
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_sim', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$namafile;
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Surat Pengantar SIM',
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat Pengajuan Surat Pengantar SIM");
        
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_data_sim/'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            // echo "<script>window.location='".base_url()."sim/'</script>";
            $this->load->view('desktop/form_pdf/keterangan_sim', $data_insert);
        }
    }
    public function detail_pengajuan_sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('md5(a.id_surat_pengantar_sim)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detail_pengajuan_sim',$data);
        $this->load->view('desktop/template/footer');
    }
    public function ubah_pengajuan_sim(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'sim';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('md5(a.id_surat_pengantar_sim)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_sim',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_sim(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'sim'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
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

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_sim', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sim'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan SIM (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_sim/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_pengajuan_sim/".$this->input->post('id')."'</script>";
        }
    }
    /* SKCK */
    public function skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/skck',$data);
        $this->load->view('desktop/template/footer');
    }
    public function json_skck(){
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('a.created_by'=>'2'), 'a.created_at DESC')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->nama;
            $isi['rtrw'] = $value->rt.'/ '.$value->rw;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tanggal_lahir);
            $pecah_tanggal = explode(' ',$value->created_at);
            $isi['waktu'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $isi['aksi'] =	'
            <a class="btn btn-xs green" type="button" href="'.base_url().'detail_pengajuan_skck/'.md5($value->id_surat_pengantar_skck).'"> Detail Data
            </a>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
    }
    public function tambah_data_skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/tambah_data_skck',$data);
        $this->load->view('desktop/template/footer');
    }
    public function simpan_permohonan_skck(){
        $this->db->trans_start();
        $get_last = $this->Main_model->getLastID('surat_pengantar_skck','id_surat_pengantar_skck');
        $namafile = ($get_last['id_surat_pengantar_skck']+1).'surat_pengantar_skck'.date('YmdHis').'.pdf';
        $data_insert = array(
            'id_surat_pengantar_skck' => $get_last['id_surat_pengantar_skck']+1,
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'agama' => $this->input->post('agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('surat_pengantar_skck',$data_insert);
        // print_r($data_insert);
        require FCPATH . 'vendor/autoload.php';

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_skck', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$namafile;
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $datainsert = array(
            'form' => 'Surat Pengantar SKCK',
            'file' => base_url().'data_upload/dokumen/'.$namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('riwayat_administrasi',$datainsert);
        // print_r($datainsert);

        $this->Main_model->log_activity('2','Adding data',"Membuat Pengajuan Surat Pengantar SKCK");
        
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."tambah_data_skck/'</script>";
        }
        else{
            // $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            // echo "<script>window.location='".base_url()."skck/'</script>";
            $this->load->view('desktop/form_pdf/keterangan_skck', $data_insert);
        }
    }
    public function detail_pengajuan_skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('md5(a.id_surat_pengantar_skck)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detail_pengajuan_skck',$data);
        $this->load->view('desktop/template/footer');
    }
    public function ubah_pengajuan_skck(){
        $data['parent'] = 'laporan_masyarakat';
        $data['child'] = 'skck';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('md5(a.id_surat_pengantar_skck)'=>$this->uri->segment(2)))->row();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/ubah_pengajuan_skck',$data);
        $this->load->view('desktop/template/footer');
    }
    public function perbarui_pengajuan_skck(){
        $this->db->trans_start();
        $cur_date = date('YmdHis');
        $nama_file = base_url().'data_upload/dokumen/'.$this->input->post('id').'skck'.$cur_date.'.pdf';

        $data_insert = array(
            'nama' => $this->input->post('nama'),
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

        require_once BASEPATH.'core/CodeIgniter.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('admin/form_pdf/keterangan_skck', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'skck'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity('2',"Updating data","Mengubah data pengajuan SKCK (".$this->input->post('nama').")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."ubah_pengajuan_skck/".$this->input->post('id')."'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."detail_pengajuan_skck/".$this->input->post('id')."'</script>";
        }
    }
    /* Other Function */
    public function scan_surat(){
        $pecah_string = explode('~',$this->uri->segment(2));
        if($pecah_string[0]=='sim'){
            $data['judul'] = 'Surat Pengantar SIM';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('md5(a.id_surat_pengantar_sim)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='kk'){
            $data['judul'] = 'Surat Pengantar KK';
            $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='ktp'){
            $data['judul'] = 'Surat Pengantar KTP';
            $data['data_utama'] = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', array('md5(a.id_permohonan_ktp)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='domisili'){
            $data['judul'] = 'Surat Keterangan Domisili';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('md5(a.id_surat_keterangan_domisili)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='usaha'){
            $data['judul'] = 'Surat Keterangan Usaha';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('md5(a.id_surat_keterangan_usaha)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='sktm_umum'){
            $data['judul'] = 'Surat Pengantar SKTM';
            $data['data_utama'] = $this->Main_model->getSelectedData('sktm a', 'a.*', array('md5(a.id_sktm)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='sktm_pendidikan'){
            $data['judul'] = 'Surat Pengantar SKTM Pendidikan';
            $data['data_utama'] = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('md5(a.id_sktm_pendidikan)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='skck'){
            $data['judul'] = 'Surat Pengantar SKCK';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('md5(a.id_surat_pengantar_skck)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='kematian'){
            $data['judul'] = 'Surat Pengantar Kematian';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar_kematian a', 'a.*', array('md5(a.id_surat_pengantar_kematian)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='surat_keterangan_pindah'){
            $data['judul'] = 'Pengajuan Surat Keterangan Pindah';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_keterangan_pindah a', 'a.*', array('md5(a.id_surat_keterangan_pindah)'=>$pecah_string[1]))->row();
        }elseif($pecah_string[0]=='surat_pengantar'){
            $data['judul'] = 'Pengajuan Surat Keterangan/ Pengantar';
            $data['data_utama'] = $this->Main_model->getSelectedData('surat_pengantar a', 'a.*', array('md5(a.id_surat_pengantar)'=>$pecah_string[1]))->row();
        }else{
            echo'';
        }
        $this->load->view('desktop/report/scan_surat',$data);
    }
    public function form_test(){
        $data = array(
            'nama' => 'hX',
            'alamat' => 'tX',
            'rt' => '2',
            'rw' => '2',
            'dusun' => 'Xv',
            'kk' => 'mX'
        );
        $this->load->view('admin/form_pdf/nikah',$data);
    }
	public function ajax_function(){
		if($this->input->post('modul')=='modul_ubah_data_status_antrean_ktp'){
            $get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*', array('md5(a.id_data_ktp)'=>$this->input->post('id')))->row();
            $waktu = explode(' ',$get_data1->created_date);
            echo'
            <form role="form" class="form-horizontal" action="'.base_url('perbarui_data_antrean_ktp').'" method="post" >
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
            <form role="form" class="form-horizontal" action="'.base_url('perbarui_data_antrean_kk').'" method="post" >
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