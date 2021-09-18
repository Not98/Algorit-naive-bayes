<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_vote extends CI_Model
{
    public function __construct()
    {
        parent::__construct();



    }


    function kirim()
    {
        $pertanyaan = $this->db->distinct('*')
        ->from('penilaian')
        ->join('jawaban', 'jawaban.id_penialian=penilaian.id')
        ->get()
        ->result_array();
        foreach ($pertanyaan as $key => $value) {
            $x = $this->coba($value['id']);
        }
        return $x;
    }
    function coba($id)
    {
        for ($i = 0; $i < $id; $i++) {
            $sql = $this->db->select('jawaban.id_kategori as jawab, layanan')
            ->from('jawaban')
            ->join('penilaian', 'penilaian.id=jawaban.id_penialian')
            ->join('layanan', 'layanan.id=penilaian.id_layanan')
            ->where('id_penialian', $id)->get()->row_array();
        }
        $data = unserialize($sql['jawab']);
        foreach ($data as $key => $value) {

            $d[] = [$this->db->get_where('kategori', ['id' => $value])->row_array(), $sql['layanan']];
        }
        return $d;
    }

    //menu vooting
    function jumlahs()
    {
        $l = $this->db->get('layanan')->result_array();
        if ($l) {
            foreach ($l as $la) {
                $j = $this->db->where('id_layanan', $la['id'])->count_all_results('penilaian');

                $data[] = ['layanan' => $la['layanan'], 'total' => $this->db->where('id_layanan', $la['id'])->count_all_results('penilaian')];
            }
        }else{
            $data=null;
        }

        return $data;
    }

    //pengecekan user voting

    function chek_vot($url)
    {
        $nim = $this->session->userdata('nim');
        $status=$this->db->get_where('m_siswa',['nim'=>$nim])->row_array();
        if ($url=='Akademik') {
            $ids=9999;
        }else{
            $ids=$status['id_status'];
        }
        $penilaian = $this->db->select('layanan.id as idl,layanan.layanan, penilaian.id as idp , penilaian.pertanyaan as pertanyaan')
        ->from('penilaian')
        ->join('layanan', 'layanan.id=penilaian.id_layanan')
        ->where('layanan', str_replace('_', ' ', $url))
        ->where('penilaian.id_status',$ids)
        ->get()->result_array();

        
        if (!empty($penilaian)) {

            foreach ($penilaian as $pen) {
                // var_dump($pen);
                if ($pen['idp']) {
                    # code...
                }
                $vot = $this->db->get_where('vote', ['id_penilaian' => $pen['idp'], 'nim' => $nim])->row_array();

                if ($vot) {
                    $data[] = ['soal' => null, 'id' => null];
                } else {
                    if ($vot < 2) {
                        # code...
                        // $pasw=$this->encrypt->encode($pen['layanan']);
                        if ($url=='Akademik') {
                            $d='akademik';
                        }else{
                            $d=$pen['pertanyaan'];
                        }

                        $data[] = ['soal' => $pen['pertanyaan'], 'id' => $pen['idp'],'layanan'=>$d];
                    } else {

                        $data[] = redirect('block', 'refresh');
                    }
                }
            }
        } else {

            $data[] = redirect('block', 'refresh');
        }
        // var_dump($data);
        // die();
        return $data;
    }

    //tampil jwaban
    function jwabanAJAX($post)
    {
        $query = $this->db->select('*')
        ->from('kategori')
        ->join('jawaban', 'jawaban.id_kategori = kategori.id')
        ->join('penilaian', 'penilaian.id = jawaban.id_penialian')
        ->where('penilaian.id', $post)->get()->result_array();
        foreach ($query as $s) {
            $soal[] = ['jawaban' => $s['kategori']];
        }
        return $soal;
    }

    //penampilan soal
    function soal()
    {
        $pertanyaan = $this->db->select('penilaian.pertanyaan,penilaian.id as idp,layanan.layanan')
        ->from('penilaian')
        ->join('layanan', 'layanan.id=penilaian.id_layanan')
        ->get()
        ->result_array();

        $penilaian = $this->db->select('layanan.id as idl,layanan.layanan, penilaian.id as idp , penilaian.pertanyaan as pertanyaan')
        ->from('penilaian')
        ->join('layanan', 'layanan.id=penilaian.id_layanan')
        ->where('layanan', 'Akademik')->get()->result_array();
        if (!empty($pertanyaan)) {
            # code...
            foreach ($pertanyaan as $p) {
                if ($p['layanan']=='Akademik') {
                    if (count($penilaian)<176) {
                     $this->jawaban($p['idp']);
                     $data[] = ['soal' => $p['pertanyaan'], 'idp' => $p['idp'], 'layanan' => $p['layanan']];
                 }
             }else{
               $this->jawaban($p['idp']);
               $data[] = ['soal' => $p['pertanyaan'], 'idp' => $p['idp'], 'layanan' => $p['layanan']];
           }



       }
       return $data;
   }
}
function jawaban()
{
    $pertanyaan = $this->db->distinct('*')
    ->from('penilaian')
    ->join('jawaban', 'jawaban.id_penialian=penilaian.id')
    ->get()
    ->result_array();

    if (!empty($pertanyaan)) {
        foreach ($pertanyaan as $p) {
            $sql = $this->db->select('kategori.id as id ,kategori.kategori as kategori')
            ->from('jawaban')
            ->join('penilaian', 'penilaian.id=jawaban.id_penialian')
            ->join('layanan', 'layanan.id=penilaian.id_layanan')
            ->join('kategori', 'kategori.id = jawaban.id_kategori')
            ->where('id_penialian', $p['id'])->get()->result_array();
        }
        foreach ($sql as $key => $value) {

            $d[] = ['id' => $value['id'], 'kategori' => $value['kategori']];
        }


        return $d;
    }
}
}

/* End of file M_vote.php */
