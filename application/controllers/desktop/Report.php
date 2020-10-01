<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
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
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*,b.fullname', '', 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'user_profile b',
            'on' => 'a.created_by=b.user_id',
            'pos' => 'LEFT'
        ))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->fullname;
            $jenis_permohonan = '';
            if($value->sub_jenis_permohonan==NULL){
                $jenis_permohonan = $value->jenis_permohonan;
            }else{
                $jenis_permohonan = $value->jenis_permohonan.' - '.$value->sub_jenis_permohonan;
            }
            $isi['keterangan'] = $jenis_permohonan;
            $isi['status'] = '';
            if($value->status=='Proses'){
                $isi['status'] = '<span class="label label-warning"> Proses </span>';
            }elseif($value->status=='Selesai'){
                $isi['status'] = '<span class="label label-success"> Selesai </span>';
            }elseif($value->status=='Ditolak'){
                $isi['status'] = '<span class="label label-danger"> Ditolak </span>';
            }else{
                echo'';
            }
            $pecah_tanggal = explode(' ',$value->created_date);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
            $return_on_click = "return confirm('Anda yakin?')";
            $isi['action'] =	'
                            <div class="btn-group" style="text-align: center;">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
											<a href="https://api.whatsapp.com/send?phone='.$value->wa.'&text=pesan_kamu">
												<i class="icon-bubble"></i> Chat WA </a>
										</li>
                                    <li>
                                        <a href="'.site_url('detil_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
                                            <i class="icon-action-redo"></i> Detail Data </a>
                                    </li>
                                    <li>
                                        <a onclick="'.$return_on_click.'" href="'.site_url('hapus_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
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
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*,b.fullname', array('md5(a.id_data_kk)'=>$this->uri->segment(2)), 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'user_profile b',
            'on' => 'a.created_by=b.user_id',
            'pos' => 'LEFT'
        ))->result();
        $data['data_detail'] = $this->Main_model->getSelectedData('detail_data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->uri->segment(2)))->result();
        $this->load->view('desktop/template/header',$data);
        $this->load->view('desktop/report/detil_data_pengajuan_kk',$data);
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

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan KK (".$keterangan.")",$this->session->userdata('location'));
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
		$get_data1 = $this->Main_model->getSelectedData('permohonan_ktp a', 'a.*', array('a.created_at'=>'2'))->result();
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
        $namafile = '';
        $data_insert = array(
            'nama' => $this->input->post('nama'),
            'permohonan_ktp' => $this->input->post('tipe'),
            'nik' => $this->input->post('nik'),
            'kk' => $this->input->post('kk'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'alamat' => $this->input->post('alamat'),
            'kode_pos' => $this->input->post('pos'),
            'file' => $namafile,
            'created_by' => '2',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('permohonan_ktp',$data_insert);
        // print_r($data_insert);
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."permohonan_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
            echo "<script>window.location='".base_url()."permohonan_ktp/'</script>";
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
        $data = $this->load->view('desktop/form_pdf/keterangan', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'ktp'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan KTP (".$this->input->post('nama').")",$this->session->userdata('location'));
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
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_domisili a', 'a.*', array('a.created_at'=>'2'))->result();
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
        $data = $this->load->view('desktop/form_pdf/keterangan_domisili', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'domisili'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan keterangan domisili (".$this->input->post('nama').")",$this->session->userdata('location'));
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
		$get_data = $this->Main_model->getSelectedData('surat_keterangan_usaha a', 'a.*', array('a.created_at'=>'2'))->result();
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
        $data = $this->load->view('desktop/form_pdf/keterangan_usaha', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'usaha'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan ijin usaha (".$this->input->post('nama').")",$this->session->userdata('location'));
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
		$get_data = $this->Main_model->getSelectedData('sktm a', 'a.*', array('a.created_at'=>'2'))->result();
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
		$get_data = $this->Main_model->getSelectedData('sktm_pendidikan a', 'a.*', array('a.created_at'=>'2'))->result();
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
        $data = $this->load->view('desktop/form_pdf/sktm', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sktm_umum'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SKTM (".$this->input->post('nama').")",$this->session->userdata('location'));
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
        $data = $this->load->view('desktop/form_pdf/sktm_sekolah', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sktm_pendidikan'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SKTM Pendidikan (".$this->input->post('nama').")",$this->session->userdata('location'));
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
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_sim a', 'a.*', array('a.created_at'=>'2'))->result();
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
        $data = $this->load->view('desktop/form_pdf/keterangan_sim', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'sim'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SIM (".$this->input->post('nama').")",$this->session->userdata('location'));
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
		$get_data = $this->Main_model->getSelectedData('surat_pengantar_skck a', 'a.*', array('a.created_at'=>'2'))->result();
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
        $data = $this->load->view('desktop/form_pdf/keterangan_skck', $data_insert, TRUE);
        $mpdf->WriteHTML($data);
        if (ob_get_contents()) ob_end_clean();
        $pathh = 'data_upload/dokumen/'.$this->input->post('id').'skck'.$cur_date.'.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);

        $this->Main_model->updateData('riwayat_administrasi',array('file'=>$nama_file),array('file'=>$this->input->post('file_lama'),'md5(created_by)'=>$this->input->post('user')));

        $this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengubah data pengajuan SKCK (".$this->input->post('nama').")",$this->session->userdata('location'));
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
    public function form_test(){
        $data = array(
            'baru' => 'X',
            'perpanjangan' => '',
            'penggantian' => '',
            'nama' => 'X',
            'alamat' => 'X',
            'rt' => 'X',
            'rw' => 'X',
            'kode_pos' => 'X',
            'nik' => 'X',
            'kk' => 'X'
        );
        $this->load->view('admin/form_pdf/permohonan_ktp',$data);
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
            echo'<iframe height="600" width="1075" src="'.$get_data->file.'"></iframe>';
		}
	}
}