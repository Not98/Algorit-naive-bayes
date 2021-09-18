<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_penilaian extends CI_Model {

    public function tambahKat($data,$tabel){
        $chek = $this->db->get_where($tabel,$data);
       if(empty($data)){
        $ms['message'] ="error";
       }else if ($chek->row_array()>1) {
        $ms['message'] ="gagal";
       }else{
           $this->db->insert($tabel,$data);
           $ms['message'] ='ok';
       }
    return $ms;
    }

    public function jawabn($id){    
        $sql= $this->db->select('kategori.kategori as jawaban')
                        ->from('penilaian')
                        ->join('layanan','layanan.id =penilaian.id_layanan')
                        ->join('jawaban','jawaban.id_penialian =penilaian.id')
                        ->join('kategori','kategori.id =jawaban.id_kategori')
                        ->where('penilaian.id ',$id)->get()->result_array();
        foreach($sql as $jaban){
            $dat[]=['jawaban'=>$jaban['jawaban']];
        }
        if($dat!=null){
            $data['message']='ok';
            $data=$dat;
            
        }else{
            $data['message']='not';
        }
        return $data;
    }
    public function getdetail(){    
        
        $sql1 = $this->db->get('kategori')->result_array();
       
        foreach ($sql1 as $key => $value) {
          
                $data[]=$value;
         
           
        }
        return $data;
    }
    public function  cekbok($id){
        $sql = $this->db->select('kategori.kategori as jawaban')
                    ->from('jawaban')
                    ->join('penilaian','penilaian.id=jawaban.id_penialian')
                    ->join('layanan','layanan.id=penilaian.id_layanan')
                    ->join('kategori','kategori.id = jawaban.id_kategori')
                    ->where('id_penialian',$id)->get()->result_array();
        // foreach ($fq1sql as $hasil){
        //     $data=unserialize($hasil['jawab']);
        // }
        
        foreach ($sql as $key => $value) {
           
            $d[]=['jawaban'=>$value['jawaban']];
        }
            // echo json_encode($d);
            // die;
       
            return $d;
        }
    

    public function soal()//belum fix 
    {
        $data=[];
        $layan =[];
        $jawaban=[];
        $sql1= $this->db->get('layanan')->result_array();
        foreach ($sql1 as $id)
        {
            $sql= $this->db->select('*')
                        ->from('penilaian')
                        ->join('layanan','layanan.id =penilaian.id_layanan')
                        ->where('layanan.id',$id['id'])
                        ->get()->result_array();
                        
            $sql2= $this->db->select('*')
                            ->from('penilaian')
                            ->join('layanan','layanan.id =penilaian.id_layanan')
                            ->join('jawaban','jawaban.id_penialian =penilaian.id')
                            ->join('kategori','kategori.id =jawaban.id_kategori')
                            ->where('layanan.id',$id['id'])->get()->result_array();
                foreach($sql as $layanan)
                {
                  $ll=['layananan'=>$layanan['layanan']];
                }
                foreach($sql2 as $jawb)
                {
                 $l=['jawaban'=>$jawb['kategori']];
                }
                $jawaban[]=$l;
                $layan[]=$ll;
                
            }
            $data[]=[$layan,$jawaban];
           
            $tampil['soal']=$data;
            echo json_encode($tampil);
            return $data;
     
                                
        
    }


}

/* End of file M_penialaian.php */



?>