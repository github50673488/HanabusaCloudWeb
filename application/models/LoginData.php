<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginData
 *
 * @author Administrator
 */
class LoginData extends CI_Model {
    //put your code here
    var $title   = '1';
    var $content = '2';
    var $date    = '3';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        return $this->title.$this->content.'111';
    }
}
