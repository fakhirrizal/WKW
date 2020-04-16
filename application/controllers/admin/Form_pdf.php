<?php
Class Form_pdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    public function form1(){
        $mpdf = new \Mpdf\Mpdf();
		$data = $this->load->view('admin/form_pdf/form1', [], TRUE);
		$mpdf->WriteHTML($data);
        ob_clean();
        $pathh = 'data_upload/dokumen/form1.pdf';
        $mpdf->Output($pathh, \Mpdf\Output\Destination::FILE);
    }
}