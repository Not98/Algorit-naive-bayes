<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_algo extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  
  public function hitung()
  {
    $this->db->count_all_results('m_siswa');
    $layanan  = $this->db->select('
      layanan.id as idl,
      penilaian.id as idp,
      kategori.id as idk,
      m_siswa.th as tahun,
      m_siswa.nim as nim,
      status.id as ids,
      status.status as status,
      layanan.layanan as layanan,
      penilaian.pertanyaan as pertanyaan,
      kategori.kategori as jawaban
      ')->from('layanan')
      ->join('penilaian', ' penilaian.id_layanan = layanan.id')
      ->join('vote', ' vote.id_penilaian =penilaian.id ')
      ->join('m_siswa', 'm_siswa.nim = vote.nim')
      ->join('kategori_m', 'kategori_m.id = m_siswa.kelas')
      ->join('kategori', ' kategori.id = vote.id_kategori')
      ->join('semester', 'semester.id =m_siswa.smester')
      ->join('status', 'status.id = m_siswa.id_status')
      ->join('jurusan', 'jurusan.id = m_siswa.id_p')
      ->get()->result_array();

    foreach ($layanan as $lay) {

      //jumlah layanan berdasarkan layanan
      $layan = $this->db->select(' m_siswa.nim,status.status,jurusan.jurusan,m_siswa.th,layanan.layanan,
      penilaian.pertanyaan,kategori.kategori,kategori_m.ktegori ,m_siswa.smester')
        ->from('layanan')
        ->join('penilaian', ' penilaian.id_layanan = layanan.id')
        ->join('vote', ' vote.id_penilaian =penilaian.id ')
        ->join('m_siswa', 'm_siswa.nim = vote.nim')
        ->join('kategori_m', 'kategori_m.id = m_siswa.kelas')
        ->join('kategori', ' kategori.id = vote.id_kategori')
        ->join('semester', 'semester.id =m_siswa.smester')
        ->join('status', 'status.id = m_siswa.id_status')
        ->join('jurusan', 'jurusan.id = m_siswa.id_p')
        ->where('penilaian.id_layanan', $lay['idl'])->get()->num_rows();
      // jumlah sooal berdasrkan vot soal
      $soal =  $this->db->select(' m_siswa.nim,status.status,jurusan.jurusan,m_siswa.th,layanan.layanan,
      penilaian.pertanyaan,kategori.kategori,kategori_m.ktegori ,m_siswa.smester')
        ->from('layanan')
        ->join('penilaian', ' penilaian.id_layanan = layanan.id')
        ->join('vote', ' vote.id_penilaian =penilaian.id ')
        ->join('m_siswa', 'm_siswa.nim = vote.nim')
        ->join('kategori_m', 'kategori_m.id = m_siswa.kelas')
        ->join('kategori', ' kategori.id = vote.id_kategori')
        ->join('semester', 'semester.id =m_siswa.smester')
        ->join('status', 'status.id = m_siswa.id_status')
        ->join('jurusan', 'jurusan.id = m_siswa.id_p')
        ->where('vote.id_penilaian', $lay['idp'])->get()->num_rows();
      //jumlah jawaban berdasarkan jawaban
      $jawb =  $this->db->distinct(' m_siswa.nim,status.status,jurusan.jurusan,m_siswa.th,layanan.layanan,
        penilaian.pertanyaan,kategori.kategori,kategori_m.ktegori ,m_siswa.smester')
        ->from('layanan')
        ->join('penilaian', ' penilaian.id_layanan = layanan.id')
        ->join('vote', ' vote.id_penilaian =penilaian.id ')
        ->join('m_siswa', 'm_siswa.nim = vote.nim')
        ->join('kategori_m', 'kategori_m.id = m_siswa.kelas')
        ->join('kategori', ' kategori.id = vote.id_kategori')
        ->join('semester', 'semester.id =m_siswa.smester')
        ->join('status', 'status.id = m_siswa.id_status')
        ->join('jurusan', 'jurusan.id = m_siswa.id_p')
        ->where('kategori.id', $lay['idk'])->get()->num_rows();
      // $jumlah_j[] = ['jawaban' => $lay['jawaban'], 'jumlah' => $jawb];
      // $jawabb[] = $lay['jawaban'];
      $pertanyaan[] = [
        'layanan' => $lay['layanan'], 'vot_layanan' => $layan,
        $lay['jawaban'] => $jawb,
        'pertanyaan' => $lay['pertanyaan'], 'data_vot' => $soal
      ];
      
    }
    return $pertanyaan;
  }
}
