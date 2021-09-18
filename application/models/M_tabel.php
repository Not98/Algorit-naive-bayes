<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Tabel extends CI_Model
{

  public function tb_nilai($search, $limit, $start, $order_ascdesc, $order_field)
  {

    $data = $this->db->select('*')
      ->from('kategori')
      ->like('kategori', $search)
      ->or_like('nilai', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();

    return $data;
  }
  public function tb_nilai_c($search)
  {

    $data = $this->db->select('*')
      ->from('kategori')
      ->like('kategori', $search)
      ->or_like('nilai', $search)
      ->get()->result_array();

    return $data;
  }
  public function tb_nilai_count()
  {
    $this->db->select('*')
      ->from('kategori');
    return $this->db->count_all_results();
  }


  //layanan

  public function tb_layanan($search, $limit, $start, $order_ascdesc, $order_field)
  {
    $data = $this->db->select('*')
      ->from('layanan')
      ->like('layanan', $search)
      ->or_like('layanan', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();

    return $data;
  }
  public function tb_layanan_c($search)
  {

    $data = $this->db->select('*')
      ->from('layanan')
      ->like('layanan', $search)
      ->or_like('layanan', $search)
      ->get()->result_array();

    return $data;
  }
  public function tb_layanan_count()
  {
    $this->db->select('*')
      ->from('layanan');
    return $this->db->count_all_results();
  }


  //per tananyaan
  public function tb_kuesioner($search, $limit, $start, $order_ascdesc, $order_field)
  {
    $data = $this->db->select('layanan,pertanyaan,penilaian.id as id')
      ->from('penilaian')
      ->join('layanan', 'layanan.id = penilaian.id_layanan')
      //penambahan detail
      //  ->join('jawaban' ,'jawaban.id_vote =penilaian.id')
      //  ->join('kategori','kategori.id =jawaban.id_kategori ')
      ->like('layanan', $search)
      ->or_like('pertanyaan', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();
    return $data;
  }
  public function tb_kuesioner_c($search)
  {
    $data = $this->db->select('layanan,pertanyaan,penilaian.id')
      ->from('penilaian')
      ->join('layanan', 'layanan.id = penilaian.id_layanan')
      ->like('layanan', $search)
      ->or_like('pertanyaan', $search)
      ->get()->result_array();

    return $data;
  }
  public function tb_kuesioner_count()
  {
    $this->db->select('kategori.kategori,penilaian.pertanyaan,penilaian.id')
      ->from('penilaian')
      ->join('layanan', 'layanan.id = penilaian.id_layanan');
    return $this->db->count_all_results();
  }
  public function detail()
  {
    $data['kat'] = $this->db->select('layanan,pertanyaan,penilaian.id as id')
      ->from('penilaian')
      ->join('layanan', 'layanan.id = penilaian.id_layanan')
      //penambahan detail
      ->join('jawaban', 'jawaban.id_vote =penilaian.id')
      ->join('kategori', 'kategori.id =jawaban.id_kategori ')
      ->where('')
      ->get()->result_array();
    return $data;
  }
  public function tbl_vot($search, $limit, $start, $order_ascdesc, $order_field)
  {
    $data = $this->db->select('
     m_siswa.id AS id,m_siswa.nim,m_siswa.id_p,m_siswa.jenis_k,m_siswa.th,
     m_siswa.smester,m_siswa.id_status,m_siswa.kelas,m_siswa.email,m_siswa.smester,
     m_siswa.password,m_siswa.keyy ,status.status,status.id as ids,jurusan.id as idj,jurusan.jurusan ')
      ->from('m_siswa')
      ->join('jurusan', 'jurusan  on jurusan.id = m_siswa.id_p')
      ->join('status', 'status.id = m_siswa.id_status ')
      ->join('kategori_m', ' kategori_m.id = m_siswa.kelas')
      ->join('semester', 'semester.id = m_siswa.smester ')
      ->where('m_siswa.id_p>0')
      ->where('id_status>0')
      ->where('m_siswa.smester>0')
      ->where('m_siswa.kelas>0')
      ->like('nim', $search)
      ->or_like('jurusan', $search)
      ->or_like('th', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();
    $cek= $this->db->select('
     m_siswa.id AS id,m_siswa.nim,m_siswa.id_p,m_siswa.jenis_k,m_siswa.th,
     m_siswa.smester,m_siswa.id_status,m_siswa.kelas,m_siswa.email,m_siswa.smester,
     m_siswa.password,m_siswa.keyy ,status.status,status.id as ids,jurusan.id as idj,jurusan.jurusan ')
      ->from('m_siswa')
      ->join('jurusan', 'jurusan  on jurusan.id = m_siswa.id_p')
      ->join('status', 'status.id = m_siswa.id_status ')
      ->join('kategori_m', ' kategori_m.id = m_siswa.kelas')
      ->join('semester', 'semester.id = m_siswa.smester ')
      ->where('m_siswa.id_p>0')
      ->where('id_status>0')
      ->where('m_siswa.smester>0')
      ->where('m_siswa.kelas>0')
      ->like('nim', $search)
      ->or_like('jurusan', $search)
      ->or_like('th', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->row_array();
    if ($cek) {
    foreach ($data as $dat) {
      if ($dat['ids'] != 0 || $dat['idj'] != 0 || $dat['jenis_k'] != null || $dat['id_p'] != 0 || $dat['password'] != 0 || $dat['email'] != null || $dat['keyy'] != null) {
        $sql[] = [
          'nim' => $dat['nim'], 'jurusan' => $dat['jurusan'],
          'th' => $dat['th'], 'smester' => $dat['smester'],
          'id' => $dat['id']
        ];
      }      

    }
  }else {
       $kosong=$this->db->like('nim', $search)->get('m_siswa')->result_array();
        foreach ($kosong as $valuek) {
            if ($valuek['id_p']==0||$valuek['jenis_k']==0||$valuek['th']==0||$valuek['smester']==0||$valuek['id_status']==0||$valuek['kelas']==0) {
              # code...
             $sql[] = [
                        'nim' => $valuek['nim'], 'jurusan' =>  'Belum di isi',
                        'th' => 'Belum di isi', 'smester' =>  'Belum di isi',
                        'id' => $valuek['id']
                      ];
            }
        }
      }
    
  
      return $sql;
   
  }
  public function tbl_vot_search($search)
  {
    $data = $this->db->select('
    m_siswa.id AS id,m_siswa.nim,m_siswa.id_p,m_siswa.jenis_k,m_siswa.th,
    m_siswa.smester,m_siswa.id_status,m_siswa.kelas,m_siswa.email,m_siswa.smester,
    m_siswa.password,m_siswa.keyy ,status.status,status.id as ids,jurusan.id as idj,jurusan.jurusan ')
      ->from('m_siswa')
      ->join('jurusan', 'jurusan  on jurusan.id = m_siswa.id_p')
      ->join('status', 'status.id = m_siswa.id_status ')
      ->join('kategori_m', ' kategori_m.id = m_siswa.kelas')
      ->join('semester', 'semester.semester = m_siswa.smester ')
      ->like('nim', $search)
      ->or_like('jurusan', $search)
      ->or_like('th', $search)
      ->get()->result_array();
    $chek =$this->db->select('
    m_siswa.id AS id,m_siswa.nim,m_siswa.id_p,m_siswa.jenis_k,m_siswa.th,
    m_siswa.smester,m_siswa.id_status,m_siswa.kelas,m_siswa.email,m_siswa.smester,
    m_siswa.password,m_siswa.keyy ,status.status,status.id as ids,jurusan.id as idj,jurusan.jurusan ')
      ->from('m_siswa')
      ->join('jurusan', 'jurusan  on jurusan.id = m_siswa.id_p')
      ->join('status', 'status.id = m_siswa.id_status ')
      ->join('kategori_m', ' kategori_m.id = m_siswa.kelas')
      ->join('semester', 'semester.semester = m_siswa.smester ')
      ->like('nim', $search)
      ->or_like('jurusan', $search)
      ->or_like('th', $search)
      ->get()->row_array();
      if ($chek) {
          foreach ($data as $dat) {
            if ($dat['ids'] != 0 || $dat['idj'] != 0 || $dat['jenis_k'] != null || $dat['id_p'] != 0 || $dat['password'] != 0 || $dat['email'] != null || $dat['keyy'] != null) {

              $sql[] = [
                'nim' => $dat['nim'], 'jurusan' => $dat['jurusan'],
                'th' => $dat['th'], 'smester' => $dat['smester'],
                'id' => $dat['id']
              ];
            } 
          }
        
      }else {
        $kosong=$this->db->like('nim', $search)->get('m_siswa')->result_array();
        foreach ($kosong as $valuek) {
            if ($valuek['id_p']==0||$valuek['jenis_k']==0||$valuek['th']==0||$valuek['smester']==0||$valuek['id_status']==0||$valuek['kelas']==0) {
              # code...
             $sql[] = [
                        'nim' => $valuek['nim'], 'jurusan' =>  'Belum di isi',
                        'th' => 'Belum di isi', 'smester' =>  'Belum di isi',
                        'id' => $valuek['id']
                      ];
            }
        }
      }
    
      # code...
      return $sql;
   
  }

  public function tbl_account_count()
  {
    $data = $this->db->select('nim,jurusan,th ,m_siswa.id as id, semester,status.status,password ,email ')
      ->from('m_siswa')
      ->join('jurusan', 'jurusan  on jurusan.id = m_siswa.id_p')
      ->join('status', 'status.id = m_siswa.id_status ')
      ->join('semester', 'semester.id = m_siswa.smester ')
      ->join('kategori_m', ' kategori_m.id = m_siswa.kelas')->get();
    $cek =  $this->db->select('nim,jurusan,th ,m_siswa.id as id, semester,status.status,password ,email ')
      ->from('m_siswa')
      ->join('jurusan', 'jurusan  on jurusan.id = m_siswa.id_p')
      ->join('status', 'status.id = m_siswa.id_status ')
      ->join('semester', 'semester.id = m_siswa.smester ')
      ->join('kategori_m', ' kategori_m.id = m_siswa.kelas')->get()->row_array();
    if ($cek) {
      $ni= $data->count_all_results();
      if ($ni>0) {
        return $ni;
      }
    } else {
      return $this->db->count_all_results('m_siswa');
    }
  }
  // kategori Mahasiswa
  public function tbl_kategori_m($search, $limit, $start, $order_ascdesc, $order_field)
  {
    $data = $this->db->select('*')
      ->from('kategori_m')
      ->like('id', $search)
      ->or_like('ktegori', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();
    foreach ($data as $sq) {
      if ($sq['id'] != 1) {
        $sql[] = ['ktegori' => $sq['ktegori'],'id'=>$sq['id']];
      }else{
      }
    }
    return $sql;
  }
  public function tbl_kategori_m_c($search)
  {
    $data = $this->db->select('*')
      ->from('kategori_m')
      ->like('id', $search)
      ->or_like('ktegori', $search)
      ->get()->result_array();
    foreach ($data as $sq) {
      if ($sq['id'] != 1) {
        $sql[] = ['ktegori' => $sq['ktegori'],'id'=>$sq['id']];
      }
    }
    return $sql;
  }
  public function tbl_kategori_m_coun()
  {
    $this->db->select('*')
      ->from('kategori_m');
    return $this->db->count_all_results();
  }
  // Status Mahasiswa
  public function tbl_status_m($search, $limit, $start, $order_ascdesc, $order_field)
  {
    $data = $this->db->select('*')
      ->from('status')
      ->like('id', $search)
      ->or_like('status', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();
    foreach ($data as $sq) {
      if ($sq['id'] != 1) {
        $sql[] = ['status' => $sq['status'],'id'=>$sq['id']];
      }
    }
    return $sql;
  }
  public function tbl_status_m_c($search)
  {
    $data = $this->db->select('*')
      ->from('status')
      ->like('id', $search)
      ->or_like('status', $search)
      ->get()->result_array();
    foreach ($data as $sq) {
      if ($sq['id'] != 1) {
        $sql[] = ['status' => $sq['status'],'id'=>$sq['id']];
      }
    }

    return $sql;
  }
  public function tbl_status_m_coun()
  {
    $this->db->select('*')
      ->from('status');
    return $this->db->count_all_results();
  }
  // jurusan mahasiswa
  public function tbl_jurusan($search, $limit, $start, $order_ascdesc, $order_field)
  {
    $data = $this->db->select('*')
      ->from('jurusan')
      ->like('id', $search)
      ->or_like('jurusan', $search)
      ->order_by($order_field, $order_ascdesc) //order by ascendin or desc
      ->limit($limit, $start)
      ->get()->result_array();
    foreach ($data as $sq) {
      if ($sq['id'] != 0) {
        $sql[] = ['jurusan' => $sq['jurusan'],'id'=>$sq['id']];
      }
    }

    # code...
    return $sql;
  }
  public function tbl_jurusan_c($search)
  {
    $data = $this->db->select('*')
      ->from('jurusan')
      ->like('id', $search)
      ->or_like('jurusan', $search)
      ->get()->result_array();
    foreach ($data as $sq) {
      if ($sq['id'] != 0) {
        $sql[] = ['jurusan' => $sq['jurusan'],'id'=>$sq['id']];
      }
    }

    return $sql;
  }
  public function tbl_jurusan_coun()
  {
    $this->db->select('*')
      ->from('jurusan');
    return $this->db->count_all_results();
  }
}

/* End of file Tabel.php */
