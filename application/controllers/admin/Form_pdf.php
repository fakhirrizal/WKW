<?php
Class Form_pdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    public function ktp(){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
		$data = $this->load->view('admin/form_pdf/ktp', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/ktp.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function kk(){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
		$data = $this->load->view('admin/form_pdf/kk', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/kk.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function keterangan_domisili(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/keterangan_domisili', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/keterangan_domisili.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function keterangan_usaha(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/keterangan_usaha', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/keterangan_usaha.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function sktm(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/sktm', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/sktm.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function sktm_sekolah(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/sktm_sekolah', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/sktm_sekolah.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function keterangan_skck(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/keterangan_skck', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/keterangan_skck.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
    public function keterangan_sim(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/keterangan_sim', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/keterangan_sim.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
}