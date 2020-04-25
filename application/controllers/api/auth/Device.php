<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Device extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('user_id')!=NULL){
			$hasil = $this->Main_model->getSelectedData('user a', 'a.*', array('a.id'=>$this->get('user_id')))->row();
			if($hasil==NULL){
				$balikan['status'] = 0;
				$balikan['message'] = 'Data kosong.';
				$this->response($balikan, 200);
			}else{
                if($hasil->verification_token=='' OR $hasil->verification_token==NULL){
                    $balikan['status'] = 0;
                    $balikan['message'] = 'Device ID belum diisi.';
                    $this->response($balikan, 200);
                }else{
                    $balikan['status'] = 1;
                    $balikan['message'] = 'Ada data.';
                    $balikan['device_id'] = $hasil->verification_token;
                    $this->response($balikan, 200);
                }
			}
		}else{
			$balikan['status'] = 0;
            $balikan['message'] = 'Harap masukkan User ID.';
            $this->response($balikan, 200);
		}
	}

	function index_post() {
        if($this->post('api_key')=='' OR $this->post('registrationIds')==''){
            echo'API Key dan registrationIds wajib diisi!!';
        }else{
            // API access key from Google API's Console
            $get_token = $this->post('api_key');
            $get_id = $this->post('registrationIds');
            define( 'API_ACCESS_KEY', $get_token );
            $registrationIds = array( $get_id );
            // prep the bundle
            $msg = array
            (
                'message'   => $this->post('message'),
                'title'     => $this->post('title'),
                'subtitle'  => $this->post('subtitle'),
                'tickerText'    => $this->post('tickerText'),
                'vibrate'   => $this->post('vibrate'),
                'sound'     => $this->post('sound'),
                'largeIcon' => $this->post('largeIcon'),
                'smallIcon' => $this->post('smallIcon')
            );
            $fields = array
            (
                'registration_ids'  => $registrationIds,
                'data'          => $msg
            );
            
            $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
            echo $result;
        }
	}

	function index_put() {
	}

	function index_delete() {
    }
}