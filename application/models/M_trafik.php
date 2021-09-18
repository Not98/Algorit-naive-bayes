<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_trafik extends CI_Model
{

    public function tampil(){
        $l=$this->db->select('penilaian.id,layanan.layanan, penilaian.pertanyaan')->from('penilaian')->join('layanan','layanan.id=penilaian.id_layanan')->get()->result_array();
        if ($l) {
          foreach ($l as $layanan){
            if ($layanan) {
                # code...
                $tampil[]=['layanan'=>$layanan['layanan'],'id'=>$layanan['id'],'pertanyaan'=>$layanan['pertanyaan']];
            }else{
                $tampil[]=null;
            }
        }
    }else{
        $tampil=null;
    }


    return $tampil;

}




public function donat()
{
    $sql1 = $this->db->query("SELECT layanan.layanan as labe, 
        count(*) as value FROM layanan JOIN penilaian on penilaian.id_layanan = layanan.id
        JOIN vote  ON vote.id_penilaian = penilaian.id
        GROUP BY layanan.layanan 
        ORDER BY layanan.id ASC")->row_array();
    $sql = $this->db->query("SELECT layanan.layanan as labe, 
        count(*) as value FROM layanan JOIN penilaian on penilaian.id_layanan = layanan.id
        JOIN vote  ON vote.id_penilaian = penilaian.id
        GROUP BY layanan.layanan 
        ORDER BY layanan.id ASC")->result_array();
        // $data['data'] = [
        //     'label'  => $sql["label"],
        //     'value'  => $sql["velu"]
        // ];
    if ($sql1) {
        $dat = array();
        foreach ($sql as $data) {
            if ($data['labe']!=null||$data['value']!=null) {
                $dat[] = [
                    'label' => $data['labe'],
                    'value' => $data['value']
                ];
            }else{
               $dat[] = [
                'label' => 'Blumadata Yang vot',
                'value' => 0
            ];  
        }
    }
} else {
    $dat[] = []; $dat[] = [
        'label' => 'Blumadata Yang vot',
        'value' => 0
    ];  
}
return $dat;
}

public function thn_a()
{
        // $sql = $this->db->select('m_siswa.id,m_siswa.th')
        //     ->from('vote')
        //     ->join('m_siswa', 'm_siswa.nim = vote.nim')

        //     ->join('penilaian', 'penilaian.id = vote.id_penilaian')
        //     ->join('layanan', 'layanan.id =penilaian.id_layanan')
        //     ->join('kategori', 'kategori.id = vote.id_kategori ')
        //     ->order_by('m_siswa.th')->get()->result_array();
    $i = 0;
    $cek=$this->db->get('m_siswa')->row_array();
    if (!empty($cek)) {
            # code...
        $sql = $this->db->query('SELECT DISTINCT th FROM m_siswa  ORDER BY `m_siswa`.`th` ASC')->result_array();
        foreach ($sql as $data) {

                    # code...
            $soal = $this->db->get('penilaian')->num_rows();
            $v = $this->db->DISTINCT(' m_siswa.th')->from('m_siswa')->join('vote', 'vote.nim =m_siswa.nim')
            ->join('penilaian', 'penilaian.id=vote.id_penilaian')->where('th', $data['th'])->get()->num_rows();
            if ($soal != 0 || $v != 0) {
                    # code...
                $tam[] = ['elapsed' => $data['th'], 'value' => $v / $soal];
            } else {
                $tam = 0;

            }
        }
    }else{
        $tam=0;

        
    }
    return  $tam;
}
}

/* End of file M_trafik.php */
