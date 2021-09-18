<?php



 function pesan($to,$url){  
     
   
    $ci =& get_instance();
    $ci->load->library('email');
    $ci->load->library('encryption');
        //  $email = '';
        //  $p='';
         //    Logo';
       $e ="";
       $pp="";
    // $p=$s['password'];
    // $e=$s['email'];
    // $t=$s['title'];
    // $to ="";
        
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => $e,
            'smtp_pass' =>  $pp,
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
$data['key']=$url;
  $msg=$ci->load->view('validasi/email',$data,true);
     $ci->email->initialize($config);

   
     $ci->email->from('', 'Validasi Account');
     $ci->email->to($to);
     $ci->email->subject('Validasi Account');
     $ci->email->message($msg);
        //$ci->email->attach('/home/not/Pictures/phoenix_logo.png');

        if ($ci->email->send()) {
            
           $ci->load->view('validasi/cekMail');
            
            return true;
           
        } else {
            echo $ci->email->print_debugger();
            die;
        }
    }


