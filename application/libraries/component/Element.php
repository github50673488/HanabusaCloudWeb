<?php
//function __autoload($class_name) { require_once  APPPATH.'component/'.$class_name.'.php'; }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Element
 *
 * @author Administrator
 */
abstract class Element {
    public $ID;
    public $Name;
    public $Class;
    public $Text;
    public $Width;
    public abstract function Render();
}
