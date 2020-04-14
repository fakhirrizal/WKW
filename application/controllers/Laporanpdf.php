<?php
Class Laporanpdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->helper('download');
    }
    
    public function index(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('contoh', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/filename.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
}