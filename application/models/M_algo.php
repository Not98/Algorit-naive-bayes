<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_algo extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
    //Codeigniter : Write Less Do More
	}
	public function tranformasi(){
		$mhs=$this->db->get('m_siswa')->result_array();
		foreach ($mhs as $mahasiswa) {
			
			$label=$this->db->DISTINCT('layanan.id as idl,kategori.kategori as jawaban, `m_siswa`.`jenis_k` as jenis, penilaian.id_status as status ,status.status as statusm')->from('vote')
			->join('m_siswa','m_siswa.nim=vote.nim')
			->join('status','status.id=m_siswa.id_status')
			->join('penilaian','penilaian.id=vote.id_penilaian')
			->join('layanan','layanan.id=penilaian.id_layanan')
			->join('kategori','kategori.id=vote.id_kategori')
			->where('m_siswa.nim',$mahasiswa['nim'])
			->get()->result_array();
			foreach ($label as $lab) {
				if ($lab['status']==9999) {
					$ket='label';
				}else{
					$ket='p'.$lab['idl'];
				}
				$data[]=[$ket=>$lab['jawaban'],'jenis_k'=>$lab['jenis'],'kate'=>$lab['statusm']];			
			}
			// $tam=[array_unique($data['jenis_k'])]

		}
		echo json_encode($data);
	}


	function hitung(){
		$jenis_k=["L","P"];
  	// membersihkan tabel
		$this->db->truncate('hitung');
    // Pertanyaan Berdasarkan Layaanan
		$layanP=$this->db->select('penilaian.id as idp, layanan.id as idl, penilaian.pertanyaan as tanya,layanan.layanan')->join('layanan','layanan.id=penilaian.id_layanan')->get('penilaian')->result_array();
    // Jawaban
		$jawaban=$this->db->get('kategori')->result_array();
 
    // Jumlah data voting di pertanyaan
		foreach ($layanP as $layanP) {
			$label=$this->db->select('*')->from('vote')
			->join('m_siswa','m_siswa.nim=vote.nim')
			->join('penilaian','penilaian.id=vote.id_penilaian')
			->join('layanan','layanan.id=penilaian.id_layanan')
			->join('kategori','kategori.id=vote.id_kategori')
			->where('vote.id_penilaian',$layanP['idp'])
			// ->where('penilaian.id_status',999)
			->get()->result_array();
			foreach ($label as $key => $value) {
				if ($value['id_status']==9999) {
					$tipe="label";
				}else{
					$tipe='p1';
				}
				$nm=[];
				$datal[]=[
					'nim'=>$value['nim'],
					'jawaban'=>$value['kategori'],
					'layanan'=>$value['layanan'],
					'kategori'=>$tipe,
				];
			}




		}

		echo json_encode($datal);
	}

	function algo(){
		$layanan=$this->db->join('layanan','layanan.id=penilaian.id_layanan')->get('penilaian')->result_array();
		foreach ($layanan as  $value) {
			$jawaban=$this->db->get('kategori')->result_array();
			$awal=$this->db->select('nilai')->get_where('hitung',['layanan'=>$value['layanan']])->row_array();
			foreach ($jawaban as $jawab) {
				$hitung=$this->db->select('nilai')->get_where('hitung',['layanan'=>$value['pertanyaan'],
					'from'=>'L','to'=>$jawab['kategori']])->row_array();
				$this->db->select('nilai')->get_where('hitung',['layanan'=>$value['layanan']])->row_array();

			}

		}

		echo json_encode($hitung);

	}

}



?>