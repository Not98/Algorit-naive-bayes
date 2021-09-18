<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
		
    }
    

    
    public function index()
    {
        $this->sesi->login();
        $this->form_validation->set_rules('nim', 'Nim', 'required');
        $this->form_validation->set_rules('password','Password', 'required');
        $this->form_validation->set_message('required',"<p class='bg-gradient-danger'>Harap isi  %s masih kosong</p>");
        if ($this->form_validation->run()==false) {
            $this->load->view('validasi/login');
        }else{
            $post = $this->input->post(null,true);
            $this->m_login->login($post);

        }

    }


    //new user fot

    public function vote(){
        $this->form_validation->set_rules('email', 'email', 'required|is_unique[m_siswa.email]');
        $this->form_validation->set_rules('nim', 'Nim', 'required');
        $this->form_validation->set_message('required',"<p class='bg-gradient-danger'>Harap isi  %s masih kosong</p>");
        $this->form_validation->set_message('is_unique',"<p class='bg-gradient-danger'>Data  %s Telah Digunakan</p>");
        if ($this->form_validation->run()==false) {
            $this->load->view('validasi/chek');
        }else{
            $post = $this->input->post(null,true);
            $this->m_login->vot_valid($post);

        }
       
    }
    public function valsidas($keyy){
      $this->session->set_userdata('keyy',substr($keyy,0,50));
      redirect('account/new_password');
    }

    public function new(){
        
        if($this->session->userdata('keyy')==null){
            redirect();
        }else{
            $key =$this->session->userdata('keyy');
            $sql = $this->db->get_where('m_siswa',['keyy'=>$key])->row_array();
            if (empty($sql['password'])) {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('passconf', 'Password Confirmation',  'trim|required|matches[password]');

                
                if ($this->form_validation->run()==false) {
                    $this->load->view('validasi/newPassword');
                }else{
                    $post = $this->input->post(null,true);
                    $cek=$this->m_login->pass_vot($post);
                    if ($cek) {
                redirect('login','refresh');
                       
                    }
                }
                
            }else{

             redirect();
            }
        }
    }

    public function lougout()
    {
        $ses=['akun','nim'];
        $this->session->unset_userdata($ses);
        redirect('login');
    }
    

}

/* End of file Validasi.php */
