<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;


class Cetak extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');
    $this->load->model('M_trasnformasi','kepo');

   
  }
  public function pdf()
  {
    $this->kepo->trasnformasi();
    $this->kepo->hitung();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //penulis
        $pdf->SetAuthor('42416019');
        $pdf->SetTitle('Hasil Dari Kepuasan');
        $pdf->SetSubject('Prediksi Kepusasan  layanan Akademik degan Naive Bayes');
        $pdf->SetKeywords('Naive Bayes,Prediksi');
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetMargins(PDF_MARGIN_TOP,PDF_MARGIN_BOTTOM,PDF_MARGIN_LEFT,PDF_MARGIN_RIGHT);

        
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        
        $pdf->SetFont('');
        $dat= $this->db->order_by('tranformasi.id', 'ASC')->get('tranformasi', 100)->result_array();
      
       $tabel = ' <html>
          <head>
          <style>
          table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
          }
          </style>
          </head>
          <body><center><h1>Hasil Transformasi Data Training</h1></center><table>
                            
                  <tr bgcolor="#ffffff">
                  <th>Jenis kelamin</th>
                  <th>Pertanyaan1</th>
                  <th>Pertanyaan2</th>
                  <th>Pertanyaan3</th>
                  <th>Pertanyaan4</th>
                  <th style="text-align:center">Label</th>
                  </tr>
                  
                  <tbody>';
        foreach ($dat as $trans) {
           $tabel.= '
                  <tr bgcolor="#ffffff">
                  <td style="text-align:center">'.$trans['jenis_k'].'</td>
                  <td style="text-align:center">'.$trans['l1'].'</td>
                  <td style="text-align:center">'.$trans['l2'].'</td>
                  <td style="text-align:center">'.$trans['l3'].'</td>
                  <td style="text-align:center">'.$trans['l4'].'</td>
                  <td style="text-align:center">'.$trans['label'].'</td>
                 
                  </tr>';
        }
                  
        $tabel.='</tbody></table>';

       $tabel.= ' <center><h1>Hasil Transformasi Data uji</h1></center><table>
                            
                  <tr bgcolor="#ffffff">
                  <th>Jenis kelamin</th>
                  <th>Pertanyaan1</th>
                  <th>Pertanyaan2</th>
                  <th>Pertanyaan3</th>
                  <th>Pertanyaan4</th>
                  <th style="text-align:center">Label</th>
                  </tr>
                  
                  <tbody>';

        $uji=$this->db->order_by('tranformasi.id', 'DESC')->get('tranformasi', 12)->result_array();

        foreach ($uji as $datau) {
         $lbuji = $this->db->get_where('data_uji',['nim'=>$datau['nim']])->row_array();
              $tabel.= '
                  <tr bgcolor="#ffffff">
                  <td style="text-align:center">'.$datau['jenis_k'].'</td>
                  <td style="text-align:center">'.$datau['l1'].'</td>
                  <td style="text-align:center">'.$datau['l2'].'</td>
                  <td style="text-align:center">'.$datau['l3'].'</td>
                  <td style="text-align:center">'.$datau['l4'].'</td>
                  <td style="text-align:center">'.$lbuji['label'].'</td>
                 
                  </tr>';
         
        }

        $tabel.='</tbody></table><br><br>';
        $hitung=$this->db->get('hitung')->result_array();
        foreach ($hitung as $value) {
          if ($value['kategori']!='label') {
            $tabel.='<br>Nilai '.$value['kategori'].' '.$value['from'].' = '.$value['nilai'];
          }
          
          if ($value['kategori']='label') {
            if ($value['layanan']!=null) {
              # code...
            $tabel.='<br>'.$value['layanan'].'('.$value['from'].' '.$value['to'].')'.' = '.$value['nilai'];
            }
          }
        }
 $rumus=$this->db->order_by('tranformasi.id', 'DESC')->get('tranformasi', 12)->result_array();
 
        foreach ($rumus as $r) {
    
            $l=$this->db->DISTINCT('to')->select('to')->get('hitung')->result_array();
              foreach ($l as $ll) {
                // total data trening
                $toatld=$this->db->select_sum('`hitung`.`nilai`')->get_where('hitung',['kategori'=>'Data Training'])->row_array();
                // nilai porbabelyti
                $bagi=$this->db->select('nilai')->get_where('hitung',['kategori'=>'Data Training','from'=>$ll['to']])->row_array();
                if ($ll['to']!=null) {
                  // total data l4 where label(puas tidak puas)
                  $nilai4=$this->db->select('nilai')->get_where('hitung',['layanan'=>'p4','from'=>$r['l4'],'to'=>$ll['to']])->row_array();

                  // nilai berdasarkan jawaban
                  $tnilai4=$this->db->query('select count(l4) as l4 from tranformasi where l4="'.$r['l4'].'" and label!=""')->row_array();
                    // total data l4 where label(puas tidak puas)
                  $nilai3=$this->db->select('nilai')->get_where('hitung',['layanan'=>'p3','from'=>$r['l3'],'to'=>$ll['to']])->row_array();

                  // nilai berdasarkan jawaban
                  $tnilai3=$this->db->query('select count(l3) as l3 from tranformasi where l3="'.$r['l3'].'" and label!=""')->row_array();

                       // total data l2 where label(puas tidak puas)
                  $nilai2=$this->db->select('nilai')->get_where('hitung',['layanan'=>'p2','from'=>$r['l2'],'to'=>$ll['to']])->row_array();

                  // nilai berdasarkan jawaban
                  $tnilai2=$this->db->query('select count(l2) as l2 from tranformasi where l2="'.$r['l2'].'" and label!=""')->row_array();
                 
                     // total data l2 where label(puas tidak puas)
                  $nilai1=$this->db->select('nilai')->get_where('hitung',['layanan'=>'p1','from'=>$r['l1'],'to'=>$ll['to']])->row_array();

                  // nilai berdasarkan jawaban
                  $tnilai1=$this->db->query('select count(l1) as l1 from tranformasi where l1="'.$r['l1'].'" and label!=""')->row_array();

                     // total data jenis kelamin where label(puas tidak puas)
                  $njk=$this->db->select('nilai')->get_where('hitung',['layanan'=>'jenis_k','from'=>$r['jenis_k'],'to'=>$ll['to']])->row_array();

                  // nilai berdasarkan jawaban
                  $tjk=$this->db->query('select count(jenis_k) as jenis_k from tranformasi where jenis_k="'.$r['jenis_k'].'" and label!=""')->row_array();
                  $hsl[$ll['to']]=[
                                    $bagi['nilai']/$toatld['nilai']*($nilai4['nilai']/$tnilai4['l4'])*
                                  ($nilai3['nilai']/$tnilai3['l3'])*($nilai2['nilai']/$tnilai2['l2'])*
                                  ($nilai1['nilai']/$tnilai1['l1'])*($njk['nilai']/$tjk['jenis_k'])
                                ];
                  // $tabel.=$hsl[];

                 

                  $tabel.='<br><br>P(X|'.$ll['to'].')=P('.$bagi['nilai'].'/'.$toatld['nilai'].')*P('.$nilai4['nilai'].'/'.$tnilai4['l4'].')*P('.$nilai3['nilai'].'/'.$tnilai3['l3'].')*P('.$nilai2['nilai'].'/'.$tnilai2['l2'].')*P('.$nilai1['nilai'].'/'.$tnilai1['l1'].')*P('.$njk['nilai'].'/'.$tjk['jenis_k'].')='.
                  $bagi['nilai']/$toatld['nilai']*($nilai4['nilai']/$tnilai4['l4'])*($nilai3['nilai']/$tnilai3['l3'])*($nilai2['nilai']/$tnilai2['l2'])*($nilai1['nilai']/$tnilai1['l1'])*($njk['nilai']/$tjk['jenis_k']).'<br>';
                  if ($ll['to']=='Puas') {
                    $t='p';
                  }else{
                    $t='t';
                  }

                  $cek=$this->db->get_where('hasil',['nim'=>$r['nim']])->row_array();
                  if (empty($cek)) {
                    $this->db->insert('hasil',['nim'=>$r['nim']]);
                    if (empty($cek['p'])) {
                      if ($t=='p') {
                        $this->db->update('hasil', [$t=>$bagi['nilai']/$toatld['nilai']*($nilai4['nilai']/$tnilai4['l4'])*($nilai3['nilai']/$tnilai3['l3'])*($nilai2['nilai']/$tnilai2['l2'])*($nilai1['nilai']/$tnilai1['l1'])*($njk['nilai']/$tjk['jenis_k'])],['nim'=>$r['nim']]);
                      }
                    }
                    if (empty($cek['t'])) {
                      if ($t=='t') {
                        $this->db->update('hasil', [$t=>$bagi['nilai']/$toatld['nilai']*($nilai4['nilai']/$tnilai4['l4'])*($nilai3['nilai']/$tnilai3['l3'])*($nilai2['nilai']/$tnilai2['l2'])*($nilai1['nilai']/$tnilai1['l1'])*($njk['nilai']/$tjk['jenis_k'])],['nim'=>$r['nim']]);
                      }
                    }

                  }else{
                    if (empty($cek['p'])) {
                      if ($t=='p') {
                        $this->db->update('hasil', [$t=>$bagi['nilai']/$toatld['nilai']*($nilai4['nilai']/$tnilai4['l4'])*($nilai3['nilai']/$tnilai3['l3'])*($nilai2['nilai']/$tnilai2['l2'])*($nilai1['nilai']/$tnilai1['l1'])*($njk['nilai']/$tjk['jenis_k'])],['nim'=>$r['nim']]);
                      }
                    }
                    if (empty($cek['t'])) {
                      if ($t=='t') {
                        $this->db->update('hasil', [$t=>$bagi['nilai']/$toatld['nilai']*($nilai4['nilai']/$tnilai4['l4'])*($nilai3['nilai']/$tnilai3['l3'])*($nilai2['nilai']/$tnilai2['l2'])*($nilai1['nilai']/$tnilai1['l1'])*($njk['nilai']/$tjk['jenis_k'])],['nim'=>$r['nim']]);
                      }
                    }
                  }

                }
                
              }            
          
        }
        $hasil_a=$this->db->select('*')->from('tranformasi')
        ->join('hasil','hasil.nim=tranformasi.nim')->limit(12)->get()
        ->result_array();
   
  $tabel.= '<br><br><br><br><br><br> <center><h1>Hasil Perhitungan </h1></center><table>
                            
                  <tr bgcolor="#ffffff">
                  <th>Data uji</th>
                  <th>Class Prediksi</th>
                  <th>Tidak Puas</th>
                  <th> Puas</th>
                  </tr>
                  
                  <tbody>';
        foreach ($hasil_a as $hasill) {
          if ($hasill['p']>$hasill['t']) {
            $hasil_akhir='Puas';
          } else {
            $hasil_akhir='Tidak Puas';
          }
        $this->db->update('data_uji',['matrix'=>$hasil_akhir],['nim'=>$hasill['nim']]);
        $lbuji2 = $this->db->get_where('data_uji',['nim'=>$hasill['nim']])->row_array();
        $pt=$this->db->get_where('hasil',['nim'=>$hasill['nim']])->row_array();
              $tabel.= '
                  <tr bgcolor="#ffffff">
                 
                  <td style="text-align:center;bgcolor=#d3dce3;">'.$lbuji2['label'].'</td>
                  <td style="text-align:center;bgcolor=#d3dce3;">'.$hasil_akhir.'</td>
                  <td style="text-align:center;bgcolor=#d3dce3;">'.$pt['t'].'</td>
                  <td style="text-align:center;bgcolor=#d3dce3;">'.$pt['p'].'</td>
                 
                  </tr>';
       
        }

 
        $tabel.='</tbody></table><br><br>';

         $tabel.= '<br> <center><h1>Matrix</h1></center><table>
                            
                  <tr bgcolor="#ffffff">
                 
                  <th>label</th>
                  <th>Prediksi</th>
                  </tr>
                  
                      <tbody>';
    $matrix=$this->db->get('data_uji',12)->result_array();
    foreach ($matrix as $m) {
    $tabel.= '
                      <tr bgcolor="#ffffff">
                      <td style="text-align:center">'.$m['label'].'</td>
                      <td style="text-align:center">'.$m['matrix'].'</td>
                      </tr>';
                    }


        $tabel.='</tbody></table><br><br>';

        $tabel.= '<br><br><br><br><br><br> <center><h1>Hasil Perhitingan Confunction Matrix</h1></center><table>
                            
                  <tr bgcolor="#ffffff">
                  <th></th>
                  <th>Puas</th>
                  <th>Tidak Puas</th>
                  </tr>
                  
                  <tbody>';
        $pt=$this->db->query("SELECT count('nim') as haslipt FROM `data_uji`WHERE label='Puas' AND matrix='Tidak Puas'")->row_array();
        $pp=$this->db->query("SELECT count('nim') as haslipp FROM `data_uji`WHERE label='Puas' AND matrix='Puas'")->row_array();
        $tp=$this->db->query("SELECT count('nim') as haslitp FROM `data_uji`WHERE label='Tidak Puas' AND matrix='Puas'")->row_array();
        $tt=$this->db->query("SELECT count('nim') as haslitt FROM `data_uji`WHERE label='Tidak Puas' AND matrix='Tidak Puas'")->row_array();
           $tabel.= '
                  <tr bgcolor="#ffffff">
                  <td style="text-align:center">Puas</td>
                  <td style="text-align:center">'.$pp['haslipp'].'</td>
                  <td style="text-align:center">'.$pt['haslipt'].'</td>
                  </tr> 
                   <tr bgcolor="#ffffff">
                  <td style="text-align:center">Tidak Puas</td>
                  <td style="text-align:center">'.$tp['haslitp'].'</td>
                  <td style="text-align:center">'.$tt['haslitt'].'</td>
                  </tr>';
        $tabel.='</tbody></table><br><br>';
        $has=($pp['haslipp']+$tt['haslitt'])/($pp['haslipp']+$pt['haslipt']+$tp['haslitp']+$tt['haslitt']);
       $tabel.='Hasil Akurasi = '.$has;


        $pdf->writeHTML($tabel); 
        $pdf->Output('Naive-Bayes.pdf', 'I');

      
  }
  public function docx(){

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    $section->addText('Hello World !' ,array('name' => 'Times New Roman', 'size' => 12));
    
    $writer = new Word2007($phpWord);
    
    $filename = 'simple';
    
    header('Content-Type: application/msword');
          header('Content-Disposition: attachment;filename="'. $filename .'.docx"'); 
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
  

  }
  
  
}