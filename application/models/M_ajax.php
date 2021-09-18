<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ajax extends CI_Model
{

  function getDel($id, $tabel)
  {
    return $this->db->get_where($tabel, ['id' => $id])->result();
  }
  public function del($id, $tabel)
  {
    return $this->db->delete($tabel, ['id' => $id]);
  }
  public function updt($id, $data, $tabel)
  {
    return $this->db->update($tabel, $data, ['id' => $id]);
  }

  public function delkuejaw($get)
  {
    $data1 = $this->db->where('id_penialian', $get['id'])->delete('jawaban');
    $data = $this->db->where('id', $get['id'])->delete('penilaian');
    if ($data && $data1) {
      $message['message'] = "del_ok";
    } else {
      $message['message'] = "del_error";
    }
    return $message;
  }

  public function add($db, $data)
  {

    $chek = $this->db->get_where($db, $data)->row_array();
    if (empty($chek)) {
      $sql  = $this->db->insert($db, $data);
      if ($sql) {
        $dat['message'] = "ok";
      } else {
        $dat['message'] = "error";
      }
    } else {
      $dat['message'] = "sudah_ada";
    }
    return $dat;
  }

  public function pilihan()
  {
    $data = [];
    $sql = $this->db->get('layanan')->result_array();
    foreach ($sql as  $dat) {
      $data[] = ['layanan' => $dat['layanan'], 'id' => $dat['id']];
    }
    return $data;
  }



  public function jawaban($db, $data, $post)
  {
   
    for ($i = 0; $i < count($post['jawab']); $i++) {
      $data3[] = $post['jawab'][$i]['value'];
      # code...
    }
    $chek1 = $this->db->get_where($db, $data)->row_array();
    if (empty($chek1)) {
      $insert1 = $this->db->insert($db, $data);
      if ($insert1) {
        $chek3 =  $this->db->get_where($db, $data)->row_array();
        if ($chek3) {
         for ($i = 0; $i < count($post['jawab']); $i++) {
          $data1 = [
            "id_penialian" =>$chek3['id'],
            "id_kategori"  => $post['jawab'][$i]['value']
          ];
          $chek2 = $this->db->get_where('jawaban', $data1)->row_array();
          if (empty($chek2)) {
            $insert2 = $this->db->insert('jawaban', $data1);
            if ($insert2) {
              $dat['message'] = "ok";
            } else {
              $dat['message'] = "error";
            }
          } else {
            $dat['message'] = "data_ada";
          }
        }
        
      }
    } else {

      $dat['message'] = "error";
    }
  } else {
    $dat['message'] = "data_ada";
  }

  return $dat;
}

public function upjawaban($db, $data, $post)
{

  for ($i = 0; $i < count($post['jawab']); $i++) {
    $data3[] = $post['jawab'][$i]['value'];
      # code...
  }


  $sql = $this->db->get_where('penilaian', ['id' => $post['id']])->row_array();
  if ($sql) {

    $update = $this->db->update('penilaian', $data, ['id' => $post['id']]);
    if ($update) {
      $hps=$this->db->delete('jawaban',[ "id_penialian" =>$sql['id']]);
      
      for ($i = 0; $i < count($post['jawab']); $i++) {
       $data1 = [
        "id_penialian" =>$sql['id'],
        "id_kategori"  => $post['jawab'][$i]['value']
      ];
      $upjawaban = $this->db->insert('jawaban', $data1);
      
            # code...
    }
    
    if ($upjawaban) {
      $dat['message'] = "ok";
    } else {
      $dat['message'] = "error";
    }
  } else {
    $dat['message'] = "error";
  }
} else {
  $dat['message'] = "error";
}

return $dat;
}
public function get_editJ($get)
{

 $sql = $this->db->select(' `jawaban`.`id_kategori` as `jawab`,
  `layanan`.`layanan` as `layanann`, `penilaian`.`pertanyaan` as `pertanyaan`,
  layanan.id as idL,penilaian.id as pid')
 ->from('jawaban')
 ->join('penilaian','penilaian.id=jawaban.id_penialian')
 ->join('layanan','layanan.id=penilaian.id_layanan')
 ->join('kategori','kategori.id = jawaban.id_kategori')
 ->where('id_penialian',$get['id'])->get()->result_array();
        // foreach ($fq1sql as $hasil){
        //     $data=unserialize($hasil['jawab']);
        // }
 
 foreach ($sql as $key => $value) {

  $idj[]=$value['jawab'];
  $pr[]= $value['pertanyaan'];
  $pid[]= $value['pid'];
  $idl[]=$value['idL'];
  $lay[]=$value['layanann'];
  
}
            // echo json_encode($d);
            // die;


$jawabn = $this->db->get('kategori')->result_array();
foreach ($jawabn as $j) {
  $ja[] = $j;
}
$layan = $this->db->get('layanan')->result_array();
foreach ($layan as $j) {
  $la[] = $j;
}
$data = ['idJ'=>$idj,
'layanan' => $lay, 
'pertanyaan' => $pr, 'pid' => $pid, 'idL' => $idl,  'jawaban' => $ja, 'layananf' => $la];

return $data;
}

function jawaba($data1)
{
  $s =  $this->db->insert('jawaban', $data1);
  if ($s) {
      # code...
    $dat['message'] = "ok";
  }
  return $dat;
}
}

/* End of file M_ajax.php */
