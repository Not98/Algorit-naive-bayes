<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_tabel');

    }


    public function kategori() {
        $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"


        $total=$this->m_tabel->tb_nilai_count();
        $data=$this->m_tabel->tb_nilai($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari=$this->m_tabel->tb_nilai_c($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
       		header('Content-Type: application/json');
        echo json_encode($callback);
    }


    public function tbl_layanan(){
        $post =$this->input->post(null,true);
        $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"


        $total=$this->m_tabel->tb_layanan_count();
        $data=$this->m_tabel->tb_layanan($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari=$this->m_tabel->tb_layanan_c($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
       		header('Content-Type: application/json');
        echo json_encode($callback);

    }


    public function tbl_kuesioner(){
        $post =$this->input->post(null,true);
        $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"


        $total=$this->m_tabel->tb_kuesioner_count();
        $data=$this->m_tabel->tb_kuesioner($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari=$this->m_tabel->tb_kuesioner_c($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
       		header('Content-Type: application/json');
        echo json_encode($callback);

    }

    public function tbl_vot(){
      $post =$this->input->post(null,true);
      $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
      $limit = $_POST['length']; // Ambil data limit per page
      $start = $_POST['start']; // Ambil data start
      $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
      $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
      $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $total =$this->m_tabel->tbl_account_count();
        $data = $this->m_tabel->tbl_vot($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari = $this->m_tabel->tbl_vot_search($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
        header('Content-Type: application/json');
        echo json_encode($callback);

    }

    public function tbl_k_m(){
        $post =$this->input->post(null,true);
        $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $total =$this->m_tabel->tbl_kategori_m_coun();
        $data = $this->m_tabel->tbl_kategori_m($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari = $this->m_tabel->tbl_kategori_m_c($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
        header('Content-Type: application/json');
        echo json_encode($callback);

    }
//Status Mahasiswa
    public function tbl_status_m(){
        $post =$this->input->post(null,true);
        $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $total =$this->m_tabel->tbl_status_m_coun();
        $data = $this->m_tabel->tbl_status_m($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari = $this->m_tabel->tbl_status_m_c($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
        header('Content-Type: application/json');
        echo json_encode($callback);

    }
// Jurusan
    public function tbl_jurusan(){
        $post =$this->input->post(null,true);
        $search = $_POST['search']['value'];// Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $total =$this->m_tabel->tbl_jurusan_coun();
        $data = $this->m_tabel->tbl_jurusan($search,$limit,$start,$order_ascdesc,$order_field);
        $d_cari = $this->m_tabel->tbl_jurusan_c($search);
        $callback=[
            'draw'  => $_POST['draw'],
            'recordsTotal'  =>$total,
            'recordFiltered'=>$d_cari,
            'data'          =>$data

        ];
        header('Content-Type: application/json');
        echo json_encode($callback);

    }
}

/* End of file Tabel.php */
