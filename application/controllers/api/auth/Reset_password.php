<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Reset_password extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
		if($this->post('email')!=NULL){
			$hasil = $this->Main_model->getSelectedData('masyarakat a', 'a.*', array('a.email'=>$this->post('email')))->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'User_ID tidak ditemukan.';
				$this->response($balikan, 200);
			}else{
				if($hasil->email==NULL){
					$balikan['status'] = 0;
					$balikan['message'] = 'Email tidak ditemukan.';
					$this->response($balikan, 200);
				}else{
					$this->db->trans_start();
					$new_pass = $this->Main_model->random_string(6);
					require_once(APPPATH.'libraries/class.phpmailer.php');

					$mail = new PHPMailer; 
					$mail->IsSMTP();
					$mail->SMTPSecure = 'ssl'; 
					$mail->Host = "kalipucangwetan.id";
					// 0 = off (for production use, No debug messages)
					// 1 = client messages
					// 2 = client and server messages
					$mail->SMTPDebug = 0;
					$mail->Port = 465;
					$mail->SMTPAuth = true;
					$mail->Username = "layanan@kalipucangwetan.id";
					$mail->Password = "CW(p{wvO_z+G";
					$mail->SetFrom("layanan@kalipucangwetan.id","Admin Desa Kalipucang Wetan");
					$mail->Subject = "Reset Password";
					$mail->MsgHTML("Kata sandi baru Anda adalah : ".$new_pass);
					$mail->AddAddress($hasil->email,$hasil->nama);
					$mail->Send();
					$this->Main_model->updateData('user',array('pass'=>$new_pass),array('id'=>$hasil->user_id));
					$this->db->trans_complete();
					if($this->db->trans_status() === false){
						$balikan['status'] = 0;
						$balikan['message'] = 'Gagal reset kata sandi, harap ulangi!';
						$this->response($balikan, 200);
					}
					else{
						$balikan['status'] = '1';
						$balikan['message'] = 'Sukses reset kata sandi, silahkan cek inbox atau spam di email Anda!';
						$this->response($balikan, 200);
					}
				}
			}
		}else{
			$balikan['status'] = 0;
			$balikan['message'] = 'Harap masukkan email Anda.';
			$this->response($balikan, 200);
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}