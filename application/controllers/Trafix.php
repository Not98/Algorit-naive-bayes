<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trafix extends CI_Controller {




	public function layanan(){
		$data=$this->input->get(null,true);
			$jawab= $this->db->get('kategori')->result_array();
			foreach ($jawab as $key ) {
				$sql= $this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					 ->where('penilaian.id',$data['id'])
					 ->where('vote.id_kategori',$key['id'])
					 ->count_all_results();
			
				

				$out[]=['label'=>$key['kategori'],'value'=>$sql];
		
			}
			echo json_encode($out);
	}
	public function tahun()
	{
		$data=$this->input->get(null,true);

		$th=$this->db->query('SELECT DISTINCT th FROM m_siswa  ORDER BY `m_siswa`.`th` ASC')->result_array();
		foreach ($th as $thn) {
			if ($thn['th']==0) {
				$sql=0;
			}else{
				
			$sql= $this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					 ->where('penilaian.id',$data['id'])
					 ->where('m_siswa.th',$thn['th'])
					 ->count_all_results();
			}
			
				$out[]=['elapsed'=>$thn['th'],'value'=>$sql];
		}
			echo json_encode($out);

	}
	public function total()
	{
		
		$data1 =$this->db->query('SELECT DISTINCT kategori, pertanyaan, penilaian.id AS idp , kategori.id AS idl FROM vote JOIN penilaian on penilaian.id =vote.id_penilaian JOIN layanan on layanan.id =penilaian.id_layanan JOIN kategori on kategori.id = vote.id_kategori')->result_array();
		$rumus=[];

		
		foreach ($data1 as $value) {

			//total berdasasrrkan jawaban
				$sql= $this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					 ->where('penilaian.id',$value['idp'])
					 ->where('vote.id_kategori',$value['idl'])
					 ->count_all_results();


			//Rumus layanan ->jawana * layanan->jawaban
				$lj= $this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					->where('penilaian.id',$value['idp'])
					 ->where('vote.id_kategori',$value['idl'])
					 ->count_all_results()*$this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					->where('penilaian.id',$value['idp'])
					 ->where('vote.id_kategori',$value['idl'])
					 ->count_all_results()/$this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					 ->where('penilaian.id',$value['idp'])
					 ->count_all_results();


				//Total layanan vot
				$sqlTl= $this->db->select('*')
					 ->from('vote')
					 ->join('penilaian','penilaian.id= vote.id_penilaian')
					 ->join('layanan','layanan.id =penilaian.id_layanan')
					 ->join('kategori','kategori.id =vote.id_kategori')
					 ->join('m_siswa','m_siswa.nim = vote.nim')
					 ->where('penilaian.id',$value['idp'])
					 ->count_all_results();


				

				$out[]=['pertanyaan'=>$value['pertanyaan'],'label'=>$value['kategori'],'value'=>$sql,'total jawaban / data masuk'.$value['kategori']=>$lj,'total layanan'=>$sqlTl
				];
		}
			echo json_encode($out);

	}

}

/* End of file Trafix.php */
/* Location: ./application/controllers/Trafix.php */
 ?>