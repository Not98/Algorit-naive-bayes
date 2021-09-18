<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vote extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_trafik');
	}


	public function index()
	{
		$data['trafik'] = $this->m_trafik->thn_a();
		$data['tampil'] = $this->m_trafik->tampil();
		// echo json_encode($data);
		// // var_dump($data);
		// die;
		$data['donut'] = $this->m_trafik->donat();
		$this->load->view('depan/menu', $data);
	}
}

/* End of file Vote.php */
