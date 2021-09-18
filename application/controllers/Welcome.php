<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

public function __construct()
{
	parent::__construct();
	//Do your magic here
}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// // $this->load->view('welcome_message');
		// $cek=$this->db->order_by('data_uji.id', 'DESC')->get('data_uji')->result_array();
	

		// foreach ($cek as $key => $value) {
		// 	$cek=$this->db->get_where('vote',['nim'=>$value['nim'],'id_penilaian'=>1])->row_array();
		// 	if ($cek) {
		// 	// $this->db->delete('vote',['nim'=>$value['nim'],'id_penilaian'=>1]);
		// 	}else{
			
		// 		$this->db->insert('vote',['nim'=>$value['nim'],'id_penilaian'=>1,'id_kategori'=>1]);
		
		// 	}
		// }
	}
}
