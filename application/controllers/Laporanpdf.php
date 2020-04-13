<?php
Class Laporanpdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function index(){
        $pdf = new FPDF('p','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();

        // Page header
        $pdf->SetFont('Arial','B',16);
        // Logo
        $pdf->Image(base_url('assets_dashboard/batang.png'),10,6,30);
        // Move to the right
        $pdf->Cell(80);
        // Title
        $pdf->Cell(30,10,'Title',1,0,'C');
        // Line break
        $pdf->Ln(20);

        // mencetak string
        $pdf->Ln(20);
        $pdf->Cell(190,7,'TEKS TEKS TEKS',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'TEKS TEKS TEKS',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat

        // Position at 1.5 cm from bottom
        $pdf->SetY(-15);
        // Arial italic 8
        $pdf->SetFont('Arial','I',8);
        // Page number
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().'/20',0,0,'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'Header 1',1,0,'C');
        $pdf->Cell(85,6,'Header 2',1,0,'C');
        $pdf->Cell(27,6,'Header 3',1,0,'C');
        $pdf->Cell(58,6,'Header 4',1,1,'C');
        $pdf->SetFont('Arial','',10);
        // $getdataberita = $this->db->get('berita')->result();
        // foreach ($getdataberita as $row){
            $pdf->Cell(20,6,'kolom1',1,0);
            $pdf->Cell(85,6,'kolom2',1,0);
            $pdf->Cell(27,6,'kolom3',1,0);
            $pdf->Cell(58,6,'kolom4',1,1); 
        // }
        $pdf->Output();
    }
}