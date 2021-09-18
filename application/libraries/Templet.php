<?php

Class Templet{
    var $templet_data=[];
    function set($name, $value){
        $this->templet_data[$name] = $value;
    }

    function load($templet = '', $view = '' , $view_data = array(), $return = FALSE ){
        $ci = get_instance();
        $this->set('contens', $ci->load->view($view,$view_data,true));
        return $ci->load->view($templet,$this->templet_data, $return);
    }

}