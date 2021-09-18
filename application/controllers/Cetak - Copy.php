<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;


class Cetak extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');

   
  }
  public function pdf()
  {

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
        // $pdf->Write(0, 'Simpan ke PDF - Jaranguda.com', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('');
        $siswa=$this->db->get('m_siswa')->row_array();
        $tabel = 'Data Test  : 80'.'<br>'.
                 'Data Uji : '.$siswa['kelas'].'<br>'.
                 'Jumlah Data voting';
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