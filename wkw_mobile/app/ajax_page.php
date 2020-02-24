<?php
if($_POST['modul']=='beranda'){
    // $data['berita'] = $this->Main_model->getSelectedData('berita a', 'a.*', '', "a.created_at DESC",'2')->result();
    // $data['potensi_desa'] = $this->Main_model->getSelectedData('potensi_desa a', 'a.*', '', "a.created_at DESC",'1')->result();
    // $this->load->view('mobile/app/ajax_page/beranda',$data);
    header("location:beranda.php");
}elseif($this->input->post('modul')=='administrasi'){
    $this->load->view('mobile/app/ajax_page/administrasi');
}elseif($this->input->post('modul')=='ekonomi'){
    $this->load->view('mobile/app/ajax_page/ekonomi');
}elseif($this->input->post('modul')=='kependudukan'){
    $this->load->view('mobile/app/ajax_page/kependudukan');
}
?>