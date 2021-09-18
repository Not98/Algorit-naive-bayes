<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('encryption');
   }

   public function cek_profile()
   {
      $profil = $this->db->get_where('m_siswa', ['nim' => $this->session->userdata('nim')])->row_array();
      if ($profil['sataus']) {
         $status = $this->db->get_where('status', ['id' => $profil['status']])->row_array();
      } else {
      }
   }
   public function addprofile($post)
   {
      $nim = $this->session->userdata('nim');
      
         $data = [
            'jenis_k' => $post['jk'],
            'kelas' => $post['kls'],
            'id_status' => $post['status'],
            'smester' => $post['semester'],
            'id_p' => $post['prod'],
            'th' => $post['th']
         ];
      

      if ($nim == $this->encryption->decrypt($post['key'])) {
         $updat = $this->db->update('m_siswa', $data, ['nim' => $nim]);

         if ($updat) {
            $message['message'] = "ok";
         } else {
            $message['message'] = "xx";
         }
      } else {
         $message['message'] = "error";
      }
      return $message;
   }
}

/* End of file M_user.php */
