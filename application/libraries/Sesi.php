<?php
Class Sesi{
	
	//beck to login no session
    public function menu(){
		$ci = get_instance();
		if ($ci->session->userdata('akun')==null) {
			redirect('login');
		}
	}
	//tidak bisa login ketika memmiliki accoun
	public function login()
	{
		$ci = get_instance();
		if ($ci->session->userdata('akun')!=null) {
			if($ci->session->userdata('akun')=='admin'){

				redirect('menu');
			}else{
				redirect('user');

			}
		}
	}
	
	///akses  user dengan admin
	public function akses()
	{
		$ci = get_instance();
		if ($ci->session->userdata('akun')=='vot') {
			$url=$ci->uri->segment(3);
			$boleh=[""];
			if ($url != $boleh) {
				echo "blok";
			}
		}
	}
	public function urll(){
		$ci = get_instance();
		
		if($ci->session->userdata('akun')=='vote'){
	
				redirect('blok');		

			
		}
	}
	
}
