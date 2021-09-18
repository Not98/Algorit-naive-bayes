<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_algo');
    // $this->load->model('');
  }

  function index()
  {

    $this->m_algo->hitung();
  }
  function hitung(){
    $this->m_algo->algo();
  }
  public function transfor(){
    $this->m_algo->tranformasi();
  }
}
