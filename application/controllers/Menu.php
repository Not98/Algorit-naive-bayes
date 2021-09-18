<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_trafik');
        $this->load->model('m_ajax');
        $this->load->model('m_penilaian');
        $this->load->model('m_vote', 'vote');
        $this->load->library('encryption');
        $this->sesi->menu();
        $this->sesi->urll();
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
        if ($this->session->userdata('akun') == 'admin') {
            $this->templet->load('templet/Templet', 'Menu/home');
            $this->load->view('Menu/js_home', $data);
        } elseif ($this->session->userdata('akun') == 'vote') {
            if (empty($cek['jenis_k']) || $cek['smester'] == 0 || $cek['id_p'] == 0) {
                $this->templet->load('templet/Templet', 'user/home_user_profile', $d);
                $this->load->view('user/js_home_user_profile', $data);
            } else {
                $this->templet->load('templet/Templet', 'user/home_user', $d);
                $this->load->view('user/js_home_user', $data);
            }
        }
    }
    //admin
    public function  dataKritria()
    {
        $k = "surveyneiv@gmail.com";
        $data['q'] = $this->encryption->encrypt($k);
        $data['status']=$this->db->get('status')->result_array();
        $this->templet->load('templet/Templet', 'Menu/penilaian',$data);
        $this->load->view('Menu/penilaian_js', $data);
    }
    public function getidlayanan()
    {
        $k = "surveyneiv@gmail.com";
        $id = $this->input->post('id', true);
        if ($this->encryption->decrypt($this->input->post('lcrfs', true)) == $k) {
            $tabel = 'layanan';
            $data = $this->m_ajax->getDel($id, $tabel);
            echo json_encode($data);
        } else {
            $block = "";
        }
    }
    public function deletlayanan()
    {
        $id = $this->input->post('id', true);
        $tabel = 'layanan';
        $k = "surveyneiv@gmail.com";
        if ($this->encryption->decrypt($this->input->post('lcrfslh', true)) == $k) {
            $data = $this->m_ajax->del($id, $tabel);
            if ($data) {
                $ms['message'] = 'delet';
            } else {
                $ms['message'] = 'del_error';
            }
            echo json_encode($ms);
        } else {
            $block = "";
        }
    }
    public function updatelayanan()
    {
        $data = ['layanan' => $this->input->post('layanan', true)];
        $id = $this->input->post('id', true);
        $tabel = 'layanan';
        $k = "surveyneiv@gmail.com";
        if ($this->encryption->decrypt($this->input->post('crfslu', true)) == $k) {
            $data = $this->m_ajax->updt($id, $data, $tabel);
            if ($data) {
                $ms['message'] = 'delet';
            } else {
                $ms['message'] = 'del_error';
            }
            echo json_encode($ms);
        } else {
            $block = "";
        }
    }
    public function simpanlayanan()
    {
        $post = $this->input->post(null, true);
        $data = ['layanan' => $post['Layanann']];
        $db = 'layanan';
        $dat = $this->m_ajax->add($db, $data);
        echo json_encode($dat);
    }
    ///kategir
    public function getidkat()
    {
        $k = "surveyneiv@gmail.com";
        $id = $this->input->post('id', true);

        if ($this->encryption->decrypt($this->input->post('crfs')) == $k) {
            $tabel = 'kategori';
            $data = $this->m_ajax->getDel($id, $tabel);
            echo json_encode($data);
        } else {
            $block = "";
        }
    }
    public function deletka()
    {
        $id = $this->input->post('id', true);
        $tabel = 'kategori';
        $data = $this->m_ajax->del($id, $tabel);
        if ($data) {
            $ms['message'] = 'delet';
        } else {
            $ms['message'] = 'del_error';
        }
        echo json_encode($ms);
    }
    public function updatekat()
    {
        $data = ['kategori' => $this->input->post('kat', true)];
        $id = $this->input->post('id', true);
        $tabel = 'kategori';
        $k = "surveyneiv@gmail.com";
        if ($this->encryption->decrypt($this->input->post('crfs', true)) == $k) {
            $data = $this->m_ajax->updt($id, $data, $tabel);
            if ($data) {
                $ms['message'] = 'update';
            } else {
                $ms['message'] = 'update_error';
            }
            echo json_encode($ms);
        } else {
            $block = "";
        }
    }
    public function simpanKategori()
    {
        $post = $this->input->post(null, true);
        $this->form_validation->set_rules('Kategori', 'Kategori', 'is_unique[kategori.kategori]');
        if ($this->form_validation->run() == FALSE) {
            $dat['message'] = "gagal";
        } else {
            $data = [
                'kategori' => $post['Kategori'],

            ];


            $db = 'kategori';
            $dat = $this->m_ajax->add($db, $data);
        }

        echo json_encode($dat);
    }
    //kuisioner
    public function kuisioner()
    {
        $key = $this->input->post('key', true);
        if ($this->encryption->decrypt($key) == 'surveyneiv@gmail.com') {
            echo json_encode($this->m_ajax->pilihan());
        } else {
            echo "kosong";
        }
    }
    public function getidku()
    {
        $k = "surveyneiv@gmail.com";
        $id = $this->input->post('id', true);

        $tabel = 'penilaian';
        if ($this->encryption->decrypt($this->input->post('crfs')) == $k) {
            $data = $this->m_ajax->getDel($id, $tabel);

            echo json_encode($data);
        } else {
            $block = "";
        }
    }
    public function addkuisioner()
    {
        $post = $this->input->post(null, true);

        if ($post['l'] == null && $post['p'] == null) {
            $dat['message'] = 'chek';
        } else {
            if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
                $db = 'penilaian';
                $data = [
                    'id_layanan' => $post['l'],
                    'pertanyaan' => $post['p']
                ];

                $dat = $this->m_ajax->add($db, $data);
            } else {
                echo "kosong";
            }
        }
        echo json_encode($dat);
    }

    public function addjawaban()
    {
        $post = $this->input->post(null, true);
        $db = 'penilaian';
        $data = [
            'id_layanan' => $post['l'],
            'pertanyaan' => $post['p'],
            'id_status'  => $post['ks']
        ];

        if ($this->db->where('id_layanan', $post['l'])->count_all_results("penilaian") < 3) {
            # code...
            $this->form_validation->set_rules('p', 'Pertnyaan', 'required');
        } else {

            $this->form_validation->set_rules('p', 'Pertnyaan', 'required');
            $this->form_validation->set_rules('l', 'Layanan ', 'required');
        }
        $this->form_validation->set_message('required', '%s masih kosong harap di isi');
        $this->form_validation->set_message('is_unique', '%s Telah di gunakan');
        if ($this->form_validation->run() ==  FALSE) {
            $dat['error'] = ['layanan' => form_error('l'), 'Pertnyaan' => form_error('p')];
        } else {


            if ($post['l'] == null && $post['p'] == null) {
                $dat['message'] = 'chek';
            } else {
                if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {

                    $db = 'penilaian';
                    $data = [
                        'id_layanan' => $post['l'],
                        'pertanyaan' => $post['p'],
                        'id_status'  => $post['ks']
                        
                    ];



                    $dat = $this->m_ajax->jawaban($db, $data, $post);
                } else {
                    echo "kosong";
                }
            }
        }
        echo json_encode($dat);
    }

    public function updatjawaban()
    {
        $post = $this->input->post(null, true);

        if ($post['l'] == null && $post['p'] == null) {
            $dat['message'] = 'chek';
        } else {
            if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {

                $db = 'penilaian';
                $data = [
                    'id_layanan' => $post['l'],
                    'pertanyaan' => $post['p']
                ];

                $dat = $this->m_ajax->upjawaban($db, $data, $post);
            } else {
                echo "kosong";
            }
        }

        echo json_encode($dat);
    }

    public function jawabn()
    {
        $id = $this->input->get('id', true);

        $data = $this->m_penilaian->cekbok($id);

        echo json_encode($data);
    }
    public function get_jwab_a()
    {
        $data = $this->m_penilaian->getdetail();
        echo json_encode($data);
    }
    public function deljwb_k()
    {
        $get = $this->input->get(null, true);

        if ($this->encryption->decrypt($get['crfs']) == 'surveyneiv@gmail.com') {
            $data = $this->m_ajax->delkuejaw($get);
        } else {
            $data = "error";
        }
        echo json_encode($data);
    }
    function get_edit_j()
    {
        $get = $this->input->get(null, true);

        if ($this->encryption->decrypt($get['crfs']) == 'surveyneiv@gmail.com') {
            $data = $this->m_ajax->get_editJ($get); 
        } else {
            $data = "error";
        }
        echo json_encode($data);
    }



    //data vot
    public function vote_data()
    {
        $k = "surveyneiv@gmail.com";
        $data['q'] = $this->encryption->encrypt($k);
        $this->templet->load('templet/Templet', 'Menu/data_vot', $data);
        $this->load->view('Menu/data_vot_js', $data);
    }
    public function vot_get_id()
    {
        $get = $this->input->get(null, true);

        if ($this->encryption->decrypt($get['key']) == 'surveyneiv@gmail.com') {
            $tabel = 'status';
            $id = $get['id'];
            $data = $this->m_ajax->getDel($id, $tabel);
            if ($data) {
                $tam = $data;
            } else {
                $tam = "kosong";
            }
        } else {
            $tam = "error";
        }
        echo json_encode($tam);
    }
    //status
    public function status_del()
    {
        $post = $this->input->post(null, true);
        $tabel = 'status';
        $id = $post['id'];
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = $this->m_ajax->del($id, $tabel);
            if ($data) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "error";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function updat_sta()
    {
        $post = $this->input->post(null, true);
        $tabel = 'status';
        $id = $post['id'];
        // die(var_dump($post['key']));
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = [
                'status' => $post['status']

            ];
            $dat = $this->m_ajax->updt($id, $data, $tabel);
            if ($dat) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "a";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function simpan_s()
    {
        $post = $this->input->post(null, true);
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {

            $db = 'status';
            $data = [
                'status' => $post['status']
            ];

            $dat = $this->m_ajax->add($db, $data);
        } else {
            echo "kosong";
        }
        echo json_encode($dat);
    }
    //kategori mahasiswa
    public function get_id_km()
    {
        $get = $this->input->get(null, true);
        if ($this->encryption->decrypt($get['key']) == 'surveyneiv@gmail.com') {
            $tabel = 'kategori_m';
            $id = $get['id'];
            $data = $this->m_ajax->getDel($id, $tabel);
            if ($data) {
                $tam = $data;
            } else {
                $tam = "kosong";
            }
        } else {
            $tam = "error";
        }
        echo json_encode($tam);
    }
    public function km_del()
    {
        $post = $this->input->post(null, true);
        $tabel = 'kategori_m';
        $id = $post['id'];
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = $this->m_ajax->del($id, $tabel);
            if ($data) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "error";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function update_km()
    {
        $post = $this->input->post(null, true);
        $tabel = 'kategori_m';
        $id = $post['id'];
        // die(var_dump($post['key']));
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = [
                'ktegori' => $post['kategori']

            ];
            $dat = $this->m_ajax->updt($id, $data, $tabel);
            if ($dat) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "a";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function simpan_km()
    {
        $post = $this->input->post(null, true);
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {

            $db = 'kategori_m';
            $data = [
                'ktegori' => $post['kategori']

            ];

            $dat = $this->m_ajax->add($db, $data);
        } else {
            echo "kosong";
        }
        echo json_encode($dat);
    }
    //jurusan
    public function get_id_jrs()
    {
        $get = $this->input->get(null, true);
        if ($this->encryption->decrypt($get['key']) == 'surveyneiv@gmail.com') {
            $tabel = 'jurusan';
            $id = $get['id'];
            $data = $this->m_ajax->getDel($id, $tabel);
            if ($data) {
                $tam = $data;
            } else {
                $tam = "kosong";
            }
        } else {
            $tam = "error";
        }
        echo json_encode($tam);
    }
    public function del_jrs()
    {
        $post = $this->input->post(null, true);
        $tabel = 'jurusan';
        $id = $post['id'];
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = $this->m_ajax->del($id, $tabel);
            if ($data) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "error";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function up_jurusan()
    {
        $post = $this->input->post(null, true);
        $tabel = 'jurusan';
        $id = $post['id'];
        // die(var_dump($post['key']));
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = ['jurusan' => $post['jurusan']];
            $dat = $this->m_ajax->updt($id, $data, $tabel);
            if ($dat) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "a";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function add_jursan()
    {
        $post = $this->input->post(null, true);
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {

            $db = 'jurusan';
            $data = ['jurusan' => $post['jurusan']];

            $dat = $this->m_ajax->add($db, $data);
        } else {
            $dat = "kosong";
        }
        echo json_encode($dat);
    }
    //mahasiswa
    public function get_mhs()
    {
        $get = $this->input->get(null, true);
        if ($this->encryption->decrypt($get['key']) == 'surveyneiv@gmail.com') {
            $tabel = 'm_siswa';
            $id = $get['id'];
            $data = $this->m_ajax->getDel($id, $tabel);
            if ($data) {
                $tam = $data;
            } else {
                $tam = "kosong";
            }
        } else {
            $tam = "error";
        }
        echo json_encode($tam);
    }
    public function del_mhs()
    {
        $post = $this->input->post(null, true);
        $tabel = 'm_siswa';
        $id = $post['id'];
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = $this->m_ajax->del($id, $tabel);
            if ($data) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "error";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function up_mhs()
    {
        $post = $this->input->post(null, true);
        $tabel = 'm_siswa';
        $id = $post['id'];
        // die(var_dump($post['key']));
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {
            $data = ['nim' => $post['nim']];
            $dat = $this->m_ajax->updt($id, $data, $tabel);
            if ($dat) {
                $tam['message'] = "ok";
            } else {
                $tam['message'] = "a";
            }
        } else {
            $tam['message'] = "error";
        }
        echo json_encode($tam);
    }
    public function add_mhs()
    {
        $post = $this->input->post(null, true);
        if ($this->encryption->decrypt($post['key']) == 'surveyneiv@gmail.com') {

            $db = 'm_siswa';
            $data = ['nim' => $post['nim']];

            $dat = $this->m_ajax->add($db, $data);
        } else {
            $dat = "kosong";
        }
        echo json_encode($dat);
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

        $this->templet->load('templet/Templet', 'user/pertanyaan', $d);
        $this->load->view('user/pertanyaan_js');
    }
    public function p()
    {
        // $this->vote->soal();

    }
}

/* End of file Menu.php */
