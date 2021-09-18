<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Block extends CI_Controller {

    public function index()
    {
        $this->load->view('templet/block');
    }

}

/* End of file Block.php */
