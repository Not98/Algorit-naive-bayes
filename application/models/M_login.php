<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        
        $this->load->library('encryption');
        
    }
    


    function login ($post){ 
    

        $vot = $this->db->get_where('m_siswa',['nim'=>$post['nim']])->row_array();
        $sql = $this->db->get_where('user',['nim'=>$post['nim']])->row_array();
//login admin
        if($sql){        
            if ($post['password']==$sql['password']) {
                $ses = ['nim' =>$sql['nim'],
                        'akun' => 'admin'
                        ];
                $this->session->set_userdata($ses);               
                redirect('menu');  
            }else{
                $this->session->set_flashdata('ps','<div class="card bg-gradient-danger"> Passwor Salah      </div>');
                redirect('login');
            }
//login user vot
        }elseif ($vot){
            $pasw=$this->encryption->encrypt($post['password']);
             
            if ($post['password']==$this->encryption->decrypt($vot['password'])) {
                $ses = ['nim' =>$vot['nim'],
                        'akun' => 'vote',
                        'key'=>$this->encryption->encrypt($vot['nim'])];
                $this->session->set_userdata($ses);               
                redirect('user');               
            }else{
                $this->session->set_flashdata('ps','<div class="card bg-gradient-danger"> User Passwor Salah      </div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('user','<div class="card bg-gradient-danger"> User tidak di temukan</div>');
            redirect('login');           
        }   
    }
    // kirim Validasi email 
    public function vot_valid($post){
        $vot = $this->db->get_where('m_siswa',['nim'=>$post['nim']])->row_array();
        if ($vot && $vot['email']==null&& $vot['keyy']== null) {
            $to = $post['email'];
            $nim =$vot['nim'];
                $key = $this->encryption->encrypt($nim);
                $data =['keyy'=>substr($key,0,50),
                        'email'=>$post['email']        
                        ];
                $url=base_url('Chekin/').substr($key,0,50);
               $kirim=pesan($to,$url);
               if ($kirim) {
                           # code...
                $this->db->where('nim',$post['nim'])->set($data)->update('m_siswa');      
                       }        
        }else{
          $this->session->set_flashdata('nim','<div class="card bg-gradient-danger"> NIM tidak di temukan / Email Sudah terpakai</div>');
          
          redirect('new_accout','refresh');
          
        }
    }
    // Membuat Pass word user baru
    public function pass_vot($post){
        $chek = $this->db->get_where('m_siswa',['keyy'=>$this->session->userdata('keyy')])->row_array();
        if ($chek) {
            $pass =$this->encryption->encrypt($post['password']);
            $up =$this->db->update('m_siswa',['password'=>$pass],['keyy'=>$this->session->userdata('keyy')]);
                redirect('login','refresh');
            if ($up) {
                redirect('login','refresh');
                
            }else{
                echo "error";
            }

        }
    }

    

}

/* End of file M_login.php */

