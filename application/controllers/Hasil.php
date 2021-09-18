<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_algo');
        $this->load->model('m_trasnformasi');
        // $this->cetak= new cetak();
    }
    public function ubahp(){
        $p=$this->db->get('m_siswa')->result_array();
        foreach ($p as $key => $value) {
            if ($value['id_p']!=0||$value['jenis_k']!=null || $value['th']!=0 ||$value['smester']!=0||$value['id_status']!=0|| $value['kelas']!=0||$value['key']!=null) {
               
            $this->db->update('m_siswa',['password'=>$this->encryption->encrypt(1)],['nim'=>$value['nim']]);
            }
        }
    }

   
    public function transformasi(){
        $this->db->truncate('hasil');
        $this->db->truncate('tranformasi');



        $nim=$this->db->join('status','status.id=m_siswa.id_status')->get('m_siswa')->result_array();
        foreach ($nim as $key => $value) {
            if ($value['th']!=null) {
                # code...
                $this->db->insert('tranformasi',['nim'=>$value['nim'],'jenis_k'=>$value['jenis_k'],'kate'=>$value['status']]);
            }
        }
          $l =$this->db->select('layanan.id as idl')->from('penilaian')->join('layanan','layanan.id=penilaian.id_layanan')->get()->result_array();
        foreach ($l as $key => $la) {
            $j = $this->db->select('*')
                          ->from('vote')
                          ->join('penilaian','penilaian.id=vote.id_penilaian')
                          ->join('layanan','layanan.id=penilaian.id_layanan')
                          ->join('kategori','kategori.id=vote.id_kategori')
                          ->where('layanan.id',$la['idl'])->get()->result_array();
            foreach ($j as $key => $value) {
                if ($value['id_status']==9999) {
                    $d='label';
                }else{
                    $d='l'.($la['idl']-1);
                }
                $this->db->update('tranformasi',[$d=>$value['kategori']],['nim'=>$value['nim']]);
                $data[]=[$value['layanan'],$d=>$value['kategori']];
            }
        }

       $data_tes= $this->db->get('tranformasi')->result_array();
        foreach ($data_tes as $tes) {
          if ($tes['label']==null) {
            $this->db->insert('test',['nim'=>$tes['nim'],'jenis_k'=>$tes['jenis_k'],'kate'=>$tes['kate'],'l1'=>$tes['l1'],'l2'=>$tes['l2'],'l3'=>$tes['l3'],'l4'=>$tes['l4']] );
          }
        }
        
    }
    public function hitung()
    {
      
  $this->db->truncate('hitung');

       $label=$this->db->DISTINCT('label')->select('label')->get('tranformasi')->result_array();
       $l1=$this->db->DISTINCT('l1,label')->select('l1,label')->get('tranformasi')->result_array();
       $l2=$this->db->DISTINCT('l2,label')->select('l2,label')->get('tranformasi')->result_array();
       $l3=$this->db->DISTINCT('l3,label')->select('l3,label')->get('tranformasi')->result_array();
       $l4=$this->db->DISTINCT('l4,label')->select('l4,label')->get('tranformasi')->result_array();
       $jenis_k=$this->db->DISTINCT('jenis_k,label')->select('jenis_k,label')->get('tranformasi')->result_array();
       $totol=$this->db->count_all_results('tranformasi');
       foreach ($label as $labell) {
        // $labelt[]=['nilai'=>$this->db->where('label',$labell['label'])->count_all_results('tranformasi'),'kategori'=>'total data'];
          if ($labell['label']!=null) {
            $tipe='Data Training';
            $x=[$labell['label']];
          }else{
            $tipe='Data Uji';
          }
            $this->db->insert('hitung',['nilai'=>$this->db->where('label',$labell['label'])->count_all_results('tranformasi'),'kategori'=>$tipe,'from'=>$labell['label']]);
       }

       foreach ($l1 as $ll1) {
        if ($ll1['label']!=null) {
          $this->db->insert('hitung',['kategori'=>'label','layanan'=>'p1','to'=>$ll1['label'],'from'=>$ll1['l1'],'nilai'=>$this->db->where('l1',$ll1['l1'])->where('label',$ll1['label'])->count_all_results('tranformasi')]);
        }
       }
        foreach ($l2 as $ll2) {
        if ($ll2['label']!=null) {
          $this->db->insert('hitung',['kategori'=>'label','layanan'=>'p2','to'=>$ll2['label'],'from'=>$ll2['l2'],'nilai'=>$this->db->where('l2',$ll2['l2'])->where('label',$ll2['label'])->count_all_results('tranformasi')]);
        }
       }
        foreach ($l3 as $ll3) {
        if ($ll3['label']!=null) {
          $this->db->insert('hitung',['kategori'=>'label','layanan'=>'p3','to'=>$ll3['label'],'from'=>$ll3['l3'],'nilai'=>$this->db->where('l3',$ll3['l3'])->where('label',$ll3['label'])->count_all_results('tranformasi')]);
        }
       }
        foreach ($l4 as $ll4) {
        if ($ll4['label']!=null) {
          $this->db->insert('hitung',['kategori'=>'label','layanan'=>'p4','to'=>$ll4['label'],'from'=>$ll4['l4'],'nilai'=>$this->db->where('l4',$ll4['l4'])->where('label',$ll4['label'])->count_all_results('tranformasi')]);
        }
       }
         foreach ($jenis_k as $ljenis_k) {
        if ($ljenis_k['label']!=null) {
          $this->db->insert('hitung',['kategori'=>'label','layanan'=>'jenis_k','to'=>$ljenis_k['label'],'from'=>$ljenis_k['jenis_k'],'nilai'=>$this->db->where('jenis_k',$ljenis_k['jenis_k'])->where('label',$ljenis_k['label'])->count_all_results('tranformasi')]);
        }
       }
       redirect('cetak/pdf','refresh');
 
    }
}

/* End of file: Hasil.php */
