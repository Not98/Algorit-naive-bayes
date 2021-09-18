<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_algo extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function hitung(){
    $this->db->truncate('hitung');
    $jk=['L','K'];
    $jawaban=$this->db->get('kategori')->result_array();

    foreach($jawaban as $jawaban){
      //Jumlah Jawaban
      $this->db->insert('hitung', ['nilai'=>$this->db->select('*')
                                                    ->from('vote')
                                                    ->join('m_siswa','m_siswa.nim=vote.nim')
                                                    ->join('penilaian','penilaian.id=vote.id_penilaian')
                                                    ->join('layanan','layanan.id=penilaian.id_layanan')
                                                    ->join('kategori','kategori.id=vote.id_kategori')
                                                    ->where('vote.id_kategori',$jawaban['id'])
                                                    ->count_all_results(),
                                    'kategori'=>'awal',
                                    'from'=>$jawaban['kategori']]);
    }


    //jumlah data masuk berdasarkan layanan
    $layanan=$this->db->select('layanan.id as idl, penilaian.id as idp')
                      ->join('penilaian','penilaian.id_layanan=layanan.id')
                      ->get('layanan')->result_array();
    foreach($layanan as $layanan){
      $this->db->insert('hitung', ['nilai'=>$this->db->select('*')
                                            ->from('vote')
                                            ->join('m_siswa','m_siswa.nim=vote.nim')
                                            ->join('penilaian','penilaian.id=vote.id_penilaian')
                                            ->join('layanan','layanan.id=penilaian.id_layanan')
                                            ->where('layanan.id',$layanan['idl'])
                                            ->where('penilaian.id',$layanan['idp'])
                                            ->count_all_results(),
                                  'kategori'=>'nilai',
                                  'from'=>'nilai id layanan '.$layanan['idl'],
                                  'to'=>'id penilaian '.$layanan['idp']
                                ]);
      
      }

      //jenis kelamin
      for($i=0;$i<count($jk);$i++){
    $jawabanjk=$this->db->select('kategori.kategori as kategori, kategori.id as idk, layanan.layanan,penilaian.pertanyaan')
                        ->from('vote')
                        ->join('m_siswa','m_siswa.nim=vote.nim')
                        ->join('penilaian','penilaian.id=vote.id_penilaian')
                        ->join('layanan','layanan.id=penilaian.id_layanan')
                        ->join('kategori','kategori.id=vote.id_kategori')->get()->result_array();
    foreach($jawabanjk as $jawabanjk){
            $datajk[]=['nilai'=>$this->db->select('*')
                                          ->from('vote')
                                          ->join('m_siswa','m_siswa.nim=vote.nim')
                                          ->join('penilaian','penilaian.id=vote.id_penilaian')
                                          ->join('layanan','layanan.id=penilaian.id_layanan')
                                          ->join('kategori','kategori.id=vote.id_kategori')
                                          ->where('vote.id_kategori',$jawabanjk['id'])
                                          ->where('m_siswa.jenis_k',$jk[$i])
                                          ->count_all_results(),
                        'kategori'=>'awal',
                        'from'=>$jk[$i],
                        'to'=>$jawabanjk['kategori']
                        ];
        }
      }
    echo json_encode($datajk);
  }


  
}
