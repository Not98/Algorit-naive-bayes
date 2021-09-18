<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user', 'user');
        $this->load->model('m_trafik');
        $this->load->model('m_ajax');
        $this->load->model('m_penilaian');
        $this->load->model('m_vote', 'vote');
        $this->load->library('encryption');
        $this->sesi->menu();
    }
    public function index()
    {
        $cek = $this->db->get_where('m_siswa', ['nim' => $this->session->userdata('nim')])->row_array();
        if (empty($cek['jenis_k']) || $cek['smester'] == 0 || $cek['id_p'] == 0) {
            $d['d'] = "disabled";
        } else {
            $d['d'] = "";
        }
        $d['akun'] = $cek;
        $data['donut'] = $this->m_trafik->donat();

        if (empty($cek['jenis_k']) || $cek['smester'] == 0 || $cek['id_p'] == 0) {
            $this->templet->load('templet/Templet', 'user/home_user_profile', $d);
            $this->load->view('user/js_home_user_profile', $data);
        } else {
            $this->templet->load('templet/Templet', 'user/home_user', $d);
            $this->load->view('user/js_home_user', $data);
        }
    }
    public function addpro()
    {
        $post = $this->input->post(null, true);
        $data =  $this->user->addprofile($post);
        echo json_encode($data);
    }

    //vote user
    public function voting()
    {
        $cek = $this->db->get_where('m_siswa', ['nim' => $this->session->userdata('nim')])->row_array();
        if (empty($cek['jenis_k']) || $cek['smester'] == 0 || $cek['id_p'] == 0) {
            $d['d'] = "disabled";
        } else {
            $d['d'] = "";
        }
        $d['soal'] = $this->vote->soal();
        $d['jumlah'] = $this->vote->jumlahs();
        $d['jawaban'] = $this->vote->jawaban();

        $this->templet->load('templet/Templet', 'user/pertanyaan', $d);
        $this->load->view('user/pertanyaan_js');
    }


    public function detailvot($vot)
    {
        // var_dump($vot);
        // die;
        if (!empty($vot)) {
            $data['soal'] = $this->vote->chek_vot($vot);
        }
        else {
            $data = redirect('block', 'refresh');
        }
        // echo json_encode($data);
        $this->load->view('voting/fot', $data);
    }
    public function vot($vot)
    {
     $nim = $this->session->userdata('nim');
     $status=$this->db->get_where('m_siswa',['nim'=>$nim])->row_array();
     if ($vot=='Akademik') {
        $ids=9999;
    }else{
        $ids=$status['id_status'];
    }
    $post = $this->input->post(null, true);
    $name=$this->db->select('penilaian.id as idp, layanan.id as idl, layanan.layanan, penilaian.pertanyaan')->from('layanan')->join('penilaian','penilaian.id_layanan=layanan.id')->where('layanan.layanan',str_replace("_", " ",$vot))->where('penilaian.id_status',$ids)->get()->result_array();
    if ($name) {
        foreach ($name as $key => $value) {

            if ($value['layanan']=='Akademik') {
                $x='akademik';
            }else{
                $x= $this->session->userdata('inp');
            }
            
            $data = ['id_kategori' => $post[$x], 'nim' => $this->session->userdata('nim'), 'id_penilaian' => $value['idp']];

            $cek = $this->db->get_where('vote', ['id_penilaian' => $post[$x], 'nim' => $this->session->userdata('nim')])->row_array();

            if (empty($cek)) {

                $in = $this->db->insert('vote', $data);
            }else {
                redirect('voting');
            }
        }
        if ($in) {
            $this->session->unset_userdata('inp');
            redirect('voting');
        }else{
            echo "error";
        }
    }


    // var_dump($cek);
    // die();
    // $cek = $this->db->get_where('vote', ['id_penilaian' => $d[$i]['idp'], 'nim' => $this->session->userdata('nim')])->row_array();

    // $post[str_replace("_", " ",$vot)];

    //     $d = $this->vote->soal();
    //     for ($i=0; $i < count($d) ; $i++) { 
    //        if ($d[$i]['idp'] != null || $d[$i]['soal'] != null) {
    //           if ($post[str_replace(" ", "",$d[$i]['soal'])] != null) {
    //             $data = ['id_kategori' => $post[str_replace(" ", "_",$d[$i]['soal'])], 'nim' => $this->session->userdata('nim'), 'id_penilaian' => $d[$i]['idp']];
    //             $cek = $this->db->get_where('vote', ['id_penilaian' => $d[$i]['idp'], 'nim' => $this->session->userdata('nim')])->row_array();
    //             if (empty($cek)) {
    //               $in = $this->db->insert('vote', $data);

    //           }else {
    //             redirect('voting');
    //         }
    //     }
    // }
    // }
    // if ($in) {
    //     redirect('voting');
    // }else{
    //     echo "error";
    // }

}

public function ajaxsoal()
{
    echo json_encode($this->vote->kirim());


        //ori
        // $id=$this->input->post('ids',true);
        // $data=$this->vote->jawaban($id);
        // echo json_encode($data);

}
}
